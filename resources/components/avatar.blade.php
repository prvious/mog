@props([
    'img' => null,
    'initials' => null,
])

<span
    x-cloak
    x-data="{ error: false }"
    data-slot="avatar"
    {{ $attributes->twMerge('relative flex size-8 shrink-0 overflow-hidden rounded-full') }}>
    @if ($initials)
        <span
            {{ when($img, 'x-show="error"') }}
            {{ $initials->attributes->twMerge('absolute inset-0 z-10 bg-muted flex size-full items-center justify-center rounded-full') }}>
            {{ $initials }}
        </span>
    @endif

    @if ($img)
        <img
            src="{{ $img->attributes->get('src') }}"
            x-on:error="error = true"
            x-on:load="error = false"
            x-show="!error"
            {{ $img->attributes->twMerge('absolute inset-0 z-10 aspect-square size-full') }} />
    @endif
</span>
