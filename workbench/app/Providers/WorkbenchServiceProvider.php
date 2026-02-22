<?php

namespace Workbench\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

use function Orchestra\Testbench\workbench_path;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->usePublicPath(workbench_path('public'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureVite();
        $this->configureLivewire();
        $this->configureBladeComponents();
    }

    private function configureVite(): void
    {
        Vite::useHotFile(workbench_path('public/hot'));

        $this->symlinkViteBuild();
    }

    private function symlinkViteBuild(): void
    {
        $target = workbench_path('public/build');
        $link = base_path('public/build');

        if (is_dir($target) && ! file_exists($link)) {
            @symlink($target, $link);
        }
    }

    private function configureLivewire(): void
    {
        $workbenchViews = workbench_path('resources/views');

        Livewire::addNamespace('pages', $workbenchViews.'/pages');
        Livewire::addNamespace('layouts', $workbenchViews.'/layouts');

        View::addNamespace('layouts', $workbenchViews.'/layouts');

        config()->set('livewire.component_layout', 'layouts::app');
    }

    private function configureBladeComponents(): void
    {
        Blade::anonymousComponentPath(workbench_path('resources/views/components'));
    }
}
