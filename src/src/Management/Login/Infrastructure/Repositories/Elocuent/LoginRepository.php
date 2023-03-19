<?php

namespace Src\Management\Login\Infrastructure\Repositories\Elocuent;

use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthAutentication;

final class LoginRepository implements LoginRepositoryContract
{
    private User $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login(LoginAuthAutentication $loginAuthTentication): Login
    {
        $email = $loginAuthTentication->value()['email'] ?? '';
        $requestPassword = $loginAuthTentication->value()['password'] ?? '';
        $user = $this->findUserByEmail($email);
        if (!$user) {
            return new Login(null, 'USER_OR_PASSWORD_INCORRECT');
        }
        $check = $loginAuthTentication->checkPassword($requestPassword, $user['password']);
        if (!$check) {
            return new Login(null, 'USER_OR_PASSWORD_INCORRECT');
        }
        return new Login($user);
    }


    /**
     * findUserByEmail
     *
     * @param  mixed $email
     */
    private function findUserByEmail(string $email): array
    {
        $user = $this->model->where('email', $email)->first([
            'id', 'email', 'password', 'first_name'
        ]);
        return $user ? $user->makeVisible('password')->toArray() : [];
    }
}