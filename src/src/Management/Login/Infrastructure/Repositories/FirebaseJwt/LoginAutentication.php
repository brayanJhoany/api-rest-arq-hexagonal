<?php

namespace Src\Management\Login\Infrastructure\Repositories\FirebaseJwt;

use Src\Management\Login\Domain\Contracts\LoginAutenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAutenticationParameters;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginAutentication implements LoginAutenticationContract
{
    private JWT $jwt;
    public function __construct()
    {
        $this->jwt = new JWT();
    }
    public function auth(LoginAutenticationParameters $loginAuthTentication): string
    {
        return  $this->jwt::encode(
            $loginAuthTentication->handler(),
            $loginAuthTentication->jwtKey(),
            $loginAuthTentication->jwtEncryot()
        );
    }

    public function check(LoginJwt $loginJwt): bool
    {
        try {
            $tokenData =  $this->jwt::decode(
                $loginJwt->value(),
                new Key($loginJwt->jwtKey(), $loginJwt->jwtEncryot())
            );

            if ($tokenData->exp < time()) {
                return false;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function get(LoginJwt $loginJwt): mixed
    {
        try {
            $decode = $this->jwt::decode(
                $loginJwt->value(),
                new Key($loginJwt->jwtKey(), $loginJwt->jwtEncryot())
            );
            $data = $decode->data;
            return $data;
        } catch (\Throwable $th) {
            return false;
        }
    }
}