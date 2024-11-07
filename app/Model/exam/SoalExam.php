<?php
namespace App\Model\Exam;

use App\Core\Model;
use PDO;
class SoalExam extends Model {
    protected static $table = 'soal';
    protected $id;
    protected $deskripsi;
    protected $pilihan;

    
    public function getAll() {
        $query = "SELECT * FROM " . self::$table;
        $stmt = self::getDB()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAllByParity($isGanjil) {
        $parity = $isGanjil ? 1 : 0; // 1 untuk ganjil, 0 untuk genap
        $query = "SELECT * FROM " . self::$table . " WHERE id % 2 = :parity LIMIT 60";
        $stmt = self::getDB()->prepare($query);
        $stmt->bindParam(':parity', $parity, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}