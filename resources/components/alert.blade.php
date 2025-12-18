@props([
    'variant' => 'default',
    'title',
    'icon',
    'content',
])

@php
    $variantClasses = match ($variant) {
        default => 'bg-card text-card-foreground',
        'destructive' => 'text-destructive bg-card *:data-[slot=alert-description]:text-destructive/90 [&>svg]:text-current',
    };
@endphp

<div
    data-slot="alert"
    role="alert"
    {{
        $attributes->cn(
            'relative w-full rounded-lg border px-4 py-3 text-sm',
            'grid has-[>svg]:grid-cols-[calc(var(--spacing)*4)_1fr] grid-cols-[0_1fr]',
            'has-[>svg]:gap-x-3 gap-y-0.5 items-start [&>svg]:size-4 [&>svg]:translate-y-0.5 [&>svg]:text-current',
            $variantClasses
        )
    }}>
    @if ($icon)
        {{ $icon }}
    @endif

    <div
        data-slot="alert-title"
        {{ $title->attributes->cn('col-start-2 line-clamp-1 min-h-4 font-medium tracking-tight') }}>
        {{ $title }}
    </div>
    <div
        data-slot="alert-description"
        {{ $content->attributes->cn('text-muted-foreground col-start-2 grid justify-items-start gap-1 text-sm [&_p]:leading-relaxed') }}>
        {{ $content }}
    </div>
</div>
