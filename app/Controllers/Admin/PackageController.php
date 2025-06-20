<?php

namespace App\Controllers\Admin;

use App\Models\Package;
use App\Models\Company;
use App\Models\Tariff;
use Core\Controller;
use Core\Middleware;
use Core\View;

class PackageController extends Controller {
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index() {
        $packageModel = new Package();
        $companyModel = new Company();

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 15;
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
   
    public function addAges($packageId) {
        $tariffModel = new Tariff();
    
        // Check if there are any existing records for this package
        $existingTariffs = $tariffModel->getTariffsByPackage($packageId);
    
        if (empty($existingTariffs)) {
            // If no records exist, insert ages 0 to 70
            for ($age = 0; $age <= 70; $age++) {
                $tariffModel->createTariff($packageId, $age, 0, 0, 0);
            }
    
            $limit = 10;
            $page = 1;
            $offset = ($page - 1) * $limit;
            $sortField = 'id';
            $sortOrder = 'ASC';
        
            $tariffs = $tariffModel->getTariffsByPackageId($packageId, $limit, $offset, $sortField, $sortOrder);
            $totalTariffs = $tariffModel->getTariffCountByPackageId($packageId);
        
            $viewData = [
                'tariffs' => $tariffs,
                'totalTariffs' => $totalTariffs,
                'limit' => $limit,
                'page' => $page,
                'sortField' => $sortField,
                'sortOrder' => $sortOrder,
                'companyId' => null,
                'packageId' => $packageId
            ];
        
            ob_start();
            extract($viewData); // Extract variables for use in the included file
            include realpath(__DIR__ . '/../views/admin/tariffs/tariff_table.php');
            $html = ob_get_clean();
        
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Ages added successfully.', 'html' => $html]);
        }else{
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'تعرفه سنها قبلا موجود است']);
        }
    }   
    
    public function tariffs($packageId) {
        $tariffModel = new Tariff();
    
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';
    
        $tariffs = $tariffModel->getTariffsByPackageId($packageId, $limit, $offset, $sortField, $sortOrder);
        $totalTariffs = $tariffModel->getTariffCountByPackageId($packageId);
    
        $viewData = [
            'tariffs' => $tariffs,
            'totalTariffs' => $totalTariffs,
            'limit' => $limit,
            'page' => $page,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'companyId' => null,
            'packageId' => $packageId
        ];
    
        ob_start();
        extract($viewData); // Extract variables for use in the included file
        include realpath(__DIR__ . '/../../views/admin/tariffs/tariff_table.php');
        $html = ob_get_clean();
    
        header('Content-Type: text/html');
        echo $html;
    }

    public function create() {
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();
        
        View::render('admin/packages/create', [
            'companies' => $companies,
            'pagetitle' => 'افزودن پکیج جدید'
        ], 'admin');
    }

    public function store() {
        $data = [
            'company_id' => $_POST['company_id'],
            'tip' => $_POST['tip'],
            'discount_rate' => $_POST['discount_rate'],
            'sort' => $_POST['sort'],
            'color' => $_POST['color'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $packageModel = new Package();
        $packageModel->createPackage($data);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Package created successfully.']);
    }

    public function edit($id) {
        $packageModel = new Package();
        $package = $packageModel->getPackageById($id);
        
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();
        
        View::render('admin/packages/edit', [
            'package' => $package,
            'companies' => $companies,
            'pagetitle' => 'ویرایش پکیج'
        ], 'admin');
    }

    public function update($id) {
        $data = [
            'company_id' => $_POST['company_id'],
            'tip' => $_POST['tip'],
            'discount_rate' => $_POST['discount_rate'],
            'sort' => $_POST['sort'],
            'color' => $_POST['color'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $packageModel = new Package();
        $packageModel->updatePackage($id, $data);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Package updated successfully.']);
    }

    public function delete($id) {
        $packageModel = new Package();
        $packageModel->deletePackage($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Package deleted successfully.']);
    }

    public function viewByCompany($companyId) {
        $packageModel = new Package();
        $packages = $packageModel->getPackagesByCompany($companyId);
    
        header('Content-Type: application/json');
        echo json_encode(['packages' => $packages,'pagetitle' => 'پکیج های شرکت']);
    }
    
    private function sendJsonResponse($response) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
