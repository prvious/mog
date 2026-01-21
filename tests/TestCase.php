<?php

namespace Tests;

use BladeUI\Icons\BladeIconsServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\LivewireServiceProvider;
use MallardDuck\LucideIcons\BladeLucideIconsServiceProvider;
use Mog\MogServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app): array
    {
        return [
            BladeIconsServiceProvider::class,
            BladeLucideIconsServiceProvider::class,
            MogServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<string, class-string<\Illuminate\Support\Facades\Facade>>
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Mog' => \Mog\Mog::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function defineEnvironment($app): void
    {
        // Setup default environment settings
        $app['config']->set('cache.default', 'array');
        $app['config']->set('view.compiled', storage_path('framework/views'));
        $app['config']->set('app.debug', true);

        // Register test views namespace
        $app->afterResolving('view', function ($view) {
            $view->addNamespace('mog-test', __DIR__.'/views');
        });
    }

    /**
     * Define routes for browser testing.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    protected function defineRoutes($router): void
    {
        // Test route for button component
        $router->get('/test/button', function () {
            return view('mog-test::button');
        });

        // Test route for theme system
        $router->get('/test/theme', function () {
            return view('mog-test::theme');
        });

        // Test route for Alpine.js verification
        $router->get('/test/alpine', function () {
            return view('mog-test::alpine');
        });

        // Test route for input component
        $router->get('/test/input', function () {
            return view('mog-test::input');
        });

        // Test route for select and input group components
        $router->get('/test/select-input-group', function () {
            return view('mog-test::select-input-group');
        });

        // Test route for checkbox, radio, switch, toggle, and slider components
        $router->get('/test/checkbox-radio-switch', function () {
            return view('mog-test::checkbox-radio-switch');
        });
    }

    /**
     * Assert that a Blade component renders the expected output.
     *
     * @param  array<string, mixed>  $attributes
     */
    protected function assertBladeRenders(string $component, string $expected, array $attributes = []): void
    {
        $attributesString = '';
        foreach ($attributes as $key => $value) {
            $attributesString .= " {$key}=\"{$value}\"";
        }

        $blade = "<x-{$component}{$attributesString} />";
        $rendered = Blade::render($blade);

        $this->assertStringContainsString($expected, $rendered);
    }

    /**
     * Register a temporary Blade view for testing.
     */
    protected function registerTestView(string $name, string $contents): void
    {
        $viewPath = resource_path('views');

        if (! file_exists($viewPath)) {
            mkdir($viewPath, 0755, true);
        }

        file_put_contents("{$viewPath}/{$name}.blade.php", $contents);
    }
}
