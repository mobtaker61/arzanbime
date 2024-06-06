<?php
class CompanyController extends Controller {
    public function index() {
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();
        $this->view('admin/companies/index', ['companies' => $companies], 'admin');
    }

    public function create() {
        $this->view('admin/companies/create', [], 'admin');
    }

    public function store() {
        try {
            $data = [
                'logo' => '',
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
        $company['tariffs_images'] = json_decode($company['tariffs_images'], true); // Decode JSON to array
        $this->view('admin/companies/edit', ['company' => $company], 'admin');
    }

    public function update($id) {
        try {
            $data = [
                'logo' => '',
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
        if ($file["size"] > 500000) {
            throw new Exception("Sorry, your file is too large.");
        }

        // Allow certain file formats
        $allowedFormats = ['jpg', 'png', 'jpeg', 'gif', 'pdf'];
        if (!in_array($fileType, $allowedFormats)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.");
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
