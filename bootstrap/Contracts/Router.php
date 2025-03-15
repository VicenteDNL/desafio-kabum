<?php

namespace Bootstrap\Contracts;

/**
 * Interface Router
 *
 * Represents a route registered in the application
 */
interface Router
{
    /**
     * HTTP method associated with the route (e.g. GET, POST).
     */
    public function method(): string;

    /**
     * Path of the route.
     */
    public function path(): string;

    /**
     * Controller to be instantiated
     */
    public function controller(): string;

    /**
     * Method of the controller to be triggered
     */
    public function action(): string;
}
