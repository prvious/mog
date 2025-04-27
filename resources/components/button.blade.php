@props([
    'variant' => 'default',
    'size' => 'default',
    'asLink' => false,
])

@php
    $variantClasses = match ($variant) {
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/90 shadow-sm',
        'outline' => 'border-input bg-background hover:bg-accent hover:text-accent-foreground border shadow-sm',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80 shadow-sm',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline',
        default => 'bg-primary text-primary-foreground hover:bg-primary/90 shadow',
    };

    $sizeClasses = match ($size) {
        'default' => 'h-9 px-4 py-2',
        'sm' => 'h-8 rounded-md px-3 text-xs',
        'lg' => 'h-10 rounded-md px-8',
        'icon' => 'h-9 w-9',
    };

    $defaultClasses = twMerge('focus-visible:ring-ring inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium whitespace-nowrap transition-colors duration-75 hover:cursor-pointer focus-visible:ring-1 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0');

    $tag = $asLink ? 'a' : 'button';

    if ($tag === 'button') {
        $attributes = $attributes->merge(['type' => 'button']);
    }
@endphp

<{{ $tag }} {{ $attributes->twMerge($defaultClasses, $variantClasses, $sizeClasses) }}>
    {{ $slot }}
</{{ $tag }}>
