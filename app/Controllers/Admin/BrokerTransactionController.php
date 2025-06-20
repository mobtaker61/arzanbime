<?php

namespace App\Controllers\Admin;

use App\Models\BrokerTransaction;
use App\Models\TransactionType;
use App\Models\Broker;
use App\Models\Order;
use Core\Controller;
use Core\Middleware;
use Core\View;

class BrokerTransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index()
    {
        $brokerTransactionModel = new BrokerTransaction();
        $transactions = $brokerTransactionModel->getAllBrokerTransactions();
        
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        $transactionTypeModel = new TransactionType();
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        
        View::render('admin/broker-transactions/index', [
            'transactions' => $transactions,
            'brokers' => $brokers,
            'transactionTypes' => $transactionTypes,
            'pagetitle' => 'مدیریت تراکنش‌های کارگزاران'
        ], 'admin');
    }

    public function create()
    {
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        $transactionTypeModel = new TransactionType();
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        
        View::render('admin/broker-transactions/create', [
            'brokers' => $brokers,
            'transactionTypes' => $transactionTypes,
            'pagetitle' => 'افزودن تراکنش کارگزار جدید'
        ], 'admin');
    }

    public function edit($id)
    {
        $brokerTransactionModel = new BrokerTransaction();
        $transaction = $brokerTransactionModel->getBrokerTransactionById($id);
        
        if (!$transaction) {
            $this->redirect('/admin/broker-transactions');
            return;
        }
        
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        $transactionTypeModel = new TransactionType();
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        
        View::render('admin/broker-transactions/edit', [
            'transaction' => $transaction,
            'brokers' => $brokers,
            'transactionTypes' => $transactionTypes,
            'pagetitle' => 'ویرایش تراکنش کارگزار'
        ], 'admin');
    }

    public function store()
    {
        $data = [
            'transaction_date' => $_POST['transaction_date'],
            'transaction_type_id' => $_POST['transaction_type_id'],
            'broker_id' => $_POST['broker_id'],
            'order_id' => $_POST['order_id'] ?? null,
            'description' => $_POST['description'],
            'debit' => $_POST['debit'],
            'credit' => $_POST['credit']
        ];

        $brokerTransactionModel = new BrokerTransaction();
        $brokerTransactionModel->createBrokerTransaction($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'تراکنش بروکر با موفقیت ایجاد شد.']);
    }

    public function update($id)
    {
        $data = [
            'transaction_date' => $_POST['transaction_date'],
            'transaction_type_id' => $_POST['transaction_type_id'],
            'broker_id' => $_POST['broker_id'],
            'order_id' => $_POST['order_id'] ?? null,
            'description' => $_POST['description'],
            'debit' => $_POST['debit'],
            'credit' => $_POST['credit']
        ];

        $brokerTransactionModel = new BrokerTransaction();
        $brokerTransactionModel->updateBrokerTransaction($id, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'تراکنش بروکر با موفقیت ویرایش شد.']);
    }
}
