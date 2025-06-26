@use(Illuminate\View\ComponentSlot)

@props([
    'trigger',
    'header' => app(ComponentSlot::class),
    'title',
    'content',
    'footer' => app(ComponentSlot::class),
    'action',
    'cancel',
    'open' => false,
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
@endphp

<div
    x-data="{
        dialog: @js($open),
        open() {
            this.dialog = true
        },
        close() {
            this.dialog = false
        },
        toggle() {
            this.dialog = ! this.dialog
        },
    }"
    x-effect="
        dialog
            ? document.body.setAttribute('data-scroll-locked', 'true')
            : document.body.removeAttribute('data-scroll-locked')
    ">
    <div {{ $trigger->attributes->merge(['x-on:click' => 'open()']) }}>
        {{ $trigger }}
    </div>
    <x-mog::overlay x-model="dialog" />
    <div
        x-show="dialog"
        :data-state="dialog ? 'open' : 'closed'"
        class="bg-background data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[state=closed]:slide-out-to-left-1/2 data-[state=closed]:slide-out-to-top-[48%] data-[state=open]:slide-in-from-left-1/2 data-[state=open]:slide-in-from-top-[48%] fixed top-[50%] left-[50%] z-50 grid w-full max-w-lg translate-x-[-50%] translate-y-[-50%] gap-4 border p-6 shadow-lg duration-200 sm:rounded-lg">
        <div {{ $header->attributes->twMerge('flex flex-col gap-2 text-center sm:text-left') }}>
            <div {{ $title->attributes->twMerge('text-lg font-semibold') }}>
                {{ $title }}
            </div>
            <div {{ $content->attributes->twMerge('text-sm text-muted-foreground') }}>
                {{ $content }}
            </div>
        </div>

        <div
            {{ $footer->attributes->twMerge('flex flex-col-reverse items-center sm:[align-items:unset] sm:flex-row sm:justify-end gap-2') }}>
            @foreach ($orderedButtons as $name)
                {{ $$name }}
            @endforeach
        </div>
    </div>
</div>

@php
    unset($keys, $actionIndex, $cancelIndex, $orderedButtons);
@endphp
