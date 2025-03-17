<?php

namespace App\Controllers;

use App\Models\User;
use Bootstrap\Modules\Controller\Controller;

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

        $credentials = $this->request->getBodyParams(['email', 'password']);

        try {
            $user = User::where('email', $credentials['email'])->firstOrFail();

            if (!password_verify($credentials['password'], $user->password)) {
                throw new Exception('Usuário ou senha inválida');
            }

            $jwt = $this->jtw();
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

    public function register()
    {

        $credentials = $this->request->getBodyParams(['name', 'email', 'password', 'confirmPassword']);

        $user = User::where('email', $credentials['email'])->first();

        if(!is_null($user)) {
            return Response::json(['status' => 'error', 'message' => 'E-mail já cadastrado', 'data' => null]);
        }

        if($credentials['password'] != $credentials['confirmPassword']) {
            return Response::json(['status' => 'error', 'message' => 'Senhas não conferem', 'data' => null]);
        }

        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = password_hash($credentials['password'], PASSWORD_BCRYPT);
        $user->save();
        return Response::json(['status' => 'success', 'data' => [
            'token' => $this->jtw(),
            'user'  => $user->toArray(),
        ]]);
    }

    private function jtw()
    {
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

        return JWT::encode($payload, $secretKey, 'HS256');
    }
}
