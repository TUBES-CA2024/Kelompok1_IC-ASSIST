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
    
            // Ambil soal berdasarkan status aktif
            $soalExam = new SoalExam();
            $soals = $soalExam->getTempByStatus();  // Mengambil satu soal aktif saja
    
            // Periksa apakah $soals mengembalikan hasil
            if (!$soals) {
                throw new \Exception('Soal tidak ditemukan');
            }
    
            $results = [];
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/documents/';
    
            
            $file = $dir . $soals['nama'];  // Ambil nama file dari database
            if (file_exists($file)) {
                $jsonContent = file_get_contents($file);
                $dataJson = json_decode($jsonContent, true);
                if (is_array($dataJson)) {
                    $results = $dataJson;  
                } else {
                    error_log("JSON decoding failed: " . json_last_error_msg());
                }
            } else {
                error_log("File not found: " . $file);
            }
    
            shuffle($results);  // Acak soal jika lebih dari satu soal (misal, ke depan)
            $soal = $results;  // Assign soal yang sudah diproses ke variabel $soal
    
            // Render the view with the results
            View::render('index', 'exam', [
                'results' => $soal,
                'id_soal' => $soals['id']
        ]);
    
        } catch (\Exception $e) {
            View::render('error', 'exam', ['message' => $e->getMessage()]);
        }
    }

    public static function viewAllSoal() {
        $soalExam = new SoalExam();
        $soal = $soalExam->getAll();
        return $soal == null ? [] : $soal;
    
    }
}