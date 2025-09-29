@props([
    'position' => 'bottom-right',
    'maxToasts' => 5,
])

@php
    $positionClasses = match ($position) {
        'top-left' => 'left-4 top-4',
        'top-center' => 'left-1/2 top-4 -translate-x-1/2',
        'top-right' => 'right-4 top-4',
        'bottom-left' => 'bottom-4 left-4',
        'bottom-center' => 'bottom-4 left-1/2 -translate-x-1/2',
        'bottom-right' => 'bottom-4 right-4',
        default => 'bottom-4 right-4',
    };
@endphp

<div
    x-data="{
        get toasts() {
            return $toast.toasts
        },
    }"
    x-show="toasts.length > 0"
    {{ $attributes->twMerge('pointer-events-none fixed z-[100] flex max-h-screen w-full flex-col-reverse space-y-4 space-y-reverse p-4 sm:max-w-[420px]', $positionClasses) }}>
    <template
        x-for="(toast, index) in toasts.slice(0, {{ $maxToasts }})"
        :key="toast.id">
        <div
            x-data="{ toast }"
            :style="`transform: translateY(${Math.max(0, (toasts.length - 1 - index) * -8)}px) scale(${1 - Math.max(0, (toasts.length - 1 - index) * 0.05)}); z-index: ${toasts.length - index};`"
            class="transition-all duration-200 ease-out">
            <x-mog::toast />
        </div>
    </template>

    <!-- Show count if there are more toasts than maxToasts -->
    <div
        x-show="toasts.length > {{ $maxToasts }}"
        x-transition
        class="bg-popover text-popover-foreground border-border pointer-events-auto rounded-md px-3 py-2 text-center text-sm shadow-lg">
        <span x-text="`${toasts.length - {{ $maxToasts }}} more toast${toasts.length - {{ $maxToasts }} === 1 ? '' : 's'}`"></span>
        <button
            type="button"
            x-on:click="$toast.dismissAll()"
            class="ml-2 text-xs underline hover:no-underline">
            Dismiss all
        </button>
    </div>
</div>
