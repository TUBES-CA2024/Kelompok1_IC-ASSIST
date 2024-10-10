<?php 

namespace App\Model\User\BiodataUser;
use App\Core\Model;

class BiodataUser extends Model {
    private static $table = 'mahasiswa';
    private $id;
    private $idUser;
    private $idJurusan;
    private $stambuk;
    private $id_kelas;
    private $namaLengkap;
    private $alamat;
    private $jenisKelamin;
    private $tempatLahir;
    private $tanggalLahir;
    private $noHp;

    public function __construct(
        $id = null, 
        $idUser = null, 
        $idJurusan = null, 
        $stambuk = null, 
        $id_kelas = null, 
        $namaLengkap = null, 
        $alamat = null, 
        $jenisKelamin = null, 
        $tempatLahir = null, 
        $tanggalLahir = null, 
        $noHp = null
        ) {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->idJurusan = $idJurusan;
        $this->stambuk = $stambuk;
        $this->id_kelas = $id_kelas;
        $this->namaLengkap = $namaLengkap;
        $this->alamat = $alamat;
        $this->jenisKelamin = $jenisKelamin;
        $this->tempatLahir = $tempatLahir;
        $this->tanggalLahir = $tanggalLahir;
        $this->noHp = $noHp;
    }

    public function save() {
        $query = "INSERT INTO mahasiswa 
        (idUser, idJurusan, stambuk, id_kelas, namaLengkap, alamat, jenisKelamin, tempatLahir, tanggalLahir, noHp) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $this->idUser);
        $stmt->bindParam(2, $this->idJurusan);
        $stmt->bindParam(3, $this->stambuk);
        $stmt->bindParam(4, $this->id_kelas);
        $stmt->bindParam(5, $this->namaLengkap);
        $stmt->bindParam(6, $this->alamat);
        $stmt->bindParam(7, $this->jenisKelamin);
        $stmt->bindParam(8, $this->tempatLahir);
        $stmt->bindParam(9, $this->tanggalLahir);
        $stmt->bindParam(10, $this->noHp);
        return $stmt->execute();
    }

    public function isEmpty() {

        $query = "SELECT * FROM mahasiswa WHERE idUser = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $this->idUser);
        $stmt->execute();
        $result = $stmt->fetch()->first();

        return ($result['id_jurusan'] == null || $result['stambuk'] == null
        || $result['id_kelas'] == null || $result['namaLengkap'] == null
        || $result['alamat'] == null || $result['jenisKelamin'] == null
        || $result['tempatLahir'] == null || $result['tanggalLahir'] == null
        || $result['noHp'] == null) 
        ? true : false;
    }
    
}