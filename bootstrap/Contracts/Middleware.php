<?php

namespace Bootstrap\Contracts;

use Closure;

/**
 * interface Middleware
 *
 * Application middleware execution class
 */
interface Middleware
{
    /**
     * Initializes an instance of Middleware or retrieves an already initialized instance
     *
     * @param string $stacker location of registered middlewares
     */
    public static function init(string $stacker): Middleware;

    /**
     * Start of the execution flow of registered middleware
     *
     * @param Request $request Request HTTP
     * @param Closure $handle  Action protected by middleware
     */
    public function start(Request $request, Closure $handle);
}
