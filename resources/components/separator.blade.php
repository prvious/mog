@props([
    'orientation' => 'horizontal',
    'decorative' => true,
])

<div
    {{ $attributes->twMerge('bg-border my-2 shrink-0 data-[orientation=horizontal]:h-px data-[orientation=vertical]:h-full data-[orientation=horizontal]:w-full data-[orientation=vertical]:w-px') }}
    data-orientation="{{ $orientation }}"></div>
