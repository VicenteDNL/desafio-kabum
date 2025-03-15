<?php

namespace Bootstrap\Contracts;

use Throwable;

/**
 * interface HandleError
 *
 * Error handling
 */
interface HandleError
{
    /**
     * Initializes an instance of HandleError or retrieves an already initialized instance
     *
     * @param string $messages Personalized messages for each exception
     */
    public static function init(string $messages): HandleError;

    /**
     *Catch the exception and return a handled Response
     *
     * @param Request   $request   The Request HTTP
     * @param Throwable $exception The exception thrown
     */
    public function treat(Request $request, Throwable $exception): Response;
}
