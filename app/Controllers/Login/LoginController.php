<?php

namespace App\Controllers\Login;
use App\Core\Controller;
use App\Core\View;
class LoginController extends Controller {
    public function index() {
        View::render('index','Login');
    }
}