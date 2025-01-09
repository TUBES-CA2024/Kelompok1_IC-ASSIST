<?php
namespace App\Model\Presentasi;
use App\Core\Model;

class JadwalPresentasi extends Model
{
    protected static $table = 'jadwal_presentasi';
    protected $id;
    protected $id_presentasi;
    protected $id_ruangan;
    protected $tanggal;
    protected $waktu;

    public function __construct(
        $id_presentasi = null,
        $id_ruangan = null,
        $tanggal = null,
        $waktu = null
    ) {
        $this->id_presentasi = $id_presentasi;
        $this->id_ruangan = $id_ruangan;
        $this->tanggal = $tanggal;
        $this->waktu = $waktu;
    }

    public function save(JadwalPresentasi $jadwalPresentasi, $mahasiswas)
    {
        foreach ($mahasiswas as $mahasiswa) {
            $sql = "INSERT INTO " . static::$table . " 
            (id_presentasi,id_ruangan,tanggal,waktu) VALUES (?,?,?,?)";
            $stmt = self::getDB()->prepare($sql);
            $stmt->bindParam(1, $mahasiswa['id']);                  
            $stmt->bindParam(2, $jadwalPresentasi->id_ruangan);
            $stmt->bindParam(3, $jadwalPresentasi->tanggal);
            $stmt->bindParam(4, $jadwalPresentasi->waktu);
        }

        if (!$stmt->execute()) {
            error_log(print_r($stmt->errorInfo(), true));
            return false;
        }
        return true;

    }

}