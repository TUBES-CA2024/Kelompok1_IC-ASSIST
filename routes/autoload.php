<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$core = glob('../app/core/*.php');
foreach ($core as $file) {
    require $file;
}

$config = glob('../config/*.php');
foreach ($config as $file) {
    require $file;
}

$app = new App\Core\App;
$app->run();