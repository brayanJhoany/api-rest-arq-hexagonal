<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Support\Facades\Route;

abstract class RouteServiceProvider extends ProvidersRouteServiceProvider
{
    private mixed $prefix;
    private mixed $namespaceName;
    private mixed $group;
    private ?bool $exept = null;

    public function setDependency(
        mixed $prefix,
        mixed $namespaceName,
        mixed $group,
        ?bool $exept = null
    ) {
        $this->prefix = $prefix;
        $this->namespaceName = $namespaceName;
        $this->group = $group;
        $this->exept = $exept;
    }

    public function boot(): void
    {
        parent::boot();
    }
    public function map(): void
    {
        $this->mapRoute();
    }
    /**
     * mapRoute
     *
     * @return void
     */
    public function mapRoute(): void
    {
        Route::middleware('api')
            ->prefix($this->prefix)
            ->namespace($this->namespaceName)
            ->group(base_path($this->group));
    }
}