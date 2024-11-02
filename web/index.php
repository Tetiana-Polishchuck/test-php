<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
require_once '../vendor/autoload.php';
require_once '../config/database.php';


use App\Controllers\HomeController;

$controller = new HomeController($pdo);

$get = $_GET;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo $controller->getCategory(get: $get);
} else{
    echo $controller->index($get);

}


