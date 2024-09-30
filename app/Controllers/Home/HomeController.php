<?php

namespace App\Controllers\Home;

use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;

class HomeController extends Controller {

    public function index() {
        echo "<pre>";
        print_r(UserModel::paginate(2));
    }

}