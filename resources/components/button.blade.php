@props([
    'variant' => 'default',
    'size' => 'default',
    'asLink' => false,
])

@php
    $variantClasses = match ($variant) {
        'destructive' => 'bg-destructive hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:focus-visible:ring-destructive/40 dark:bg-destructive/60 text-white',
        'outline' => 'bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 border',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50',
        'link' => 'text-primary underline-offset-4 hover:underline',
        default => 'bg-primary text-primary-foreground hover:bg-primary/90',
    };

    $sizeClasses = match ($size) {
        'sm' => 'h-8 gap-1.5 rounded-md px-3 has-[>svg]:px-2.5',
        'lg' => 'h-10 rounded-md px-6 has-[>svg]:px-4',
        'icon' => 'size-9',
        'icon-sm' => 'size-8',
        'icon-lg' => 'size-10',
        default => 'h-9 px-4 py-2 has-[>svg]:px-3',
    };

    $loaderClasses = match ($size) {
        'sm' => 'size-4 p-0.5',
        default => 'size-5 p-0.5',
    };

    $classes = [
        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive shrink-0',
        'focus-visible:ring-ring/50 group/button relative isolate inline-flex items-center justify-center gap-2',
        'whitespace-nowrap rounded-md font-medium transition-all duration-75',
        'focus-visible:border-ring text-sm outline-none focus-visible:ring-[3px]',
        "disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:shrink-0",
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

<{{ $tag }} {{ $attributes->cn($classes, $variantClasses, $sizeClasses) }}>
    @if ($loading)
        <div
            class="group-data-loading/button:animate-spin absolute inset-0 flex items-center justify-center opacity-0"
            data-loading-indicator>
            @svg('mog-loader-2', $loaderClasses)
        </div>
    @endif

    <span class="inline-flex items-center justify-center gap-2 whitespace-nowrap">
        {{ $slot }}
    </span>
</{{ $tag }}>
