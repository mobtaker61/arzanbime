<?php
class PackageController extends Controller {
    public function index() {
        $packageModel = new Package();
        $companyModel = new Company();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) && strtolower($_GET['sortOrder']) === 'desc' ? 'DESC' : 'ASC';

        $company_id = isset($_GET['company_id']) ? intval($_GET['company_id']) : null;

        $packages = $packageModel->getPackages($limit, $offset, $sortField, $sortOrder, $company_id);
        $totalPackages = $packageModel->getPackageCount($company_id);
        $companies = $companyModel->getAllCompanies();

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->view('admin/packages/package_table', [
                'packages' => $packages,
                'totalPackages' => $totalPackages,
                'limit' => $limit,
                'page' => $page,
                'sortField' => $sortField,
                'sortOrder' => $sortOrder,
                'companies' => $companies,
                'selectedCompany' => $company_id
            ], false);
        } else {
            $this->view('admin/packages/index', [
                'packages' => $packages,
                'totalPackages' => $totalPackages,
                'limit' => $limit,
                'page' => $page,
                'sortField' => $sortField,
                'sortOrder' => $sortOrder,
                'companies' => $companies,
                'selectedCompany' => $company_id,
                'pagetitle' => 'مدیریت پکیجها'
            ], 'admin');
        }
    }

    public function create() {
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();
        $this->view('admin/packages/create', ['companies' => $companies,'pagetitle' => 'پکیج جدید'], 'admin');
    }

    public function store() {
        $data = [
            'company_id' => $_POST['company_id'],
            'tip' => $_POST['tip'],
            'discount_rate' => $_POST['discount_rate'],
            'sort' => $_POST['sort'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $packageModel = new Package();
        if ($packageModel->createPackage($data)) {
            $this->sendJsonResponse(['success' => true, 'message' => 'Package created successfully.']);
        } else {
            $this->sendJsonResponse(['success' => false, 'message' => 'Failed to create package.']);
        }
    }

    public function edit($id) {
        $packageModel = new Package();
        $package = $packageModel->getPackageById($id);
        $this->sendJsonResponse($package);
    }

    public function update($id) {
        $data = [
            'company_id' => $_POST['company_id'],
            'tip' => $_POST['tip'],
            'discount_rate' => $_POST['discount_rate'],
            'sort' => $_POST['sort'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $packageModel = new Package();
        if ($packageModel->updatePackage($id, $data)) {
            $this->sendJsonResponse(['success' => true, 'message' => 'Package updated successfully.']);
        } else {
            $this->sendJsonResponse(['success' => false, 'message' => 'Failed to update package.']);
        }
    }

    public function delete($id) {
        $packageModel = new Package();
        if ($packageModel->deletePackage($id)) {
            $this->sendJsonResponse(['success' => true, 'message' => 'Package deleted successfully.']);
        } else {
            $this->sendJsonResponse(['success' => false, 'message' => 'Failed to delete package.']);
        }
    }

    public function viewByCompany($company_id) {
        $packageModel = new Package();
        $packages = $packageModel->getPackagesByCompany($company_id);
        $this->view('admin/packages/index', ['packages' => $packages,'pagetitle' => 'پکیج های شرکت'], 'admin');
    }

    private function sendJsonResponse($response) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
