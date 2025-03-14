<?php

namespace Bootstrap\Modules\Request;

use Bootstrap\Contracts\Request as ContractsRequest;

class Request implements ContractsRequest
{
    private static Request $instance;
    private string $method;
    private string $path;
    private array $queryParams;
    private array $bodyParams;

    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->path = $this->extractPath();
        $this->queryParams = $_GET;
        $this->bodyParams = $this->extractBodyParams();

    }

    public static function init(): Request
    {

        if (!isset(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getBodyParams(): array
    {
        return $this->bodyParams;
    }

    public function getParam(string $name, $default = null)
    {
        return $this->queryParams[$name] ?? $this->bodyParams[$name] ?? $default;
    }

    private function extractPath(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $parsedUrl = parse_url($uri);
        return $parsedUrl['path'] ?? '/';
    }

    private function extractBodyParams(): array
    {
        $bodyParams = [];

        if ($this->method === 'POST') {
            $bodyParams = $_POST;
        } elseif (in_array($this->method, ['PUT', 'DELETE', 'PATCH'])) {
            parse_str(file_get_contents('php://input'), $bodyParams);
        }
        return $bodyParams;
    }
}
