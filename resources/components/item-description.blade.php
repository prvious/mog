@php
    $attributes = $attributes
        ->merge(['data-slot' => 'item-description'])
        ->twMerge(
            'text-muted-foreground line-clamp-2 text-sm leading-normal font-normal text-balance',
            '[&>a:hover]:text-primary [&>a]:underline [&>a]:underline-offset-4',
        );
@endphp

<p {{ $attributes }}>
    {{ $slot }}
</p>
