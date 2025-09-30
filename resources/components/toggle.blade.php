@props([
    'default',
    'off' => null,
    'size' => 'default',
    'variant' => 'default',
])

@php
    $defaultClasses = 'hover:bg-muted hover:text-muted-foreground focus-visible:ring-ring data-[state=on]:bg-accent data-[state=on]:text-accent-foreground inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium transition-colors hover:cursor-pointer focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0';

    $variantClasses = match ($variant) {
        'outline' => 'border-input hover:bg-accent hover:text-accent-foreground border bg-transparent shadow-sm',
        default => 'bg-transparent',
    };

    $sizeClasses = match ($size) {
        'sm' => 'h-8 min-w-8 px-1.5',
        'lg' => 'h-10 min-w-10 px-2.5',
        default => 'h-9 min-w-9 px-2',
    };

    if (! $attributes->has('x-on:click')) {
        $attributes = $attributes->merge(['x-on:click' => 'mog_toggle = !mog_toggle']);
    }
@endphp

<button
    x-cloak
    x-data="{
        mog_toggle: @js((bool) ($default ?? false)),
        toggle() {
            this.mog_toggle = ! this.mog_toggle
        },
    }"
    x-modelable="mog_toggle"
    x-bind:data-state="mog_toggle ? 'on' : 'off'"
    type="button"
    {{ $attributes->twMerge($defaultClasses, $variantClasses, $sizeClasses) }}>
    <div {!! when(! is_null($off), 'x-show="!mog_toggle"') !!}>
        {{ $slot }}
    </div>

    @if (! is_null($off))
        <div
            x-show="mog_toggle"
            {{ $off->attributes }}>
            {{ $off }}
        </div>
    @endif
</button>
