<?php
require_once '../config.php';
require_once '../models/Content.php';

$contentModel = new Content($conn);
$contents = $contentModel->getAllContents();

include '../views/home.php';
?>
