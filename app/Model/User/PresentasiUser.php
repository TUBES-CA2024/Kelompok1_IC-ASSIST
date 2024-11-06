<?php

namespace App\Model\User;
use App\Core\Model;
use PDO;
use \Exception;
class PresentasiUser extends Model {
    protected static $table = 'presentasi';
    protected $id;
    protected $id_mahasiswa;
    protected $judul;
    protected $makalah;
    protected $ppt;
    protected $is_revisi;
    protected $is_accepted;
    protected $absensi;
    protected $pptSize;
    protected $makalahSize;
    public function __construct(
        $id_mahasiswa = null,
        $judul = null,
        $makalah = null,
        $makalahSize = null,
        $ppt = null,
        $pptSize = null,
        $is_revisi = null,
        $is_accepted = null
    ) {
        if ($makalah === null && $makalahSize === null && $ppt === null && $pptSize === null) {
            $this->id_mahasiswa = $id_mahasiswa;
            $this->judul = $judul;
        } else {
            $this->id_mahasiswa = $id_mahasiswa;
            $this->makalah = $makalah;
            $this->ppt = $ppt;
            $this->is_revisi = $is_revisi;
            $this->is_accepted = $is_accepted;
            $this->makalahSize = $makalahSize;
            $this->pptSize = $pptSize;
        }
    }

    public function saveJudul(PresentasiUser $presentasiUser) {
        $query = "INSERT INTO " . static::$table . " 
            (id_mahasiswa, judul) 
            VALUES 
            (?, ?)";
        $stmt = self::getDB()->prepare($query);
    
        $idMahasiswa = $this->getIdMahasiswa($presentasiUser->id_mahasiswa);
        if (!$idMahasiswa || !isset($idMahasiswa['id'])) {
            throw new Exception("Mahasiswa tidak ditemukan" + var_dump($idMahasiswa)); 
        }
        $idMahasiswa = $idMahasiswa['id'];
        $stmt->bindParam(1, $idMahasiswa, PDO::PARAM_INT);
        $stmt->bindParam(2, $presentasiUser->judul, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    public function updateMakalahAndPpt(PresentasiUser $presentasiUser) {
        $query = "UPDATE " . static::$table . " 
            SET makalah = ?, ppt = ? WHERE id_mahasiswa = ?";
        $stmt = self::getDB()->prepare($query);

        $idMahasiswa = $this->getIdMahasiswa($presentasiUser->id_mahasiswa);
        if (!$idMahasiswa || !isset($idMahasiswa['id'])) {
            throw new Exception("Mahasiswa tidak ditemukan" + var_dump($idMahasiswa)); 
        }

        $filePpt = $this->getFilePpt($presentasiUser->ppt, $presentasiUser->pptSize);
        if (!$filePpt) {
            throw new Exception("Gagal memproses ppt");
        }
        $fileMakalah = $this->getFileMakalah($presentasiUser->makalah, $presentasiUser->makalahSize);
        if(!$fileMakalah) {
            throw new Exception("Gagal memproses makalah");
        }

        $idMahasiswa = $idMahasiswa['id'];
        $stmt->bindParam(1, $presentasiUser->makalah, PDO::PARAM_STR);
        $stmt->bindParam(2, $fileMakalah, PDO::PARAM_STR);
        $stmt->bindParam(3, $filePpt, PDO::PARAM_INT);
    }
    
    private function getFilePpt($berkas, $berkasSize) {
        $fileExt = strtolower(pathinfo($_FILES['ppt']['name'], PATHINFO_EXTENSION));
        if ($fileExt !== $this->fileAccepted) {
            throw new Exception("Gunakan ekstensi pdf untuk file.");
        }
    
        if ($berkasSize > $this->maxFileSize) {
            throw new Exception("Ukuran file terlalu besar.");
        }
    
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/berkasUser/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Membuat direktori jika tidak ada
        }
    
        $newFileName = uniqid() . '.' . $fileExt;
    
        if (empty($berkas)) {
            throw new Exception("Path file sementara untuk CV kosong.");
        }
    
        $destination = $uploadDir . $newFileName;
        if (!move_uploaded_file($berkas, $destination)) {
            throw new Exception("Gagal memindahkan file CV. Pastikan folder tujuan dapat diakses.");
        }
    
        return $newFileName;
    }

    private function getFileMakalah($berkas, $berkasSize) {
        $fileExt = strtolower(pathinfo($_FILES['makalah']['name'], PATHINFO_EXTENSION));
        if ($fileExt !== $this->fileAccepted) {
            throw new Exception("Gunakan ekstensi pdf untuk file.");
        }
    
        if ($berkasSize > $this->maxFileSize) {
            throw new Exception("Ukuran file terlalu besar.");
        }
    
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/tubes_web/res/berkasUser/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Membuat direktori jika tidak ada
        }
    
        $newFileName = uniqid() . '.' . $fileExt;
    
        if (empty($berkas)) {
            throw new Exception("Path file sementara untuk CV kosong.");
        }
    
        $destination = $uploadDir . $newFileName;
        if (!move_uploaded_file($berkas, $destination)) {
            throw new Exception("Gagal memindahkan file CV. Pastikan folder tujuan dapat diakses.");
        }
    
        return $newFileName;
    }
    private function getIdMahasiswa($idUser) {
        $query = "SELECT id FROM mahasiswa WHERE id_user = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }
    public function getAllPresentasi($id) {
        $query = "SELECT * FROM " . static::$table . " WHERE id_mahasiswa = ?";
        $idMahasiswa = $this->getIdMahasiswa($id);
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1,$idMahasiswa['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            return null;
        }
        return $result;
    }
    public function getValueForTable($id) {
        $query = "SELECT judul, is_revisi, is_accepted,created_at FROM " . static::$table . " WHERE id_mahasiswa = ?";
        $stmt = self::getDB()->prepare($query);
        $idMahasiswa = $this->getIdMahasiswa($id);
        $stmt->bindParam(1,$idMahasiswa['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            return null;
        }
        return $result ?? [];
    }
    public function isAccepted($id) {
        $query = "SELECT is_accepted FROM " . static::$table . " WHERE id_mahasiswa = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            return null;
        }
        return $result['is_accepted'];
    }
}