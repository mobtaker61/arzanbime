<?php

namespace App\Controllers;

use App\Models\Office;
use Core\Controller;


class OfficeController extends Controller {
    public function getOfficesByProvince($provinceId) {
        $officeModel = new Office();
        $offices = $officeModel->getOfficesByProvinceId($provinceId);

        header('Content-Type: application/json');
        echo json_encode($offices);
    }
}
