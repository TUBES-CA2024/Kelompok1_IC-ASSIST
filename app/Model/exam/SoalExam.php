<?php
namespace App\Model\Exam;

use App\Core\Model;
use PDO;
class SoalExam extends Model {
    protected static $table = 'soal';
    protected $id;
    protected $deskripsi;
    protected $pilihan;
    protected $jawaban;
    protected $gambar;
    protected $status;
    public function __construct(
        $deskripsi = null,
        $pilihan = null,
        $jawaban = null,
        $gambar = null,
        $status = null
    ) {
        if($jawaban == null && $gambar == null) {
            $this->deskripsi = $deskripsi;
            $this->pilihan = $pilihan;
            $this->status = $status;
        } else if($gambar == null) {
            $this->deksripsi = $deskripsi;
            $this->pilihan = $pilihan;
            $this->jawaban = $jawaban;
            $this->status = $status;
        } else if($jawaban == null) {
            $this->deskripsi = $deskripsi;
            $this->pilihan = $pilihan;
            $this->gambar = $gambar;
            $this->status = $status;
        }
    }

    
    public function getAll() {
        $query = "SELECT * FROM " . self::$table;
        $stmt = self::getDB()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllByParity($isGanjil) {
        $parity = $isGanjil ? 1 : 0; 
        $query = "SELECT * FROM " . self::$table . " WHERE id % 2 = :parity LIMIT 60";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':parity', $parity, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function saveWithImage(SoalExam $soal) {
        $sql = "INSERT INTO " . static::$table . " (deskripsi,gambar,pilihan,jawaban,status_soal) VALUES (?,?,?,?,?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $soal->deskripsi);
        $stmt->bindParam(2, $soal->gambar);
        $stmt->bindParam(3, $soal->pilihan);
        $stmt->bindParam(4, $soal->jawaban);
        $stmt->bindParam(5, $soal->status);
        return $stmt->execute();
    }

    public function saveWithoutImage(SoalExam  $soal) {
        $sql = "INSERT INTO " . static::$table . " (deskripsi,pilihan,jawaban,status_soal) VALUES (?,?,?,?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $soal->deskripsi);
        $stmt->bindParam(2, $soal->pilihan);
        $stmt->bindParam(3, $soal->jawaban);
        $stmt->bindParam(4, $soal->status);
        return $stmt->execute();
    }

    public function saveWithoutImageAndAnswer(SoalExam $soal) {
        $sql = "INSERT INTO " . static::$table . " (deskripsi,pilihan,status_soal) VALUES (?,?,?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $soal->deskripsi);
        $stmt->bindParam(2, $soal->pilihan);
        $stmt->bindParam(3, $soal->status);
        return $stmt->execute();
    }

    public function saveWithoutAnswer(SoalExam $soal) {
        $sql = "INSERT INTO " . static::$table . " (deskripsi,gambar,pilihan,status_soal) VALUES (?,?,?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $soal->deskripsi);
        $stmt->bindParam(2, $soal->gambar);
        $stmt->bindParam(3, $soal->pilihan);
        $stmt->bindParam(4, $soal->status);
        return $stmt->execute();
    }
    
}