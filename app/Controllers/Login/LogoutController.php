<?php
namespace App\Controllers\Login;

use App\Core\Controller;
use App\Core\View;
class LogoutController extends Controller {
    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        session_unset();
        View::render('index', 'Login');
        exit;
    }
}
