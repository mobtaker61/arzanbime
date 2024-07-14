<?php

namespace App\Controllers\Admin;

use App\Models\BrokerTransaction;
use App\Models\TransactionType;
use App\Models\Broker;
use App\Models\Order;
use Core\Controller;
use Core\View;

class BrokerTransactionController extends Controller
{
    public function index()
    {
        $brokerTransactionModel = new BrokerTransaction();
        $transactionTypeModel = new TransactionType();
        $brokerModel = new Broker();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'DESC';
        $filterDateStart = isset($_GET['date_start']) ? $_GET['date_start'] : null;
        $filterDateEnd = isset($_GET['date_end']) ? $_GET['date_end'] : null;
        $filterBrokerId = isset($_GET['broker_id']) ? $_GET['broker_id'] : null;

        $transactions = $brokerTransactionModel->getAllBrokerTransactions($limit, $offset, $sortField, $sortOrder, $filterDateStart, $filterDateEnd, $filterBrokerId);
        $totalTransactions = $brokerTransactionModel->getBrokerTransactionCount($filterDateStart, $filterDateEnd, $filterBrokerId);

        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        $brokers = $brokerModel->getAllBrokers();

        $viewData = [
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions,
            'limit' => $limit,
            'page' => $page,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'filterDateStart' => $filterDateStart,
            'filterDateEnd' => $filterDateEnd,
            'filterBrokerId' => $filterBrokerId,
            'transactionTypes' => $transactionTypes,
            'brokers' => $brokers,
            'pagetitle' => 'مدیریت تراکنش‌های بروکر'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            View::render('admin/broker_transactions/broker_transaction_table', $viewData, false);
        } else {
            $this->view('admin/broker_transactions/index', $viewData, 'admin');
        }
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

    public function edit($id)
    {
        $brokerTransactionModel = new BrokerTransaction();
        $transaction = $brokerTransactionModel->getBrokerTransactionById($id);

        header('Content-Type: application/json');
        echo json_encode($transaction);
    }
}
