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
    'size' => 'lg',
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

    $size = match ($size) {
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        'full' => 'w-full',
        'screen' => 'w-screen',
        'fit' => 'max-w-fit',
        default => 'max-w-lg',
    };
@endphp

<div
    :id="id"
    x-data="{
        id: $id('dialog'),
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

        if (dialog) $store.dialog.add(id)
        else $store.dialog.remove(id)
    "
    x-on:close-dialog.window="
        if ($store.dialog.isTop(id)) close()
    ">
    <div {{ $trigger->attributes->merge(['x-on:click' => 'open()']) }}>
        {{ $trigger }}
    </div>

    <template x-teleport="body">
        <div
            x-show="dialog"
            x-transition:enter="transition-all ease-out"
            x-transition:enter-start="translate-x-[-50%] translate-y-[-60%] scale-95 opacity-0"
            x-transition:enter-end="translate-x-[-50%] translate-y-[-50%] scale-100 opacity-100"
            x-transition:leave="transition-all ease-in"
            x-transition:leave-start="translate-x-[-50%] translate-y-[-50%] scale-100 opacity-100"
            x-transition:leave-end="translate-x-[-50%] translate-y-[-60%] scale-95 opacity-0"
            x-bind:class="{
                'z-49': ! $store.dialog.isTop(id),
                'z-51': $store.dialog.isTop(id),
            }"
            {{ $attributes->twMerge('fixed left-[50%] top-[45%] flex flex-col w-full translate-x-[-50%] translate-y-[-50%] gap-4 border bg-background p-4 sm:rounded-lg ring-4 ring-neutral-800/55', $size) }}>
            <div {{ $header->attributes->twMerge('flex flex-col gap-2 text-center sm:text-left') }}>
                <div {{ $title->attributes->twMerge('text-lg font-semibold') }}>
                    {{ $title }}
                </div>
                <div
                    {{ $content->attributes->twMerge('text-sm px-3') }}
                    x-trap="dialog">
                    {{ $content }}
                </div>
            </div>

            <div {{ $footer->attributes->twMerge('flex flex-col-reverse items-center sm:[align-items:unset] sm:flex-row sm:justify-end gap-2') }}>
                @foreach ($orderedButtons as $name)
                    {{ $$name }}
                @endforeach
            </div>
        </div>
    </template>
</div>

@php
    unset($keys, $actionIndex, $cancelIndex, $orderedButtons);
@endphp
