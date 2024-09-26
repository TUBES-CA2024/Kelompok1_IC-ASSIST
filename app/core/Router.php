<?php

namespace App\Core;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Router {

    private static $getRoutes = [];
    private static $postRoutes = [];
    private static $putRoutes = [];
    private static $deleteRoutes = [];

    public static function get($path, $handler) {
        self::$getRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }
    public static function post($path, $handler) {
        self::$postRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }
    public static function put($path, $handler) {
        self::$putRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }
    public static function delete($path, $handler) {
        self::$deleteRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }
    public static function route($method, $path) {
        // Debugging: Tampilkan method dan path yang diterima
        echo "Method: " . $method . "<br>";
        echo "Requested Path: " . $path . "<br>";
    
        $routes = array();
        switch($method) {
            case 'GET' :
                $routes = self::$getRoutes;
                break;
    
            case 'PUT' :
                $routes = self::$putRoutes;
                break;
    
            case 'POST' :
                $routes = self::$postRoutes; 
                break;
    
            case 'DELETE' :
                $routes = self::$deleteRoutes;
                break;    
        }
    
        // Cek apakah path cocok dengan rute yang ada
        foreach($routes as $route) {
            $pattern = str_replace("/", "\/", $route['path']);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';
    
            // Debugging: Tampilkan pattern yang dibentuk
            echo "Matching Pattern: " . $pattern . "<br>";
    
            if (preg_match($pattern, $path, $matches)) {
                $handler = $route['handler'];
                return $handler($matches);
            }
        }
    
        // Jika tidak ada yang cocok, redirect ke halaman 404
        echo "No matching route found. Redirecting to 404...<br>"; // Debugging: Tampilkan sebelum redirect
        if($path != APP_URL . '/miscellaneous/404'){
            redirect(APP_URL . '/miscellaneous/404');
        }
    }
    
}

