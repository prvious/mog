@props([
    'ratio' => 1 / 1,
])

{{-- paddingBottom: `${100 / ratio}%` --}}
<div
    {{ $attributes->twMerge('relative w-full') }}
    :style="{'padding-bottom': `${100 / {{ (float) $ratio }} }%`}">
    <div class="absolute top-0 right-0 bottom-0 left-0">
        {{ $slot }}
    </div>
</div>
