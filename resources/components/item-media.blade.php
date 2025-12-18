@props([
    'variant' => 'default',
])

@php
    $variantClasses = match ($variant) {
        'image' => 'size-10 overflow-hidden rounded-sm [&_img]:size-full [&_img]:object-cover',
        'icon' => "size-8 border rounded-sm bg-muted [&_svg:not([class*='size-'])]:size-4",
        default => 'bg-transparent',
    };

    $attributes = $attributes
        ->twMerge('flex shrink-0 items-center justify-center gap-2 group-has-[[data-slot=item-description]]/item:self-start [&_svg]:pointer-events-none group-has-[[data-slot=item-description]]/item:translate-y-0.5', $variantClasses)
        ->merge([
            'data-slot' => 'item-media',
        ]);
@endphp

<div {{ $attributes }}>
    {{ $slot }}
</div>
