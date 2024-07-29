<?php

namespace App\Controllers\Admin;

use App\Models\Broker;
use App\Models\BrokerTransaction;
use App\Models\Order;
use App\Models\Quotation;
use App\Models\Transaction;
use App\Models\User;
use Core\Controller;
use Core\IMVerify;
use Core\Middleware;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();   // Ensure user is authenticated
        Middleware::admin();  // Ensure user is admin
    }

    public function dashboard()
    {
        $orderModel = new Order();
        $quotationModel = new Quotation();
        $transactionModel = new Transaction();
        $brokerTransactionModel = new BrokerTransaction();

        $newOrdersCount = $orderModel->getNewOrdersCount();
        $newQuotationsCount = $quotationModel->getNewQuotationsCount();
        $userBalance = $transactionModel->getUsersBalance();
        $brokerBalance = $brokerTransactionModel->getBrokersBalance();

        // Get last 5 orders and quotations
        $lastOrders = $orderModel->getAllOrders(5, 0, 'created_at', 'DESC');
        $lastQuotations = $quotationModel->getAllQuotations(5, 0, 'created_at', 'DESC');

        // Get users with upcoming birthdays
        $startDate = date('Y-m-d', strtotime('-2 days'));
        $endDate = date('Y-m-d', strtotime('+7 days'));
        $userModel = new User();
        $usersWithUpcomingBirthdays = $userModel->getUsersWithUpcomingBirthdays($startDate, $endDate);

        // Get orders expiring soon using existing getAllOrders method
        $startDate = date('Y-m-d', strtotime("-10 days"));
        $endDate = date('Y-m-d', strtotime("+60 days"));
        $ordersExpiringSoon = $orderModel->getAllOrders(100, 0, 'end_date', 'ASC', $startDate, $endDate);        

        // Prepare view data
        $viewData = [
            'user' => $_SESSION['user_data'],
            'newOrdersCount' => $newOrdersCount,
            'newQuotationsCount' => $newQuotationsCount,
            'userBalance' => $userBalance,
            'brokerBalance' => $brokerBalance,
            'lastOrders' => $lastOrders,
            'lastQuotations' => $lastQuotations,
            'usersWithUpcomingBirthdays' => $usersWithUpcomingBirthdays,
            'ordersExpiringSoon' => $ordersExpiringSoon,
            'pagetitle' => 'داشبورد ادمین'
        ];

        $this->view('admin/dashboard', $viewData, 'admin');
    }

    public function getChartData()
    {
        $days = isset($_GET['days']) ? intval($_GET['days']) : 7;

        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime("-$days days"));

        $orderModel = new Order();
        $transactionModel = new Transaction();
        $brokerTransactionModel = new BrokerTransaction();
        $quotationModel = new Quotation();

        $dates = $orderModel->generateDateRange($startDate, $endDate);
        $data = $orderModel->getOrderData($startDate, $endDate);

        $totalSales = $transactionModel->getTotalDebit($startDate, $endDate);
        $totalExpenses = $brokerTransactionModel->getTotalCredit($startDate, $endDate);
        $totalOrders = $orderModel->getTotalFinishedOrders($startDate, $endDate);
        $totalQuotations = $quotationModel->getTotalQuotations($startDate, $endDate);

        header('Content-Type: application/json');
        echo json_encode([
            'dates' => $dates,
            'data' => $data,
            'totalSales' => $totalSales,
            'totalExpenses' => $totalExpenses,
            'totalOrders' => $totalOrders,
            'totalQuotations' => $totalQuotations
        ]);
    }

    public function getBrokers()
    {
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        header('Content-Type: application/json');
        echo json_encode($brokers);
    }

    public function getUsers()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function storeBrokerTransaction()
    {
        $transactionData = [
            'transaction_date' => date('Y-m-d'),
            'transaction_type_id' => 2, // Payment type ID
            'broker_id' => $_POST['select_id'],
            'description' => 'پرداخت',
            'credit' => $_POST['amount'],
            'debit' => 0
        ];

        $brokerTransactionModel = new BrokerTransaction();
        $brokerTransactionModel->createBrokerTransaction($transactionData);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Broker transaction created successfully.']);
    }

    public function storeUserTransaction()
    {
        $transactionData = [
            'transaction_date' => date('Y-m-d'),
            'transaction_type_id' => 2, // Payment type ID
            'user_id' => $_POST['select_id'],
            'description' => 'پرداخت',
            'credit' => $_POST['amount'],
            'debit' => 0
        ];

        $transactionModel = new Transaction();
        $transactionModel->createTransaction($transactionData);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'User transaction created successfully.']);
    }

    public function sendSMS()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $phone = $input['phone'];
            $message = $input['message'];

            $imVerify = new IMVerify();
            $success = $imVerify->send($phone, $message);

            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
        }
    }
}
