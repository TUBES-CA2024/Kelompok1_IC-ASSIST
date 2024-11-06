<?php

namespace App\Core;

class Router
{
    protected static $getRoutes = [];
    protected static $postRoutes = [];
    protected static $putRoutes = [];
    protected static $deleteRoutes = [];

    public static function get($path, $handler)
    {
        self::$getRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function post($path, $handler)
    {
        self::$postRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function put($path, $handler)
    {
        self::$putRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function delete($path, $handler)
    {
        self::$deleteRoutes[] = ['path' => $path, 'handler' => $handler];
    }

    public static function route($method, $path)
    {
        $routes = array();

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

        $found = false; 

        foreach ($routes as $route) {
            $pattern = str_replace("/", "\/", $route['path']);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            try {
                if (isset($route['handler']) && $path === $route['path']) {
                    $handler = $route['handler'];
                    $found = true; 
                    return is_callable($handler) ? $handler() : throw new Exception('Handler not callable.');
                }

                if (isset($route['handler']) && preg_match($pattern, $path, $matches)) {
                    $handler = $route['handler'];
                    $found = true; 
                    return is_callable($handler) ? $handler($matches) : throw new Exception('Handler not callable.');
                }
            } catch (\Exception $e) {
                redirect('miscellaneous/404');
            }
        }

        if (!$found) {
            echo "404 Not Found";
            redirect('miscellaneous/404');
        }


    }
}