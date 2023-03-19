<?php

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAutenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAutenticationParameters;

class LoginAutenticationUseCase
{

    public function __construct(
        private readonly LoginAutenticationContract $loginAutenticationContract
    ) {
    }
    public function __invoke(array $request)
    {
        return $this->loginAutenticationContract->auth(new LoginAutenticationParameters($request));
    }
}