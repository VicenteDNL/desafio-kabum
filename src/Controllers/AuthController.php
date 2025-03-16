<?php

namespace App\Controllers;

use App\Models\User;
use Bootstrap\Modules\Controller\Controller;

/**
 * TODO: verifica para que a chamada nao seja feito direto de uma classe do modulo (remover aclopamento)
 */
use Bootstrap\Modules\Response\Response;
use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        //TODO: Validar parametros

        $credentials = $this->request->getBodyParams(['email', 'password']);

        try {
            $user = User::where('email', $credentials['email'])->firstOrFail();

            if (!password_verify($credentials['password'], $user->password)) {
                throw new Exception('Usuário ou senha inválida');
            }
            //TODO:: Mover logica de autenticacao/ geracao jwt para o modulo
            $secretKey = $_ENV['PRIVATE_KEY'];
            $issuedAt = new DateTimeImmutable();
            $expire = $issuedAt->modify('+1 hour')->getTimestamp();
            $serverName = 'seu_dominio.com';
            $username = 'nome_do_usuario';

            $payload = [
                'iat'      => $issuedAt->getTimestamp(),
                'iss'      => $serverName,
                'nbf'      => $issuedAt->getTimestamp(),
                'exp'      => $expire,
                'userName' => $username,
            ];

            $jwt = JWT::encode($payload, $secretKey, 'HS256');
            return Response::json(['status' => 'success', 'data' => [
                'token' => $jwt,
                'user'  => $user->toArray(),
            ]]);

        } catch(ModelNotFoundException $e) {
            return Response::json(['status' => 'error', 'message' => 'Usuário ou senha inválida', 'data' => null]);
        } catch(Throwable $e) {
            return Response::json(['status' => 'error', 'message' => $e->getMessage(), 'data' => null]);
        }

    }
}
