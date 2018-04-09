<?php

use Framework\Core\Router;

require_once 'Framework/Debug/Dev.php';
require_once 'Framework/Core/Autoloader.php';

session_start();

Autoloader::register();

$router = new Router();
$router->run();