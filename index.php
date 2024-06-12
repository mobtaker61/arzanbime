<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'autoload.php'; // Include custom autoloader

$router = new Core\Router();
require 'routes/web.php';

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
