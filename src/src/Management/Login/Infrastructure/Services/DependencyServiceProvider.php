<?php

namespace Src\Management\Login\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServicesDependencyServiceProvider;

final class DependencyServiceProvider extends ServicesDependencyServiceProvider
{

    public function __construct($app)
    {
        $this->setDependency(
            [
                [
                    'useCase' => [
                        \Src\Management\Login\Application\Login\LoginAuthUserCase::class
                    ],
                    'contract' => \Src\Management\Login\Domain\Contracts\LoginRepositoryContract::class,
                    'repository' => \Src\Management\Login\Infrastructure\Repositories\Elocuent\LoginRepository::class
                ],
                [
                    'useCase' => [
                        \Src\Management\Login\Application\Auth\LoginAutenticationUseCase::class,
                        \Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase::class,
                        \Src\Management\Login\Application\Login\LoginRoleAuthenticationUseCase::class

                    ],
                    'contract' => \Src\Management\Login\Domain\Contracts\LoginAutenticationContract::class,
                    'repository' => \Src\Management\Login\Infrastructure\Repositories\FirebaseJwt\LoginAutentication::class
                ]
            ]
        );
        parent::__construct($app);
    }
}