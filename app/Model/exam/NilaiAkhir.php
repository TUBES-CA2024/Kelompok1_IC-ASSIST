<?php
namespace App\Model\Exam;

use app\Core\Model;
use PDO;
class NilaiAkhir extends Model {
    protected static $table = "nilai_akhir";
    protected $id;
    
    protected $id_mahasiswa;
    protected $nilai;

    public function saveNilai($id) {
        $total_nilai = 0;
    $poin_per_benar = 10;

    $query = "SELECT id_soal, jawaban FROM jawaban WHERE id_mahasiswa = :id_mahasiswa";
    $stmt = self::getDB()->prepare($query);
    $id_user = $this->getIdMahasiswa($id)['id'];
    $stmt->bindParam(':id_mahasiswa', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $user_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($user_answers as $answer) {
        $id_soal = $answer['id_soal'];
        $jawaban_user = $answer['jawaban'];

        $query_soal = "SELECT pilihan, jawaban FROM soal WHERE id = :id_soal";
        $stmt_soal = self::getDB()->prepare($query_soal);
        $stmt_soal->bindParam(':id_soal', $id_soal, PDO::PARAM_INT);
        $stmt_soal->execute();
        $soal_data = $stmt_soal->fetch(PDO::FETCH_ASSOC);

        if ($soal_data) {
            $pilihan = json_decode($soal_data['pilihan'], true);
            $correct_answer = $soal_data['jawaban'];
            if (isset($pilihan[$jawaban_user]) && $pilihan[$jawaban_user] === $correct_answer) {
                $total_nilai += $poin_per_benar;
            }
        }
    }

    $query_update = "INSERT INTO nilai_akhir (id_mahasiswa, nilai, created_at)
                     VALUES (:id_mahasiswa, :nilai, NOW())
                     ON DUPLICATE KEY UPDATE nilai = :nilai, modified = NOW()";
    $stmt_update = self::getDB()->prepare($query_update);
    $stmt_update->bindParam(':id_mahasiswa', $id_user, PDO::PARAM_INT);
    $stmt_update->bindParam(':nilai', $total_nilai, PDO::PARAM_INT);
    $stmt_update->execute();

    return $total_nilai;
    }
    
    public function getNilai($id) {
        $query = "SELECT nilai FROM " . self::$table . " WHERE id_mahasiswa = :id_mahasiswa";
        $stmt = self::getDB()->prepare($query);
        $id_mahasiswa = $this->getIdMahasiswa($id);
        $stmt->bindParam(':id_mahasiswa', $id_mahasiswa);
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