@php
    $attributes = $attributes
        ->cn('flex-1 rounded-none border-0 bg-transparent shadow-none focus-visible:ring-0 dark:bg-transparent')
        ->merge([
            'data-slot' => 'input-group-control',
        ]);
@endphp

<x-mog::input :attributes="$attributes" />
