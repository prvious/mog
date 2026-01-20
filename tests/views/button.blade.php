@extends('mog-test::layout')

@section('title', 'Button Component Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Button Component Tests</h1>

        {{-- Button Variants --}}
        <section dusk="section-variants" class="space-y-4">
            <h2 class="text-2xl font-semibold">Variants</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::button dusk="variant-default">Default</x-mog::button>
                <x-mog::button variant="destructive" dusk="variant-destructive">Destructive</x-mog::button>
                <x-mog::button variant="outline" dusk="variant-outline">Outline</x-mog::button>
                <x-mog::button variant="secondary" dusk="variant-secondary">Secondary</x-mog::button>
                <x-mog::button variant="ghost" dusk="variant-ghost">Ghost</x-mog::button>
                <x-mog::button variant="link" dusk="variant-link">Link</x-mog::button>
            </div>
        </section>

        {{-- Button Sizes --}}
        <section dusk="section-sizes" class="space-y-4">
            <h2 class="text-2xl font-semibold">Sizes</h2>
            <div class="flex flex-wrap items-center gap-4">
                <x-mog::button size="sm" dusk="size-sm">Small</x-mog::button>
                <x-mog::button dusk="size-default">Default</x-mog::button>
                <x-mog::button size="lg" dusk="size-lg">Large</x-mog::button>
            </div>
        </section>

        {{-- Icon Buttons --}}
        <section dusk="section-icon-sizes" class="space-y-4">
            <h2 class="text-2xl font-semibold">Icon Sizes</h2>
            <div class="flex flex-wrap items-center gap-4">
                <x-mog::button size="icon-sm" dusk="size-icon-sm">
                    @svg('mog-plus', 'size-4')
                </x-mog::button>
                <x-mog::button size="icon" dusk="size-icon">
                    @svg('mog-plus', 'size-4')
                </x-mog::button>
                <x-mog::button size="icon-lg" dusk="size-icon-lg">
                    @svg('mog-plus', 'size-4')
                </x-mog::button>
            </div>
        </section>

        {{-- Button with Icons and Text --}}
        <section dusk="section-icons-text" class="space-y-4">
            <h2 class="text-2xl font-semibold">With Icons</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::button dusk="with-icon-left">
                    @svg('mog-plus', 'size-4')
                    Add Item
                </x-mog::button>
                <x-mog::button variant="destructive" dusk="with-icon-right">
                    Delete
                    @svg('mog-trash', 'size-4')
                </x-mog::button>
            </div>
        </section>

        {{-- Button States --}}
        <section dusk="section-states" class="space-y-4">
            <h2 class="text-2xl font-semibold">States</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::button dusk="state-default">Default State</x-mog::button>
                <x-mog::button disabled dusk="state-disabled">Disabled</x-mog::button>
            </div>
        </section>

        {{-- Interactive States (for testing hover/focus) --}}
        <section dusk="section-interactive" class="space-y-4">
            <h2 class="text-2xl font-semibold">Interactive</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::button dusk="interactive-hover" id="hover-target">Hover Me</x-mog::button>
                <x-mog::button dusk="interactive-focus" id="focus-target">Focus Me</x-mog::button>
                <x-mog::button dusk="interactive-click" onclick="this.textContent='Clicked!'">
                    Click Me
                </x-mog::button>
            </div>
        </section>

        {{-- Loading State (Livewire simulation) --}}
        <section dusk="section-loading" class="space-y-4" x-data="{ loading: false }">
            <h2 class="text-2xl font-semibold">Loading State</h2>
            <div class="flex flex-wrap gap-4">
                <button
                    @click="loading = !loading"
                    :data-loading="loading"
                    dusk="loading-button"
                    class="aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive shrink-0 focus-visible:ring-ring/50 group/button relative isolate inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium transition-all duration-75 focus-visible:border-ring text-sm outline-none focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:shrink-0 *:transition-opacity [&[data-loading]>:not([data-loading-indicator])]:opacity-0 [&[data-loading]>[data-loading-indicator]]:opacity-100 data-loading:pointer-events-none bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[>[data-slot=button-content]>svg]:px-3">
                    <div
                        data-loading-indicator
                        data-slot="loading-indicator"
                        :class="loading ? 'animate-spin' : ''"
                        class="absolute inset-0 flex items-center justify-center opacity-0">
                        @svg('mog-loader-2', 'size-5 p-0.5')
                    </div>
                    <span data-slot="button-content" class="inline-flex items-center justify-center gap-2 whitespace-nowrap">
                        Toggle Loading
                    </span>
                </button>
            </div>
        </section>

        {{-- As Link --}}
        <section dusk="section-as-link" class="space-y-4">
            <h2 class="text-2xl font-semibold">As Link</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::button :asLink="true" href="#link-test" dusk="as-link">
                    Link Button
                </x-mog::button>
            </div>
            <div id="link-test" class="text-sm text-gray-600">Link target</div>
        </section>

        {{-- Button Group --}}
        <section dusk="section-group" class="space-y-4">
            <h2 class="text-2xl font-semibold">Button Group</h2>
            <x-mog::button-group dusk="button-group">
                <x-mog::button dusk="group-btn-1">First</x-mog::button>
                <x-mog::button dusk="group-btn-2">Second</x-mog::button>
                <x-mog::button dusk="group-btn-3">Third</x-mog::button>
            </x-mog::button-group>
        </section>

        {{-- All Variants Side by Side (for snapshots) --}}
        <section dusk="section-all-variants" class="space-y-4">
            <h2 class="text-2xl font-semibold">All Variants Comparison</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="p-4 border rounded">
                    <p class="text-sm mb-2">Default</p>
                    <x-mog::button dusk="snap-default">Button</x-mog::button>
                </div>
                <div class="p-4 border rounded">
                    <p class="text-sm mb-2">Destructive</p>
                    <x-mog::button variant="destructive" dusk="snap-destructive">Button</x-mog::button>
                </div>
                <div class="p-4 border rounded">
                    <p class="text-sm mb-2">Outline</p>
                    <x-mog::button variant="outline" dusk="snap-outline">Button</x-mog::button>
                </div>
                <div class="p-4 border rounded">
                    <p class="text-sm mb-2">Secondary</p>
                    <x-mog::button variant="secondary" dusk="snap-secondary">Button</x-mog::button>
                </div>
                <div class="p-4 border rounded">
                    <p class="text-sm mb-2">Ghost</p>
                    <x-mog::button variant="ghost" dusk="snap-ghost">Button</x-mog::button>
                </div>
                <div class="p-4 border rounded">
                    <p class="text-sm mb-2">Link</p>
                    <x-mog::button variant="link" dusk="snap-link">Button</x-mog::button>
                </div>
            </div>
        </section>
    </div>
@endsection
