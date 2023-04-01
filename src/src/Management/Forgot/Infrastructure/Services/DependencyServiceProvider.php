<?php

namespace Src\Management\Forgot\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServicesDependencyServiceProvider;


class DependencyServiceProvider extends ServicesDependencyServiceProvider
{
    public function __construct($app)
    {
        $this->setDependency(
            [
                [
                    'useCase' => [
                        \Src\Management\Forgot\Application\Mail\UserForgotPasswordUseCase::class,
                    ],
                    'contract' => \Src\Management\Forgot\Domain\Contracts\ForgotMailableContract::class,
                    'repository' => \Src\Management\Forgot\Infrastructure\Repositories\Mail\ForgotMailable::class,
                ]
            ]
        );
        parent::__construct($app);
    }
}