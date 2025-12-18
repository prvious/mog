@props([
    'orientation' => 'vertical',
])

@php
    $orientationClasses = match ($orientation) {
        'vertical' => 'flex-col [&>*]:w-full [&>.sr-only]:w-auto',
        'horizontal' => [
            'flex-row items-center',
            '[&>[data-slot=field-label]]:flex-auto',
            'has-[>[data-slot=field-content]]:[&>[role=checkbox],[role=radio]]:mt-px has-[>[data-slot=field-content]]:items-start',
        ],
        'responsive' => [
            '@md/field-group:flex-row @md/field-group:items-center @md/field-group:[&>*]:w-auto flex-col [&>*]:w-full [&>.sr-only]:w-auto',
            '@md/field-group:[&>[data-slot=field-label]]:flex-auto',
            '@md/field-group:has-[>[data-slot=field-content]]:items-start @md/field-group:has-[>[data-slot=field-content]]:[&>[role=checkbox],[role=radio]]:mt-px',
        ]
    };
@endphp

<div
    role="group"
    data-slot="field"
    data-orientation="{{ $orientation }}"
    {{ $attributes->cn('group/field flex w-full gap-3 data-[invalid=true]:text-destructive', $orientationClasses) }}>
    {{ $slot }}
</div>
