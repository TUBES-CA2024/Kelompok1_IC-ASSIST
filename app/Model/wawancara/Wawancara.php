<?php
namespace App\Model\Wawancara;
use App\Core\Model;

class Wawancara extends Model {
    protected static $table = 'wawancara';
    protected $id;
    protected $id_mahasiswa;
    protected $jenis_wawancara;
    protected $absensi;

    public function __construct(
        $id_mahasiswa = null,
        $jenis_wawancara = null,
        $absensi = null
    ) {
        if($absensi == null) {
            $this->id_mahasiswa = $id_mahasiswa;
            $this->jenis_wawancara = $jenis_wawancara;
        } else {
            $this->id_mahasiswa = $id_mahasiswa;
            $this->jenis_wawancara = $jenis_wawancara;
            $this->absensi = $absensi;
        }
    }
    
}