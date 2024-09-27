<?php

use App\Controllers\Home\HomeController;
use App\Controllers\Login\LoginController;
use App\Core\Router;

Router::get('/about', function() {
    echo "WELCOME from web.php";
});
Router::get('/login', [new LoginController, 'index']);
Router::get('/Login', [new LoginController, 'index']);

Router::get('/',[new HomeController, 'index']);
Router::get('/contact', function() {
    echo "Route contact successfully reached.";
});

Router::get('/mantap', function() {
    echo "Route home successfully reached.";
});




