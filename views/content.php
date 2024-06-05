<?php
$title = htmlspecialchars($content['title']);
$metaDescription = htmlspecialchars(substr($content['body'], 0, 160));
$metaKeywords = 'content, blog, ' . htmlspecialchars($content['title']);
$view = 'content_content.php';
include BASE_PATH . '/views/layout.php';
?>