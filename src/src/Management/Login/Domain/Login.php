<?php

namespace Src\Management\Login\Domain;

use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodeDomainHelper;

final class Login extends Domain
{
    use HttpCodeDomainHelper;
    private const USER_OR_PASSWORD_INCORRECT = 'USER_OR_PASSWORD_INCORRECT';

    public function handler()
    {
        return [
            'id' => $this->entity()['id'],
            'email' => $this->entity()['email'],
            'first_name' => $this->entity()['first_name'],
        ];
    }
    /**
     * isExeption
     *
     * @param  mixed $exeption
     * @return void
     */
    protected function isExeption(?string $exeption): void
    {
        if (!is_null($exeption)) {
            match ($exeption) {
                self::USER_OR_PASSWORD_INCORRECT => throw new NotLoginException("User or password incorrect, please try again", $this->badRequest()),
            };
        }
    }
}