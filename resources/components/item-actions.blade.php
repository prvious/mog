@php
    $attributes = $attributes
        ->merge(['data-slot' => 'item-actions'])
        ->cn('flex items-center gap-2');
@endphp

<div {{ $attributes }}>
    {{ $slot }}
</div>
