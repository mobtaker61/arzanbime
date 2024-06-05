<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'core/Router.php';
require 'core/Controller.php';
require 'core/Model.php';
require 'core/View.php';
require 'core/Security.php';
require 'core/Middleware.php';

require 'app/controllers/HomeController.php';
require 'app/controllers/AdminController.php';
require 'app/controllers/AuthController.php';
require 'app/controllers/UserController.php';
require 'app/models/Post.php';
require 'app/models/User.php';

$router = new Router();

require 'routes/web.php';

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
