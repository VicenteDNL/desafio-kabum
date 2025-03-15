<?php

namespace Bootstrap\Modules\HandleError\Resources;

use Throwable;

class TemplateHTML
{
    private Throwable $exception;
    private string $human;
    private string $system;
    private bool $showDebug;

    public function __construct(string $human, string $system, Throwable $exception, bool $showDebug)
    {
        $this->exception = $exception;
        $this->human = $human;
        $this->system = $system;
        $this->showDebug = $showDebug;
    }

    public function html()
    {
        return '<!DOCTYPE html>
                    <html lang="pt-BR">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Erro {{status_code}}</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f8f8f8;
                                color: #333;
                                margin: 0;
                                padding: 20px;
                            }
                            .container {
                                max-width: 600px;
                                margin: 50px auto;
                                background-color: #fff;
                                padding: 20px;
                                border: 1px solid #ddd;
                                border-radius: 4px;
                                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                            }
                            h1 {
                                color: #d9534f;
                            }
                            pre {
                                background-color: #f1f1f1;
                                padding: 10px;
                                border-radius: 4px;
                                overflow-x: auto;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h1>Erro ' . $this->exception->getCode() . '</h1>
                            <p>' . $this->human . '</p>  '
                            . $this->traceToHML()
                         . '</div>
                    </body>
                    </html>';
    }

    private function traceToHML()
    {
        if(!$this->showDebug) {
            return '';
        }
        $output = '<h2>Detalhes do Erro:</h2><pre><ul>';

        foreach ($this->exception->getTrace() as $entry) {
            $file = $entry['file'] ?? '';
            $line = $entry['line'] ?? '';
            $function = $entry['function'] ?? '';
            $class = $entry['class'] ?? '';
            $output .= "<li><strong>Arquivo:</strong> {$file} <br> <strong>Linha:</strong> {$line} <br> <strong>Classe:</strong> {$class} <br> <strong>Função:</strong> {$function}</li>";
        }
        $output .= '</pre></ul>';
        return $output;
    }
}
