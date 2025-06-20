<?php

namespace App\Controllers\Admin;

use Core\Middleware;
use App\Models\Broker;
use App\Models\Package;
use App\Models\BrokerPackageCommission;
use Core\Controller;
use Core\View;

class BrokerPackageCommissionController extends Controller {
    public function __construct() {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index() {
        $commissionModel = new BrokerPackageCommission();
        $commissions = $commissionModel->getAllCommissions(10, 0);
        
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        $packageModel = new Package();
        $packages = $packageModel->getAllPackages();
        
        View::render('admin/broker-package-commissions/index', [
            'commissions' => $commissions,
            'brokers' => $brokers,
            'packages' => $packages,
            'pagetitle' => 'مدیریت کمیسیون‌های بسته کارگزاران'
        ], 'admin');
    }

    public function create()
    {
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        $packageModel = new Package();
        $packages = $packageModel->getAllPackages();
        
        View::render('admin/broker-package-commissions/create', [
            'brokers' => $brokers,
            'packages' => $packages,
            'pagetitle' => 'افزودن کمیسیون بسته جدید'
        ], 'admin');
    }

    public function edit($id)
    {
        $commissionModel = new BrokerPackageCommission();
        $commission = $commissionModel->getCommissionById($id);
        
        if (!$commission) {
            $this->redirect('/admin/broker-package-commissions');
            return;
        }
        
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        $packageModel = new Package();
        $packages = $packageModel->getAllPackages();
        
        View::render('admin/broker-package-commissions/edit', [
            'commission' => $commission,
            'brokers' => $brokers,
            'packages' => $packages,
            'pagetitle' => 'ویرایش کمیسیون بسته'
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
