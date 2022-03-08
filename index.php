<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

use App\EmailController;

$controller = new EmailController();

$response = $controller->displayForm();

$response->send();


