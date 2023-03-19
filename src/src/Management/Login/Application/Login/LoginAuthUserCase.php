<?php

namespace Src\Management\Login\Application\Login;

use Src\Management\Login\Application\Auth\LoginAutenticationUseCase;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginAuthAutentication;

final class LoginAuthUserCase
{
    public function __construct(
        private readonly LoginRepositoryContract $loginRepositoryContract,
        private readonly LoginAutenticationUseCase $loginAutenticationUseCase
    ) {
    }

    public function __invoke(array $request): Login
    {
        $login  = $this->loginRepositoryContract->login(new LoginAuthAutentication($request));
        $jwt    = $this->loginAutenticationUseCase->__invoke($login->handler());
        $response = array_merge($login->handler(), ['jwt' => $jwt]);
        return new Login($response, null);
    }
}