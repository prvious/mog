@use(Illuminate\View\ComponentSlot)

@props([
    'header' => app(ComponentSlot::class),
    'title' => app(ComponentSlot::class),
    'description' => app(ComponentSlot::class),
    'content' => app(ComponentSlot::class),
    'media' => app(ComponentSlot::class),
])

<div
    data-slot="empty"
    {{ $attributes->cn('flex min-w-0 flex-1 flex-col items-center justify-center gap-6 rounded-lg border-dashed p-6 text-center text-balance md:p-12') }}>
    <div
        data-slot="empty-header"
        {{ $header->attributes->cn('flex max-w-sm flex-col items-center gap-2 text-center') }}>
        @if ($media->isNotEmpty())
            <div
                data-slot="empty-icon"
                data-variant="{{ $media->attributes->get('variant', 'default') }}"
                {{
                    $media->attributes->cn(
                        'flex shrink-0 items-center justify-center mb-2 [&_svg]:pointer-events-none [&_svg]:shrink-0',
                        match ($media->attributes->get('variant', 'default')) {
                            'icon' => "bg-muted text-foreground flex size-10 shrink-0 items-center justify-center rounded-lg [&_svg:not([class*='size-'])]:size-6",
                            default => 'bg-transparent',
                        }
                    )
                }}>
                {{ $media }}
            </div>
        @endif

        @if ($title->isNotEmpty())
            <div
                data-slot="empty-title"
                {{ $title->attributes->cn('text-lg font-medium tracking-tight') }}>
                {{ $title }}
            </div>
        @endif

        @if ($description->isNotEmpty())
            <div
                data-slot="empty-description"
                {{ $description->attributes->cn('text-muted-foreground [&>a:hover]:text-primary text-sm/relaxed [&>a]:underline [&>a]:underline-offset-4') }}>
                {{ $description }}
            </div>
        @endif
    </div>

    @if ($content->isNotEmpty())
        <div
            data-slot="empty-content"
            {{ $content->attributes->cn('flex w-full max-w-sm min-w-0 flex-col items-center gap-4 text-sm text-balance') }}>
            {{ $content }}
        </div>
    @endif
</div>
