<?php
// Get the route from the URL
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Define the routes
switch ($route) {
    case 'home':
        require_once BASE_PATH . '/controllers/HomeController.php';
        break;
    case 'content':
        require_once BASE_PATH . '/controllers/ContentController.php';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
?>
