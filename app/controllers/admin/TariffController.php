<?php

namespace App\Controllers\Admin;

use App\Models\Tariff;
use App\Models\Company;
use App\Models\Package;
use Core\Controller;

class TariffController extends Controller {
    public function index() {
        $tariffModel = new Tariff();
        $companyModel = new Company();
        $packageModel = new Package();

        $companies = $companyModel->getAllCompanies();
        $packages = $packageModel->getAllPackages();

        $companyId = isset($_GET['company_id']) ? intval($_GET['company_id']) : null;
        $packageId = isset($_GET['package_id']) ? intval($_GET['package_id']) : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 25;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';

        $tariffs = $tariffModel->getTariffs($companyId, $packageId, $limit, $offset, $sortField, $sortOrder);
        $totalTariffs = $tariffModel->getTariffCount($companyId, $packageId);

        $viewData = [
            'tariffs' => $tariffs,
            'totalTariffs' => $totalTariffs,
            'limit' => $limit,
            'page' => $page,
            'companies' => $companies,
            'packages' => $packages,
            'companyId' => $companyId,
            'packageId' => $packageId,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'pagetitle' => 'تعرفه ها'
        ];

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->view('admin/tariffs/tariff_table', $viewData, false); // No layout for AJAX
        } else {
            $this->view('admin/tariffs/index', $viewData, 'admin');
        }
    }

    public function store() {
        $data = [
            'package_id' => $_POST['package_id'],
            'age' => $_POST['age'],
            'first_year' => $_POST['first_year'],
            'second_year' => $_POST['second_year'],
            'two_year' => $_POST['two_year']
        ];

        $tariffModel = new Tariff();
        $tariffModel->createTariff(
            $data['package_id'], 
            $data['age'], 
            $data['first_year'], 
            $data['second_year'], 
            $data['two_year']
        );
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Tariff created successfully.']);
    }

    public function edit($id) {
        $tariffModel = new Tariff();
        $tariff = $tariffModel->getTariffById($id);
    
        header('Content-Type: application/json');
        echo json_encode($tariff);
    }

    public function update($id) {
        $data = [
            'package_id' => $_POST['package_id'],
            'age' => $_POST['age'],
            'first_year' => $_POST['first_year'],
            'second_year' => $_POST['second_year'],
            'two_year' => $_POST['two_year']
        ];

        $tariffModel = new Tariff();
        $tariffModel->updateTariff($id, $data);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Tariff updated successfully.']);
    }

    public function updateField($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $first_year = $data['first_year'];
        $second_year = $data['second_year'];
        $two_year = $data['two_year'];
    
        $tariffModel = new Tariff();
        $result = $tariffModel->updateField($id, $first_year, $second_year, $two_year);
    
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    public function setTariff() {
        $data = json_decode(file_get_contents('php://input'), true);
        $packageId = $data['package_id'];
        $startAge = $data['start_age'];
        $endAge = $data['end_age'];
        $firstYear = $data['first_year'];
        $secondYear = $data['second_year'];
        $twoYear = $firstYear + $secondYear;

        $tariffModel = new Tariff();
        $result = $tariffModel->setTariffForAgeRange($packageId, $startAge, $endAge, $firstYear, $secondYear, $twoYear);

        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Tariff set successfully.']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to set tariff.']);
        }
    }
       
    public function delete($id) {
        $tariffModel = new Tariff();
        $tariffModel->deleteTariff($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Tariff deleted successfully.']);
    }
}
