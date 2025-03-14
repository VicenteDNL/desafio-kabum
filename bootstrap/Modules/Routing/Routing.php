<?php

namespace Bootstrap\Modules\Routing;

use Bootstrap\Contracts\Routing as ContractsRouting;

class Routing implements ContractsRouting
{
    private static Routing $instance;
    private static array $routes = [];

    private function __construct(string $routesPath)
    {
        require $routesPath;
    }

    public static function init(string $routesPath): Routing
    {

        if (!isset(self::$instance)) {
            self::$instance = new Routing($routesPath);
        }

        return self::$instance;
    }

    public static function add(string $method, string $path, callable $handler): void
    {
        self::$routes[] = [
            'method'  => strtoupper($method),
            'path'    => $path,
            'handler' => $handler,
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        foreach (self::$routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $uri) {
                call_user_func($route['handler']);
                return;
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }
}
