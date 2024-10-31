<?php

use App\Controllers\Home\HomeController;
use App\Controllers\Login\LoginController;
use App\Controllers\Login\RegisterController;
use App\Controllers\Login\LogoutController;
use App\Controllers\user\BerkasUserController;
use App\Controllers\user\BiodataUserController;
use App\Core\Router;

Router::get('/login', [new LoginController, 'index']);
Router::get('/Login', [new LoginController, 'index']);
Router::get('/',[new HomeController, 'index']);
Router::get('/{page}', [new HomeController, 'loadContent']);


Router::post('/login/authenticate', [new LoginController, 'authenticate']);
Router::post('/register/authenticate', [new RegisterController, 'register']);
Router::post('/logout', [new LogoutController, 'logout']);
Router::post("/store", [new BiodataUserController, 'saveBiodata']);
Router::post("/berkas", [new BerkasUserController, 'saveBerkas']);


