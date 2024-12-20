<?php

namespace App\Model\User;
use App\Core\Model;

class NotificationUser extends Model {
    protected static $table = 'notifikasi';
    protected $id;
    protected $id_mahasiswa;
    protected $pesan;

    public function __construct(
        $id_mahasiswa = null,
        $pesan = null
    ) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->pesan = $pesan;
    }

    public function getAll() {
        $query = "SELECT * FROM " . static::$table;
        $stmt = self::getDB()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $data = [];
        foreach ($result as $stmt) {
            $data[] = [
                'id' => $stmt['id'],
                'id_mahasiswa' => $stmt['id_mahasiswa'],
                'pesan' => $stmt['pesan']
            ];
        }

        return $data;
    }

    public function getById($idMahasiswa) {
        $query = "SELECT * FROM " . static::$table . " WHERE id_mahasiswa = :idMahasiswa";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id', $idMahasiswa);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function insert(NotificationUser $notification) {
        $query = "INSERT INTO " . static::$table . " (id_mahasiswa, pesan) VALUES (:id_mahasiswa, :pesan)";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':id_mahasiswa', $notification->id_mahasiswa);
        $stmt->bindParam(':pesan', $notification->pesan);
        $stmt->execute();
    }
}