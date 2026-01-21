@props([
    'icon' => 'lucide:loader-circle',
])

@svg($icon, $attributes->cn('flex size-4 animate-spin items-center justify-center')->merge(['role' => 'status', 'aria-label' => 'Loading'])->all())
