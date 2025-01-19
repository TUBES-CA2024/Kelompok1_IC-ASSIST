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
            $pilihan = $_POST['pilihan'] ?? 'bukan soal pilihan';
            $jawaban = $_POST['jawaban'] ?? null;
            $fotoSize = null;
    
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambar = $_FILES['gambar']['tmp_name'] ?? '';
                $fotoSize = $_FILES['gambar']['size'] ?? 0;
   
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
    
            if (($soalExam->getGambar() === null )&& $soalExam->getJawaban() === null) {
                $soalExam->saveWithoutImageAndAnswer($soalExam);
            } else if ($soalExam->getGambar() === null) {
                $soalExam->saveWithoutImage($soalExam);
            } else if ($jawaban === null) {
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
    public function deleteSoal() {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
            $id = $_POST['id'] ?? '';
            $soal = new SoalExam(
                null,
                null,
                null,
                null,
                null
            );
            $soal->deleteSoal($id);
            echo json_encode([
                'status' => 'success',
                'message' => 'Soal berhasil dihapus'
            ]);
            http_response_code(200);
        } catch (\Exception $e) {
            error_log("Error in deleteSoal: " . $e->getMessage());
    
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            http_response_code(500);
        }
    }
    public function updateSoal() {
    try {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']['id'])) {
            throw new \Exception('User tidak terautentikasi');
        }

        $id = $_POST['id'] ?? '';
        $deskripsi = $_POST['deskripsi'] ?? '';
        $tipeJawaban = $_POST['tipeJawaban'] ?? '';
        $pilihan = $_POST['pilihan'] ?? 'bukan soal pilihan';
        $jawaban = $_POST['jawaban'] ?? null;
        $gambar = ''; 
        $fotoSize = null;

        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $gambar = $_FILES['gambar']['tmp_name'] ?? '';
            $fotoSize = $_FILES['gambar']['size'] ?? 0;
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

        // Memperbarui soal menggunakan metode updateSoal
        $soalExam->updateSoal($id, $soalExam);

        // Respon sukses
        echo json_encode([
            'status' => 'success',
            'message' => 'Soal berhasil diupdate'
        ]);
        http_response_code(200);

    } catch (\Exception $e) {
        // Log error dan respon error
        error_log("Error in updateSoal: " . $e->getMessage());

        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        http_response_code(500);
    }
}
}