<?php

namespace App\Controllers\Admin;

use App\Models\TransactionType;
use Core\Controller;

class TransactionTypeController extends Controller
{
    public function index()
    {
        $transactionTypeModel = new TransactionType();
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();

        $viewData = [
            'transactionTypes' => $transactionTypes,
            'pagetitle' => 'مدیریت انواع تراکنش'
        ];

        $this->view('admin/transaction_types/index', $viewData, 'admin');
    }

    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description']
        ];

        $transactionTypeModel = new TransactionType();
        $transactionTypeModel->createTransactionType($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'نوع تراکنش با موفقیت ایجاد شد.']);
    }

    public function update($id)
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description']
        ];

        $transactionTypeModel = new TransactionType();
        $transactionTypeModel->updateTransactionType($id, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'نوع تراکنش با موفقیت ویرایش شد.']);
    }

    public function delete($id)
    {
        $transactionTypeModel = new TransactionType();
        $transactionTypeModel->deleteTransactionType($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'نوع تراکنش با موفقیت حذف شد.']);
    }
}
