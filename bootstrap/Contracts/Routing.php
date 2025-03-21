<?php

namespace Bootstrap\Contracts;

use Closure;

/**
 * Interface Routing
 *
 * Defines the methods required for route registrations
 */
interface Routing
{
    /**
     * Initializes an instance of Routing or retrieves an already initialized instance
     *
     * @param  string  $routesPath
     * @return Routing The instance of Routing
     */
    public static function init(string $routesPath): Routing;

    /**
     * Adds a new route to the list of registered routes.
     *
     * @param string $method     HTTP method associated with the route (e.g. GET, POST).
     * @param string $path       Path of the route.
     * @param string $controller Controller to be instantiated
     * @param string $action     Method of the controller to be triggered
     */
    public static function add(string $method, string $path, string $controller, string $action): void;

    /**
     * Register routes protected by a Guard
     *
     * @param array   $aliases     The Aliase guard
     * @param Closure $groupRoutes Closure containing the call to the route registry
     */
    public static function guard(array $aliases, Closure $groupRoutes): void;

    /**
     * Return the corresponding Route based on the  HTTP Request.
     *
     * @param Request $request HTTP Request
     */
    public function find(Request $request): Route;
}
