@extends('mog-test::layout')

@section('title', 'Input Component Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Input Component Tests</h1>

        {{-- Input Types --}}
        <section dusk="section-types" class="space-y-4">
            <h2 class="text-2xl font-semibold">Input Types</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::input type="text" dusk="type-text" placeholder="Text input" />
                <x-mog::input
                    type="email"
                    dusk="type-email"
                    placeholder="Email input"
                />
                <x-mog::input
                    type="password"
                    dusk="type-password"
                    placeholder="Password"
                />
                <x-mog::input
                    type="number"
                    dusk="type-number"
                    placeholder="Number"
                />
                <x-mog::input type="tel" dusk="type-tel" placeholder="Phone" />
                <x-mog::input type="url" dusk="type-url" placeholder="URL" />
                <x-mog::input type="date" dusk="type-date" />
                <x-mog::input type="time" dusk="type-time" />
                <x-mog::input type="datetime-local" dusk="type-datetime" />
                <x-mog::input type="file" dusk="type-file" />
                <x-mog::input
                    type="search"
                    dusk="type-search"
                    placeholder="Search"
                />
            </div>
        </section>

        {{-- Input Sizes --}}
        <section dusk="section-sizes" class="space-y-4">
            <h2 class="text-2xl font-semibold">Sizes</h2>
            <div class="flex flex-col gap-4">
                <x-mog::input size="xs" dusk="size-xs" placeholder="Extra Small" />
                <x-mog::input size="sm" dusk="size-sm" placeholder="Small" />
                <x-mog::input size="md" dusk="size-md" placeholder="Medium (default)" />
                <x-mog::input size="xl" dusk="size-xl" placeholder="Extra Large" />
            </div>
        </section>

        {{-- Input States --}}
        <section dusk="section-states" class="space-y-4">
            <h2 class="text-2xl font-semibold">States</h2>
            <div class="flex flex-col gap-4">
                <x-mog::input dusk="state-default" placeholder="Default" />
                <x-mog::input
                    disabled
                    dusk="state-disabled"
                    placeholder="Disabled"
                    value="Disabled"
                />
                <x-mog::input
                    readonly
                    dusk="state-readonly"
                    placeholder="Readonly"
                    value="Readonly"
                />
                <x-mog::input
                    invalid
                    dusk="state-invalid"
                    placeholder="Invalid/Error"
                />
            </div>
        </section>

        {{-- Interactive States --}}
        <section dusk="section-interactive" class="space-y-4">
            <h2 class="text-2xl font-semibold">Interactive</h2>
            <div class="flex flex-col gap-4">
                <x-mog::input
                    dusk="interactive-type"
                    placeholder="Type something..."
                />
                <x-mog::input
                    dusk="interactive-focus"
                    placeholder="Focus me"
                    id="focus-target"
                />
            </div>
        </section>

        {{-- Textarea --}}
        <section dusk="section-textarea" class="space-y-4">
            <h2 class="text-2xl font-semibold">Textarea</h2>
            <div class="flex flex-col gap-4">
                <x-mog::textarea
                    dusk="textarea-default"
                    placeholder="Default textarea"
                    rows="3"
                />
                <x-mog::textarea
                    dusk="textarea-disabled"
                    disabled
                    placeholder="Disabled"
                    rows="3"
                />
                <x-mog::textarea
                    dusk="textarea-readonly"
                    readonly
                    placeholder="Readonly"
                    value="Readonly textarea content"
                    rows="3"
                />
                <x-mog::textarea
                    dusk="textarea-invalid"
                    invalid
                    placeholder="Invalid textarea"
                    rows="3"
                />
            </div>
        </section>

        {{-- All Sizes Comparison --}}
        <section dusk="section-all-sizes" class="space-y-4">
            <h2 class="text-2xl font-semibold">All Sizes Comparison</h2>
            <div class="flex flex-col gap-4">
                <div>
                    <p class="text-sm mb-2">Extra Small (xs)</p>
                    <x-mog::input
                        size="xs"
                        dusk="snap-size-xs"
                        placeholder="Extra Small"
                    />
                </div>
                <div>
                    <p class="text-sm mb-2">Small (sm)</p>
                    <x-mog::input
                        size="sm"
                        dusk="snap-size-sm"
                        placeholder="Small"
                    />
                </div>
                <div>
                    <p class="text-sm mb-2">Medium (md)</p>
                    <x-mog::input
                        size="md"
                        dusk="snap-size-md"
                        placeholder="Medium"
                    />
                </div>
                <div>
                    <p class="text-sm mb-2">Extra Large (xl)</p>
                    <x-mog::input
                        size="xl"
                        dusk="snap-size-xl"
                        placeholder="Extra Large"
                    />
                </div>
            </div>
        </section>
    </div>
@endsection
