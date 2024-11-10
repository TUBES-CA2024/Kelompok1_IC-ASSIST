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
    
    
}