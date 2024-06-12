<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

session_start();
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
require 'app/controllers/CompanyController.php'; // Include CompanyControllers
require 'app/controllers/PackageController.php'; // Include PackageControllers
require 'app/controllers/TariffController.php'; // Include TariffControllers
require 'app/controllers/QuotationController.php'; // Include QuotationController
require 'app/controllers/OfficeController.php'; // Include OfficeController

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
require 'app/models/Followup.php';
require 'app/models/Configuration.php';

$router = new Router();
require 'routes/web.php';

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
