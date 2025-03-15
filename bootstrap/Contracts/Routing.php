<?php

namespace Bootstrap\Contracts;

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
     * Return the corresponding route based on the provided HTTP method and URI.
     *
     * @param string $method HTTP method of the request.
     * @param string $uri    URI of the request.
     */
    public function getRoute(string $method, string $uri): Router;
}
