@props([
    'orientation' => 'vertical',
])

<x-mog::separator
    :attributes="$attributes->cn('bg-input relative !m-0 self-stretch data-[orientation=vertical]:h-auto')"
    :orientation="$orientation"
    data-slot="button-group-separator">
    {{ $slot }}
</x-mog::separator>
