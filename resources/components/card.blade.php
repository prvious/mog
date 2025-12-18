@use(Illuminate\View\ComponentSlot)

@props([
    'header' => app(ComponentSlot::class),
    'title',
    'description',
    'content',
    'footer' => app(ComponentSlot::class),
    'open' => false,
])

<div {{ $attributes->cn('rounded-xl border bg-card text-card-foreground shadow') }}>
    <div {{ $header->attributes->cn('flex flex-col space-y-1.5 p-6') }}>
        <div {{ $title->attributes->cn('font-semibold leading-none tracking-tight') }}>{{ $title }}</div>
        <div {{ $description->attributes->cn('text-sm text-muted-foreground') }}>{{ $description }}</div>
    </div>

    <div {{ $content->attributes->cn('p-6 pt-0') }}>{{ $content }}</div>

    <div {{ $footer->attributes->cn('flex items-center p-6 pt-0') }}>{{ $footer }}</div>
</div>
