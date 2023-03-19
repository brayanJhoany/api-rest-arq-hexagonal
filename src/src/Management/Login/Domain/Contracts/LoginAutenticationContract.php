<?php

namespace Src\Management\Login\Domain\Contracts;


use Src\Management\Login\Domain\ValueObjects\LoginAutenticationParameters;

interface LoginAutenticationContract
{
    public function auth(LoginAutenticationParameters $loginAutenticationParameters): string;
}