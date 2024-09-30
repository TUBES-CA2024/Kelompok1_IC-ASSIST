<?php

namespace App\Core;
use \PDO;
abstract class Model {
    protected static $table;
    protected static $primaryKey = "id";
    public static function all() {
        $sql = "SELECT * FROM " . static::$table;
        return Database::query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function find($id) {
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?";
        return Database::query($sql,['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }
    public static function paginate($limit = 10, $page = 1) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM " . static::$table . " LIMIT {$limit} OFFSET {$offset}";
        $countQuery = "SELECT COUNT(*) as total FROM " . static::$table;

        $result = Database::query($query)->fetchAll(PDO::FETCH_ASSOC);
        $total = Database::query($countQuery)->fetch(PDO::FETCH_ASSOC)['total'];

        $lastPage = ceil($total/$limit);

        return[
            'data' => $result,
            'current_page' => $page,
            'per_page' => $limit,
            'total' => $total,
            'last_page' => $lastPage
        ];
    }
}
