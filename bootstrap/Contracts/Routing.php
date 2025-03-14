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
     * @param string   $method  HTTP method associated with the route (e.g. GET, POST).
     * @param string   $path    Path of the route.
     * @param callable $handler Function to be executed when the route is accessed.
     */
    public static function add(string $method, string $path, callable $handler): void;

    /**
     * Return the corresponding handler based on the provided HTTP method and URI.
     *
     * @param string $method HTTP method of the request.
     * @param string $uri    URI of the request.
     */
    public function handler(string $method, string $uri): Closure;
}
