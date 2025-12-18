@props([
    'name',
])

<div
    data-slot="select-group"
    role="group"
    {{ $attributes }}>
    @if ($name)
        <div
            data-slot="select-label"
            {{ $name->attributes->twMerge('text-muted-foreground px-2 py-1.5 text-xs') }}>
            {{ $name }}
        </div>
    @endif

    {{ $slot }}
</div>
