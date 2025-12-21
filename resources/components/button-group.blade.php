@props([
    'orientation' => 'horizontal',
])

@php
    $orientationClasses = match ($orientation) {
        'vertical' => 'flex-col [&>*:not(:first-child)]:rounded-t-none [&>*:not(:first-child)]:border-t-0 [&>*:not(:last-child)]:rounded-b-none',
        default => '[&>*:not(:first-child)]:rounded-l-none [&>*:not(:first-child)]:border-l-0 [&>*:not(:last-child)]:rounded-r-none',
    };
@endphp

<div
    role="group"
    data-slot="button-group"
    data-orientation="{{ $orientation }}"
    {{
        $attributes->cn(
            "flex w-fit items-stretch [&>*]:focus-visible:z-10 [&>*]:focus-visible:relative [&>[data-slot=select-trigger]:not([class*='w-'])]:w-fit [&>input]:flex-1 has-[select[aria-hidden=true]:last-child]:[&>[data-slot=select-trigger]:last-of-type]:rounded-r-md has-[>[data-slot=button-group]]:gap-2",
            $orientationClasses,
        )
    }}>
    {{ $slot }}
</div>
