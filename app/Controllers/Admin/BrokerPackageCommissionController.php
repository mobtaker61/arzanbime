<?php

namespace App\Controllers\Admin;

use Core\Middleware;
use App\Models\Broker;
use App\Models\Package;
use App\Models\BrokerPackageCommission;
use Core\Controller;

class BrokerPackageCommissionController extends Controller {
    public function __construct() {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index() {
        $commissionModel = new BrokerPackageCommission();
        $brokerModel = new Broker();
        $packageModel = new Package();

        $search = $_GET['search'] ?? '';
        $limit = $_GET['limit'] ?? 10;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $commissions = $commissionModel->getAllCommissions($limit, $offset, $search);
        $totalCommissions = $commissionModel->getCommissionCount($search);
        $brokers = $brokerModel->getAllBrokers();
        $packages = $packageModel->getAllPackages();

        $this->view('admin/commissions/index', [
            'commissions' => $commissions,
            'totalCommissions' => $totalCommissions,
            'limit' => $limit,
            'page' => $page,
            'search' => $search,
            'brokers' => $brokers,
            'packages' => $packages,
            'pagetitle' => 'مدیریت کمیسیون‌ها'
        ], 'admin');
    }

    public function store() {
        $data = [
            'broker_id' => $_POST['broker_id'],
            'package_id' => $_POST['package_id'],
            'commission_rate' => $_POST['commission_rate']
        ];

        $commissionModel = new BrokerPackageCommission();
        $commissionModel->createCommission($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Commission created successfully.']);
    }

    public function edit($id) {
        $commissionModel = new BrokerPackageCommission();
        $commission = $commissionModel->getCommissionById($id);

        header('Content-Type: application/json');
        echo json_encode($commission);
    }

    public function update($id) {
        $data = [
            'broker_id' => $_POST['broker_id'],
            'package_id' => $_POST['package_id'],
            'commission_rate' => $_POST['commission_rate']
        ];

        $commissionModel = new BrokerPackageCommission();
        $commissionModel->updateCommission($id, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Commission updated successfully.']);
    }

    public function delete($id) {
        $commissionModel = new BrokerPackageCommission();
        $commissionModel->deleteCommission($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Commission deleted successfully.']);
    }
}
