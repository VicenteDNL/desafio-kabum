<?php

namespace Bootstrap\Modules\Routing;

use Bootstrap\Contracts\Routing as ContractsRouting;
use Bootstrap\Modules\Routing\Exceptions\RouteNotFound;
use Closure;

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

    public function handler(string $method, string $uri): Closure
    {
        foreach (self::$routes as $route) {
            if ($route['method'] === strtoupper($method) && $this->matchRouter($route['path'], $uri)) {
                return $route['handler'];
            }
        }
        throw new RouteNotFound();
    }

    private function matchRouter(string $route, string $uri)
    {
        $routeBlock = $this->demystifiesRoute($route);
        $uriBlock = $this->demystifiesRoute($uri);

        if(count($routeBlock) != count($uriBlock)) {
            return false;
        }

        foreach($uriBlock as $key => $block) {
            if(!($block == $routeBlock[$key]) && !$this->isRouteParam($routeBlock[$key])) {
                return false;
            }
        }

        return true;
    }

    private function isRouteParam(string $uri)
    {
        return preg_match('/^\{.+\}$/', $uri);
    }

    private function demystifiesRoute(string $uri)
    {
        return array_values(array_diff(explode('/', $uri), ['']));
    }
}
