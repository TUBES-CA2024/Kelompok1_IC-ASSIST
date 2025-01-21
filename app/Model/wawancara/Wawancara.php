<?php
namespace App\Model\Wawancara;
use App\Core\Model;

class Wawancara extends Model
{
    protected static $table = 'wawancara';
    protected $id;
    protected $id_mahasiswa;
    protected $id_ruangan;
    protected $jenis_wawancara;
    protected $waktu;
    protected $tanggal;
    public function __construct(
        $id_mahasiswa = null,
        $id_ruangan = null,
        $jenis_wawancara = null,
        $waktu = null,
        $tanggal = null,
    ) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->id_ruangan = $id_ruangan;
        $this->jenis_wawancara = $jenis_wawancara;
        $this->waktu = $waktu;
        $this->tanggal = $tanggal;
    }

    public function getAll()
    {
        $sql = "SELECT w.id,w.id_mahasiswa,m.nama_lengkap, m.stambuk, r.nama as ruangan, w.jenis_wawancara, w.waktu, w.tanggal FROM " . self::$table . " w JOIN mahasiswa m ON w.id_mahasiswa = m.id JOIN ruangan r ON w.id_ruangan = r.id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getWawancaraById($id)
    {
        $sql = "SELECT m.nama_lengkap, m.stambuk, r.nama, w.jenis_wawancara, w.waktu, w.tanggal FROM " . self::$table . " w JOIN mahasiswa m ON w.id_mahasiswa = :id JOIN ruangan r ON w.id_ruangan = r.id WHERE w.id = r.id";
        try {
            $stmt = self::getDB()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error in getWawancaraById: " . $e->getMessage());
            return [];
        }
    }
    public function save(Wawancara $wawancara)
    {
        $sql = "INSERT INTO " . self::$table . " (id_mahasiswa, id_ruangan, jenis_wawancara, waktu, tanggal) VALUES (?, ?, ?, ?, ?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1, $wawancara->id_mahasiswa);
        $stmt->bindParam(2, $wawancara->id_ruangan);
        $stmt->bindParam(3, $wawancara->jenis_wawancara);
        $stmt->bindParam(4, $wawancara->waktu);
        $stmt->bindParam(5, $wawancara->tanggal);
        return $stmt->execute();
    }
}