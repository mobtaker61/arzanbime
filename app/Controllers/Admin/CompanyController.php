<?php

namespace App\Controllers\Admin;

use App\Models\Company;
use Core\Controller;
use Core\Middleware;
use Core\View;
use Exception;

class CompanyController extends Controller {
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index() {
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();
        
        View::render('admin/companies/index', [
            'companies' => $companies,
            'pagetitle' => 'مدیریت شرکت‌ها'
        ], 'admin');
    }

    public function getCompanyDetails($companyId) {
        $companyModel = new Company();
        $company = $companyModel->getCompanyById($companyId);

        header('Content-Type: application/json');
        echo json_encode($company);
    }

    public function create() {
        View::render('admin/companies/create', [
            'pagetitle' => 'افزودن شرکت جدید'
        ], 'admin');
    }

    public function store() {
        try {
            $data = [
                'logo' => '',
                'icon' => '',
                'name' => $_POST['name'],
                'intro' => $_POST['intro'],
                'shareholders' => $_POST['shareholders'],
                'contract_file' => '',
                'tariffs_images' => [],
                'color' => $_POST['color'],
                'sort' => $_POST['sort'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0,
            ];

            if ($_FILES['logo']['name']) {
                $data['logo'] = $this->uploadFile($_FILES['logo']);
            }

            if ($_FILES['icon']['name']) {
                $data['icon'] = $this->uploadFile($_FILES['icon']);
            }

            if ($_FILES['contract_file']['name']) {
                $data['contract_file'] = $this->uploadFile($_FILES['contract_file']);
            }

            if (isset($_POST['tariffs_images'])) {
                $data['tariffs_images'] = json_decode($_POST['tariffs_images'], true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON in tariffs_images');
                }
            }

            $companyModel = new Company();
            $companyModel->createCompany($data);
            $this->sendJsonResponse(['success' => true, 'message' => 'Company created successfully.']);
        } catch (Exception $e) {
            $this->sendJsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function edit($id) {
        $companyModel = new Company();
        $company = $companyModel->getCompanyById($id);
        
        View::render('admin/companies/edit', [
            'company' => $company,
            'pagetitle' => 'ویرایش شرکت'
        ], 'admin');
    }

    public function update($id) {
        try {
            $data = [
                'logo' => '',
                'icon' => '',
                'name' => $_POST['name'],
                'intro' => $_POST['intro'],
                'shareholders' => $_POST['shareholders'],
                'contract_file' => '',
                'tariffs_images' => [],
                'color' => $_POST['color'],
                'sort' => $_POST['sort'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0,
            ];

            if ($_FILES['logo']['name']) {
                $data['logo'] = $this->uploadFile($_FILES['logo']);
            } else {
                $data['logo'] = $_POST['existing_logo'];
            }

            if ($_FILES['icon']['name']) {
                $data['icon'] = $this->uploadFile($_FILES['icon']);
            } else {
                $data['icon'] = $_POST['existing_icon'];
            }

            if ($_FILES['contract_file']['name']) {
                $data['contract_file'] = $this->uploadFile($_FILES['contract_file']);
            } else {
                $data['contract_file'] = $_POST['existing_contract_file'];
            }

            if (isset($_POST['tariffs_images'])) {
                $data['tariffs_images'] = json_decode($_POST['tariffs_images'], true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON in tariffs_images');
                }
            } else {
                $data['tariffs_images'] = json_decode($_POST['existing_tariffs_images'], true);
            }

            $companyModel = new Company();
            $companyModel->updateCompany($id, $data);
            $this->sendJsonResponse(['success' => true, 'message' => 'Company updated successfully.']);
        } catch (Exception $e) {
            $this->sendJsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete($id) {
        try {
            $companyModel = new Company();
            $companyModel->deleteCompany($id);
            $this->sendJsonResponse(['success' => true, 'message' => 'Company deleted successfully.']);
        } catch (Exception $e) {
            $this->sendJsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function uploadFile($file) {
        $targetDir = "public/uploads/";
        $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $uniqueFileName = uniqid() . '.' . $fileType;
        $targetFile = $targetDir . $uniqueFileName;

        // Check if file already exists
        if (file_exists($targetFile)) {
            throw new Exception("Sorry, file already exists.");
        }

        // Check file size
        if ($file["size"] > 5000000) {
            throw new Exception("Sorry, your file is too large.");
        }

        // Allow certain file formats
        $allowedFormats = ['jpg', 'png', 'jpeg', 'gif', 'pdf','xlsx'];
        if (!in_array($fileType, $allowedFormats)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG, GIF, XLSX and PDF files are allowed.");
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return "/" . $targetFile;
        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }
    }

    private function sendJsonResponse($response) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}