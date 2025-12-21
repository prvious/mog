@props([
    'type' => 'button',
    'variant' => 'ghost',
    'size' => 'xs',
])

@php
    $attributes = $attributes
        ->cn(
            'text-sm shadow-none flex gap-2 items-center',
            match ($size) {
                'xs' => "h-6 gap-1 px-2 rounded-[calc(var(--radius)-5px)] [&>svg:not([class*='size-'])]:size-3.5 has-[>[data-slot=button-content]>svg]:px-2",
                'sm' => 'h-8 px-2.5 gap-1.5 rounded-md has-[>[data-slot=button-content]>svg]:px-2.5',
                'icon-xs' => 'size-6 rounded-[calc(var(--radius)-5px)] p-0 has-[>[data-slot=button-content]>svg]:p-0',
                'icon-sm' => 'size-8 p-0 has-[>[data-slot=button-content]>svg]:p-0',
            }
        )
        ->merge([
            'type' => $type,
            'variant' => $variant,
            'size' => $size,
        ]);
@endphp

<x-mog::button :attributes="$attributes">
    {{ $slot }}
</x-mog::button>
