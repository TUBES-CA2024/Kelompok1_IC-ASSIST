<?php
namespace App\Model\Exam;

use App\Core\Model;

class SoalExam extends Model {
    protected static $table = 'soal';
    protected $id;
    protected $deskripsi;
    protected $pilihan;

    
    public function getAll() {
        $query = "SELECT * FROM " . self::$table;
        $stmt = self::getDB()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}