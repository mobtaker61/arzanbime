<?php
require_once '../config.php';
require_once '../models/Content.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$contentModel = new Content($conn);
$content = $contentModel->getContentById($id);

include '../views/content.php';
?>