<?php

/**
 * verifica para que a chamada nao seja feito direto de uma classe do modulo (remover aclopamento)
 */
use App\Controllers\ClientController;
use Bootstrap\Modules\Routing\Routing;

Routing::guard(['auth'], function () {
    Routing::add('GET', '/cliente', ClientController::class, 'index');
});
Routing::add('GET', '/cliente/{id}', ClientController::class, 'show');
Routing::add('POST', '/cliente', ClientController::class, 'store');
Routing::add('DELETE', '/cliente/{id}', ClientController::class, 'destroy');
Routing::add('PUT', '/cliente/{id}', ClientController::class, 'update');
