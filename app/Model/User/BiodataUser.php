<?php 

namespace App\Model\User;
use App\Core\Model;
use PDO;
class BiodataUser extends Model {
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

    public function save(BiodataUser $biodata) {
        $query = "INSERT INTO " . static::$table . " 
            (id_user, id_jurusan, stambuk, id_kelas, nama_lengkap, alamat, jenis_kelamin, tempat_lahir, tanggal_lahir, no_telp) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = self::getDB()->prepare($query);
    
        // Konversi nama jurusan ke id jurusan
        $idJurusanData = $this->getIdJurusan($biodata->jurusan);
        if (!$idJurusanData) {
            throw new Exception("Jurusan tidak ditemukan: " . $biodata->jurusan);
        }
        $biodata->idJurusan = $idJurusanData['id'];
        
        $jenisKelamin = ucfirst($biodata->jenisKelamin);
        // Konversi nama kelas ke id kelas
        $idKelasData = $this->getIdKelas($biodata->kelas);
        if (!$idKelasData) {
            throw new Exception("Kelas tidak ditemukan: " . $biodata->kelas);
        }
        $biodata->id_kelas = $idKelasData['id'];
        
        $stmt->bindParam(1, $biodata->idUser);
        $stmt->bindParam(2, $biodata->idJurusan);
        $stmt->bindParam(3, $biodata->stambuk);
        $stmt->bindParam(4, $biodata->id_kelas);
        $stmt->bindParam(5, $biodata->namaLengkap);
        $stmt->bindParam(6, $biodata->alamat);
        $stmt->bindParam(7, $jenisKelamin);
        $stmt->bindParam(8, $biodata->tempatLahir);
        $stmt->bindParam(9, $biodata->tanggalLahir);
        $stmt->bindParam(10, $biodata->noHp);
    
        return $stmt->execute();
    }
    

    private function getIdJurusan($namaJurusan)   {
        $query = "SELECT id FROM " . static::$tabelJurusan . " WHERE nama = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $namaJurusan);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [
            "id" => $result['id']
        ];
        return $result;
    }
    private function getIdKelas($namaKelas)   {
        $query = "SELECT id FROM " . static::$tabelKelas . " WHERE nama = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $namaKelas);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [
            "id" => $result['id']
        ];
        return $result;
    }
    public function isEmpty($idUser) {

        $query = "SELECT * FROM mahasiswa WHERE id_user = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $idUser);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Periksa apakah $result adalah array, jika tidak kembalikan true
        if (!$result) {
            return true;
        }
    
        return (
            $result['id_jurusan'] === null || $result['stambuk'] === null ||
            $result['id_kelas'] === null || $result['nama_lengkap'] === null ||
            $result['alamat'] === null || $result['jenis_kelamin'] === null ||
            $result['tempat_lahir'] === null || $result['tanggal_lahir'] === null ||
            $result['no_telp'] === null
        );
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