<?php

namespace App\Controllers\Admin;

use App\Models\Quotation;
use App\Models\Followup;
use App\Models\User;
use App\Models\Tariff;
use Core\Controller;

class QuotationController extends Controller {
    public function index() {
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
            'pagetitle' => 'مدیریت درخواستها'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->view('admin/quotations/quotation_table', $viewData, false); 
        } else {
            $this->view('admin/quotations/index', $viewData, 'admin');
        }
    }

    public function detail($id) {
        $quotationModel = new Quotation();
        $followupModel = new Followup();
        $userModel = new User();

        $quotation = $quotationModel->getQuotation($id);
        $followups = $followupModel->getFollowupsByQuotationId($id);
        $adminUsers = $userModel->getAdminUsers();

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
            'adminUsers' => $adminUsers
        ];

        $this->view('admin/quotations/detail', $viewData, false);
    }
    
    public function showOffers($id) {
        $quotationModel = new Quotation();
        $tariffModel = new Tariff();

        $quotation = $quotationModel->getQuotation($id);
        $tariffs = $tariffModel->getTariffsByAge($quotation['age']);

        $viewData = [
            'quotation' => $quotation,
            'tariffs' => $tariffs,
            'pagetitle' => 'Offers'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->view('admin/quotations/offer_modal_content', $viewData, false);
        } else {
            $this->view('admin/quotations/offers', $viewData, 'admin');
        }
    }

    public function store() {
        $data = [
            'tel' => $_POST['tel'],
            'birth_date' => $_POST['birth_date'],
            'age' => $_POST['age'],
            'duration' => $_POST['duration'],
            'status' => $_POST['status']
        ];

        $quotationModel = new Quotation();
        $quotationModel->createQuotation(
            $data['tel'], 
            $data['birth_date'], 
            $data['age'], 
            $data['duration'],
            $data['status']
        );
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Quotation created successfully.']);
    }

    public function addFollowup() {
        $data = [
            'quotation_id' => $_POST['quotation_id'],
            'date' => $_POST['date'],
            'responsible_user' => $_POST['responsible_user'],
            'comment' => $_POST['comment'],
            'refer_to' => $_POST['refer_to'],
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
}
?>