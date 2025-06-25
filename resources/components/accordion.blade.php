@props([
    'trigger',
    'open' => false,
    'collapsible' => true,
    'content',
])

@aware(['collapsible'])

@php
    if ($collapsible === false) {
        $open = true;
    }
@endphp

<div
    data-mog-groupable
    x-data="{
        mog_open: @js($open),
        toggle() {
            this.mog_open = ! this.mog_open
        },
        close() {
            this.mog_open = false
        },
        open() {
            this.mog_open = true
        },
    }"
    {{ $attributes->twMerge('border-b group')->merge(['x-bind:data-state' => "mog_open ? 'open' : 'closed'"]) }}>
    <div class="flex">
        <button
            {!! when($collapsible !== false, 'x-on:click="toggle()"') !!}
            {{ $trigger->attributes->twMerge('flex flex-1 items-center justify-between py-4 text-left text-sm font-medium transition-[rotate] hover:underline group-data-[state=closed]:[&>svg]:rotate-180 [&>svg]:transition-[rotate] [&>svg]:duration-200') }}>
            {{ $trigger }}
            {{ svg('mog-chevron-up', 'text-muted-foreground h-4 w-4 shrink-0') }}
        </button>
    </div>

    <div
        {{ $content->attributes->twMerge('grid group-data-[state=closed]:grid-rows-[0fr] transition-[grid-template-rows] ease-in-out duration-200 group-data-[state=open]:grid-rows-[1fr] overflow-hidden text-sm') }}>
        <div class="overflow-hidden pb-4 pt-0">
            {{ $content }}
        </div>
    </div>
</div>
