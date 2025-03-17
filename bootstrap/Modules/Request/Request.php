<?php

namespace Bootstrap\Modules\Request;

use Bootstrap\Contracts\Request as ContractsRequest;
use Bootstrap\Modules\Request\Exceptions\BadRequest;

class Request implements ContractsRequest
{
    private static Request $instance;
    private string $method;
    private string $path;
    private array $queryParams;
    private array $bodyParams;
    private string $accept;
    private string $contentType;
    private string $authorization;

    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->path = $this->extractPath();
        $this->queryParams = $_GET;
        $this->accept = $_SERVER['HTTP_ACCEPT'] ?? 'text/html';
        $this->contentType = $_SERVER['HTTP_CONTENT_TYPE'] ?? 'multipart/form-data';
        $this->authorization = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
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

    public function getBodyParams(array $only = []): array
    {
        if(empty($only)) {
            return $this->bodyParams;
        }
        return array_intersect_key($this->bodyParams, array_flip($only));
    }

    public function getParam(string $name, $default = null): mixed
    {
        return $this->queryParams[$name] ?? $this->bodyParams[$name] ?? $default;
    }

    public function getHttpAccept(): string
    {
        return $this->accept;
    }

    public function getToken(): string
    {
        return str_replace('Bearer ', '', $this->authorization) ;
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

        if(in_array($this->method, ['GET', 'DELETE'])) {
            return $bodyParams;
        };

        if(str_contains($this->contentType, 'application/json')) {
            $bodyParams = json_decode(file_get_contents('php://input'), true);

        } elseif(str_contains($this->contentType, 'application/x-www-form-urlencoded')) {
            parse_str(file_get_contents('php://input'), $bodyParams);
        } else {
            if ($this->method === 'POST') {
                $bodyParams = $_POST;
            } else {
                throw new BadRequest();
            }
        }

        return $bodyParams;
    }
}
