<?php

namespace App\Core;

use App\Core\Router;

class App {
    public function run() {
        require_once "../routes/web.php";
    
        $path = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $method = $_SERVER['REQUEST_METHOD'];
    
        Router::route($method, $path);
    }
}