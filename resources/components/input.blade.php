@props([
    'type' => 'text',
    'invalid' => false,
    'autoWireInvalid' => true,
    'size' => 'md',
])

@php
    if($attributes->has('wire:model') && $autoWireInvalid) {
        $invalid = $errors->has($attributes->get('wire:model'));
    }
    
    $size = match ($size) {
        'xs' => 'px-2 py-0.5',
        'sm' => 'px-2.5 py-1',
        default => 'px-3 py-1.5',
        'xl' => 'px-3.5 py-2',
    };
@endphp

<input
    type="{{ $type }}"
    data-slot="input"
    {{ when($invalid, 'aria-invalid=true') }}
    {{
        $attributes->twMerge(
            'file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
            'read-only:pointer-events-none read-only:cursor-not-allowed read-only:opacity-50',
            'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
            'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
            $size
        )
    }} />
