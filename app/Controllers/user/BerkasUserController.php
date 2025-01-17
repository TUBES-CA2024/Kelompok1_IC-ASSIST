<?php
namespace App\Controllers\user;

use App\Core\Controller;
use App\Model\User\BerkasUser;
use App\Model\User\Mahasiswa;

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

    public static function getBerkasAdmin()
    {
        $user = new BerkasUser();
        $berkas = $user->getBerkasAdmin();
        if (!$berkas) {
            return null;
        }
        return $berkas;
    }
    public function downloadBerkas()
    {
        try {
            if (!isset($_GET['type'])) {
                throw new \Exception('Jenis berkas tidak disediakan');
            }

            $type = $_GET['type']; 
            $allowedTypes = ['foto', 'cv', 'transkrip_nilai', 'surat_pernyataan'];
            if (!in_array($type, $allowedTypes)) {
                throw new \Exception('Jenis berkas tidak valid');
            }

            $user = new Mahasiswa();
            $mahasiswaId = $user->getMahasiswaId(['id_user' => $_SESSION['user']['id']])['id'];

            if (!$mahasiswaId) {
                throw new \Exception('Mahasiswa tidak ditemukan');
            }

            $berkas = $user->getBerkasMahasiswa($mahasiswaId);

            if (!$berkas || !$berkas[$type]) {
                throw new \Exception('Berkas tidak tersedia');
            }

            $basePath = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/';
            $filePath = ($type === 'foto')
                ? $basePath . 'imageUser/' . $berkas[$type]
                : $basePath . 'berkasUser/' . $berkas[$type];

            if (!file_exists($filePath)) {
                throw new \Exception('File tidak ditemukan');
            }

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;

        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
