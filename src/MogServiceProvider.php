<?php

namespace Mog;

use BladeUI\Icons\Factory as BladeIconFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class MogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(MogManager::class, 'mog');

        $this->app->singleton(MogManager::class);

        $this->app->singleton(SelfClosingSlotsCompiler::class);
    }

    public function boot(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $blade->prepareStringsForCompilationUsing(fn ($value) => $this->app->make(SelfClosingSlotsCompiler::class)->compile($value));

            $blade->anonymousComponentPath(__DIR__.'/../resources/components', 'mog');
        });

        $this->callAfterResolving(BladeIconFactory::class, function (BladeIconFactory $factory) {
            $factory->add('mog', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'mog',
            ]);
        });
    }

    public function provides()
    {
        return [MogManager::class];
    }
}
