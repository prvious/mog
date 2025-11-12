<?php

namespace Mog;

use BladeUI\Icons\Factory as BladeIconFactory;
use Illuminate\Foundation\Application;
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
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade, Application $app): void {
            $blade->prepareStringsForCompilationUsing(fn (string $value) => $this->app->make(SelfClosingSlotsCompiler::class)->compile($value));

            $blade->anonymousComponentPath(__DIR__.'/../resources/components', 'mog');

            $app->make(MogManager::class)->registerBladeDirectives();
        });

        $this->callAfterResolving(BladeIconFactory::class, function (BladeIconFactory $factory): void {
            $factory->add('mog', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'mog',
            ]);
        });

        app(MogManager::class)->bootBladeDirectives();
    }

    /**
     * @return array<class-string>
     */
    public function provides(): array
    {
        return [MogManager::class];
    }
}
