<?php

namespace App\Controllers\Admin;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Order;
use App\Models\User;
use App\Models\Broker;
use Core\Controller;
use Core\Middleware;
use Core\View;

class TransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index()
    {
        $transactionModel = new Transaction();
        $transactionTypeModel = new TransactionType();
        $orderModel = new Order();
        $userModel = new User();
        $brokerModel = new Broker();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'DESC';
        $filterDateStart = isset($_GET['date_start']) ? $_GET['date_start'] : null;
        $filterDateEnd = isset($_GET['date_end']) ? $_GET['date_end'] : null;
        $filterUserId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $filterBrokerId = isset($_GET['broker_id']) ? $_GET['broker_id'] : null;

        $transactions = $transactionModel->getAllTransactions($limit, $offset, $sortField, $sortOrder, $filterDateStart, $filterDateEnd, $filterUserId, $filterBrokerId);
        $totalTransactions = $transactionModel->getTransactionCount($filterDateStart, $filterDateEnd, $filterUserId, $filterBrokerId);
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        $orders = $orderModel->getAllOrders();
        $users = $userModel->getAllUsers();
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
            'filterUserId' => $filterUserId,
            'filterBrokerId' => $filterBrokerId,
            'transactionTypes' => $transactionTypes,
            'orders' => $orders,
            'users' => $users,
            'brokers' => $brokers,
            'pagetitle' => 'مدیریت تراکنش‌ها'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            View::render('admin/transactions/transaction_table', $viewData, false);
        } else {
            $this->view('admin/transactions/index', $viewData, 'admin');
        }
    }

    public function store()
    {
        $data = [
            'transaction_date' => $_POST['transaction_date'],
            'transaction_type_id' => $_POST['transaction_type_id'],
            'order_id' => $_POST['order_id'] ?? null,
            'user_id' => $_POST['user_id'],
            'description' => $_POST['description'],
            'debit' => $_POST['debit'],
            'credit' => $_POST['credit']
        ];

        $transactionModel = new Transaction();
        $transactionModel->createTransaction($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Transaction created successfully.']);
    }

    public function update($id)
    {
        $data = [
            'transaction_date' => $_POST['transaction_date'],
            'transaction_type_id' => $_POST['transaction_type_id'],
            'order_id' => !empty($_POST['order_id']) ? $_POST['order_id'] : null,
            'user_id' => $_POST['user_id'],
            'description' => $_POST['description'],
            'debit' => $_POST['debit'],
            'credit' => $_POST['credit']
        ];
    
        $transactionModel = new Transaction();
        $transactionModel->updateTransaction($id, $data);
    
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'تراکنش با موفقیت ویرایش شد.']);
    }
    

    public function edit($id)
    {
        $transactionModel = new Transaction();
        $transactionTypeModel = new TransactionType();
        $orderModel = new Order();
        $userModel = new User();
        $brokerModel = new Broker();
    
        $transaction = $transactionModel->getTransactionById($id);
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        $orders = $orderModel->getAllOrders();
        $users = $userModel->getAllUsers();
        $brokers = $brokerModel->getAllBrokers();
    
        $viewData = [
            'transaction' => $transaction,
            'transactionTypes' => $transactionTypes,
            'orders' => $orders,
            'users' => $users,
            'brokers' => $brokers,
            'pagetitle' => 'ویرایش تراکنش'
        ];
    
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'transaction' => $transaction, 'transactionTypes' => $transactionTypes, 'orders' => $orders, 'users' => $users, 'brokers' => $brokers]);
    }
    

    public function destroy($id)
    {
        $transactionModel = new Transaction();
        $transactionModel->deleteTransaction($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Transaction deleted successfully.']);
    }

    public function create()
    {
        $transactionTypeModel = new TransactionType();
        $transactionTypes = $transactionTypeModel->getAllTransactionTypes();
        
        View::render('admin/transactions/create', [
            'transactionTypes' => $transactionTypes,
            'pagetitle' => 'افزودن تراکنش جدید'
        ], 'admin');
    }
}
