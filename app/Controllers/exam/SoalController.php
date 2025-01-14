<?php
namespace App\Controllers\exam;

use App\Core\Controller;
use App\Model\exam\SoalExam;

class SoalController extends Controller {
    public function saveSoal() {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
            $deskripsi = $_POST['deskripsi'] ?? '';
            $tipeJawaban = $_POST['tipeJawaban'] ?? '';
            $pilihan = $_POST['pilihan'] ?? null;
            $jawaban = $_POST['jawaban'] ?? null;
            $fotoSize = null;
    
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambar = $_FILES['gambar']['tmp_name'];
                $fotoSize = $_FILES['gambar']['size'];
   
            }
          
            if ($tipeJawaban === 'pilihan_ganda' && !empty($pilihan)) {
                $pilihanArray = explode(',', $pilihan); 
                $pilihan = json_encode($pilihanArray);  
            }
    
            $soalExam = new SoalExam(
                $deskripsi,
                $pilihan,
                $jawaban,
                $gambar,
                $fotoSize,
                $tipeJawaban
            );
    
            if ($soalExam->getGambar() === null && $soalExam->getJawaban() === null) {
                $soalExam->saveWithoutImageAndAnswer($soalExam);
            } else if ($soalExam->getGambar() === null) {
                $soalExam->saveWithoutImage($soalExam);
            } else if ($soalExam->getJawaban() === null) {
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
            error_log("Error in saveSoal: " . $e->getMessage());
    
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            http_response_code(500);
        }
    }
    
}