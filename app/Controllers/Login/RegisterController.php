<?php

namespace App\Controllers\Login;

use App\Core\Controller;
use App\Model\User\UserModel;
use App\Core\View;

class RegisterController extends Controller
{
    public function register()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['username'] ?? '';
                $stambuk = $_POST['stambuk'] ?? '';
                $password = $_POST['password'] ?? '';
                $confirmPassword = $_POST['konfirmasiPassword'] ?? '';

                if (empty($name) || empty($stambuk) || empty($password) || empty($confirmPassword)) {
                    echo json_encode(['error' => 'All fields are required.']);
                    return;
                }

                if ($password !== $confirmPassword) {
                    echo json_encode(['error' => 'Passwords do not match.']);
                    return;
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $user = new UserModel;
                $user->__construct2($name, $stambuk, $hashedPassword);

                if ($user->save()) {
                    echo "<script>alert('Berhasil silahkan login')</script>";
                    View::render('index', 'Login');
                } else {
                    echo "<script>alert('Registrasi gagal')</script>";
                    View::render('index', 'Login');
                }
            }
        }  catch (\Exception $e) {
            echo "<script>alert('Silahkan gunakan stambuk yang lain! pengguna dengan '$stambuk' telah ada!')</script>";
            View::render('index', 'Login');
        }
    }
}
?>