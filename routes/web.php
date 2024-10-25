<?php

use App\Controllers\Home\HomeController;
use App\Controllers\Login\LoginController;
use App\Controllers\Login\RegisterController;
use App\Controllers\Login\LogoutController;
use App\Core\Router;

Router::get('/login', [new LoginController, 'index']);
Router::get('/Login', [new LoginController, 'index']);
Router::post('/login/authenticate', [new LoginController, 'authenticate']);
Router::post('/register/authenticate', [new RegisterController, 'register']);
Router::get('/',[new HomeController, 'index']);
Router::get('/{page}', [new HomeController, 'loadContent']);
Router::get('/logout', [new LogoutController, 'logout']);


