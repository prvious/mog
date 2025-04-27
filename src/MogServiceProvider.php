<?php

namespace Mog;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(MogManager::class, 'mog');

        $this->app->singleton(MogManager::class);
    }

    public function boot(): void
    {
        Blade::anonymousComponentPath(__DIR__.'/../resources/components/', 'mog');
    }

    public function provides()
    {
        return [MogManager::class];
    }
}
