@use(Illuminate\View\ComponentSlot)

@props([
    'content' => app(ComponentSlot::class),
    'trigger' => app(ComponentSlot::class),
    'align' => 'top',
    'offset' => '5',
    'open' => false,
])

<div
    data-ignore
    data-slot="popover"
    x-data="{
        open: @js($open ?? false),
    }"
    x-modelable="open"
    x-on:click.away="open = false"
    x-on:keydown.escape="open = false"
    {{ $attributes->cn('contents') }}>
    <div
        data-ignore-trigger
        data-slot="popover-trigger"
        x-ref="trigger"
        x-on:click="open = !open"
        {{ $trigger->attributes->cn('contents') }}>
        {{ $trigger }}
    </div>

    <div
        {{
            $content->attributes->cn(
                'z-50 bg-popover text-popover-foreground rounded-md border p-4 shadow-md outline-none',
            )
        }}
        x-show="open"
        x-trap="open"
        x-on:click.away="open = false"
        x-on:keydown.escape="open = false"
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
