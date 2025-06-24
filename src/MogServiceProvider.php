<?php

namespace Mog;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Component;

class MogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(MogManager::class, 'mog');

        $this->app->singleton(MogManager::class);

        $this->app->singleton(SelfClosingSlotsCompiler::class);

        $this->registerViewOverrides();
    }

    public function boot(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $blade->prepareStringsForCompilationUsing(fn ($value) => $this->app->make(SelfClosingSlotsCompiler::class)->compile($value));

            $blade->anonymousComponentPath(__DIR__.'/../resources/components', 'mog');
        });
    }

    public function provides()
    {
        return [MogManager::class];
    }

    private function registerViewOverrides(): void
    {
        $this->app->singleton('view', function ($app) {
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP or Blade engine.
            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            $factory = new ViewFactory($resolver, $finder, $app['events']);

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $factory->setContainer($app);

            $factory->share('app', $app);

            $app->terminating(static function () {
                Component::forgetFactory();
            });

            return $factory;
        });

        $this->app->alias('view', \Illuminate\Contracts\View\Factory::class);
        $this->app->alias('view', ViewFactory::class);
    }
}
