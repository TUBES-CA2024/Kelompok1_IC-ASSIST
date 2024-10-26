<?php
namespace App\Controllers\Login;
session_start();
use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;
class LoginController extends Controller {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        View::render('index', 'Login');
    }

    public function authenticate() {
        // Pastikan metode request adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stambuk = $_POST['stambuk'] ?? '';
            $password = $_POST['password'] ?? '';
    
            // Validasi jika stambuk atau password kosong
            if (empty($stambuk) || empty($password)) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Stambuk and password are required.']);
                return;
            }
    
            // Cari user berdasarkan stambuk
            $user = UserModel::findByStambuk($stambuk);
    
            // Verifikasi password
            if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
                // Simpan user ke dalam session
                $_SESSION['user'] = $user;
                
                // Berikan respons JSON untuk AJAX
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
                return;
            } else {
                // Respons jika login gagal
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Stambuk or password is incorrect.']);
                return;
            }
        } else {
            // Respons jika metode request bukan POST
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
            return;
        }
    }
    

}
?>
