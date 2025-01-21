<?php
namespace App\Controllers\user;
use App\Core\Controller;
use App\Model\Wawancara\Wawancara;
class WawancaraController extends Controller
{
    public static function getAll()
    {
        $wawancara = new Wawancara(0, 0, 0, 0, 0);
        $data = $wawancara->getAll();
        return $data;
    }
    public function save()
    {
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

        $input = json_decode(file_get_contents('php://input'), true);
        $selectedMahasiswa = $input['id'] ?? [];
        $id_ruangan = $input['ruangan'] ?? "";
        $jenis_wawancara = $input['wawancara'] ?? "";
        $waktu = $input['waktu'] ?? "";
        $tanggal = $input['tanggal'] ?? "";

        if (empty($selectedMahasiswa) || empty($id_ruangan) || empty($jenis_wawancara) || empty($waktu) || empty($tanggal)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }
        $wawancara = new Wawancara(
            $id_ruangan,
            $jenis_wawancara,
            $waktu,
            $tanggal
        );
        if ($wawancara->save($wawancara, $selectedMahasiswa)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Jadwal wawancara berhasil disimpan']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Jadwal gagal disimpan']);
        }
    }
    public function update()
    {
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
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? "";
        $id_ruangan = $input['ruangan'] ?? "";
        $jenis_wawancara = $input['jenisWawancara'] ?? "";
        $waktu = $input['waktu'] ?? "";
        $tanggal = $input['tanggal'] ?? "";
        if (empty($id) || empty($id_ruangan) || empty($jenis_wawancara) || empty($waktu) || empty($tanggal)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }
        $wawancara = new Wawancara(
            $id_ruangan,
            $jenis_wawancara,
            $waktu,
            $tanggal
        );
        if ($wawancara->updateWawancara($id, $wawancara)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Jadwal wawancara berhasil diupdate']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Jadwal gagal diupdate']);
        }
    }
    public function delete()
    {
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
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? "";
        if (empty($id)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }
        $wawancara = new Wawancara(
            0,
            0,
            0,
            0
        );
        if ($wawancara->deleteWawancara($id)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Jadwal wawancara berhasil dihapus']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Jadwal gagal dihapus']);
        }
    }

}