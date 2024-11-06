<?php
namespace App\Controllers\Exam;

use App\Core\Controller;
use App\Model\exam\JawabanExam;
use App\Model\exam\NilaiAkhir;

class AnswersController extends Controller {
    public function saveAnswer() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Metode tidak diizinkan');
            }

            $data = json_decode(file_get_contents("php://input"), true);
            error_log("Input data: " . print_r($data, true));
            if (empty($data)) {
                throw new \Exception('Data jawaban kosong');
            }

            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }

            $id_user = $_SESSION['user']['id'];
            $jawabanExam = new JawabanExam();

            // Simpan semua jawaban
            foreach ($data as $answer) {
                if (!isset($answer['id_soal'], $answer['jawaban'])) {
                    throw new \Exception('Data jawaban tidak lengkap');
                }

                $id_soal = $answer['id_soal'];
                $jawaban = $answer['jawaban'];

                if (!$jawabanExam->saveJawaban($id_soal, $id_user, $jawaban)) {
                    throw new \Exception("Gagal menyimpan jawaban untuk soal ID: $id_soal");
                }
            }

            // Hitung nilai langsung setelah semua jawaban tersimpan
            $nilaiAkhir = new NilaiAkhir();
            $score = $nilaiAkhir->saveNilai($id_user);

            // Berikan respons sukses
            echo json_encode([
                'status' => 'success',
                'message' => 'Semua jawaban berhasil disimpan dan nilai telah dihitung',
                'score' => $score
            ]);
            http_response_code(200);

        } catch (\Exception $e) {
            // Kirim respons error
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            http_response_code(500);
        }
    }
}
