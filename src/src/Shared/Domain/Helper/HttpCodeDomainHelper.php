<?php

namespace Src\Shared\Domain\Helper;


trait HttpCodeDomainHelper
{

    public function ok(): int
    {
        return 200;
    }

    public function badRequest(): int
    {
        return 400;
    }

    public function unauthorized(): int
    {
        return 401;
    }
}