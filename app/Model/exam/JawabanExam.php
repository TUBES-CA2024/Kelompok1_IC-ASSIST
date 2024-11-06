<?php
namespace App\Model\exam;

use app\Core\Model;
use PDO;
class JawabanExam extends Model {
    protected static $table = 'jawaban';
    protected $id;
    protected $id_soal;
    protected $id_mahasiswa;
    protected $jawaban;


    public function saveJawaban($id_soal, $id_user, $jawaban) {
        $query = "INSERT INTO " . self::$table . " (id_soal, id_mahasiswa, jawaban) VALUES (:id_soal, :id_mahasiswa, :jawaban)";
        
        $mahasiswa = $this->getIdMahasiswa($id_user);
        if (!$mahasiswa || !isset($mahasiswa['id'])) {
            return false; 
        }
        $id_mahasiswa = $mahasiswa['id'];
        
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id_soal', $id_soal, PDO::PARAM_INT);
        $stmt->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
        $stmt->bindParam(':jawaban', $jawaban, PDO::PARAM_STR); 
        
        return $stmt->execute();
    }
    public function getJawaban($id_soal) {
        $query = "SELECT jawaban FROM " . self::$table . " WHERE id_soal = :id_soal";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id_soal', $id_soal);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    private function getIdMahasiswa($idUser) {
        $query = "SELECT id FROM mahasiswa WHERE id_user = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }
}