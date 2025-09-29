@props([
    'ratio' => 1 / 1,
])

@php
    $ratio = is_string($ratio) ? eval("return $ratio;") : $ratio;
@endphp

{{-- paddingBottom: `${100 / ratio}%` --}}

<div
    {{ $attributes->twMerge('relative w-full') }}
    :style="{'padding-bottom': `${100 / {{ (float) $ratio }} }%`}">
    <div class="absolute top-0 right-0 bottom-0 left-0">
        {{ $slot }}
    </div>
</div>
