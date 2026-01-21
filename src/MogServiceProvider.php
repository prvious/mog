<?php

namespace Mog;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\Factory as ViewFactory;
use Mog\Blade\ArraySlotsCompiler;
use Mog\Blade\CustomCompiler;
use Mog\Blade\SelfClosingSlotsCompiler;
use TalesFromADev\TailwindMerge\TailwindMerge;
use TalesFromADev\TailwindMerge\TailwindMergeInterface;

class MogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(MogManager::class, 'mog');

        $this->app->singleton(MogManager::class);

        $this->app->singleton(SelfClosingSlotsCompiler::class);

        $this->registerTailwind();
    }

    public function boot(): void
    {
        $this->bootTailwind();

        ViewFactory::macro('arraySlot', CustomCompiler::compileArraySlotDirective());
        ViewFactory::macro('endArraySlot', CustomCompiler::compileEndArraySlotDirective());

        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade, Application $app): void {
            $blade->directive('cn', fn (?string $expression): string => "<?php echo app('mog')->cn($expression); ?>");

            $blade->directive('arraySlot', CustomCompiler::compileArraySlot(...));
            $blade->directive('endArraySlot', CustomCompiler::compileEndArraySlot(...));

            $blade->prepareStringsForCompilationUsing(fn (string $value) => $this->app->make(ArraySlotsCompiler::class)->compile($value));

            $blade->anonymousComponentPath(__DIR__.'/../resources/components', 'mog');

            $app->make(MogManager::class)->registerBladeDirectives();
        });

        app(MogManager::class)->bootScriptRoute();
    }

    private function registerTailwind(): void
    {
        $this->app->singleton(
            TailwindMergeInterface::class,
            static fn (): TailwindMerge => new TailwindMerge,
        );
    }

    private function bootTailwind(): void
    {
        ComponentAttributeBag::macro('cn', function (...$args): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            $this->offsetSet('class', app(TailwindMergeInterface::class)->merge($args, $this->get('class', '')));

            return $this;
        });
    }

    /**
     * @return array<class-string>
     */
    public function provides(): array
    {
        return [
            MogManager::class,
            TailwindMerge::class,
            TailwindMergeInterface::class,
        ];
    }
}
