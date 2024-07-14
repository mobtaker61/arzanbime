<?php
echo phpinfo();


require 'index.php';

use App\Controllers\HomeController;

$controller = new HomeController();
echo "Autoloader works!";
