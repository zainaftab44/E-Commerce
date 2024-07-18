<?php

require_once 'autoloader.php';
require_once 'config.php';

use Utils\Router;

// Capture the request URI
$requestUri = $_SERVER['REQUEST_URI'];
// Instantiate the router
$route = new Router();
$router->access($requestUri);

