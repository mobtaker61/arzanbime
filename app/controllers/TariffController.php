<?php
class TariffController extends Controller {
    public function index() {
        $tariffModel = new Tariff();
        $companyModel = new Company();
        $packageModel = new Package();

        $companies = $companyModel->getAllCompanies();
        $packages = $packageModel->getAllPackages();

        $companyId = isset($_GET['company_id']) ? intval($_GET['company_id']) : null;
        $packageId = isset($_GET['package_id']) ? intval($_GET['package_id']) : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';

        $tariffs = $tariffModel->getTariffs($companyId, $packageId, $limit, $offset, $sortField, $sortOrder);
        $totalTariffs = $tariffModel->getTariffCount($companyId, $packageId);

        $this->view('admin/tariffs/index', [
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
        ], 'admin');
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
        $tariffModel->createTariff($data);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Tariff created successfully.']);
    }

    public function edit($id) {
        $tariffModel = new Tariff();
        $tariff = $tariffModel->getTariffById($id);

        $packageModel = new Package();
        $packages = $packageModel->getAllPackages();

        $this->view('admin/tariffs/edit', ['tariff' => $tariff, 'packages' => $packages], false); // No layout for AJAX
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

    public function delete($id) {
        $tariffModel = new Tariff();
        $tariffModel->deleteTariff($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Tariff deleted successfully.']);
    }
}
