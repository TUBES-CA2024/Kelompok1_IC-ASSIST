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
        $id_ruangan = null,
        $tanggal = null,
        $waktu = null
    ) {
        $this->id_ruangan = $id_ruangan;
        $this->tanggal = $tanggal;
        $this->waktu = $waktu;
    }

    public function save(JadwalPresentasi $jadwalPresentasi, $mahasiswas)
    {

        foreach ($mahasiswas as $mahasiswa) {
            $sql = "INSERT INTO " . static::$table . " 
            (id_presentasi,id_ruangan,tanggal,waktu) VALUES (?,?,?,?)";
            $idRuangan = (int) $jadwalPresentasi->id_ruangan;
            $idPresentasi = (int) $mahasiswa['id'];
            $date = $this->validateAndFormatDate($jadwalPresentasi->tanggal);
            $time = $this->validateAndFormatTime($jadwalPresentasi->waktu);
            $stmt = self::getDB()->prepare($sql); 
            $stmt->bindParam(1, $idPresentasi);
            $stmt->bindParam(2, $idRuangan);
            $stmt->bindParam(3, $date);
            $stmt->bindParam(4, $time);
            if (!$stmt->execute()) {
                error_log(print_r($stmt->errorInfo(), true));
                return false;
            }
        }
        return true;

    }
    function validateAndFormatDate($date)
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            $year = (int) substr($date, 0, 4);
            if ($year >= 1900 && $year <= (int) date('Y')) {
                return $date;
            }
        }

        return null;
    }

    function validateAndFormatTime($time)
    {
        if (preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $time)) {
            if (strlen($time) === 5) {
                $time .= ":00";
            }
            return $time;
        }
        return null;
    }

}