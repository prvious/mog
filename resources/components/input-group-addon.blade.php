@props([
    'align' => 'inline-start',
])

@php
    $alignClass = match ($align) {
        'inline-start' => 'order-first pl-3 has-[>[data-ignore]>[data-ignore-trigger]>button]:ml-[-0.45rem] has-[>[data-ignore]>[data-ignore-trigger]>kbd]:ml-[-0.35rem] has-[>button]:ml-[-0.45rem] has-[>kbd]:ml-[-0.35rem]',
        'inline-end' => 'order-last pr-3 has-[>[data-ignore]>[data-ignore-trigger]>button]:mr-[-0.45rem] has-[>[data-ignore]>[data-ignore-trigger]>kbd]:mr-[-0.35rem] has-[>button]:mr-[-0.45rem] has-[>kbd]:mr-[-0.35rem]',
        'block-start' => '[.border-b]:pb-3 order-first w-full justify-start px-3 pt-3 group-has-[>[data-ignore]>[data-ignore-trigger]>input]/input-group:pt-2.5 group-has-[>input]/input-group:pt-2.5',
        'block-end' => '[.border-t]:pt-3 order-last w-full justify-start px-3 pb-3 group-has-[>[data-ignore]>[data-ignore-trigger]>input]/input-group:pb-2.5 group-has-[>input]/input-group:pb-2.5',
    };
@endphp

<div
    role="group"
    data-slot="input-group-addon"
    data-align="{{ $align }}"
    x-on:click="
        if ($event.target.closest('button')) return
        $event.currentTarget.parentElement?.querySelector('input')?.focus()
    "
    {{
        $attributes->cn(
            "text-muted-foreground flex h-auto cursor-text items-center justify-center gap-2 py-1.5 text-sm font-medium select-none [&>svg:not([class*='size-'])]:size-4 [&>kbd]:rounded-[calc(var(--radius)-5px)] group-data-[disabled=true]/input-group:opacity-50",
            $alignClass,
        )
    }}>
    {{ $slot }}
</div>
