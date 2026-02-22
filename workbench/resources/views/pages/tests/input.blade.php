<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Title('Input Test')]
class extends Component {};

?>

<div class="container mx-auto space-y-8 p-8">
    {{-- Input Types --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Input Types</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input dusk="input-text" type="text" placeholder="Text input" />
            <x-mog::input dusk="input-email" type="email" placeholder="Email input" />
            <x-mog::input dusk="input-password" type="password" placeholder="Password input" />
            <x-mog::input dusk="input-number" type="number" placeholder="Number input" />
            <x-mog::input dusk="input-tel" type="tel" placeholder="Phone input" />
            <x-mog::input dusk="input-url" type="url" placeholder="URL input" />
            <x-mog::input dusk="input-date" type="date" />
            <x-mog::input dusk="input-search" type="search" placeholder="Search input" />
        </div>
    </section>

    {{-- Sizes --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Sizes</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input dusk="input-sm" size="sm" placeholder="Small input" />
            <x-mog::input dusk="input-md" size="md" placeholder="Default input" />
            <x-mog::input dusk="input-xl" size="xl" placeholder="Extra large input" />
        </div>
    </section>

    {{-- States --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">States</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::input dusk="input-disabled" disabled placeholder="Disabled input" />
            <x-mog::input dusk="input-readonly" readonly value="Readonly input" />
            <x-mog::input dusk="input-invalid" :invalid="true" placeholder="Invalid input" />
        </div>
    </section>

    {{-- Textarea --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Textarea</h2>
        <div class="grid max-w-md gap-4">
            <x-mog::textarea dusk="textarea-default" placeholder="Default textarea" />
            <x-mog::textarea dusk="textarea-disabled" disabled placeholder="Disabled textarea" />
        </div>
    </section>

    {{-- Label --}}
    <section>
        <h2 class="mb-4 text-lg font-semibold">Label</h2>
        <div class="grid max-w-md gap-2">
            <x-mog::label dusk="label-default" for="labeled-input">Input Label</x-mog::label>
            <x-mog::input dusk="labeled-input" id="labeled-input" placeholder="Labeled input" />
        </div>
    </section>
</div>
