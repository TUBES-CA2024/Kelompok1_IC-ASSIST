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
    public function insertSoalWithoutImage() {

    }
    
    public function insertSoalWithImage() {

    }

    public function insertWithoutImageAndAnswer() {

    }

    public function insertWithoutAnswer()  {
        
    }
}