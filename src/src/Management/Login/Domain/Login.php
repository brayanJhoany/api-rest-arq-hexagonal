<?php

namespace Src\Management\Login\Domain;

use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodeDomainHelper;

final class Login extends Domain
{
    use HttpCodeDomainHelper;
    private const USER_OR_PASSWORD_INCORRECT = 'USER_OR_PASSWORD_INCORRECT';
    private const ID_ROLE_DEFAULT = 2;
    private const NAME_ROLE_DEFAULT = 'natural';
    private const ALL_ROLES_ALLOWED = '*';

    private bool $checkRole = false;
    /**
     * __construct
     *
     * @param  mixed $entity
     * @param  mixed $exeption
     * @return void
     */
    public function __construct(private mixed $entity, private ?string $exeption = null)
    {
        parent::__construct($this->entity, $this->exeption);
        $this->checkRole = $this->isUserCheckRole();
    }


    public function handler()
    {
        $roleName = (isset($this->entity()['roles'][0]['name']) && $this->entity()['roles'][0]['name']) ? $this->entity()['roles'][0]['name'] : self::NAME_ROLE_DEFAULT;
        $roleId = (isset($this->entity()['roles'][0]['id']) && $this->entity()['roles'][0]['id']) ? $this->entity()['roles'][0]['id'] : self::ID_ROLE_DEFAULT;
        return [
            'id'    => $this->entity()['id'],
            'email' => $this->entity()['email'],
            'first_name' => $this->entity()['first_name'],
            'roles'     => [
                'id'    => $roleId,
                'name'  => $roleName,
            ],
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

    private function isUserCheckRole(): bool
    {
        $roleName = (isset($this->entity()['user']->roles) && $this->entity()['user']->roles->name)  ? $this->entity()['user']->roles->name : '';
        if (
            !array_key_exists('typeRoles', $this->entity())
            && !array_key_exists('user', $this->entity())
        ) {
            return true;
        }

        if (is_array($this->entity()['typeRoles'])) {

            if (!in_array($roleName, $this->entity()['typeRoles'])) {
                return false;
            }
            return true;
        }

        if (self::ALL_ROLES_ALLOWED === $this->entity()['typeRoles']) {
            return false;
        }
        if ($roleName !== $this->entity()['typeRoles']) {
            return false;
        }
        return true;
    }

    public function getCheckRole()
    {
        return $this->checkRole;
    }
}