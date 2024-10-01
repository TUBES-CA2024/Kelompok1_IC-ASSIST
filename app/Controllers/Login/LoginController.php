<?php
namespace App\Controllers\Login;
session_start();
use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;
class LoginController extends Controller {
    public function __construct() {
        // Start the session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        View::render('index', 'Login');
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stambuk = $_POST['stambuk'] ?? '';
            $password = $_POST['password'] ?? '';
    
            if (empty($stambuk) || empty($password)) {
                View::render('index', 'Login', ['error' => 'Stambuk and password are required.']);
                return;
            }
    
            $user = UserModel::findByStambuk($stambuk);
    
            if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /tubes_web/public/home');
                exit();
            } else {
                echo "<script>alert('Stambuk or password is incorrect.')</script>";
                View::render('index', 'Login');
            }
        }
    }

}
?>
