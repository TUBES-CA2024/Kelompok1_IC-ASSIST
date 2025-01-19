<?php
namespace App\Model\User;
use App\Core\Model;
class Absensi extends Model {
    protected static $table = 'absensi';
    public function getAbsensi() {
        $sql = "SELECT m.nama_lengkap, m.stambuk a.absensi_wawancara_I, a.absensi_wawancara_II, absensi_wawancara_III, absensi_tes_tertulis, absensi_presentasi FROM " . self::$table . " a JOIN mahasiswa m ON a.id_mahasiswa = m.id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateTesTertulisAbsensi($id) {
        $sql = "UPDATE ". self::$table . " SET absensi_tes_tertulis = Hadir WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updatePresentasiAbsensi($id) {
        $sql = "UPDATE ". self::$table . " SET absensi_presentasi = Hadir WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateWawancaraAbsensiI($id) {
        $sql = "UPDATE ". self::$table . " SET absensi_wawancara_I = Hadir WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updateWawancaraAbsensiII($id) {
        $sql = "UPDATE ". self::$table . " SET absensi_wawancara_II = Hadir WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updateWawancaraAbsensiIII($id) {
        $sql = "UPDATE ". self::$table . " SET absensi_wawancara_III = Hadir WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    
}