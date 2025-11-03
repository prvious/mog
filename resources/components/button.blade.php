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
        'sm' => 'h-7 rounded-md px-3 text-xs',
        'lg' => 'h-9 rounded-md px-8',
        'icon' => 'size-7 p-0.5',
        default => 'h-8 px-4 py-2',
    };

    $iconClasses = match ($size) {
        'sm' => 'size-3 p-0.5',
        default => 'size-5 p-0.5',
    };

    $classes = [
        'focus-visible:ring-ring group relative isolate inline-flex items-center justify-center gap-2',
        'whitespace-nowrap rounded-md text-sm font-medium transition-colors duration-75',
        'hover:cursor-pointer focus-visible:outline-none focus-visible:ring-1',
        'disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-3 [&_svg]:shrink-0',
    ];

    $loading = $attributes->whereStartsWith('wire:click')->first() !== null || $attributes->has('wire:target');

    if ($loading) {
        $classes[] = '*:transition-opacity';
        $classes[] = $attributes->get('type') === 'submit' ? '[&[disabled]>:not([data-loading-indicator])]:opacity-0' : '[&[data-loading]>:not([data-loading-indicator])]:opacity-0';
        $classes[] = $attributes->get('type') === 'submit' ? '[&[disabled]>[data-loading-indicator]]:opacity-100' : '[&[data-loading]>[data-loading-indicator]]:opacity-100';
        $classes[] = $attributes->get('type') === 'submit' ? '[&[disabled]]:pointer-events-none' : 'data-loading:pointer-events-none';
    }

    $tag = $asLink ? 'a' : 'button';

    $isJsMethod = str_starts_with($attributes->whereStartsWith('wire:click')->first() ?? '', '$js.');

    if ($loading && $attributes->get('type') !== 'submit' && ! $isJsMethod) {
        $attributes = $attributes->merge(['wire:loading.attr' => 'data-loading']);

        if (! $attributes->has('wire:target') && ($target = $attributes->whereStartsWith('wire:click')->first())) {
            $attributes = $attributes->merge(['wire:target' => $target], escape: false);
        }
    }
@endphp

<{{ $tag }} {{ $attributes->twMerge($classes, $variantClasses, $sizeClasses) }}>
    @if ($loading)
        <div
            class="group-data-loading:animate-spin absolute inset-0 flex items-center justify-center opacity-0"
            data-loading-indicator>
            @svg('mog-loader-2', $iconClasses)
        </div>
    @endif

    <span class="inline-flex items-center justify-center gap-2 whitespace-nowrap">
        {{ $slot }}
    </span>
</{{ $tag }}>
