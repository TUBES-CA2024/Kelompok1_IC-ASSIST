<?php

namespace App\Controllers\Home;

use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;


class HomeController extends Controller {

    public function index() {
        View::render('sidebar','Templates');
        View::render('index','Home');
    }
    public function dashboard() {
        View::render('dashboard','Home');
    }

}