<?php

namespace App\Controllers\Admin;

use App\Models\TransactionType;
use Core\Controller;
use Core\Middleware;
use Core\View;

class TransactionTypeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index()
    {
        $transactionTypeModel = new TransactionType();
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();

        View::render('admin/transaction-types/index', [
            'transactionTypes' => $transactionTypes,
            'pagetitle' => 'مدیریت انواع تراکنش'
        ], 'admin');
    }

    public function create()
    {
        View::render('admin/transaction-types/create', [
            'pagetitle' => 'افزودن نوع تراکنش جدید'
        ], 'admin');
    }

    public function edit($id)
    {
        $transactionTypeModel = new TransactionType();
        $transactionType = $transactionTypeModel->getTransactionTypeById($id);
        
        if (!$transactionType) {
            $this->redirect('/admin/transaction-types');
            return;
        }
        
        View::render('admin/transaction-types/edit', [
            'transactionType' => $transactionType,
            'pagetitle' => 'ویرایش نوع تراکنش'
        ], 'admin');
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
