<?php

namespace Bootstrap\Contracts;

/**
 * Interface Request
 *
 * Defines the methods required to handle HTTP requests.
 */
interface Request
{
    /**
     * Initializes an instance of Request or retrieves an already initialized instance
     *
     * @return Request The instance of Request
     */
    public static function init(): Request;

    /**
     * Gets the HTTP method of the request.
     *
     * @return string The HTTP method used in the request (for example, GET, POST).
     */
    public function getMethod(): string;

    /**
     * Gets the path of the request.
     *
     * @return string The path requested in the URL.
     */
    public function getPath(): string;

    /**
     * Gets the query parameters from the URL.
     *
     * @return array An associative array containing the query parameters.
     */
    public function getQueryParams(): array;

    /**
     * Gets the parameters from the request body.
     *
     * @param  array $only List the parameters you want to be returned
     * @return array An associative array containing the data sent in the request body.
     */
    public function getBodyParams(array $only = []): array;

    /**
     * Gets the Authorization Token
     *
     * @return string The Authorization Token
     */
    public function getToken(): string;

    /**
     * Gets a specific parameter from the request, either from the query parameters or the body.
     *
     * @param  string $name    The name of the parameter to search for.
     * @param  mixed  $default Default value to be returned if the parameter is not found.
     * @return mixed  The requested parameter value or the default value if none exists.
     */
    public function getParam(string $name, $default = null): mixed;

    /**
     * The Client response format
     *
     * @return mixed The http accept formart
     */
    public function getHttpAccept(): string;
}
