<?php

namespace Src\Management\Login\Application\Login;

use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;
use Src\Management\Login\Domain\Contracts\LoginAutenticationContract;

final class LoginRoleAuthenticationUseCase
{

    public function __construct(private readonly LoginAutenticationContract $loginAutenticationContract)
    {
    }
    public function __invoke(
        string $token,
        string|array $typeRoles
    ) {
        $login = new Login([
            'user'      => $this->loginAutenticationContract->get(new LoginJwt($token)),
            'typeRoles' => $typeRoles
        ]);
        return $login->getCheckRole();
    }
}