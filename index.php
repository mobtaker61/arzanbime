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
require 'app/controllers/PostController.php'; // Include PostControllers

require 'app/models/Post.php';
require 'app/models/User.php';
require 'app/models/PostType.php';
require 'app/models/Province.php';
require 'app/models/Office.php';
require 'app/models/Company.php';
require 'app/models/Package.php';
require 'app/models/Tariff.php';
require 'app/models/Newsletter.php';
require 'app/models/Quotation.php';
require 'app/models/Configuration.php';

$router = new Router();

require 'routes/web.php';

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
