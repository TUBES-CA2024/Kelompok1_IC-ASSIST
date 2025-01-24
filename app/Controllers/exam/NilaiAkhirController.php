<?php
namespace App\Controllers\Exam;

use App\Core\Controller;
use app\Model\exam\NilaiAkhir;
class NilaiAkhirController extends Controller {
    public function saveNilai() {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
    
            $id_user = $_SESSION['user']['id'];
    
            $nilaiAkhir = new NilaiAkhir();
            $score = $nilaiAkhir->saveNilai($id_user);
            error_log("Nilai akhir dihitung: " . $score);
            echo json_encode([
                'status' => 'success',
                'message' => 'Nilai berhasil disimpan',
                'score' => $score
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
    
    public static function getAllNilaiAkhirMahasiswa() {
        try {
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
            $nilai = new NilaiAkhir();
            return $nilai->getAllNIlai();
        } catch(\Exception $e) {
            error_log("Error in getAllNilaiAkhirMahasiswa: " . $e->getMessage());
            return [];
        }
    }

    public function getSoalAndJawabanMahasiswa() {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
    
            $id = $_POST['id'] ?? null;
            if (!$id) {
                throw new \Exception('ID mahasiswa tidak ditemukan');
            }
    
            $nilai = new NilaiAkhir();
            $result = $nilai->getSoalAndJawaban($id);
    
            if (empty($result)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tidak ada data soal dan jawaban untuk mahasiswa ini.'
                ]);//tess
                return;
            }
    
            echo json_encode([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            error_log("Error in getSoalAndJawabanMahasiswa: " . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    
}