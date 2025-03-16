<?php

namespace App\Guards;

use Bootstrap\Contracts\Guard;
use Bootstrap\Contracts\Request;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthGuard implements Guard
{
    public function process(Request $request): bool
    {
        if (empty($request->getToken())) {
            return false;
        }

        try {
            $token = JWT::decode($request->getToken(), new Key($_ENV['PRIVATE_KEY'], 'HS256'));
            return true;
        } catch (Exception $e) {
            return false;
        }
        ;
    }
}
