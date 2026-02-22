<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Title('Input Group Test')]
class extends Component {};

?>

<div class="container mx-auto space-y-8 p-8">
    {{-- Text Addon Prefix --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Text Addons</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input-group dusk="ig-text-prefix">
                <x-mog::input-group-addon align="inline-start">
                    <x-mog::input-group-text dusk="ig-text-prefix-text">https://</x-mog::input-group-text>
                </x-mog::input-group-addon>
                <x-mog::input-group-input dusk="ig-text-prefix-input" placeholder="example.com" />
            </x-mog::input-group>

            <x-mog::input-group dusk="ig-text-suffix">
                <x-mog::input-group-input dusk="ig-text-suffix-input" placeholder="username" />
                <x-mog::input-group-addon align="inline-end">
                    <x-mog::input-group-text dusk="ig-text-suffix-text">@example.com</x-mog::input-group-text>
                </x-mog::input-group-addon>
            </x-mog::input-group>
        </div>
    </section>

    {{-- Button Addon --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Button Addon</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input-group dusk="ig-button">
                <x-mog::input-group-input dusk="ig-button-input" placeholder="Search..." />
                <x-mog::input-group-addon align="inline-end">
                    <x-mog::input-group-button dusk="ig-button-btn">
                        @svg('lucide-search', 'size-4')
                    </x-mog::input-group-button>
                </x-mog::input-group-addon>
            </x-mog::input-group>
        </div>
    </section>

    {{-- Icon Addon --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Icon Addon</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input-group dusk="ig-icon">
                <x-mog::input-group-addon align="inline-start">
                    @svg('lucide-mail', 'size-4')
                </x-mog::input-group-addon>
                <x-mog::input-group-input dusk="ig-icon-input" type="email" placeholder="you@example.com" />
            </x-mog::input-group>
        </div>
    </section>

    {{-- Combined --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Combined</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input-group dusk="ig-combined">
                <x-mog::input-group-addon align="inline-start">
                    @svg('lucide-dollar-sign', 'size-4')
                </x-mog::input-group-addon>
                <x-mog::input-group-input dusk="ig-combined-input" type="number" placeholder="0.00" />
                <x-mog::input-group-addon align="inline-end">
                    <x-mog::input-group-text dusk="ig-combined-suffix">USD</x-mog::input-group-text>
                </x-mog::input-group-addon>
            </x-mog::input-group>
        </div>
    </section>

    {{-- Textarea --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Input Group with Textarea</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input-group dusk="ig-textarea">
                <x-mog::input-group-addon align="block-start">
                    <x-mog::input-group-text dusk="ig-textarea-label">Description</x-mog::input-group-text>
                </x-mog::input-group-addon>
                <x-mog::input-group-textarea dusk="ig-textarea-input" placeholder="Enter description..." />
            </x-mog::input-group>
        </div>
    </section>
</div>
