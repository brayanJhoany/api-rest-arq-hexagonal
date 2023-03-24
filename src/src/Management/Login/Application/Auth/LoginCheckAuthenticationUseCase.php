<?php

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAutenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginCheckAuthenticationUseCase
{
    public function __construct(private readonly LoginAutenticationContract $loginCheckAuthenticationContract)
    {
    }

    public function __invoke(string $token)
    {
        return $this->loginCheckAuthenticationContract->check(new LoginJwt($token));
    }
}
