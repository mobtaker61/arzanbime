<?php
require_once BASE_PATH . '/config.php';
require_once BASE_PATH . '/models/Content.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$contentModel = new Content($conn);
$content = $contentModel->getContentById($id);

include BASE_PATH . '/views/content.php';
?>
