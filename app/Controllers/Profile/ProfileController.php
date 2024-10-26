<?php

namespace App\Controllers\Profile;
use App\Core\Controller;
use App\Model\User\BiodataUser;
use App\Model\User\UserModel;

class ProfileController extends Controller {

    public static function viewBiodata() : array  {
        $user = new BiodataUser();
        $profile = $user->getBiodata($_SESSION['user']['id']);
        return $profile == null ? [] : $profile;
    }
    public static function viewUser() : array {
        $user = new UserModel();
        $profile = $user->getUser($_SESSION['user']['id']);
        return $profile == null ? [] : $profile;
    }

}