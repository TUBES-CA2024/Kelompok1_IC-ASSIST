<?php
namespace App\Controllers\Exam;

use App\Core\Controller;
use App\Model\exam\JawabanExam;

class AnswersController extends Controller
{

    public function saveAnswer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true); 
            $id_user = $_SESSION['user']['id'];
            
            if (is_array($data)) {
                $jawabanExam = new JawabanExam(); 
                $errors = [];
                
                foreach ($data as $answer) {
                    if (isset($answer['id_soal'], $answer['jawaban'])) { 
                        $id_soal = $answer['id_soal'];
                        $jawaban = $answer['jawaban']; 
                        $success = $jawabanExam->saveJawaban($id_soal, $id_user, $jawaban);
                        
                        if (!$success) {
                            $errors[] = "Gagal menyimpan jawaban untuk soal ID: $id_soal";
                        }
                    } else {
                        $errors[] = "Data tidak lengkap untuk soal ID: " . ($answer['id_soal'] ?? 'unknown');
                    }
                }
                
                if (empty($errors)) {
                    http_response_code(200);
                    echo json_encode(['status' => 'success', 'message' => 'Semua jawaban berhasil disimpan']);
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Beberapa jawaban gagal disimpan', 'errors' => $errors]);
                }
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Format data tidak valid']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
        }
    }
    
}
