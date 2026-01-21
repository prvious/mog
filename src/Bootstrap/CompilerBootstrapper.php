<?php

namespace Mog\Bootstrap;

use Illuminate\Foundation\Application;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory as ViewFactory;
use Mog\Blade\DirectiveProvider;
use Mog\Blade\Directives\ArraySlotDirectives;

class CompilerBootstrapper
{
    public function __construct(
        private DirectiveProvider $directiveProvider
    ) {}

    /**
     * Boot Blade compiler integrations.
     *
     * Registers:
     * - View factory macros for array slots
     * - Custom Blade directives
     * - Anonymous component paths
     */
    public function boot(BladeCompiler $blade, Application $app): void
    {
        // Register View macros for array slots
        ViewFactory::macro('arraySlot', ArraySlotDirectives::makeArraySlotMacro());
        ViewFactory::macro('endArraySlot', ArraySlotDirectives::makeEndArraySlotMacro());

        // Register all Blade directives
        $this->directiveProvider->registerDirectives($blade);

        // Register anonymous components with mog:: prefix
        $blade->anonymousComponentPath(__DIR__.'/../../resources/components', 'mog');
    }
}
