<?php

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\ValueObjects\LoginAutenticationParameters;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

interface LoginAutenticationContract
{
    public function auth(LoginAutenticationParameters $loginAutenticationParameters): string;

    public function check(LoginJwt $loginJwt): bool;

    public function get(LoginJwt $loginJwt): mixed;
}