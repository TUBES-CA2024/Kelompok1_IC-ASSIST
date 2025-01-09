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
    
        if (!isset($_FILES['makalah']) || !is_array($_FILES['makalah']) || !isset($_FILES['ppt']) || !is_array($_FILES['ppt'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'File uploads are invalid']);
            return;
        }
    
        if ($_FILES['makalah']['error'] !== UPLOAD_ERR_OK || $_FILES['ppt']['error'] !== UPLOAD_ERR_OK) {
            $errors = [
                UPLOAD_ERR_INI_SIZE => 'File exceeds maximum size',
                UPLOAD_ERR_FORM_SIZE => 'File exceeds form size limit',
                UPLOAD_ERR_PARTIAL => 'File only partially uploaded',
                UPLOAD_ERR_NO_FILE => 'No file uploaded',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
            ];
            $errorCode = $_FILES['makalah']['error'] !== UPLOAD_ERR_OK ? $_FILES['makalah']['error'] : $_FILES['ppt']['error'];
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $errors[$errorCode] ?? 'Unknown error']);
            return;
        }
    
        $idUser = $_SESSION['user']['id'];
        $makalah = $_FILES['makalah']['tmp_name'];
        $ppt = $_FILES['ppt']['tmp_name'];
        $makalahSize = $_FILES['makalah']['size'];
        $pptSize = $_FILES['ppt']['size'];
    
        try {
            $presentasiUser = new PresentasiUser(id_mahasiswa:$idUser, makalah:$makalah, ppt: $ppt, makalahSize: $makalahSize, pptSize:$pptSize);

            if ($presentasiUser->updateMakalahAndPpt($presentasiUser)) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Makalah dan PPT berhasil disimpan']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Makalah dan PPT gagal disimpan']);
            }
        } catch (\Exception $e) {
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

    public static function viewAllAccStatusForAdmin() {
        $presentasi = new Presentasi();
        $data = $presentasi->getAllAccStatus();
        return $data;
    }
    public function updateStatusJudul() {
        $presentasi = new Presentasi();
        $id = $_POST['id'] ?? '';
    
        if (!empty($id)) {
            try {
                $presentasi->updateJudulStatus($id);
    
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Status judul berhasil diperbarui.'
                ]);
            } catch (\Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal memperbarui status judul: ' . $e->getMessage()
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tidak ditemukan atau kosong.'
            ]);
        }
    }
   
}
