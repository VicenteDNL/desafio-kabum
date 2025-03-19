<?php

namespace Bootstrap\Modules\Routing;

use Bootstrap\Contracts\Controller;
use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Route as ContractsRoute;
use Bootstrap\Contracts\Routing as ContractsRouting;
use Bootstrap\Modules\Routing\Exceptions\RouteNotFound;
use Bootstrap\Modules\Routing\Exceptions\RouterActionNotExist;
use Bootstrap\Modules\Routing\Exceptions\RouterControllerIsNotInstance;
use Bootstrap\Modules\Routing\Exceptions\RouterControllerNotExist;
use Bootstrap\Modules\Routing\Resources\Route;
use Closure;

class Routing implements ContractsRouting
{
    private static Routing $instance;

    /** @var ContractsRoute[] $routes */
    private static array $routes = [];
    private static array $guardsMemory = [];

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
        self::$routes[] = new Route(
            strtoupper($method),
            $path,
            $controller,
            $action,
            [],
            self::$guardsMemory
        );

    }

    public static function guard(array $aliases, Closure $groupRoutes): void
    {
        self::openGroup($aliases);
        $groupRoutes();
        self::closeGroup();
    }

    private static function openGroup(array $aliases): void
    {
        self::$guardsMemory = $aliases;
    }

    private static function closeGroup(): void
    {
        self::$guardsMemory = [];
    }

    public function find(Request $request): Route
    {
        foreach (self::$routes as $route) {
            if ($route->method() === strtoupper($request->getMethod()) && $this->matchRouter($route->path(), $request->getPath())) {

                if(!class_exists($route->controller())) {
                    throw new RouterControllerNotExist();
                }

                if($route->controller() instanceof Controller) {
                    throw new RouterControllerIsNotInstance();
                }

                if(!method_exists($route->controller(), $route->action())) {
                    throw new RouterActionNotExist();
                }
                $route->setParams($this->extractRouteParam($route->path(), $request->getPath()));
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

    private function extractRouteParam(string $route, string $uri)
    {
        $routeBlock = $this->demystifiesRoute($route);
        $uriBlock = $this->demystifiesRoute($uri);

        $result = [];

        foreach($routeBlock as $key => $r) {
            if($this->isRouteParam($r)) {
                $result[trim($r, '{}')] = $uriBlock[$key];
            }
        }
        return $result;
    }

    private function demystifiesRoute(string $uri)
    {
        return array_values(array_diff(explode('/', $uri), ['']));
    }
}
