@props([
    'variant' => 'default',
])

@php
    $variantClasses = match ($variant) {
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/80 border-transparent shadow',
        'outline' => 'text-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80 border-transparent',
        default => 'bg-primary text-primary-foreground hover:bg-primary/80 border-transparent shadow',
    };

    $defaultClasses = 'focus:ring-ring inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:ring-2 focus:ring-offset-2 focus:outline-none';
@endphp

<div {{ $attributes->twMerge($defaultClasses, $variantClasses) }}>{{ $slot }}</div>
