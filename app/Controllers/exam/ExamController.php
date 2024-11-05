<?php
namespace App\Controllers\exam;

use App\Core\Controller;
use App\Core\View;
use App\Model\exam\SoalExam;
class ExamController extends Controller {
    public function index() {
       View::render('index', 'exam');
    }

    public static function viewAllSoal() {
        $soalExam = new SoalExam();
        $soal = $soalExam->getAll();
        return $soal == null ? [] : $soal;
    
    }
}