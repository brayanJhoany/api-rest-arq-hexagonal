<?php

namespace Src\Management\Login\Domain\Contracts;


use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginAuthAutentication;

interface LoginRepositoryContract
{
    public function login(LoginAuthAutentication $loginAuthTentication): Login;
}