<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Title('Button Test')]
class extends Component {};

?>

<div class="container mx-auto space-y-8 p-8">
    {{-- Variants --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Variants</h2>
        <div class="flex flex-wrap items-center gap-4">
            <x-mog::button dusk="btn-default">Default</x-mog::button>
            <x-mog::button dusk="btn-destructive" variant="destructive">Destructive</x-mog::button>
            <x-mog::button dusk="btn-outline" variant="outline">Outline</x-mog::button>
            <x-mog::button dusk="btn-secondary" variant="secondary">Secondary</x-mog::button>
            <x-mog::button dusk="btn-ghost" variant="ghost">Ghost</x-mog::button>
            <x-mog::button dusk="btn-link" variant="link">Link</x-mog::button>
        </div>
    </section>

    {{-- Sizes --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Sizes</h2>
        <div class="flex flex-wrap items-center gap-4">
            <x-mog::button dusk="btn-sm" size="sm">Small</x-mog::button>
            <x-mog::button dusk="btn-default-size" size="default">Default</x-mog::button>
            <x-mog::button dusk="btn-lg" size="lg">Large</x-mog::button>
            <x-mog::button dusk="btn-icon" size="icon">
                @svg('lucide-plus', 'size-4')
            </x-mog::button>
            <x-mog::button dusk="btn-icon-sm" size="icon-sm">
                @svg('lucide-plus', 'size-4')
            </x-mog::button>
            <x-mog::button dusk="btn-icon-lg" size="icon-lg">
                @svg('lucide-plus', 'size-4')
            </x-mog::button>
        </div>
    </section>

    {{-- States --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">States</h2>
        <div class="flex flex-wrap items-center gap-4">
            <x-mog::button dusk="btn-disabled" disabled>Disabled</x-mog::button>
            <x-mog::button dusk="btn-as-link" asLink href="#test-link">As Link</x-mog::button>
        </div>
    </section>

    {{-- Button Group --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Button Group</h2>
        <x-mog::button-group dusk="btn-group">
            <x-mog::button dusk="btn-group-1" variant="outline">First</x-mog::button>
            <x-mog::button dusk="btn-group-2" variant="outline">Second</x-mog::button>
            <x-mog::button dusk="btn-group-3" variant="outline">Third</x-mog::button>
        </x-mog::button-group>
    </section>
</div>
