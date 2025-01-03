<?php

use App\Controllers\exam\AnswersController;
use App\Controllers\exam\ExamController;
use App\Controllers\Home\HomeController;
use App\Controllers\Login\LoginController;
use App\Controllers\Login\RegisterController;
use App\Controllers\Login\LogoutController;
use App\Controllers\user\BerkasUserController;
use App\Controllers\user\BiodataUserController;
use App\Controllers\user\MahasiswaController;
use App\Controllers\user\PresentasiUserController;
use App\Controllers\notifications\NotificationControllers;
use App\Core\Router;



Router::get('/soal', [new ExamController, 'index']);
Router::get('/login', [new LoginController, 'index']);
Router::get('/',[new HomeController, 'index']);
Router::get('/{page}', [new HomeController, 'loadContent']);
Router::get('/download',[new BerkasUserController, 'downloadBerkas']);


Router::post('/login/authenticate', [new LoginController, 'authenticate']);
Router::post('/register/authenticate', [new RegisterController, 'register']);
Router::post('/logout', [new LogoutController, 'logout']);
Router::post("/store", [new BiodataUserController, 'saveBiodata']);
Router::post("/berkas", [new BerkasUserController, 'saveBerkas']);
Router::post("/judul", [new PresentasiUserController, 'saveJudul']);
Router::post("/submit/presentasi", [new PresentasiUserController, 'saveMakalahAndPpt']);
Router::post("/hasil",[new AnswersController, 'saveAnswer']);
Router::post("/notification",[new NotificationControllers, 'sendMessage']);
Router::post("/deletemhs",[new MahasiswaController,'deleteMahasiswa']);