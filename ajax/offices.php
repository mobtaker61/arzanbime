<?php
require_once '../config.php';
require_once '../models/Office.php';

header('Content-Type: application/json');

$officeModel = new Office($conn);
$province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 0;
$offices = $officeModel->getOfficesByProvinceId($province_id);

echo json_encode($offices);
?>
