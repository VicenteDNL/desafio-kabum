<?php

/**
 * verifica para que a chamada nao seja feito direto de uma classe do modulo (remover aclopamento)
 */

use App\Controllers\AddressController;
use App\Controllers\AuthController;
use App\Controllers\ClientController;
use Bootstrap\Modules\Routing\Routing;

Routing::add('POST', '/login', AuthController::class, 'login');
Routing::add('POST', '/register', AuthController::class, 'register');

Routing::guard(['auth'], function () {
    Routing::add('GET', '/client', ClientController::class, 'index');
    Routing::add('GET', '/client/{id}', ClientController::class, 'show');
    Routing::add('POST', '/client', ClientController::class, 'store');
    Routing::add('DELETE', '/client/{id}', ClientController::class, 'destroy');
    Routing::add('PUT', '/client/{id}', ClientController::class, 'update');

    Routing::add('GET', '/client/{clientId}/address', AddressController::class, 'index');
    Routing::add('GET', '/client/{clientId}/address/{id}', AddressController::class, 'show');
    Routing::add('POST', '/client/{clientId}/address', AddressController::class, 'store');
    Routing::add('DELETE', '/client/{clientId}/address/{id}', AddressController::class, 'destroy');
    Routing::add('PUT', '/client/{clientId}/address/{id}', AddressController::class, 'update');
});
