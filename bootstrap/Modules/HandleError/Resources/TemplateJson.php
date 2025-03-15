<?php

namespace Bootstrap\Modules\HandleError\Resources;

use Throwable;

class TemplateJson
{
    private Throwable $exception;
    private string $human;
    private string $system;
    private bool $showDebug;

    public function __construct(string $human, string $system, bool $showDebug, Throwable $exception)
    {
        $this->human = $human;
        $this->system = $system;
        $this->exception = $exception;
        $this->showDebug = $showDebug;
    }

    public function json()
    {
        return [
            'message' => $this->human,
            ...(
                $this->showDebug
                ? [
                    'debug' => [
                        'system'    => $this->system,
                        'exception' => $this->exception::class,
                        'message'   => $this->exception->getMessage(),
                        'line'      => $this->exception->getLine(),
                        'file'      => $this->exception->getFile(),
                        'trace'     => $this->exception->getTrace(),
                    ],
                ]
                : []
            ),

        ];
    }
}
