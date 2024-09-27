<?php

namespace App\Controllers\Home;

use App\Core\Controller;

class HomeController extends Controller {

    public function index() {
        view('index','Home');
    }

}