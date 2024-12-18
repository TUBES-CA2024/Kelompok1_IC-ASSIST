<?php

namespace App\Model\User;

use App\Core\Model;
use App\Core\Database;
use PDO;

class UserModel extends Model {
    protected static $table = 'user';
    protected $id;
    protected $username;
    protected $name;
    protected $stambuk;
    protected $password;
    protected $role;
    protected $created_at;
    protected $modified;

    public function __construct2($username, $stambuk, $password) {
        $this->username = $username;
        $this->stambuk = $stambuk;
        $this->password = $password;
    }
    public function __construct($id = null, $username = null, $stambuk = null, $password = null, $role = null, $created_at = null, $modified = null) {
        $this->id = $id;
        $this->username = $username;
        $this->stambuk = $stambuk;
        $this->password = $password;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->modified = $modified;
    }

    

    public function save() {
        $query = "INSERT INTO user (username, stambuk, password) VALUES (?, ?, ?)";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->stambuk);
        $stmt->bindParam(3, $this->password);
        return $stmt->execute();
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getName() {
        return $this->name;
    }

    public function getStambuk() {
        return $this->stambuk;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getModified() {
        return $this->modified;
    }

    public static function getDB() {
        return Database::getInstance();
    }
    public static function findByStambuk($stambuk) {
        $query = "SELECT * FROM " . static::$table . " WHERE stambuk = :stambuk LIMIT 1";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':stambuk', $stambuk);
    
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            var_dump($stmt->errorInfo());
            return null;
        }
    }
    public function getUser($id) {
        $query = "SELECT * 
        FROM " . static::$table . " WHERE id = ?";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = [
            "username" => $stmt['username'],
            "stambuk" => $stmt['stambuk'],
            "password" => $stmt['password'],
            "role" => $stmt['role']
        ];
        return $stmt;
    }
    
    public function isStambukExists($stambuk) {
        $query = "SELECT COUNT(*) FROM " . static::$table . " WHERE stambuk = :stambuk";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':stambuk', $stambuk);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }
    
}