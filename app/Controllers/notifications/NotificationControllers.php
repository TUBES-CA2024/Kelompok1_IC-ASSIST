<?php
namespace App\Controllers\notifications;

use App\Core\Controller;
use App\Model\User\NotificationUser;


class NotificationControllers extends Controller {

    public function sendMessage() {
        ob_start(); 
    
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }
    
        if (!isset($_SESSION['user']['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }
    
        $idMahasiswa = $_POST['id'] ?? '';
        $message = $_POST['message'] ?? '';
    
        if (!$idMahasiswa || !$message) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi']);
            return;
        }
    
        $notification = new NotificationUser($idMahasiswa, $message);
    
        try {
            if ($notification->insert($notification)) {
                header('Content-Type: application/json');
                ob_clean(); 
                echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim']);
                return;
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            ob_clean(); 
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    
        ob_end_clean();
    }
    
    public static function getMessageById() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['user']['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }
        $id = $_SESSION['user']['id'];
        $notifikasi = new NotificationUser($id,'');
        return $notifikasi->getById($notifikasi);
    }
}