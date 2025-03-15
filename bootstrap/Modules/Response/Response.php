<?php

namespace Bootstrap\Modules\Response;

use Bootstrap\Contracts\Response as ContractsResponse;

class Response implements ContractsResponse
{
    private mixed $content;
    private string $contentType;
    private int $statusCode;

    public function __construct(mixed $content = '', string $contentType = 'application/json', int $statusCode = 200)
    {
        $this->contentType = $contentType;
        $this->statusCode = $statusCode;
        $this->content = $this->formatContent($content);
    }

    public static function json(mixed $content = [], int $statusCode = 200): Response
    {
        return new Response($content, 'application/json', $statusCode);
    }

    public static function html(mixed $content = [], int $statusCode = 200): Response
    {
        return new Response($content, 'text/html', $statusCode);
    }

    public function getContent(): mixed
    {
        return $this->content;
    }

    public function setContent(mixed $content): void
    {
        $this->content = $this->formatContent($content);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    private function formatContent($content): string
    {
        if ($this->contentType === 'application/json') {
            return json_encode($content);
        }
        return (string)$content;
    }
}
