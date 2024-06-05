<?php
require_once BASE_PATH . '/config.php';
require_once BASE_PATH . '/models/Content.php';
require_once BASE_PATH . '/models/Office.php';

$contentModel = new Content($conn);
$officeModel = new Office($conn);

$contents = $contentModel->getAllContents();
$provinces = $officeModel->getAllProvinces();
$province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 0;
$offices = $province_id ? $officeModel->getOfficesByProvinceId($province_id) : [];
$latestHelpContents = $contentModel->getLatestHelpContents(3);

$title = 'Home';
$metaDescription = 'Welcome to My Blog Site where you can find the latest notices and help articles.';
$metaKeywords = 'home, blog, notices, help articles';
$view = 'home_content.php';
include BASE_PATH . '/views/layout.php';
?>
