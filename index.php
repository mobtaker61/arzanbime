<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

س// Debug pre-session info
error_log("PRE-SESSION: Request URI: " . $_SERVER['REQUEST_URI']);

// Session configuration - MUST be before session_start()
ini_set('session.gc_maxlifetime', 86400 * 30); // 30 days
ini_set('session.cookie_lifetime', 86400 * 30); // 30 days
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Debug session information
error_log("Session status in index.php: " . session_status());
error_log("Session ID in index.php: " . session_id());
error_log("Session data in index.php: " . print_r($_SESSION, true));

// Check if we have a user_id but no user_role (possible session issue)
if (isset($_SESSION['user_id']) && !isset($_SESSION['user_role'])) {
    error_log("WARNING: user_id exists but user_role is missing - attempting to fix");
    
    // Include necessary files to resolve the issue
    require_once __DIR__ . '/app/Models/User.php';
    require_once __DIR__ . '/core/Model.php';
    
    // Try to recover the user role
    $userModel = new App\Models\User();
    $user = $userModel->getUserById($_SESSION['user_id']);
    if ($user && isset($user['role'])) {
        $_SESSION['user_role'] = $user['role'];
        error_log("FIXED: Set user_role to " . $user['role']);
    }
}

// Autoload classes
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Autoload core classes
spl_autoload_register(function ($class) {
    $prefix = 'Core\\';
    $base_dir = __DIR__ . '/core/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Load user data if session exists
if (isset($_SESSION['user_id'])) {
    Core\Middleware::loadUserData();
}

// Debug session after user data is loaded
error_log("Session after loadUserData: " . print_r($_SESSION, true));

$router = new Core\Router();
require 'routes/web.php';

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
