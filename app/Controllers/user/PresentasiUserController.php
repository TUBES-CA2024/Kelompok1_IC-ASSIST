<?php
namespace App\Controllers\User;

use App\Core\Controller;
use App\Model\User\PresentasiUser;
use App\Model\presentasi\Presentasi;
class PresentasiUserController extends Controller {
    public function saveJudul() {
        $presentasi = new PresentasiUser();
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        if(!isset($_SESSION['user']['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }
        $idUser = $_SESSION['user']['id'];
        $judul = $_POST['judul'] ?? '';

        if(empty($judul)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }
        $presentasiUser = new PresentasiUser($idUser, $judul);
        if($presentasi->saveJudul($presentasiUser)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Judul berhasil disimpan']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Judul gagal disimpan']);
        }
    }

    public function saveMakalahAndPpt() {
        // Mulai session jika belum ada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cek metode request POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        // Cek apakah user sudah login
        if (!isset($_SESSION['user']['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        $idUser = $_SESSION['user']['id'];
        $makalah = $_FILES['makalah']['tmp_name'] ?? '';
        $ppt = $_FILES['ppt']['tmp_name'] ?? '';

        // Cek jika file tidak ada atau ada error saat upload
        if (!$makalah || !$ppt || $_FILES['makalah']['error'] !== UPLOAD_ERR_OK || $_FILES['ppt']['error'] !== UPLOAD_ERR_OK) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required or file upload error']);
            return;
        }

        $makalahSize = $_FILES['makalah']['size'] ?? 0;
        $pptSize = $_FILES['ppt']['size'] ?? 0;
        $isRevisi = 0;
        $isAccepted = 0;

        try {
            // Validasi dan proses file
            $presentasiUser = new PresentasiUser(
                $idUser,
                $makalah,
                $ppt,
                $isRevisi,
                $isAccepted,
                $makalahSize,
                $pptSize
            );
            
            if ($presentasiUser->updateMakalahAndPpt($presentasiUser)) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Makalah dan PPT berhasil disimpan']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Makalah dan PPT gagal disimpan']);
            }
        } catch (Exception $e) {
            // Tangani error jika terjadi pengecualian
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public static function viewAll(){
        $presentasi = new PresentasiUser();
        $id = $_SESSION['user']['id'];
        $presentasiUser = $presentasi->getValueForTable($id);
        return $presentasiUser ?? [];
    }
    public static function viewAllForAdmin() {
        $presentasi = new Presentasi();
        $data = $presentasi->getAll();
        return $data;
    }
}
