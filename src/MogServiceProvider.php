<?php

namespace Mog;

use BladeUI\Icons\Factory as BladeIconFactory;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\Factory as ViewFactory;
use Mog\Blade\ArraySlotsCompiler;
use Mog\Blade\CustomCompiler;
use Mog\Blade\SelfClosingSlotsCompiler;
use TailwindMerge\Contracts\TailwindMergeContract;
use TailwindMerge\TailwindMerge;

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
            $blade->directive('cn', fn (?string $expression): string => "<?php echo app('mog')->twMerge($expression); ?>");

            $blade->directive('arraySlot', CustomCompiler::compileArraySlot(...));
            $blade->directive('endArraySlot', CustomCompiler::compileEndArraySlot(...));

            $blade->prepareStringsForCompilationUsing(fn (string $value) => $this->app->make(ArraySlotsCompiler::class)->compile($value));

            $blade->anonymousComponentPath(__DIR__.'/../resources/components', 'mog');

            $app->make(MogManager::class)->registerBladeDirectives();
        });

        $this->callAfterResolving(BladeIconFactory::class, function (BladeIconFactory $factory): void {
            $factory->add('mog', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'mog',
            ]);
        });

        app(MogManager::class)->bootScriptRoute();
    }

    private function registerTailwind(): void
    {
        $this->app->singleton(
            TailwindMergeContract::class,
            static fn (): TailwindMerge => TailwindMerge::factory()->withConfiguration(['prefix' => null])->make(),
        );

        $this->app->alias(TailwindMergeContract::class, 'tailwind-merge');
        $this->app->alias(TailwindMergeContract::class, TailwindMerge::class);
    }

    private function bootTailwind(): void
    {
        ComponentAttributeBag::macro('cn', function (...$args): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            $this->offsetSet('class', resolve(TailwindMergeContract::class)->merge($args, ($this->get('class', ''))));

            return $this;
        });

        ComponentAttributeBag::macro('withoutCnClasses', function (): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            return $this->whereDoesntStartWith('class:');
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
            TailwindMergeContract::class,
            'tailwind-merge',
        ];
    }
}
