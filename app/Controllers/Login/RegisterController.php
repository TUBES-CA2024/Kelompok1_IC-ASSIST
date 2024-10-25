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
    
                // Cek input kosong
                if (empty($name) || empty($stambuk) || empty($password) || empty($confirmPassword)) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
                    return;
                }
    
                // Cek password dan konfirmasi password
                if ($password !== $confirmPassword) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
                    return;
                }
    
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                // Buat user baru
                $user = new UserModel;
                $user->__construct2($name, $stambuk, $hashedPassword);
    
                // Simpan user
                if ($user->save()) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Registration successful. Please log in.']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'Registration failed.']);
                }
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => "Please use a different stambuk. User with '$stambuk' already exists."]);
        }
    }
    
}
?>