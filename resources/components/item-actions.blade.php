@php
    $attributes = $attributes
        ->merge(['data-slot' => 'item-actions'])
        ->twMerge('flex items-center gap-2');
@endphp

<div {{ $attributes }}>
    {{ $slot }}
</div>
