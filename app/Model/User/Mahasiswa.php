<?php

namespace App\Model\User;
use App\Core\Model;

class Mahasiswa extends Model {
    

    protected static $table = 'mahasiswa';
    protected static $tabelJurusan = 'jurusan';
    protected static $tabelKelas = 'kelas';
    protected $id;
    protected $idUser;
    protected $idJurusan;
    protected $jurusan;
    protected $kelas;
    protected $stambuk;
    protected $id_kelas;
    protected $namaLengkap;
    protected $alamat;
    protected $jenisKelamin;
    protected $tempatLahir;
    protected $tanggalLahir;
    protected $noHp;

    public function __construct( 
        $idUser = null, 
        $jurusan = null, 
        $stambuk = null, 
        $kelas = null, 
        $namaLengkap = null, 
        $alamat = null, 
        $jenisKelamin = null, 
        $tempatLahir = null, 
        $tanggalLahir = null, 
        $noHp = null
        ) {
        $this->idUser = $idUser;
        $this->jurusan = $jurusan;
        $this->stambuk = $stambuk;
        $this->kelas = $kelas;
        $this->namaLengkap = $namaLengkap;
        $this->alamat = $alamat;
        $this->jenisKelamin = $jenisKelamin;
        $this->tempatLahir = $tempatLahir;
        $this->tanggalLahir = $tanggalLahir;
        $this->noHp = $noHp;
    }

    public function getAll() {
        $query = "SELECT * FROM " . static::$table;
        $stmt = self::getDB()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
    
        $data = [];
        foreach ($result as $stmt) {
            $berkas = $this->getBerkasMahasiswa($stmt['id']);
    
            $data[] = [
                'id' => $stmt['id'],
                'nama_lengkap' => $stmt['nama_lengkap'],
                'stambuk' => $stmt['stambuk'],
                'jurusan' => $this->getJurusan($stmt['id_jurusan'])['nama'] ?? null,
                'kelas' => $this->getKelas($stmt['id_kelas'])['nama'] ?? null,
                'alamat' => $stmt['alamat'],
                'notelp' => $stmt['no_telp'],
                'tempat_lahir' => $stmt['tempat_lahir'],
                'tanggal_lahir' => $stmt['tanggal_lahir'],
                'jenis_kelamin' => $stmt['jenis_kelamin'],
                'berkas' => $berkas
            ];
        }
    
        return $data;
    }
    
    public function getBerkasMahasiswa($mahasiswaId) {
        $query = "SELECT foto, cv, transkrip_nilai, surat_pernyataan FROM berkas_mahasiswa WHERE id_mahasiswa = :mahasiswa_id";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':mahasiswa_id', $mahasiswaId);
        $stmt->execute();
        $result = $stmt->fetch();
    
        return $result ?: [
            'foto' => null,
            'cv' => null,
            'transkrip_nilai' => null,
            'surat_pernyataan' => null
        ];
    }
    
    private function getJurusan($id) {
        $query = "SELECT nama FROM jurusan WHERE id = :id";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    private function getKelas($id) {
        $query = "SELECT nama FROM kelas WHERE id = :id";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}