<?php

namespace App\Controllers\Admin;

use Core\Middleware;
use App\Models\Broker;
use Core\Controller;
use Core\View;

class BrokerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index()
    {
        $brokerModel = new Broker();
        $brokers = $brokerModel->getAllBrokers();
        
        View::render('admin/brokers/index', [
            'brokers' => $brokers,
            'pagetitle' => 'مدیریت بروکرها'
        ], 'admin');
    }

    public function create()
    {
        View::render('admin/brokers/create', [
            'pagetitle' => 'افزودن بروکر جدید'
        ], 'admin');
    }

    public function edit($id)
    {
        $brokerModel = new Broker();
        $broker = $brokerModel->getBrokerById($id);
        
        View::render('admin/brokers/edit', [
            'broker' => $broker,
            'pagetitle' => 'ویرایش بروکر'
        ], 'admin');
    }

    public function store()
    {
        $data = [
            'title' => $_POST['title'],
            'manager' => $_POST['manager'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'email' => $_POST['email']
        ];

        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
            $data['logo'] = $this->uploadLogo($_FILES['logo']);
        } else {
            $data['logo'] = null;
        }

        $brokerModel = new Broker();
        $brokerModel->createBroker($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Broker created successfully.']);
    }

    public function update($id)
    {
        $data = [
            'title' => $_POST['title'],
            'manager' => $_POST['manager'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'email' => $_POST['email']
        ];

        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
            $data['logo'] = $this->uploadLogo($_FILES['logo']);
        } else {
            // Keep the existing logo if a new one is not uploaded
            $brokerModel = new Broker();
            $existingBroker = $brokerModel->getBrokerById($id);
            $data['logo'] = $existingBroker['logo'];
        }

        $brokerModel = new Broker();
        $brokerModel->updateBroker($id, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Broker updated successfully.']);
    }

    public function delete($id)
    {
        $brokerModel = new Broker();
        $brokerModel->deleteBroker($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Broker deleted successfully.']);
    }

    private function uploadLogo($file)
    {
        $uploadDir = 'public/uploads/logos/';
        $fileName = basename($file['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return $targetFilePath;
        } else {
            throw new \Exception('Failed to upload file.');
        }
    }
}
