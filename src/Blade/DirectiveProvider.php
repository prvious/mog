<?php

namespace Mog\Blade;

use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Mog\Assets\ScriptAssetManager;
use Mog\Blade\Compilers\ArraySlotsCompiler;
use Mog\Blade\Directives\ArraySlotDirectives;
use Mog\Theme\ThemeManager;

class DirectiveProvider
{
    public function __construct(
        private ThemeManager $themeManager,
        private ScriptAssetManager $scriptAssetManager,
        private ArraySlotsCompiler $arraySlotsCompiler
    ) {}

    /**
     * Register all custom Blade directives.
     */
    public function registerDirectives(BladeCompiler $blade): void
    {
        // Register @cn directive for TailwindMerge
        $blade->directive('cn', fn (?string $expression): string => "<?php echo app('mog')->cn($expression); ?>");

        // Register array slot directives
        $blade->directive('arraySlot', ArraySlotDirectives::compileArraySlot(...));
        $blade->directive('endArraySlot', ArraySlotDirectives::compileEndArraySlot(...));

        // Register @mog directive for initialization
        $this->registerMogDirective($blade);

        // Register array slots preprocessor
        $blade->prepareStringsForCompilationUsing(
            fn (string $value) => $this->arraySlotsCompiler->compile($value)
        );
    }

    /**
     * Register the @mog directive for package initialization.
     *
     * This directive outputs the necessary assets and initialization code:
     * - Color scheme CSS for dark mode
     * - Theme system JavaScript
     * - Livewire asset injection
     * - Mog script tag
     */
    private function registerMogDirective(BladeCompiler $blade): void
    {
        $blade->directive('mog', function (string $expression) {
            $themeScript = $this->themeManager->getInitializationScript();
            $colorSchemeStyle = $this->themeManager->getColorSchemeStyle();

            return <<<HTML
                <style>
                    {$colorSchemeStyle}
                </style>

                <script>
                    {$themeScript}
                </script>

                <?php app('livewire')->forceAssetInjection(); ?>

                {!! app(\Mog\Assets\ScriptAssetManager::class)->scriptTag() !!}
            HTML;
        });
    }
}
