<?php
namespace App\Model\Exam;

use app\Core\Model;
use PDO;
class NilaiAkhir extends Model {
    protected $id;
    
    protected $id_mahasiswa;
    protected $nilai;

    public function saveNilai($id) {
        $total_nilai = 0;
        $poin_per_benar = 10;

        $query = "SELECT id_soal, jawaban FROM jawaban WHERE id_mahasiswa = :id_mahasiswa";
        $id_mahasiswa = $this->getIdMahasiswa($id);
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
        $stmt->execute();
        $user_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($user_answers as $answer) {
            $id_soal = $answer['id_soal'];
            $jawaban_user = $answer['jawaban'];

            $query_soal = "SELECT jawaban FROM soal WHERE id = :id_soal";
            $stmt_soal = self::getDB()->prepare($query_soal);
            $stmt_soal->bindParam(':id_soal', $id_soal, PDO::PARAM_INT);
            $stmt_soal->execute();
            $correct_answer = $stmt_soal->fetch(PDO::FETCH_ASSOC);

            if ($correct_answer && $correct_answer['jawaban'] == $jawaban_user) {
                $total_nilai += $poin_per_benar;
            }
        }

        $check_query = "SELECT id FROM " . self::$table . " WHERE id_mahasiswa = :id_mahasiswa";
        $stmt_check = self::getDB()->prepare($check_query);
        $stmt_check->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            $update_query = "UPDATE " . self::$table . " SET nilai = :nilai, modified = NOW() WHERE id_mahasiswa = :id_mahasiswa";
            $stmt_update = self::getDB()->prepare($update_query);
            $stmt_update->bindParam(':nilai', $total_nilai, PDO::PARAM_INT);
            $stmt_update->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
            $stmt_update->execute();
        } else {
            $insert_query = "INSERT INTO " . self::$table . " (id_mahasiswa, nilai, created_at) VALUES (:id_mahasiswa, :nilai, NOW())";
            $stmt_insert = self::getDB()->prepare($insert_query);
            $stmt_insert->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
            $stmt_insert->bindParam(':nilai', $total_nilai, PDO::PARAM_INT);
            $stmt_insert->execute();
        }

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