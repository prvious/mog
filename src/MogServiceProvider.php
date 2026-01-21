<?php

namespace Mog;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Mog\Assets\AssetRouteProvider;
use Mog\Assets\ScriptAssetManager;
use Mog\Blade\Compilers\ArraySlotsCompiler;
use Mog\Blade\Compilers\SelfClosingSlotsCompiler;
use Mog\Blade\DirectiveProvider;
use Mog\Bootstrap\CompilerBootstrapper;
use Mog\Bootstrap\TailwindBootstrapper;
use Mog\Theme\OverlayManager;
use Mog\Theme\ThemeManager;
use Mog\Utilities\AspectRatioParser;
use TalesFromADev\TailwindMerge\TailwindMerge;
use TalesFromADev\TailwindMerge\TailwindMergeInterface;

class MogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register core manager
        $this->app->alias(MogManager::class, 'mog');
        $this->app->singleton(MogManager::class);

        // Register theme services
        $this->app->singleton(ThemeManager::class);
        $this->app->singleton(OverlayManager::class);

        // Register asset services
        $this->app->singleton(ScriptAssetManager::class);
        $this->app->singleton(AssetRouteProvider::class);

        // Register utility services
        $this->app->singleton(AspectRatioParser::class);

        // Register Blade services
        $this->app->singleton(ArraySlotsCompiler::class);
        $this->app->singleton(SelfClosingSlotsCompiler::class);
        $this->app->singleton(DirectiveProvider::class);

        // Register bootstrap services
        $this->app->singleton(CompilerBootstrapper::class);
        $this->app->singleton(TailwindBootstrapper::class);

        // Register TailwindMerge
        $this->app->singleton(TailwindMergeInterface::class, static fn (): TailwindMerge => new TailwindMerge);
    }

    public function boot(): void
    {
        // Boot TailwindMerge integration
        $this->app->make(TailwindBootstrapper::class)->bootMacro();

        // Register Octane state flushing
        $this->bootOctaneStateFlush();

        // Boot Blade compiler when resolved
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade, Application $app): void {
            $app->make(CompilerBootstrapper::class)->boot($blade, $app);
        });

        // Register asset route
        $this->app->make(AssetRouteProvider::class)->registerRoute();
    }

    /**
     * Register state flushing for Octane and regular requests.
     */
    private function bootOctaneStateFlush(): void
    {
        // Flush state after each Octane request (if Octane is installed)
        if (class_exists(\Laravel\Octane\Events\RequestTerminated::class)) {
            $this->app['events']->listen(
                \Laravel\Octane\Events\RequestTerminated::class,
                fn () => OverlayManager::flushState()
            );
        }

        // Flush state after regular requests as well (safe for both modes)
        $this->app->terminating(fn () => OverlayManager::flushState());
    }

    /**
     * @return array<class-string>
     */
    public function provides(): array
    {
        return [
            MogManager::class,
            ThemeManager::class,
            OverlayManager::class,
            ScriptAssetManager::class,
            AssetRouteProvider::class,
            AspectRatioParser::class,
            ArraySlotsCompiler::class,
            SelfClosingSlotsCompiler::class,
            DirectiveProvider::class,
            CompilerBootstrapper::class,
            TailwindBootstrapper::class,
            TailwindMerge::class,
            TailwindMergeInterface::class,
        ];
    }
}
