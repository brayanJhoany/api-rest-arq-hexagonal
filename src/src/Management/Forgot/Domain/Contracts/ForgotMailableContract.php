<?php

namespace Src\Management\Forgot\Domain\Contracts;

use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

interface ForgotMailableContract
{
    public function sendForgotPasswordEmail(ForgotMailable $forgotMailable): Forgot;
}