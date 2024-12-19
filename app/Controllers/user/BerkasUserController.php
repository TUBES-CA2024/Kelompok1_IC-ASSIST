<?php
namespace App\Controllers\user;

use App\Core\Controller;
use App\Model\User\BerkasUser;

class BerkasUserController extends Controller
{
    public function saveBerkas()
    {
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

        $idUser = $_SESSION['user']['id'];
        $foto = $_FILES['foto']['tmp_name'] ?? '';
        $cv = $_FILES['cv']['tmp_name'] ?? '';
        $transkrip = $_FILES['transkrip']['tmp_name'] ?? '';
        $suratPernyataan = $_FILES['suratpernyataan']['tmp_name'] ?? '';

        if (!$foto || !$cv || !$transkrip || !$suratPernyataan) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Semua file wajib diupload']);
            return;
        }

        $imgSize = $_FILES['foto']['size'] ?? 0;
        $cvSize = $_FILES['cv']['size'] ?? 0;
        $transkripSize = $_FILES['transkrip']['size'] ?? 0;
        $suratPernyataanSize = $_FILES['suratpernyataan']['size'] ?? 0;

        $berkasUser = new BerkasUser(
            $idUser,
            $foto,
            $cv,
            $transkrip,
            $suratPernyataan,
            $imgSize,
            $cvSize,
            $transkripSize,
            $suratPernyataanSize
        );
        error_log('Session ID User: ' . ($_SESSION['user']['id'] ?? 'Tidak ada'));

        error_log('File Foto: ' . print_r($_FILES['foto'], true));
        error_log('File CV: ' . print_r($_FILES['cv'], true));
        if ($berkasUser->save($berkasUser)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Berkas berhasil diupload']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Berkas gagal diupload']);
        }
    }
    public static function viewBerkas()
    {
        $user = new BerkasUser();
        $berkas = $user->getBerkas($_SESSION['user']['id']);
        if (!$berkas) {
            return null;
        }
        return $berkas;
    }
    
    public static function getBerkasAdmin() {
        $user = new BerkasUser();
        $berkas = $user->getBerkasAdmin();
        if (!$berkas) {
            return null;
        }
        return $berkas;
    }
}
