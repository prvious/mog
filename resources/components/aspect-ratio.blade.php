@props([
    'ratio' => 1 / 1,
])

@php
    if (is_string($ratio)) {
        // Accept formats like "16/9" or "4/3"
        $parts = explode('/', $ratio);
        if (count($parts) === 2 && is_numeric($parts[0]) && is_numeric($parts[1]) && (float)$parts[1] != 0) {
            $ratio = floatval($parts[0]) / floatval($parts[1]);
        } elseif (is_numeric($ratio)) {
            $ratio = floatval($ratio);
        } else {
            $ratio = 1; // fallback to 1:1 if invalid
        }
    }
@endphp

{{-- paddingBottom: `${100 / ratio}%` --}}

<div
    {{ $attributes->twMerge('relative w-full') }}
    :style="{'padding-bottom': `${100 / {{ (float) $ratio }} }%`}">
    <div class="absolute top-0 right-0 bottom-0 left-0">
        {{ $slot }}
    </div>
</div>
