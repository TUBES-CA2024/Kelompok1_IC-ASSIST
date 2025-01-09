<?php

namespace App\Controllers\Presentasi;
use App\Core\Controller;
use App\Model\Presentasi\JadwalPresentasi;
class JadwalPresentasiController extends Controller
{

    public function saveJadwal()
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
        $id_presentasi = $input['id'] ?? "";
        $id_ruangan = $input['ruangan'] ?? "";
        $tanggal = $input['tanggal'] ?? "";
        $waktu = $input['waktu'] ?? "";
        $mahasiswa = $input['mahasiswa'] ?? "";
        if (empty($id_presentasi) || empty($id_ruangan) || empty($tanggal) || empty($waktu) || empty($mahasiswa)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }

        $presentasi = new JadwalPresentasi(
            $id_presentasi,
            $id_ruangan,
            $tanggal,
            $waktu
        );
        if ($presentasi->save($presentasi,$mahasiswa)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Jadwal dan mahasiswa berhasil disimpan' . $presentasi]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Jadwal gagal disimpan']);
        }
    }
}