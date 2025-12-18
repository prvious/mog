@php
    $attributes = $attributes
        ->merge(['data-slot' => 'item-footer'])
        ->cn('flex basis-full items-center justify-between gap-2');
@endphp

<div {{ $attributes }}>
    {{ $slot }}
</div>
