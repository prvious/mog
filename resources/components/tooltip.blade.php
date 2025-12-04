@use(Illuminate\View\ComponentSlot)

@props([
    'trigger',
    'content' => app(ComponentSlot::class),
    'align' => 'top',
    'offset' => 7,
    'open' => false,
])

@php
    @[$placement, $align] = explode('-', $align);
    $align ??= 'center';
    $align = "{$placement}-{$align}";
@endphp

<div
    data-slot="tooltip"
    x-data="{
        open: @js($open ?? false),
    }"
    x-modelable="open"
    x-on:pointermove="
        if ($event.pointerType === 'touch') return
        if (open) return
        open = true
    "
    x-on:pointerleave="open = false"
    x-on:pointerdown="
        if (open) {
            open = false
        }
    "
    x-on:focus="open = true"
    x-on:blur="open = false"
    x-on:click="open = false"
    {{ $attributes->twMerge('inline-flex ') }}>
    <div
        x-ref="trigger"
        data-slot="tooltip-trigger">
        {{ $trigger }}
    </div>
    <div
        x-cloak
        x-show="open"
        data-slot="tooltip-content"
        :data-state="open ? 'open' : 'closed'"
        x-ref="content"
        x-tooltip.{{ $align }}.offset.{{ $offset }}="$refs.trigger"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="scale-95 transform opacity-0"
        x-transition:enter-end="scale-100 transform opacity-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="scale-100 transform opacity-100"
        x-transition:leave-end="scale-95 transform opacity-0"
        role="tooltip"
        class="z-50">
        <div {{ $content->attributes->twMerge('relative bg-foreground text-background text-balance rounded-md px-3 py-1.5 text-xs min-w-max') }}>
            {{ $content }}
        </div>

        <span
            data-slot="tooltip-arrow"
            class="-z-10">
            <svg
                class="bg-foreground fill-foreground block size-2.5 translate-y-[calc(-50%_-_2px)] rotate-45 rounded-[2px]"
                width="10"
                height="5"
                viewBox="0 0 30 10"
                preserveAspectRatio="none">
                <polygon points="0,0 30,0 15,10"></polygon>
            </svg>
        </span>
    </div>
</div>
