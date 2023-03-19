<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    private array $dependencies;

    public function setDependency(array $dependencies)
    {
        $this->dependencies  = $dependencies;
    }

    public function register(): void
    {
        foreach ($this->dependencies as $value) {
            $this->app
                ->when($value['useCase'])
                ->needs($value['contract'])
                ->give($value['repository']);
        }
    }
}