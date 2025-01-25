<?php
namespace App\Controllers\User;
use App\Core\Controller;
use App\Model\User\BiodataUser;

class BiodataUserController extends Controller {
    public static function isEmpty() {
        $biodata = new BiodataUser();
        $isEmpty = $biodata->isEmpty($_SESSION['user']['id']);
        return $isEmpty;
    }
    public function saveBiodata() {
        if (session_status() === PHP_SESSION_NONE) {
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
        $jurusan = $_POST['jurusan'] ?? '';
        $kelas = $_POST['kelas'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $stambuk = $_SESSION['user']['stambuk'];
        $gender = $_POST['gender'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $tempatLahir = $_POST['tempatlahir'] ?? '';
        $tanggalLahir = $_POST['tanggallahir'] ?? '';
        $noHp = $_POST['telephone'] ?? '';

        var_dump($jurusan);
        var_dump($kelas);
        if (empty($jurusan) || empty($kelas)  || empty($nama) || empty($gender) || empty($alamat) || empty($tempatLahir) || empty($tanggalLahir) || empty($noHp)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }

        $biodata = new BiodataUser(
            $idUser,
            $jurusan,
            $stambuk,
            $kelas,
            $nama,
            $alamat,
            $gender,
            $tempatLahir,
            $tanggalLahir,
            $noHp
        );

        if ($biodata->save($biodata)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }
}
