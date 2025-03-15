<?php

namespace Bootstrap\Modules\Routing;

use Bootstrap\Contracts\Controller;
use Bootstrap\Contracts\Router as ContractsRouter;
use Bootstrap\Contracts\Routing as ContractsRouting;
use Bootstrap\Modules\Routing\Exceptions\RouteNotFound;
use Bootstrap\Modules\Routing\Exceptions\RouterActionNotExist;
use Bootstrap\Modules\Routing\Exceptions\RouterControllerIsNotInstance;
use Bootstrap\Modules\Routing\Exceptions\RouterControllerNotExist;
use Bootstrap\Modules\Routing\Resources\Router;

class Routing implements ContractsRouting
{
    private static Routing $instance;

    /** @var ContractsRouter[] $routes */
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

    public static function add(string $method, string $path, string $controller, string $action): void
    {
        self::$routes[] = new Router(
            strtoupper($method),
            $path,
            $controller,
            $action
        );

    }

    public function getRoute(string $method, string $uri): Router
    {
        foreach (self::$routes as $route) {
            if ($route->method() === strtoupper($method) && $this->matchRouter($route->path(), $uri)) {

                if(!class_exists($route->controller())) {
                    throw new RouterControllerNotExist();
                }

                if($route->controller() instanceof Controller) {
                    throw new RouterControllerIsNotInstance();
                }

                if(!method_exists($route->controller(), $route->action())) {
                    throw new RouterActionNotExist();
                }

                return $route;
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
