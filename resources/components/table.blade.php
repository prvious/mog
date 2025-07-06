@use(Illuminate\View\ComponentSlot)

@props([
    'caption' => app(ComponentSlot::class),

    'header' => app(ComponentSlot::class),

    'body' => app(ComponentSlot::class),

    'footer' => app(ComponentSlot::class),
])

<div
    data-slot="table-container"
    class="relative w-full overflow-x-auto">
    <table
        data-slot="table"
        {{ $attributes->twMerge('w-full caption-bottom text-sm') }}>
        @if ($caption->hasActualContent())
            <caption
                data-slot="table-caption"
                {{ $caption->attributes->twMerge('text-muted-foreground mt-4 text-sm') }}>
                {{ $caption }}
            </caption>
        @endif

        @if ($header->hasActualContent())
            <thead
                data-slot="table-header"
                {{ $header->attributes->twMerge('[&_tr]:border-b') }}>
                {{ $header }}
            </thead>
        @endif

        <tbody
            data-slot="table-body"
            {{ $body->attributes->twMerge('[&_tr:last-child]:border-0') }}>
            @if ($body->hasActualContent())
                {{ $body ?? $slot }}
            @endif
        </tbody>

        @if ($footer->hasActualContent())
            <tfoot
                data-slot="table-footer"
                {{ $footer->attributes->twMerge('bg-muted/50 border-t font-medium [&>tr]:last:border-b-0') }}>
                {{ $footer }}
            </tfoot>
        @endif
    </table>
</div>
