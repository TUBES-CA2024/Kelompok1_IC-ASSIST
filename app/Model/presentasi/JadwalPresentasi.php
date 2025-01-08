<?php
namespace App\Model\Presentasi;
use App\Core\Model;

class JadwalPresentasi extends Model {
    protected static $table = 'jadwal_presentasi';
    protected $id;
    protected $id_presentasi;
    protected $id_ruangan;
    protected $tanggal;
    protected $waktu;

    public function __construct(
        $id  = null,
        $id_presentasi = null,
        $id_ruangan = null,
        $tanggal = null,
        $waktu = null
    ) {
        $this->id = $id;
        $this->id_presentasi = $id_presentasi;
        $this->id_ruangan = $id_ruangan;
        $this->tanggal = $tanggal;
        $this->waktu = $waktu;
    }

    public function save(JadwalPresentasi $jadwalPresentasi) {
        $sql = "INSERT INTO " . static::$table . "(id_presentasi,id_ruangan,tanggal,waktu) VALUES (?,?,?,?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(1,$jadwalPresentasi->id_presentasi);
        $stmt->bindParam(2,$jadwalPresentasi->id_ruangan);
        $stmt->bindParam(3,$jadwalPresentasi->tanggal);
        $stmt->bindParam(4,$jadwalPresentasi->waktu);
        return $stmt->execute();
    }
    
}