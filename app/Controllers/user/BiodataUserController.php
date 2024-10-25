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
        // Mulai sesi untuk akses $_SESSION
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Pastikan metode request adalah POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        // Pastikan user sudah login
        if (!isset($_SESSION['user']['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        // Ambil data dari request POST
        $idUser = $_SESSION['user']['id'];
        $jurusan = $_POST['jurusan'] ?? '';
        $kelas = $_POST['kelas'] ?? '';
        $stambuk = $_POST['stambuk'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $tempatLahir = $_POST['tempatlahir'] ?? '';
        $tanggalLahir = $_POST['tanggallahir'] ?? '';
        $noHp = $_POST['telephone'] ?? '';

        var_dump($jurusan);
        var_dump($kelas);
        // Validasi apakah semua field terisi
        if (empty($jurusan) || empty($kelas) || empty($stambuk) || empty($nama) || empty($gender) || empty($alamat) || empty($tempatLahir) || empty($tanggalLahir) || empty($noHp)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }

        // Buat instance dari BiodataUser
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

        // Simpan data dan berikan respons JSON
        if ($biodata->save($biodata)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }
}
