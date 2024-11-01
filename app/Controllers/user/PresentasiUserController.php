<?php
namespace App\Controllers\User;

use App\Core\Controller;
use App\Model\User\PresentasiUser;

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

    public function viewAll(){
        $presentasi = new PresentasiUser();
        $idMahasiswa = $presentasi->getIdMahasiswa($_SESSION['user']['id']);
        $presentasiUser = $presentasi->getAllPresentasi($idMahasiswa);
        return $presentasiUser;
    }
}
