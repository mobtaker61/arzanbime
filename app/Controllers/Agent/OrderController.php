<?php

namespace App\Controllers\Agent;

use Core\View;
use Core\Middleware;
use App\Models\Order;
use App\Models\Client;
use App\Models\Package;
use App\Models\Broker;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController
{
    public function __construct()
    {
        Middleware::auth();
        Middleware::agent();
    }

    public function index()
    {
        $agent_id = $_SESSION['user_id'];
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $filterDateStart = $_GET['date_start'] ?? '';
        $filterDateEnd = $_GET['date_end'] ?? '';
        $filterBroker = $_GET['broker'] ?? '';

        $orderModel = new Order();
        $orders = $orderModel->getAgentOrders(
            $agent_id,
            $limit,
            $offset,
            $filterDateStart,
            $filterDateEnd,
            $filterBroker
        );

        $totalOrders = $orderModel->getAgentOrdersCount(
            $agent_id,
            $filterDateStart,
            $filterDateEnd,
            $filterBroker
        );

        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllActive();

        // Get clients for this agent
        $clientModel = new Client();
        $clients = $clientModel->getClientsByAgent($agent_id);

        // Get packages
        $packageModel = new Package();
        $packages = $packageModel->getAllActive();

        View::render('agent/orders/index', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'page' => $page,
            'limit' => $limit,
            'brokers' => $brokers,
            'clients' => $clients,
            'packages' => $packages,
            'filterDateStart' => $filterDateStart,
            'filterDateEnd' => $filterDateEnd,
            'filterBroker' => $filterBroker,
            'pagetitle' => 'سفارشات'
        ], 'admin');
    }

    public function edit($id)
    {
        $agent_id = $_SESSION['user_id'];
        $orderModel = new Order();
        $order = $orderModel->getAgentOrderById($agent_id, $id);

        if (!$order) {
            echo json_encode(['success' => false]);
            return;
        }

        echo json_encode([
            'success' => true,
            'order' => $order
        ]);
    }

    public function update($id)
    {
        try {
            $agent_id = $_SESSION['user_id'];
            $orderModel = new Order();
            $order = $orderModel->getAgentOrderById($agent_id, $id);

            if (!$order) {
                echo json_encode(['success' => false, 'message' => 'سفارش یافت نشد']);
                return;
            }

            $data = [
                'client_id' => $_POST['client_id'],
                'package_id' => $_POST['package_id'],
                'duration' => $_POST['duration'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'tariff' => $_POST['tariff'],
                'payment' => $_POST['payment'],
                'auxiliary_info' => $_POST['auxiliary_info'] ?? '',
                'broker_id' => $_POST['broker_id'],
                'status' => $_POST['status']
            ];

            if ($orderModel->update($id, $data)) {
                echo json_encode(['success' => true, 'message' => 'سفارش با موفقیت بروزرسانی شد']);
            } else {
                echo json_encode(['success' => false, 'message' => 'خطا در بروزرسانی سفارش']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'خطا در بروزرسانی سفارش: ' . $e->getMessage()]);
        }
    }

    public function store()
    {
        try {
            $agent_id = $_SESSION['user_id'];
            $data = [
                'client_id' => $_POST['client_id'],
                'package_id' => $_POST['package_id'],
                'duration' => $_POST['duration'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'tariff' => $_POST['tariff'],
                'payment' => $_POST['payment'],
                'auxiliary_info' => $_POST['auxiliary_info'] ?? '',
                'broker_id' => $_POST['broker_id'],
                'operator_user_id' => $agent_id,
                'status' => 'New'
            ];

            $orderModel = new Order();
            if ($orderModel->create($data)) {
                echo json_encode(['success' => true, 'message' => 'سفارش با موفقیت ایجاد شد']);
            } else {
                echo json_encode(['success' => false, 'message' => 'خطا در ایجاد سفارش']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'خطا در ایجاد سفارش: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $agent_id = $_SESSION['user_id'];
        $orderModel = new Order();
        $order = $orderModel->getAgentOrderById($agent_id, $id);

        if (!$order) {
            echo json_encode(['success' => false, 'message' => 'سفارش یافت نشد']);
            return;
        }

        if ($order['status'] === 'Finished') {
            echo json_encode(['success' => false, 'message' => 'امکان حذف سفارش تکمیل شده وجود ندارد']);
            return;
        }

        if ($orderModel->delete($id)) {
            echo json_encode(['success' => true, 'message' => 'سفارش با موفقیت حذف شد']);
        } else {
            echo json_encode(['success' => false, 'message' => 'خطا در حذف سفارش']);
        }
    }

    public function export()
    {
        $agent_id = $_SESSION['user_id'];
        $filterDateStart = $_GET['date_start'] ?? '';
        $filterDateEnd = $_GET['date_end'] ?? '';
        $filterBroker = $_GET['broker'] ?? '';

        $orderModel = new Order();
        $orders = $orderModel->getAgentOrders(
            $agent_id,
            1000, // Increased limit for export
            0,
            $filterDateStart,
            $filterDateEnd,
            $filterBroker
        );

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set RTL direction for Persian text
        $sheet->setRightToLeft(true);

        // Set headers
        $headers = [
            'تاریخ',
            'نام کاربری',
            'نام و نام خانوادگی',
            'پکیج',
            'بروکر',
            'تعرفه',
            'پرداختی',
            'مدت',
            'تاریخ انقضاء',
            'وضعیت'
        ];

        // Write headers
        foreach ($headers as $index => $header) {
            $col = chr(65 + $index); // Convert number to letter (1=A, 2=B, etc)
            $sheet->setCellValue($col.'1', $header);
        }

        // Add data
        $row = 2;
        foreach ($orders as $order) {
            $status = match($order['status']) {
                'Finished' => 'تکمیل شده',
                'Following' => 'در حال پیگیری',
                'Rejected' => 'رد شده',
                'Canceled' => 'لغو شده',
                default => 'جدید'
            };

            $sheet->setCellValue('A'.$row, $order['order_date']);
            $sheet->setCellValue('B'.$row, $order['user_username']);
            $sheet->setCellValue('C'.$row, $order['user_name'] . ' ' . $order['user_surname']);
            $sheet->setCellValue('D'.$row, $order['package_name']);
            $sheet->setCellValue('E'.$row, $order['broker_name']);
            $sheet->setCellValue('F'.$row, $order['tariff']);
            $sheet->setCellValue('G'.$row, $order['payment']);
            $sheet->setCellValue('H'.$row, $order['duration'] . ' ساله');
            $sheet->setCellValue('I'.$row, $order['end_date']);
            $sheet->setCellValue('J'.$row, $status);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="orders.xlsx"');
        header('Cache-Control: max-age=0');

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
} 