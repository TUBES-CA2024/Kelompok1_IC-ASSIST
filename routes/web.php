<?php

use App\Controllers\Home\HomeController;
use App\Controllers\Login\LoginController;
use App\Controllers\Login\RegisterController;
use App\Core\Router;

Router::get('/about', function() {
    echo "WELCOME from web.php";
});
Router::get('/login', [new LoginController, 'index']);
Router::get('/Login', [new LoginController, 'index']);
Router::post('/login/authenticate', [new LoginController, 'authenticate']);
Router::post('/register/authenticate', [new RegisterController, 'register']);
Router::get('/',[new HomeController, 'index']);
Router::get('/home',[new HomeController, 'index']);
Router::get('/home/dashboard',[new HomeController, 'dashboard']);
Router::get('/{page}', [new HomeController, 'loadContent']);



