@props([
    'ratio' => 1 / 1,
])

@php
    $ratio = app('mog')->parseAspectRatio($ratio);
@endphp

{{-- paddingBottom: `${100 / ratio}%` --}}

<div
    {{ $attributes->cn('relative w-full') }}
    :style="{'padding-bottom': `${100 / {{ (float) $ratio }} }%`}">
    <div class="absolute bottom-0 left-0 right-0 top-0">
        {{ $slot }}
    </div>
</div>
