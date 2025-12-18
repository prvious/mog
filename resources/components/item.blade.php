@props([
    'variant' => 'default',
    'size' => 'default',
    'tag' => 'div',
])

@php
    $variantClasses = match ($variant) {
        'outline' => 'border-border',
        'muted' => 'bg-muted/50',
        default => 'bg-transparent',
    };

    $sizeClasses = match ($size) {
        'sm' => 'gap-2.5 px-4 py-3',
        default => 'p-4 gap-4 ',
    };
@endphp

<{{ $tag }}
    data-slot="item"
    data-size="{{ $size }}"
    data-variant="{{ $variant }}"
    {{ $attributes->twMerge('group/item flex items-center border border-transparent text-sm rounded-md transition-colors [a]:hover:bg-accent/50 [a]:transition-colors duration-100 flex-wrap outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]', $variantClasses, $sizeClasses) }}>
    {{ $slot }}
</{{ $tag }}>
