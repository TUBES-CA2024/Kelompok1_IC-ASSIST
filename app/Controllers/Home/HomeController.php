<?php

namespace App\Controllers\Home;

use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;


class HomeController extends Controller {

    public function index() {
        echo "<pre>";
        $users = New UserModel;
        print_r($users->where("id","=",1)->get());
    }

}