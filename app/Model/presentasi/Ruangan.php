<?php

namespace App\Model\presentasi;

use App\Core\Model;

class Ruangan extends Model {


    static protected $table = 'ruangan';

    public function getAll() {
        $sql = "SELECT * FROM " . static::$table;
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function insertRuangan() {
        $sql = "INSERT INTO " . static::$table . " (nama_ruangan, kapasitas) VALUES (:nama_ruangan, :kapasitas)";
    }
    public function deleteRuangan() {

    }
    public function updateRuangan() {

    }
}