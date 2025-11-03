@use(Illuminate\View\ComponentSlot)

@props([
    'content' => app(ComponentSlot::class),
    'trigger' => app(ComponentSlot::class),
    'align' => 'center',
    'offset' => '5',
    'open' => false,
])

@php
@endphp

<div
    x-data="{
        open: @js($open ?? false),
        toggle() {
            this.open = ! this.open
        },
        show() {
            this.open = true
        },
        hide() {
            this.open = false
        },
    }"
    x-on:click.away="hide()"
    x-on:keydown.escape="hide()"
    data-slot="popover"
    {{ $attributes->twMerge('relative group') }}>
    <div
        {{ $trigger->attributes->twMerge('cursor-pointer') }}
        x-on:click="toggle()"
        x-ref="trigger">
        {{ $trigger }}
    </div>

    <div
        {{
            $content->attributes->twMerge(
                'top-(--top) left-(--left) transform-(--transform) mt-(--margin-top) fixed z-50',
                'bg-popover text-popover-foreground',
                'rounded-md border p-4 shadow-md outline-none w-full absolute',
            )
        }}
        x-show="open"
        x-trap="open"
        x-on:click.away="hide()"
        x-on:keydown.escape="hide()"
        x-anchor.{{ $align }}.offset.{{ $offset }}="$refs.trigger"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="scale-95 transform opacity-0"
        x-transition:enter-end="scale-100 transform opacity-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="scale-100 transform opacity-100"
        x-transition:leave-end="scale-95 transform opacity-0"
        style="display: none">
        {{ $content }}
    </div>
</div>
