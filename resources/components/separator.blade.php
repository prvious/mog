@props([
    'orientation' => 'horizontal',
])

@php
    $attributes = $attributes
        ->twMerge('bg-border shrink-0 data-[orientation=horizontal]:h-px data-[orientation=horizontal]:w-full data-[orientation=vertical]:h-full data-[orientation=vertical]:w-px')
        ->merge([
            'role' => 'none',
            'data-orientation' => $orientation,
            'data-slot' => 'separator',
        ]);
@endphp

<div {{ $attributes }}></div>
