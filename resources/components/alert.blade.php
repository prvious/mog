@props([
    'variant' => 'default',
    'title',
    'icon',
    'content'
])

@php
    $variantClasses = match ($variant) {
        default => 'bg-background text-foreground',
        'destructive' => 'text-destructive [&>svg]:text-destructive',
    };
@endphp

<div
    role="alert"
    {{ $attributes->twMerge('relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7', $variantClasses) }}>
    @if ($icon)
        {{ $icon }}
    @endif

    <h5 {{ $title->attributes->twMerge('mb-1.5 font-medium leading-none tracking-tight') }}>{{ $title }}</h5>
    <div {{ $content->attributes->twMerge('text-sm [&_p]:leading-relaxed') }}>
        {{ $content }}
    </div>
</div>
