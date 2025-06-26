@use(Illuminate\View\ComponentSlot)

@props([
    'trigger',
    'header' => app(ComponentSlot::class),
    'title' => app(ComponentSlot::class),
    'description' => app(ComponentSlot::class),
    'content' => app(ComponentSlot::class),
    'footer' => app(ComponentSlot::class),
    'action',
    'cancel',
    'open' => false,
    'side' => 'right',
])

@php
    $keys = array_keys($__laravel_slots);

    $actionIndex = array_search('action', $keys);
    $cancelIndex = array_search('cancel', $keys);

    $orderedButtons = [];

    if (in_array('action', $keys)) {
        $orderedButtons[] = 'action';
    }

    if (in_array('cancel', $keys)) {
        $orderedButtons[] = 'cancel';
    }

    if (count($orderedButtons) === 2) {
        // Sort based on appearance in the original key order
        usort($orderedButtons, fn ($a, $b) => array_search($a, $keys) <=> array_search($b, $keys));
    }

    $defaultClasses = match ($side) {
        'right' => 'data-[state=closed]:slide-out-to-right data-[state=open]:slide-in-from-right inset-y-0 right-0 h-full w-3/4 border-l sm:max-w-sm',
        'left' => 'data-[state=closed]:slide-out-to-left data-[state=open]:slide-in-from-left inset-y-0 left-0 h-full w-3/4 border-r sm:max-w-sm',
        'top' => 'data-[state=closed]:slide-out-to-top data-[state=open]:slide-in-from-top inset-x-0 top-0 h-auto border-b',
        'bottom' => 'data-[state=closed]:slide-out-to-bottom data-[state=open]:slide-in-from-bottom inset-x-0 bottom-0 h-auto border-t',
    };
@endphp

<div
    x-cloak
    x-data="{
        slideOver: @js($open),
        open() {
            this.slideOver = true
        },
        close() {
            this.slideOver = false
        },
        toggle() {
            this.slideOver = ! this.slideOver
        },
    }"
    x-effect="
        slideOver
            ? document.body.setAttribute('data-scroll-locked', 'true')
            : document.body.removeAttribute('data-scroll-locked')
    ">
    <div {{ $trigger->attributes->merge(['x-on:click' => 'open()']) }}>
        {{ $trigger }}
    </div>

    <x-mog::overlay
        x-model="slideOver"
        x-on:click="close()"
        class="bg-black/50" />

    <div
        x-show="slideOver"
        :data-state="slideOver ? 'open' : 'closed'"
        {{ $attributes->twMerge('bg-background data-[state=open]:animate-in data-[state=closed]:animate-out fixed z-50 flex flex-col gap-4 shadow-lg transition ease-in-out data-[state=closed]:duration-300 data-[state=open]:duration-500', $defaultClasses) }}>
        <div {{ $header->attributes->twMerge('flex flex-col gap-1.5 p-4') }}>
            @if ($title->hasActualContent())
                <div {{ $title->attributes->twMerge('text-foreground font-semibold') }}>
                    {{ $title }}
                </div>
            @endif

            @if ($description->hasActualContent())
                <div {{ $description->attributes->twMerge('text-muted-foreground text-sm') }}>
                    {{ $description }}
                </div>
            @endif
        </div>

        @if ($content->hasActualContent())
            <div>
                {{ $content }}
            </div>
        @endif

        <div {{ $footer->attributes->twMerge('mt-auto flex flex-col gap-2 p-4') }}>
            @foreach ($orderedButtons as $name)
                {{ $$name }}
            @endforeach
        </div>
    </div>
</div>

@php
    unset($keys, $actionIndex, $cancelIndex, $orderedButtons);
@endphp
