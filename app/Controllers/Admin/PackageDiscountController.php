<?php
namespace App\Controllers\Admin;

use App\Models\PackageDiscount;
use App\Models\Package;
use App\Models\UserLevel;
use Core\Controller;
use Core\Middleware;
use Core\View;

class PackageDiscountController extends Controller {
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index() {
        $packageDiscountModel = new PackageDiscount();
        $packageDiscounts = $packageDiscountModel->getAllPackageDiscounts();
        $packageModel = new Package();
        $packages = $packageModel->getAllPackages();
        $userLevelModel = new UserLevel();
        $userLevels = $userLevelModel->getAllUserLevels();
        View::render('admin/package-discounts/index', [
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
        
        if (!$packageDiscount) {
            $this->redirect('/admin/package-discounts');
            return;
        }
        
        View::render('admin/package-discounts/edit', [
            'packageDiscount' => $packageDiscount,
            'pagetitle' => 'ویرایش تخفیف بسته'
        ], 'admin');
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

    public function create()
    {
        View::render('admin/package-discounts/create', [
            'pagetitle' => 'افزودن تخفیف بسته جدید'
        ], 'admin');
    }
}
