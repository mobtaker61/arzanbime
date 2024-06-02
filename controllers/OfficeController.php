<?php
require_once BASE_PATH . '/config.php';
require_once BASE_PATH . '/models/Office.php';

$province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 0;

$officeModel = new Office($conn);
$provinces = $officeModel->getAllProvinces();
$offices = $province_id ? $officeModel->getOfficesByProvinceId($province_id) : [];

include BASE_PATH . '/views/offices.php';
?>
