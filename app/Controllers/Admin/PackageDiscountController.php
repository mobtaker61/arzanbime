<?php
namespace App\Controllers\Admin;

use App\Models\PackageDiscount;
use App\Models\Package;
use App\Models\UserLevel;
use Core\Controller;

class PackageDiscountController extends Controller {
    public function index() {
        $packageDiscountModel = new PackageDiscount();
        $packageDiscounts = $packageDiscountModel->getAllPackageDiscounts();
        $packageModel = new Package();
        $packages = $packageModel->getAllPackages();
        $userLevelModel = new UserLevel();
        $userLevels = $userLevelModel->getAllUserLevels();
        $this->view('admin/package_discounts/index', [
            'packageDiscounts' => $packageDiscounts,
            'packages' => $packages,
            'userLevels' => $userLevels,
            'pagetitle' => 'مدیریت تخفیف‌های بسته‌ها'
        ], 'admin');
    }

    public function store() {
        $data = [
            'package_id' => $_POST['package_id'],
            'user_level_id' => $_POST['user_level_id'],
            'discount_rate' => $_POST['discount_rate']
        ];

        $packageDiscountModel = new PackageDiscount();
        $result = $packageDiscountModel->createPackageDiscount($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    public function edit($id) {
        $packageDiscountModel = new PackageDiscount();
        $packageDiscount = $packageDiscountModel->getPackageDiscountById($id);

        header('Content-Type: application/json');
        echo json_encode($packageDiscount);
    }

    public function update($id) {
        $data = [
            'package_id' => $_POST['package_id'],
            'user_level_id' => $_POST['user_level_id'],
            'discount_rate' => $_POST['discount_rate']
        ];

        $packageDiscountModel = new PackageDiscount();
        $result = $packageDiscountModel->updatePackageDiscount($id, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    public function delete($id) {
        $packageDiscountModel = new PackageDiscount();
        $result = $packageDiscountModel->deletePackageDiscount($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}
