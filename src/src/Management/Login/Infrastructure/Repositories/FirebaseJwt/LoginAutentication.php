<?php

namespace Src\Management\Login\Infrastructure\Repositories\FirebaseJwt;

use Src\Management\Login\Domain\Contracts\LoginAutenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAutenticationParameters;

use Firebase\JWT\JWT;

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
}