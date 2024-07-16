<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\Models\Broker;
use App\Models\BrokerTransaction;
use App\Models\Package;
use App\Models\Profile;
use App\Models\Tariff;
use App\Models\Transaction;
use Core\Controller;
use Core\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController extends Controller
{
    public function index()
    {
        $orderModel = new Order();
        $userModel = new User();
        $profileModel = new Profile();
        $packageModel = new Package();
        $brokerModel = new Broker();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'DESC';
        $filterDateStart = isset($_GET['date_start']) ? $_GET['date_start'] : '';
        $filterDateEnd = isset($_GET['date_end']) ? $_GET['date_end'] : '';
        $filterOperator = isset($_GET['operator']) ? $_GET['operator'] : '';
        $filterBroker = isset($_GET['broker']) ? $_GET['broker'] : '';

        $orders = $orderModel->getAllOrders($limit, $offset, $sortField, $sortOrder, $filterDateStart, $filterDateEnd, $filterOperator, $filterBroker);
        $totalOrders = $orderModel->getOrderCount($filterDateStart, $filterDateEnd, $filterOperator, $filterBroker);

        $operators = $userModel->getAllUsers();
        $packages = $packageModel->getAllPackages();
        $brokers = $brokerModel->getAllBrokers();

        $viewData = [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'limit' => $limit,
            'page' => $page,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'filterDateStart' => $filterDateStart,
            'filterDateEnd' => $filterDateEnd,
            'filterOperator' => $filterOperator,
            'filterBroker' => $filterBroker,
            'operators' => $operators,
            'packages' => $packages,
            'brokers' => $brokers,
            'pagetitle' => 'مدیریت سفارشات'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            View::render('admin/orders/order_table', $viewData, false);
        } else {
            $this->view('admin/orders/index', $viewData, 'admin');
        }
    }

    public function store()
    {
        $orderData = [
            'order_date' => date('Y-m-d'),
            'operator_user_id' => $_POST['operator_user_id'],
            'user_id' => $_POST['user_id'],
            'package_id' => $_POST['package_id'],
            'auxiliary_info' => $_POST['auxiliary_info'],
            'duration' => $_POST['duration'],
            'end_date' => $_POST['end_date'],
            'tariff' => $_POST['tariff'],
            'payment' => $_POST['payment'],
            'broker_id' => $_POST['broker_id'],
            'status' => $_POST['status']
        ];

        $orderModel = new Order();
        $orderId = $orderModel->createOrder($orderData);

        $profileModel = new Profile();
        $userProfile = $profileModel->getProfileByUserId($_POST['user_id']);
        $descText = $userProfile['name'] . ' ' . $userProfile['surname'] . ' - سفارش ' . $orderId;

        // ایجاد تراکنش برای کاربر اپراتور
        $transactionData = [
            'transaction_date' => date('Y-m-d'),
            'transaction_type_id' => 1, // نوع تراکنش باید مشخص شود
            'order_id' => $orderId,
            'broker_id' => $_POST['broker_id'],
            'user_id' => $_POST['operator_user_id'],
            'description' => $descText,
            'debit' => $_POST['payment'],
            'credit' => 0
        ];

        $this->notify($descText, ['telegram']);
        $transactionModel = new Transaction();
        $transactionModel->createTransaction($transactionData);

        // ایجاد تراکنش برای بروکر
        $brokerTransactionData = [
            'transaction_date' => date('Y-m-d'),
            'transaction_type_id' => 2, // نوع تراکنش باید مشخص شود
            'broker_id' => $_POST['broker_id'],
            'order_id' => $orderId,
            'description' => $descText,
            'debit' => 0,
            'credit' => $_POST['payment']
        ];

        $brokerTransactionModel = new BrokerTransaction();
        $brokerTransactionModel->createBrokerTransaction($brokerTransactionData);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Order created successfully.']);
    }

    public function getPackagesByBroker($brokerId)
    {
        $packageModel = new Package();
        $packages = $packageModel->getPackagesByBroker($brokerId);

        header('Content-Type: application/json');
        echo json_encode($packages);
    }

    public function exportToExcel()
    {
        $orderModel = new Order();

        $filterDateStart = isset($_GET['date_start']) ? $_GET['date_start'] : '';
        $filterDateEnd = isset($_GET['date_end']) ? $_GET['date_end'] : '';
        $filterOperator = isset($_GET['operator_user_id']) ? intval($_GET['operator_user_id']) : '';
        $filterBroker = isset($_GET['broker_id']) ? intval($_GET['broker_id']) : '';

        $orders = $orderModel->getAllOrders(1000, 0, 'id', 'ASC', $filterDateStart, $filterDateEnd, $filterOperator, $filterBroker);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $headers = [
            'کد', 'Order Date', 'Operator Username', 'Operator Name', 'Operator Surname', 'User Username', 'User Name', 'User Surname',
            'Package Name', 'Broker Name', 'Duration', 'End Date', 'Tariff', 'Payment', 'Status', 'Additional Info'
        ];

        $col = 'A';
        $sheet->setCellValue($col . '1', 'تست');
        $sheet->setCellValue($col . '2', 'تاریخ' . date('Y-m-d_H-i-s'));
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $col++;
        }

        // Fill data
        $row = 4;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order['id'],);
            $sheet->setCellValue('B' . $row, $order['order_date']);
            $sheet->setCellValue('C' . $row, $order['operator_username']);
            $sheet->setCellValue('D' . $row, $order['operator_name']);
            $sheet->setCellValue('E' . $row, $order['operator_surname']);
            $sheet->setCellValue('F' . $row, $order['user_username']);
            $sheet->setCellValue('G' . $row, $order['user_name']);
            $sheet->setCellValue('H' . $row, $order['user_surname']);
            $sheet->setCellValue('I' . $row, $order['package_name']);
            $sheet->setCellValue('J' . $row, $order['broker_name']);
            $sheet->setCellValue('K' . $row, $order['duration']);
            $sheet->setCellValue('L' . $row, $order['end_date']);
            $sheet->setCellValue('M' . $row, $order['tariff']);
            $sheet->setCellValue('N' . $row, $order['payment']);
            $sheet->setCellValue('O' . $row, $order['status']);
            $sheet->setCellValue('P' . $row, $order['additional_info']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'orders_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Expires: Fri, 11 Nov 2011 11:11:11 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

}
