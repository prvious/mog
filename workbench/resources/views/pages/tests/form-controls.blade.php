<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Title('Form Controls Test')]
class extends Component {};

?>

<div class="container mx-auto space-y-8 p-8">
    {{-- Checkbox --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Checkbox</h2>
        <div class="flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-2">
                <x-mog::checkbox dusk="checkbox-default" />
                <x-mog::label>Unchecked</x-mog::label>
            </div>
            <div class="flex items-center gap-2">
                <x-mog::checkbox dusk="checkbox-checked" :checked="true" />
                <x-mog::label>Checked</x-mog::label>
            </div>
            <div class="flex items-center gap-2">
                <x-mog::checkbox dusk="checkbox-disabled" :disabled="true" />
                <x-mog::label>Disabled</x-mog::label>
            </div>
        </div>
    </section>

    {{-- Switch --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Switch</h2>
        <div class="flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-2">
                <x-mog::switch dusk="switch-default" />
                <x-mog::label>Off</x-mog::label>
            </div>
            <div class="flex items-center gap-2">
                <x-mog::switch dusk="switch-on" :checked="true" />
                <x-mog::label>On</x-mog::label>
            </div>
            <div class="flex items-center gap-2">
                <x-mog::switch dusk="switch-disabled" :disabled="true" />
                <x-mog::label>Disabled</x-mog::label>
            </div>
        </div>
    </section>

    {{-- Toggle --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Toggle</h2>
        <div class="flex flex-wrap items-center gap-4">
            <x-mog::toggle dusk="toggle-default">
                @svg('lucide-bold', 'size-4')
            </x-mog::toggle>
            <x-mog::toggle dusk="toggle-pressed" :default="true">
                @svg('lucide-italic', 'size-4')
            </x-mog::toggle>
            <x-mog::toggle dusk="toggle-disabled" disabled>
                @svg('lucide-underline', 'size-4')
            </x-mog::toggle>
        </div>
    </section>

    {{-- Radio Group --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Radio Group</h2>
        <x-mog::radio-group dusk="radio-group" value="option-1">
            <div class="flex items-center gap-2">
                <x-mog::radio-group-item dusk="radio-option-1" value="option-1" />
                <x-mog::label>Option 1</x-mog::label>
            </div>
            <div class="flex items-center gap-2">
                <x-mog::radio-group-item dusk="radio-option-2" value="option-2" />
                <x-mog::label>Option 2</x-mog::label>
            </div>
            <div class="flex items-center gap-2">
                <x-mog::radio-group-item dusk="radio-option-3" value="option-3" />
                <x-mog::label>Option 3</x-mog::label>
            </div>
        </x-mog::radio-group>
    </section>

    {{-- Slider --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Slider</h2>
        <div class="max-w-md">
            <x-mog::slider dusk="slider-default" :min="0" :max="100" />
        </div>
    </section>
</div>
