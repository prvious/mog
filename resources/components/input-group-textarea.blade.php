@php
    $attributes = $attributes
        ->cn('flex-1 resize-none rounded-none border-0 bg-transparent py-3 shadow-none focus-visible:ring-0 dark:bg-transparent')
        ->merge([
            'data-slot' => 'input-group-control',
        ]);
@endphp

<x-mog::textarea :attributes="$attributes" />
