<?php

namespace App\Core;

class Router {
    protected static $getRoutes = [];
    protected static $postRoutes = [];
    protected static $putRoutes = [];
    protected static $deleteRoutes = [];

    public static function get($path, $handler) {
        self::$getRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function post($path, $handler) {
        self::$postRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function put($path, $handler) {
        self::$putRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function delete($path, $handler) {
        self::$deleteRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function route($method, $path) {
        $routes = array();
        echo "Path received by router: " . $path;

        switch ($method) {
            case 'GET':
                $routes = self::$getRoutes;
                break;
            case 'POST':
                $routes = self::$postRoutes;
                break;
            case 'PUT':
                $routes = self::$putRoutes;
                break;
            case 'DELETE':
                $routes = self::$deleteRoutes;
                break;
        }

        foreach ($routes as $route) {
            $pattern = str_replace("/", "\/", $route['path']);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';
            
            echo "Checking route: " . $route['path'] . "<br>";

            if (preg_match($pattern, $path, $matches)) {
                echo "Route matched: " . $route['path'] . "<br>";
                $handler = $routes['handler'];
                return $handler($matches);
            }
            if ($path == basename($route['path'])) {
                echo "Route matched: " . $route['path'] . "<br>";
                $handler = $route['handler'];
                return $handler();
            }
        }
        
        $expectedPath = parse_url(APP_URL . '/miscellaneous/404', PHP_URL_PATH);
        echo "Actual Path: " . $path . "<br>";
        echo "Expected Path: " . $expectedPath . "<br>";
        
        if ($path !== $expectedPath) {
            redirect('miscellaneous/404');
        } else {
            echo "gacor";
            exit;
        }        
        
    }
}