<?php
require_once BASE_PATH . '/config.php';
require_once BASE_PATH . '/models/Content.php';

$contentModel = new Content($conn);
$contents = $contentModel->getAllContents();

include BASE_PATH . '/views/home.php';
?>
