@props([
    'invalid' => false,
    'autoWireInvalid' => true,
])

@php
    if ($attributes->has('wire:model') && $autoWireInvalid) {
        $invalid = $errors->has($attributes->get('wire:model'));
    }
@endphp

<div
    class="group/native-select relative has-[select:disabled]:opacity-50"
    data-slot="native-select-wrapper">
    <select
        data-slot="native-select"
        {{ when($invalid === true, 'aria-invalid=true') }}
        {{
            $attributes->twMerge(
                'border-input placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 dark:hover:bg-input/50 h-9 w-full min-w-0 appearance-none rounded-md border bg-transparent px-3 py-2 pr-9 text-sm shadow-xs transition-[color,box-shadow] outline-none disabled:pointer-events-none disabled:cursor-not-allowed',
                'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
            )
        }}>
        {{ $slot }}
    </select>
    {{ svg('mog-chevron-up', 'rotate-180 text-muted-foreground pointer-events-none absolute right-3.5 top-1/2 size-4 -translate-y-1/2 select-none opacity-50', ['aria-hidden' => 'true', 'data-slot' => 'native-select-icon']) }}
</div>
