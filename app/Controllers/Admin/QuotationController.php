<?php

namespace App\Controllers\Admin;

use App\Models\Quotation;
use App\Models\Followup;
use App\Models\Profile;
use App\Models\User;
use App\Models\Tariff;
use Core\Controller;
use Core\IMVerify;
use Core\View;

class QuotationController extends Controller
{
    private $imVerify;
    public function __construct()
    {
        parent::__construct();
        $this->imVerify = new IMVerify();
    }
    public function index()
    {
        $quotationModel = new Quotation();
        $userModel = new User();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'DESC';
        $filterTel = isset($_GET['tel']) ? $_GET['tel'] : '';
        $filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

        $quotations = $quotationModel->getAllQuotations($limit, $offset, $sortField, $sortOrder, $filterTel, $filterStatus);
        $totalQuotations = $quotationModel->getQuotationCount($filterTel, $filterStatus);
        $adminUsers = $userModel->getAdminUsers();
        $users = $userModel->getAllUsers();  // Fetch all users

        $viewData = [
            'quotations' => $quotations,
            'totalQuotations' => $totalQuotations,
            'limit' => $limit,
            'page' => $page,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'filterTel' => $filterTel,
            'filterStatus' => $filterStatus,
            'adminUsers' => $adminUsers,
            'users' => $users,  // Pass users to view
            'pagetitle' => 'مدیریت درخواستها'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            View::render('admin/quotations/quotation_table', $viewData, false);
        } else {
            $this->view('admin/quotations/index', $viewData, 'admin');
        }
    }

    public function detail($id)
    {
        $quotationModel = new Quotation();
        $followupModel = new Followup();
        $tariffModel = new Tariff();
        $userModel = new User();

        $quotation = $quotationModel->getQuotation($id);
        $followups = $followupModel->getFollowupsByQuotationId($id);
        $adminUsers = $userModel->getAdminUsers();
        $tariffs = $tariffModel->getTariffsByAge($quotation['age']);
        $userLevelId = $quotation['user_level_id']; // فرض می‌کنیم که سطح کاربر در داده‌های استعلام موجود است

        // Calculate discounts and payable amounts
        foreach ($tariffs as &$tariff) {
            $discountRate = $tariffModel->getPackageDiscount($tariff['package_id'], $userLevelId);
            if ($discountRate === null) {
                $discountRate = 0;
            }
            $commissionRate = $discountRate / 100;
            $tariff['discount_rate'] = intval($discountRate);
            $tariff['first_year_discount'] = intval($tariff['first_year'] * $commissionRate);
            $tariff['two_year_discount'] = intval($tariff['two_year'] * $commissionRate);
            $tariff['first_year_pay'] = intval($tariff['first_year'] - $tariff['first_year_discount']);
            $tariff['two_year_pay'] = intval($tariff['two_year'] - $tariff['two_year_discount']);            
        }

        $userMap = [];
        foreach ($adminUsers as $user) {
            $userMap[$user['id']] = $user['username'];
        }

        foreach ($followups as &$followup) {
            $followup['responsible_user'] = $userMap[$followup['responsible_user']] ?? $followup['responsible_user'];
            $followup['refer_to'] = $userMap[$followup['refer_to']] ?? $followup['refer_to'];
        }

        $viewData = [
            'quotation' => $quotation,
            'followups' => $followups,
            'adminUsers' => $adminUsers,
            'tariffs' => $tariffs,
            'pagetitle' => 'اطلاعات درخواست'
        ];
        ob_start();
        extract($viewData); // Extract variables for use in the included file
        include realpath(__DIR__ . '/../../views/admin/quotations/detail.php');
        $html = ob_get_clean();

        header('Content-Type: text/html');
        echo $html;
    }

