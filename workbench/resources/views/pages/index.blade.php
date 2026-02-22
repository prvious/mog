<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Title('Mog UI')]
class extends Component {};

?>

<div class="flex flex-1 flex-col">
    <x-page-header>
        <x-slot:heading class="max-w-4xl">The Foundation for your Design System</x-slot:heading>

        <x-slot:description class="max-w-4xl">
            A set of beautifully designed components that you can customize, extend, and build on. Start here then make it your own. Open Source. Open Code.
        </x-slot:description>

        <x-slot:actions>
            <x-mog::button
                asLink
                size="sm"
                class="h-[31px] rounded-lg"
                href="/create">
                @svg('lucide-plus')
                New Project
            </x-mog::button>
            <x-mog::button
                asLink
                size="sm"
                variant="ghost"
                class="rounded-lg"
                href="/docs/components">
                View Components
            </x-mog::button>
        </x-slot:actions>
    </x-page-header>

    <x-page-nav class="hidden md:flex">
        <x-examples-nav class="[&>a:first-child]:text-primary flex-1 overflow-hidden" />
    </x-page-nav>

    <div class="container-wrapper section-soft flex-1 pb-6">
        <div class="container overflow-hidden">
            <section class="border-border/50 -mx-4 w-[160vw] overflow-hidden rounded-lg border md:hidden md:w-[150vw]">
                <img
                    alt="Dashboard"
                    width="1400"
                    height="875"
                    decoding="async"
                    data-nimg="1"
                    class="block dark:hidden"
                    style="color: transparent"
                    src="https://ui.shadcn.com/_next/image?url=%2Fr%2Fstyles%2Fnew-york-v4%2Fdashboard-01-light.png&amp;w=3840&amp;q=75" />
                <img
                    alt="Dashboard"
                    width="1400"
                    height="875"
                    decoding="async"
                    data-nimg="1"
                    class="hidden dark:block"
                    style="color: transparent"
                    src="https://ui.shadcn.com/_next/image?url=%2Fr%2Fstyles%2Fnew-york-v4%2Fdashboard-01-dark.png&amp;w=3840&amp;q=75" />
            </section>
            <section class="theme-container hidden md:block">
                <x-root-components />
            </section>
        </div>
    </div>
</div>
