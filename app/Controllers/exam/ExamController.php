<?php
namespace App\Controllers\exam;

use App\Core\Controller;
use App\Core\View;
use App\Model\exam\SoalExam;
class ExamController extends Controller {
    public function index() {
        try {
            if (!isset($_GET['nomorMeja'])) {
                throw new \Exception('Nomor meja tidak disediakan');
            }

            $nomorMeja = intval($_GET['nomorMeja']);
            if ($nomorMeja <= 0) {
                throw new \Exception('Nomor meja tidak valid');
            }

            $isGanjil = $nomorMeja % 2 !== 0;

            $soalExam = new SoalExam();
            $soal = $soalExam->getAllByParity($isGanjil);

            View::render('index', 'exam', ['results' => $soal]);

        } catch (\Exception $e) {
            View::render('error', 'exam', ['message' => $e->getMessage()]);
        }
    }
    

    public static function viewAllSoal() {
        $soalExam = new SoalExam();
        $soal = $soalExam->getAll();
        return $soal == null ? [] : $soal;
    
    }
    public function saveSoal() {
        try {
            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            // Check user authentication
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
    
            $id_user = $_SESSION['user']['id'];
    
            // Validate and get form data
            $deskripsi = $_POST['deskripsi'] ?? '';
            $tipeJawaban = $_POST['tipeJawaban'] ?? '';
            $pilihan = $_POST['pilihan'] ?? null;
            $jawaban = $_POST['jawaban'] ?? null;
    
            // Handle file upload if 'gambar' exists
            $gambarName = null;
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = APP_URL . '/Assets/Img/soal/';
                $gambarName = time() . '_' . basename($_FILES['gambar']['name']);
                $targetFilePath = $uploadDir . $gambarName;
    
                if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
                    throw new \Exception('Gagal mengupload gambar');
                }
            }
            $soalExam = new SoalExam (
                $deskripsi,
                $pilihan,
                $jawaban,
                $gambarName,
                $tipeJawaban
            );
            if($soalExam->getGambar() == null && $soalExam->getJawaban() == null) {
                $soalExam->saveWithoutImageAndAnswer($soalExam);
            } else if($soalExam->getGambar() == null) {
                $soalExam->saveWithoutImage($soalExam);
            } else if($soalExam->getJawaban() == null) {
                $soalExam->saveWithoutAnswer($soalExam);
            } else {
                $soalExam->saveWithImage($soalExam);
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Soal berhasil disimpan'
            ]);
            http_response_code(200);
        } catch (\Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            http_response_code(500);
        } 
    }
    public function hapusSoal() {

    }
    public function editSoal() {

    }
}