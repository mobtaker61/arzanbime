<?php

namespace App\Controllers;

use App\Models\Quotation;
use App\Models\Followup;
use Core\Controller;

class QuotationController extends Controller {
    public function index() {
        $quotationModel = new Quotation();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'DESC';
        $filterTel = isset($_GET['tel']) ? $_GET['tel'] : '';
        $filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

        $quotations = $quotationModel->getAllQuotations($limit, $offset, $sortField, $sortOrder, $filterTel, $filterStatus);
        $totalQuotations = $quotationModel->getQuotationCount($filterTel, $filterStatus);

        $this->view('public/quotations/index', [
            'quotations' => $quotations,
            'totalQuotations' => $totalQuotations,
            'limit' => $limit,
            'page' => $page,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'filterTel' => $filterTel,
            'filterStatus' => $filterStatus,
            'pagetitle' => 'درخواستها'
        ]);
    }

    public function show($id) {
        $quotationModel = new Quotation();
        $followupModel = new Followup();

        $quotation = $quotationModel->getQuotation($id);
        $followups = $followupModel->getFollowupsByQuotationId($id);

        $this->view('public/quotations/show', [
            'quotation' => $quotation,
            'followups' => $followups
        ]);
    }
}
