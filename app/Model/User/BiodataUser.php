<?php 

namespace App\Model\User;
use App\Core\Model;
use PDO;
class BiodataUser extends Model {
    protected static $table = 'mahasiswa';
    protected $id;
    protected $idUser;
    protected $idJurusan;
    protected $stambuk;
    protected $id_kelas;
    protected $namaLengkap;
    protected $alamat;
    protected $jenisKelamin;
    protected $tempatLahir;
    protected $tanggalLahir;
    protected $noHp;

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

    public function getBiodata($id) {
        $query = 
        "SELECT stambuk,(SELECT nama FROM kelas where id = id_kelas) as kelas,
        (SELECT nama FROM jurusan where id = id_jurusan) as jurusan, 
        nama_lengkap, alamat, jenis_kelamin, tempat_lahir, tanggal_lahir, 
        no_telp FROM " . static::$table . " where id_user = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt) {
            $stmt = [
                "stambuk" => $stmt["stambuk"],
                "kelas" => $stmt["kelas"],
                "jurusan" => $stmt["jurusan"],
                "namaLengkap" => $stmt["nama_lengkap"],
                "alamat" => $stmt["alamat"],
                "jenisKelamin" => $stmt["jenis_kelamin"],
                "tempatLahir" => $stmt["tempat_lahir"],
                "tanggalLahir" => $stmt["tanggal_lahir"],
                "noHp" => $stmt["no_telp"]
            ];
            return $stmt;
        }
       return null;
    }
}