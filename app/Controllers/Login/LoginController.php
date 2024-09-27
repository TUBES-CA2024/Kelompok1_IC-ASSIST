<?php

namespace App\Controllers\Login;
use App\Core\Controller;

class LoginController extends Controller {
    public function index() {
        view('index','Login');
    }
}