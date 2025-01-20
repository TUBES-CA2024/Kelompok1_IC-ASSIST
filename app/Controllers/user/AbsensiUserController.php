<?php
namespace App\Controllers\user;
use App\Model\User\Absensi;
use App\Core\Controller;
class AbsensiUserController extends Controller
{
    public static function viewAbsensi()
    {
        $absensi = new Absensi();
        $data = $absensi->getAbsensi();
        return $data;

    }

    public function saveData()
    {
        try {
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
            $id = $input['mahasiswa'] ?? "tidak ada mahasiswa";
            $wawancaraI = $input['wawancara1'] ?? "tidak ada wawancara1";
            $wawancaraII = $input['wawancara2'] ?? "tidak ada wawancara2";
            $wawancaraIII = $input['wawancara3'] ?? "tidak ada wawancara3";
            $tesTertulis = $input['tesTertulis'] ?? "tidak ada tes tertulis";
            $presentasi = $input['presentasi'] ?? "tidak ada presentasi";
            if (empty($id) || empty($wawancaraI) || empty($wawancaraII) || empty($wawancaraIII) || empty($tesTertulis) || empty($presentasi)) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'All fields are required' . 'mahasiswa : ' . $id . 'wawancaraI : ' . $wawancaraI . 'wawancaraII : ' . $wawancaraII . 'wawancaraIII : ' . $wawancaraIII . 'tesTertulis : ' . $tesTertulis . 'presentasi : ' . $presentasi]);
                return;
            }
            
            $absensi = new Absensi(
                $wawancaraI,
                $wawancaraII,
                $wawancaraIII,
                $tesTertulis,
                $presentasi
            );
            if ($absensi->addMahasiswa($absensi, $id)) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Absensi berhasil disimpan']);
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
}