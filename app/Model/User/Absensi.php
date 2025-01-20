<?php
namespace App\Model\User;
use App\Core\Model;
class Absensi extends Model {
    protected static $table = 'absensi';
    protected $id;
    protected $wawancaraI;
    protected $wawancaraII;
    protected $wawancaraIII;
    protected $tesTertulis;
    protected $presentasi;
    
    public function __construct(
        $wawancaraI = null,
        $wawancaraII = null,
        $wawancaraIII = null,
        $tesTertulis = null,
        $presentasi = null
    ) {
        $this->wawancaraI = $wawancaraI;
        $this->wawancaraII = $wawancaraII;
        $this->wawancaraIII = $wawancaraIII;
        $this->tesTertulis = $tesTertulis;
        $this->presentasi = $presentasi;
    }
    public function getAbsensi() {
        $sql = "SELECT
        a.id, 
                    m.nama_lengkap, 
                    m.stambuk, 
                    a.absensi_wawancara_I, 
                    a.absensi_wawancara_II, 
                    a.absensi_wawancara_III, 
                    a.absensi_tes_tertulis, 
                    a.absensi_presentasi 
                FROM " . self::$table . " a 
                JOIN mahasiswa m ON a.id_mahasiswa = m.id";
    
        try {
            $stmt = self::getDB()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error in getAbsensi: " . $e->getMessage());
            return [];
        }
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
    
    public function addMahasiswa(Absensi $absensi, $id) {
        if (!is_array($id) || empty($id)) {
            throw new \InvalidArgumentException("Parameter 'id' harus berupa array dan tidak boleh kosong.");
        }
    
        $sql = "INSERT INTO " . self::$table . " 
                (id_mahasiswa, absensi_wawancara_I, absensi_wawancara_II, absensi_wawancara_III, absensi_tes_tertulis, absensi_presentasi) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = self::getDB()->prepare($sql);
        
        foreach ($id as $id_mahasiswa) {
            $stmt->bindValue(1, $id_mahasiswa);
            $stmt->bindValue(2, $absensi->wawancaraI);
            $stmt->bindValue(3, $absensi->wawancaraII);
            $stmt->bindValue(4, $absensi->wawancaraIII);
            $stmt->bindValue(5, $absensi->tesTertulis);
            $stmt->bindValue(6, $absensi->presentasi);
            $stmt->execute();
        }
        return true;
    }
    
}