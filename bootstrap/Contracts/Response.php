<?php

namespace Bootstrap\Contracts;

interface Response
{
    /**
     * Create a response instance for json
     *
     * @param  mixed    $content    The Content
     * @param  int      $statusCode The status code.
     * @return Response Returns the object with the content formatted in json
     */
    public static function json(mixed $content = [], int $statusCode = 200): Response;

    /**
     * Create a response instance for html
     *
     * @param  mixed    $content    The Content
     * @param  int      $statusCode The status code.
     * @return Response Returns the object with the content formatted in html/text
     */
    public static function html(mixed $content = [], int $statusCode = 200): Response;

    /**
     * The content type (MIME type).
     *
     * @return string The contentType.
     */
    public function getContentType(): string;

    /**
     * The HTTP status code.
     *
     * @return int The status code.
     */
    public function getStatusCode(): int;

    /**
     * Returns formatted content based on content type.
     *
     * @return mixed The formated content.
     */
    public function getContent(): mixed;

    /**
     * Set response content.
     *
     * @param mixed $content
     */
    public function setContent(mixed $content): void;
}
