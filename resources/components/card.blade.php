@use(Illuminate\View\ComponentSlot)

@props([
    'header' => app(ComponentSlot::class),
    'title',
    'description',
    'content',
    'footer' => app(ComponentSlot::class),
    'open' => false,
])

<div {{ $attributes->twMerge('rounded-xl border bg-card text-card-foreground shadow') }}>
    <div {{ $header->attributes->twMerge('flex flex-col space-y-1.5 p-6') }}>
        <div {{ $title->attributes->twMerge('font-semibold leading-none tracking-tight') }}>{{ $title }}</div>
        <div {{ $description->attributes->twMerge('text-sm text-muted-foreground') }}>{{ $description }}</div>
    </div>

    <div {{ $content->attributes->twMerge('p-6 pt-0') }}>{{ $content }}</div>

    <div {{ $footer->attributes->twMerge('flex items-center p-6 pt-0') }}>{{ $footer }}</div>
</div>
