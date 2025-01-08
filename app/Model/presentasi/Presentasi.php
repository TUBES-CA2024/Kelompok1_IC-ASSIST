<?php

namespace App\Model\presentasi;

use App\Core\Model;
class Presentasi extends Model {

    static protected $table = 'presentasi';

    public function getAll() {
        $sql = "SELECT * FROM " . static::$table;
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        $data = [];
        foreach ($stmt as $result) {
            $nama = $this->getNameAndStambukFromPresentation($result['id_mahasiswa'])['nama_lengkap'];
            $stambuk =  $this->getNameAndStambukFromPresentation($result['id_mahasiswa'])['stambuk'];
            $berkas = $this->getPptAndMakalah($result['id_mahasiswa']);
            $data[] = [
                'id' => $result['id'],
                'id_mahasiswa' => $result['id_mahasiswa'],
                'nama' => $nama,
                'stambuk' => $stambuk,
                'judul' =>  $result['judul'],
                'berkas' => [
                    'ppt' => $berkas['ppt'],
                    'makalah' => $berkas['makalah']
                ]
            ];
        }
        return $data;
    }

    public function getAllAccStatus() {
        $sql = "SELECT * FROM " . static::$table . " WHERE is_accepted = 1";
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        $data = [];
        foreach ($stmt as $result) {
            $nama = $this->getNameAndStambukFromPresentation($result['id_mahasiswa'])['nama_lengkap'];
            $stambuk =  $this->getNameAndStambukFromPresentation($result['id_mahasiswa'])['stambuk'];
            $berkas = $this->getPptAndMakalah($result['id_mahasiswa']);
            $data[] = [
                'id' => $result['id'],
                'id_mahasiswa' => $result['id_mahasiswa'],
                'nama' => $nama,
                'stambuk' => $stambuk,
                'judul' =>  $result['judul'],
                'berkas' => [
                    'ppt' => $berkas['ppt'],
                    'makalah' => $berkas['makalah']
                ]
            ];
        }
        return $data;
    }


    public function getAbsensi() {
        $sql = "SELECT absensi,id_mahasiswa FROM " . static::$table;
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        $nama = $this->getNameAndStambukFromPresentation($stmt['id_mahasiswa'])['nama_lengkap'];
        $stambuk = $this->getNameAndStambukFromPresentation($stmt['id_mahasiswa'])['stambuk'];
        return [
            "nama" => $nama,
            "stambuk" => $stambuk,
            "absensi" => $stmt['absensi']
        ];
    }
    private function getNameAndStambukFromPresentation($id) {
        $sql = "SELECT stambuk,nama_lengkap from 
        mahasiswa where id = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
   
    private function getPptAndMakalah($id) {
        $sql = "SELECT ppt,makalah from " . 
        static::$table . " WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateJudulStatus($id) {
        $sql = "UPDATE " . static::$table . " SET is_accepted = 1 WHERE id_mahasiswa = :id";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
    }

}