<?php

namespace Src\Management\Forgot\Infrastructure\Services;


use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServicesRouteServiceProvider;

class RouteServiceProvider extends ServicesRouteServiceProvider
{

    public function __construct($app)
    {
        $appVersion = env('APP_VERSION');
        $this->setDependency(
            'api/' . $appVersion . '/forgot',
            'Src\Management\Forgot\Infrastructure\Controller',
            'Src/Management/Forgot/Infrastructure/Routes/Api.php',
            true
        );
        parent::__construct($app);
    }
}