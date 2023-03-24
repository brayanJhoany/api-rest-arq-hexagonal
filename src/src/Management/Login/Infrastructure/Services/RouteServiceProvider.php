<?php

namespace Src\Management\Login\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServicesRouteServiceProvider;

class RouteServiceProvider extends ServicesRouteServiceProvider
{

    public function __construct($app)
    {
        $appVersion = env('APP_VERSION');
        $this->setDependency(
            'api/' . $appVersion . '/login',
            'Src\Management\Login\Infrastructure\Controller',
            'Src/Management/Login/Infrastructure/Routes/Api.php',
            false
        );
        parent::__construct($app);
    }
}
