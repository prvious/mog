@extends('mog-test::layout')

@section('title', 'Checkbox Radio Switch Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Checkbox, Radio, Switch Tests</h1>

        {{-- Checkbox States --}}
        <section dusk="section-checkbox" class="space-y-4">
            <h2 class="text-2xl font-semibold">Checkbox</h2>
            <div class="flex flex-col gap-4">
                <label class="flex items-center gap-2">
                    <x-mog::checkbox dusk="checkbox-unchecked" />
                    <span>Unchecked</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::checkbox dusk="checkbox-checked" checked />
                    <span>Checked</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::checkbox dusk="checkbox-disabled" disabled />
                    <span>Disabled</span>
                </label>
            </div>
        </section>

        {{-- Radio Group --}}
        <section dusk="section-radio" class="space-y-4">
            <h2 class="text-2xl font-semibold">Radio Group</h2>
            <x-mog::radio-group dusk="radio-group" name="test-radio" value="option1">
                <label class="flex items-center gap-2">
                    <x-mog::radio-group-item dusk="radio-option-1" value="option1" />
                    <span>Option 1</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::radio-group-item dusk="radio-option-2" value="option2" />
                    <span>Option 2</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::radio-group-item dusk="radio-option-3" value="option3" />
                    <span>Option 3</span>
                </label>
            </x-mog::radio-group>
        </section>

        {{-- Switch --}}
        <section dusk="section-switch" class="space-y-4">
            <h2 class="text-2xl font-semibold">Switch</h2>
            <div class="flex flex-col gap-4">
                <label class="flex items-center gap-2">
                    <x-mog::switch dusk="switch-off" />
                    <span>Off</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::switch dusk="switch-on" checked />
                    <span>On</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::switch dusk="switch-disabled" disabled />
                    <span>Disabled</span>
                </label>
            </div>
        </section>

        {{-- Toggle --}}
        <section dusk="section-toggle" class="space-y-4">
            <h2 class="text-2xl font-semibold">Toggle</h2>
            <div class="flex gap-4">
                <x-mog::toggle dusk="toggle-default">Toggle</x-mog::toggle>
                <x-mog::toggle dusk="toggle-pressed" default="true">Pressed</x-mog::toggle>
                <x-mog::toggle dusk="toggle-disabled" disabled>Disabled</x-mog::toggle>
            </div>
        </section>

        {{-- Slider --}}
        <section dusk="section-slider" class="space-y-4">
            <h2 class="text-2xl font-semibold">Slider</h2>
            <div class="flex flex-col gap-4">
                <x-mog::slider dusk="slider-default" min="0" max="100" />
                <x-mog::slider dusk="slider-disabled" min="0" max="100" disabled />
            </div>
        </section>
    </div>
@endsection
