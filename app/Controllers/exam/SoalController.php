<?php
namespace App\Controllers\exam;

use App\Core\Controller;
use App\Model\exam\SoalExam;

class SoalController extends Controller
{
    public function getSoalWithJson()
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }
            $year = isset($_POST['year']) ? $_POST['year'] : date('Y');
    
            $soal = new SoalExam();
            $soals = $soal->getAllTempByYears($year);
            $results = null;
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/documents/';
            
            // echo json_encode([
            //     'status' => 'testing',
            //     'allSoal' => $soals['nama']
            // ]);
            if ($soals && !empty($soals['nama'])) {
                $file = $dir . $soals['nama'];
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
                
                echo json_encode([
                    'tstatus' => 'success',
                    'allSoal' => $results
                ]);
                exit;
            }
            echo json_encode([
                'tstatus' => 'error',
                'message' => print_r($soals, true)
            ]);
        } catch (\Exception $e) {
            echo json_encode([
                'tstatus' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    
    public static function getYears()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']['id'])) {
            throw new \Exception('User tidak terautentikasi');
        }
        try {
            $soal = new SoalExam();
            $createdAts = $soal->getCreatedAt();
            $years = [];
            foreach ($createdAts as $row) {
                $year = date('Y', strtotime($row['created_at']));
                if (!in_array($year, $years)) {
                    $years[] = $year;
                }
            }
            sort($years);
            return $years;
        } catch (\Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function saveSoal()
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['user']['id'])) {
                throw new \Exception('User tidak terautentikasi');
            }

            $soals = json_decode(file_get_contents('php://input'), true); // Decode JSON menjadi array

            if (empty($soals['soals'])) {
                throw new \Exception('Tidak ada soal untuk disimpan');
            }

            // Tentukan path untuk file JSON
            $fileName = rand(1000, 9999) . 'soals.json';
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/documents/';
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

            $existingData = [];
            if (file_exists($filePath)) {
                $existingData = json_decode(file_get_contents($filePath), true);
                if (!$existingData) {
                    $existingData = [];
                }
            }

            foreach ($soals['soals'] as $soal) {
                $deskripsi = $soal['deskripsi'] ?? '';
                $tipeJawaban = $soal['tipeJawaban'] ?? '';
                $pilihan = $soal['pilihan'] ?? 'bukan soal pilihan';
                $jawaban = $soal['jawaban'] ?? null;

                if ($tipeJawaban === 'pilihan_ganda' && !empty($pilihan)) {
                    $pilihanArray = explode(',', $pilihan);
                    $pilihan = json_encode($pilihanArray);
                }

                $existingData[] = [
                    'deskripsi' => $deskripsi,
                    'tipeJawaban' => $tipeJawaban,
                    'pilihan' => $pilihan,
                    'jawaban' => $jawaban
                ];
            }

            $json_data = json_encode($existingData, JSON_PRETTY_PRINT);

            if (!file_put_contents($filePath, $json_data)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Soal gagal disimpan ke file JSON'
                ]);
                exit();
            }
            $soal = new SoalExam(deskripsi: $fileName);
            if ($soal->saveJson($soal)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Soal berhasil disimpan'
                ]);
                http_response_code(200);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Soal gagal disimpan'
                ]);
                http_response_code(500);
            }
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