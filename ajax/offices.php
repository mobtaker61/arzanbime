<?php
require_once '../config.php';
require_once '../models/Office.php';

$province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 0;

$officeModel = new Office($conn);
$offices = $province_id ? $officeModel->getOfficesByProvinceId($province_id) : [];

echo json_encode($offices);
?>