    public function store()
    {
        $data = [
            'user_id' => $_POST['user_id'],
            'tel' => $_POST['tel'] ?? null,
            'birth_date' => $_POST['birth_date'],
            'age' => $_POST['age'],
            'duration' => $_POST['duration'] ?? 1,
            'status' => $_POST['status'] ?? 'New'
        ];

        $quotationModel = new Quotation();
        $quotationId = $quotationModel->createQuotation($data);

        $profile = new Profile();
        $tel = $profile->getProfileByUserId($_POST['user_id']);

        $this->imVerify->send($tel['phone'], 'نتیجه استعلام شما در آدرس ' . 'https://arzanbime.com/offers/' . $quotationId);
        $this->notify('استعلام جدید در: ' . PHP_EOL . 'https://arzanbime.com/offers/' . $quotationId, ['telegram']);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'quotation_id' => $quotationId, 'message' => 'Quotation created successfully.']);
    }

    public function addFollowup()
    {
        $data = [
            'quotation_id' => $_POST['quotation_id'],
            'date' => $_POST['date'],
            'responsible_user' => $_POST['responsible_user'],
            'comment' => $_POST['comment'],
            'refer_to' => isset($_POST['refer_to']) ?? null,
            'is_closed' => isset($_POST['is_closed']) ? 1 : 0,
        ];

        $followupModel = new Followup();
        $followupModel->createFollowup(
            $data['quotation_id'],
            $data['date'],
            $data['responsible_user'],
            $data['comment'],
            $data['refer_to'],
            $data['is_closed']
        );

        $followups = $followupModel->getFollowupsByQuotationId($data['quotation_id']);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Followup created successfully.', 'followups' => $followups]);
    }

    public function getProfile($userId)
    {
        $profileModel = new Profile();
        $profile = $profileModel->getProfileByUserId($userId);

        if ($profile) {
            header('Content-Type: application/json');
            echo json_encode($profile);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Profile not found']);
        }
    }

    public function updateProfile()
    {
        $profileModel = new Profile();
        $userId = $_POST['user_id'];
        $data = [
            'profile_image' => $_FILES['profile_image']['name'],  // Handle file upload accordingly
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'is_verified' => 1  // Example field, update as needed
        ];

        // Handle file upload
        if ($_FILES['profile_image']['tmp_name']) {
            $uploadDir = 'public/uploads/profiles/';
            $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile);
        }

        $profileModel->updateProfile($userId, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
    }

    public function checkOrCreateUser()
    {
        $userModel = new User();
        $profileModel = new Profile();

        $name = $_POST['name'] ?? null;
        $surname = $_POST['surname'] ?? null;
        $tel = $_POST['tel'] ?? null;
        $birth_date = $_POST['birth_date'] ?? null;
        $userId = $_POST['user_id'] ?? null;

        if ($userId) {
            // کاربر انتخاب شده است، برگرداندن user_id
            $response = ['success' => true, 'user_id' => $userId];
        } elseif ($tel) {
            // چک کردن وجود کاربر با شماره تلفن            
            $profile = $profileModel->getProfileByPhone($tel);
            if ($profile) {
                // کاربر موجود است، برگرداندن user_id
                $response = ['success' => true, 'user_id' => $profile[0]['user_id']];
            } else {
                // کاربر جدید ایجاد میشود
                $userData = [
                    'username' => $tel,
                    'password' => password_hash($tel, PASSWORD_DEFAULT), // مثال: رمزعبور همان شماره تلفن باشد
                    'role' => 'user',
                    'is_active' => 1
                ];
                $newUserId = $userModel->createUser($userData);
                $profileData = [
                    'user_id' => $newUserId,
                    'name' => $name,
                    'surname' => $surname,
                    'birth_date' => $birth_date,
                    'phone' => $tel,
                    'is_verified' => 1
                ];
                $profileModel->createProfile($profileData);
                $response = ['success' => true, 'user_id' => $newUserId];
            }
        } else {
            $response = ['success' => false, 'message' => 'Please enter a phone number or select a user.'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function manualQuotationForm()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        $viewData = [
            'pagetitle' => 'فرم استعلام دستی',
            'users' => $users
        ];
        $this->View('admin/quotations/manual', $viewData, 'admin');
    }

    public function getOffers($id)
    {
        $quotationModel = new Quotation();
        $tariffModel = new Tariff();


        // Fetch tariffs based on the quotation data
        $quotation = $quotationModel->getQuotation($id);
        $tariffs = $tariffModel->getTariffsByAge($quotation['age']);
        $userLevelId = $quotation['user_level_id'];

        foreach ($tariffs as &$tariff) {
            $discountRate = $tariffModel->getPackageDiscount($tariff['package_id'], $userLevelId);
            if ($discountRate === null) {
                $discountRate = 0;
            }
            $commissionRate = $discountRate / 100;
            $tariff['discount_rate'] = intval($discountRate);
            $tariff['first_year_discount'] = intval($tariff['first_year'] * $commissionRate);
            $tariff['two_year_discount'] = intval($tariff['two_year'] * $commissionRate);
            $tariff['first_year_pay'] = intval($tariff['first_year'] - $tariff['first_year_discount']);
            $tariff['two_year_pay'] = intval($tariff['two_year'] - $tariff['two_year_discount']);

            // Fetch highest commission and broker name
            $highestCommission = $tariffModel->getHighestCommission($tariff['package_id']);
            $tariff['highest_commission'] = intval($highestCommission['commission_rate']);
            $tariff['broker_name'] = $highestCommission['title'];

            // Calculate profit
            $profitRate = intval($tariff['highest_commission'] - $tariff['discount_rate']);
            $tariff['first_year_profit'] = intval($tariff['first_year'] * $profitRate / 100);
            $tariff['two_year_profit'] = intval($tariff['two_year'] * $profitRate / 100);
        }

        $viewData = [
            'quotation' => $quotation,
            'tariffs' => $tariffs,
            'pagetitle' => 'پیشنهادات'
        ];

        ob_start();
        extract($viewData);
        include realpath(__DIR__ . '/../../views/admin/quotations/offer_modal_content.php');
        $html = ob_get_clean();

        header('Content-Type: text/html');
        echo $html;
    }
}
