<?php

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObject;

/**
 * LoginAuthAutentication
 */
final class LoginAuthAutentication extends MixedValueObject
{
    /**
     * checkPassword
     *
     * @param  mixed $requestPassword
     * @param  mixed $userPassword
     * @return bool
     */
    public function checkPassword(string $requestPassword, string $userPassword): bool
    {
        return password_verify($requestPassword, $userPassword);
    }
}