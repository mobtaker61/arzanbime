<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Quotation;
use App\Models\User;
use Core\Controller;
use Core\Security;
use Core\View;
use Core\IMVerify;

class AuthController extends Controller
{
    private $imVerify;
    public function __construct()
    {
        parent::__construct();
        $this->imVerify = new IMVerify();
    }

    public function showLoginForm()
    {
        View::render('public/auth/login', ['pagetitle' => 'Login'], 'public');
    }

    public function login()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User();
        if ($user->login($username, $password)) {
            $this->notify($username . ' is logged.', ['telegram']);
            header('Location: /' . $_SESSION['user_role']);
            exit(); // Ensure no further code is executed after the redirection
        } else {
            View::render('public/auth/login', ['error' => 'نام کاربری یا رمز عبور اشتباه است', 'pagetitle' => 'ورود کاربر'], 'public');
        }
    }

    public function showRegisterForm()
    {
        View::render('public/auth/register', ['pagetitle' => 'Register'], 'public');
    }

    public function register()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $data = $this->getUserDataFromRequest();

        $user = new User();
        if ($user->isUsernameOrTelExists($data['username'], $data['tel'], $data['email'])) {
            View::render('public/auth/register', ['error' => 'نام کاربری، ایمیل یا تلفن قبلا ثبت شده است', 'pagetitle' => 'ثبت نام کاربر'], 'public');
            return;
        }

        $userId = $user->register($data);
        $this->createUserProfile($userId, $data);

        header('Location: /login');
        exit();
    }

    public function logout()
    {
        $user = new User();
        $user->logout();
        header('Location: /');
        exit();
    }

    private function getUserDataFromRequest()
    {
        return [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'tel' => $_POST['tel'],
            'email' => $_POST['email'],
            'birth_date' => $_POST['birth'],
            'role' => $_POST['role'] ?? 'user'
        ];
    }

    private function createUserProfile($userId, $data)
    {
        $profileData = [
            'user_id' => $userId,
            'profile_image' => '',
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'phone' => $data['tel'],
            'is_verified' => 0
        ];

        $profile = new Profile();
        $profile->createProfile($profileData);
    }

    public function showResetPasswordForm()
    {
        View::render('public/auth/reset_password', ['pagetitle' => 'Reset Password'], 'public');
    }

    public function resetPassword()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $email = $_POST['email'];

        $user = new User();
        $token = $user->generatePasswordResetToken($email);
        if ($token) {
            mail($email, "Password Reset", "Here is your password reset token: $token");
            View::render('public/auth/reset_password', ['message' => 'Check your email for the reset token.', 'pagetitle' => 'Reset Password'], 'public');
        } else {
            View::render('public/auth/reset_password', ['error' => 'Email not found.', 'pagetitle' => 'Reset Password'], 'public');
        }
    }

    public function showNewPasswordForm()
    {
        View::render('public/auth/new_password', ['pagetitle' => 'New Password'], 'public');
    }

    public function setNewPassword()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        $user = new User();
        if ($user->resetPassword($token, $newPassword)) {
            header('Location: /login');
            exit();
        } else {
            View::render('public/auth/new_password', ['error' => 'Invalid token or password reset failed.', 'pagetitle' => 'New Password'], 'public');
        }
    }

    public function sendOTP()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $tel = preg_replace('/\s+/', '', $data['tel']); // Remove spaces

        $_SESSION['quotation_data'] = [
            'birth_date' => $data['birth'],
            'age' => $data['age'],
            'duration' => $data['duration'],
            'tel' => $tel,
            'role' => 'user',            
            'user_level_id' => 2,
            'user_id' => null,
            'status' => 'NEW'
        ];

        if ($this->imVerify->send($tel)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send OTP']);
        }
    }

    public function verifyOTP()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $otp = $data['otp'];

        if ($this->imVerify->checkIsValid($otp)) {
            $quotationModel = new Quotation();
            $quotationData = $_SESSION['quotation_data'];
            $quotationData['user_id'] = $quotationData['user_id'] ?? $this->createUserFromQuotationData($quotationData);

            $uid = $quotationModel->createQuotation($quotationData);

            $this->notify('استعلام جدید در: ' . PHP_EOL . json_encode($_SESSION['quotation_data']) . PHP_EOL . PHP_EOL . 'https://arzanbime.com/offers/' . $uid, ['telegram']);
            $this->imVerify->send($quotationData['tel'], 'نتیجه استعلام شما در آدرس ' . 'https://arzanbime.com/offers/' . $uid);

            unset($_SESSION['quotation_data']);
            echo json_encode(['success' => true, 'redirect' => "/offers/$uid"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    public function storeQuotationData()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $_SESSION['quotation_data'] = [
            'birth' => $data['birth'],
            'age' => $data['age'],
            'duration' => $data['duration'],
            //            'tel' => preg_replace('/\s+/', '', $data['tel']),
            'user_id' => $data['user_id'] ?? $_SESSION['user_id'],
        ];

        $quotationModel = new Quotation();
        $quotationData = $_SESSION['quotation_data'];

        $uid = $quotationModel->createQuotation($quotationData);

        $profile = new Profile();
        $tel = $profile->getProfileByUserId($_SESSION['user_id']);

        $this->notify('استعلام جدید در: ' . PHP_EOL . json_encode($_SESSION['quotation_data']) . PHP_EOL . PHP_EOL . 'https://arzanbime.com/offers/' . $uid, ['telegram']);
        $this->imVerify->send($tel['phone'], 'نتیجه استعلام شما در آدرس ' . 'https://arzanbime.com/offers/' . $uid);

        echo json_encode(['success' => true, 'redirect' => "/offers/$uid"]);
    }

    public function checkTel()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $tel = preg_replace('/\s+/', '', $data['tel']);

        $profileModel = new Profile();
        $profile = $profileModel->getProfileByPhone($tel);

        if ($profile) {
            $_SESSION['user_id'] = $profile[0]['user_id'];
            $_SESSION['user_role'] = 'user';
            echo json_encode(['exists' => true, 'user_id' => $profile[0]['user_id']]);
        } else {
            echo json_encode(['exists' => false]);
        }
    }

    private function createUserFromQuotationData($quotationData)
    {
        $user = new User();
        $profile = new Profile();

        $username = $quotationData['tel'];
        $password = password_hash($username, PASSWORD_BCRYPT);

        $userId = $user->register([
            'username' => $username,
            'password' => $password,
            'role' => 'user',
            'user_level_id' => 2,//بعدا باید از جدول تنطیمات خوانده شود
            'is_active' => 1
        ]);

        $profileData = [
            'user_id' => $userId,
            'profile_image' => '',
            'name' => '',
            'surname' => '',
            'birth_date' => $quotationData['birth'],
            'email' => null,
            'phone' => $quotationData['tel'],
            'is_verified' => 1
        ];

        $profile->createProfile($profileData);

        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = 'user';

        return $userId;
    }
}
