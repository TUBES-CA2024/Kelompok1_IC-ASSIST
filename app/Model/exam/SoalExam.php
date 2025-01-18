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
    protected $fotoSize;
    private $imageAccepted = ['jpg', 'jpeg', 'png'];
    private $maxFileSize = 1024 * 1024 * 5; // 5mb 

    public function __construct(
        $deskripsi = null,
        $pilihan = null,
        $jawaban = null,
        $gambar = null,
        $fotoSize = null,
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
            $this->fotoSize = $fotoSize;
        } else {
            $this->deskripsi = $deskripsi;
            $this->pilihan = $pilihan;
            $this->jawaban = $jawaban;
            $this->gambar = $gambar;
            $this->status = $status;
            $this->fotoSize = $fotoSize;
        }
    }

    
    public function getGambar() {
        return $this->gambar;
    }
    public function getJawaban() {
        return $this->jawaban;
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
        $fileImage = $this->getImageNama($soal->gambar, $soal->fotoSize);
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $soal->deskripsi);
        $stmt->bindParam(2, $fileImage);
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
        $sql = "INSERT INTO " . static::$table . " (deskripsi,gambar,pilihan,status_soal) VALUES (?,?,?,?)";
        $fileGambar = $this->getImageNama($soal->gambar, $soal->fotoSize);
        if(!$fileGambar) {
            throw new \Exception("Gagal memproses gambar");
        }
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $soal->deskripsi);
        $stmt->bindParam(2, $fileGambar);
        $stmt->bindParam(3, $soal->pilihan);
        $stmt->bindParam(4, $soal->status);
        return $stmt->execute();
    }

    private function getImageNama($berkas, $berkasSize) {
        $imageExt = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        if (!in_array($imageExt, $this->imageAccepted)) {
            throw new \Exception("Gunakan ekstensi jpg, jpeg, atau png untuk gambar.");
        }
    
        if ($berkasSize > $this->maxFileSize) {
            throw new \Exception("Ukuran file gambar terlalu besar.");
        }
    
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/public/Assets/Img/soal/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); 
        }
    
        $newImageName = uniqid() . '.' . $imageExt;
    
        if (empty($berkas)) {
            throw new \Exception("Path file sementara kosong.");
        }
    
        $destination = $uploadDir . $newImageName;
        if (!move_uploaded_file($berkas, $destination)) {
            throw new \Exception("Gagal memindahkan file foto. Pastikan folder tujuan dapat diakses.");
        }
    
        return $newImageName;
    }
    
}