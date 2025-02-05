<?php
namespace App\Controllers\exam;

use App\Core\Controller;
use App\Model\exam\SoalExam;

class SoalController extends Controller
{
    public function saveSoal()
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
    
            // Mendapatkan data soal yang dikirimkan dalam array JSON
            $soals = json_decode(file_get_contents('php://input'), true); // Decode JSON menjadi array
    
            if (empty($soals['soals'])) {
                throw new \Exception('Tidak ada soal untuk disimpan');
            }
    
            // Proses seluruh soal yang diterima
            foreach ($soals['soals'] as $soal) {
                $deskripsi = $soal['deskripsi'] ?? '';
                $tipeJawaban = $soal['tipeJawaban'] ?? '';
                $pilihan = $soal['pilihan'] ?? 'bukan soal pilihan';
                $jawaban = $soal['jawaban'] ?? null;
    
                if ($tipeJawaban === 'pilihan_ganda' && !empty($pilihan)) {
                    $pilihanArray = explode(',', $pilihan);
                    $pilihan = json_encode($pilihanArray);
                }
    
                $data = [
                    'deskripsi' => $deskripsi,
                    'tipeJawaban' => $tipeJawaban,
                    'pilihan' => $pilihan,
                    'jawaban' => $jawaban
                ];
    
                // Menyimpan soal ke dalam file JSON
                $json_data = json_encode($data, JSON_PRETTY_PRINT);
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/documents/';
                $fileName = uniqid('soal-', true) . '.json';
                $filePath = $dir . $fileName;
    
                // Cek dan buat direktori jika belum ada
                if (!is_dir($dir)) {
                    if (!mkdir($dir, 0777, true)) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal membuat direktori'
                        ]);
                        exit();
                    }
                }
    
                // Menyimpan file JSON
                if (!file_put_contents($filePath, $json_data)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Soal gagal dibuat JSON'
                    ]);
                    exit();
                }
    
                $soalExam = new SoalExam(
                    $deskripsi,
                    $pilihan,
                    $jawaban,
                    $tipeJawaban
                );
    
                if ($soalExam->getJawaban() === null) {
                    $soalExam->saveWithoutAnswer($soalExam);
                } else {
                    $soalExam->save($soalExam);
                }
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
    
    public function deleteSoal()
    {
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

    public function updateSoal()
    {
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
            $jawaban = $_POST['jawaban'] ?? 'soal tidak mempunyai jawaban';


            if ($tipeJawaban === 'pilihan_ganda' && !empty($pilihan)) {
                $pilihanArray = explode(',', $pilihan);
                $pilihan = json_encode($pilihanArray);
            }

            $soalExam = new SoalExam(
                $deskripsi,
                $pilihan,
                $jawaban,
                $tipeJawaban
            );

            $soalExam->updateSoal($id, $soalExam);

            echo json_encode([
                'status' => 'success',
                'message' => 'Soal berhasil diupdate'
            ]);
            http_response_code(200);

        } catch (\Exception $e) {
            error_log("Error in updateSoal: " . $e->getMessage());

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            http_response_code(500);
        }
    }
}