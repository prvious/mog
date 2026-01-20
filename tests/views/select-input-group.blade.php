@extends('mog-test::layout')

@section('title', 'Input Group and Label Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Input Group & Label Tests</h1>

        {{-- Input Group with Addons --}}
        <section dusk="section-input-group" class="space-y-4">
            <h2 class="text-2xl font-semibold">Input Group</h2>

            {{-- With text addon --}}
            <x-mog::input-group dusk="input-group-text">
                <x-mog::input-group-addon>
                    <x-mog::input-group-text>$</x-mog::input-group-text>
                </x-mog::input-group-addon>
                <x-mog::input-group-input placeholder="Amount" />
                <x-mog::input-group-addon>
                    <x-mog::input-group-text>.00</x-mog::input-group-text>
                </x-mog::input-group-addon>
            </x-mog::input-group>

            {{-- With button addon --}}
            <x-mog::input-group dusk="input-group-button">
                <x-mog::input-group-input placeholder="Search..." />
                <x-mog::input-group-addon>
                    <x-mog::input-group-button>
                        <x-mog::button>Search</x-mog::button>
                    </x-mog::input-group-button>
                </x-mog::input-group-addon>
            </x-mog::input-group>

            {{-- Multiple inputs --}}
            <x-mog::input-group dusk="input-group-multiple">
                <x-mog::input-group-input placeholder="First name" />
                <x-mog::input-group-input placeholder="Last name" />
            </x-mog::input-group>

            {{-- With textarea --}}
            <x-mog::input-group dusk="input-group-textarea">
                <x-mog::input-group-addon>
                    <x-mog::input-group-text>@</x-mog::input-group-text>
                </x-mog::input-group-addon>
                <x-mog::input-group-textarea placeholder="Comment..." rows="3" />
            </x-mog::input-group>
        </section>

        {{-- Label Variants --}}
        <section dusk="section-label" class="space-y-4">
            <h2 class="text-2xl font-semibold">Label</h2>
            <div class="flex flex-col gap-4">
                <div>
                    <x-mog::label dusk="label-default" for="input-1">Default Label</x-mog::label>
                    <x-mog::input id="input-1" placeholder="Input" />
                </div>
                <div>
                    <x-mog::label dusk="label-required" for="input-2" required>Required Label *</x-mog::label>
                    <x-mog::input id="input-2" placeholder="Required input" />
                </div>
            </div>
        </section>
    </div>
@endsection
