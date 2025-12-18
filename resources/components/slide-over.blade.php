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
        'right' => 'inset-y-0 right-0 h-full w-3/4 border-l sm:max-w-sm',
        'left' => 'inset-y-0 left-0 h-full w-3/4 border-r sm:max-w-sm',
        'top' => 'inset-x-0 top-0 h-auto border-b',
        'bottom' => 'inset-x-0 bottom-0 h-auto border-t',
    };

    $transition = match ($side) {
        'right' => ['enter' => 'data-[state=open]:slide-in-from-right', 'leave' => 'data-[state=closed]:slide-out-to-right'],
        'left' => ['enter' => 'data-[state=open]:slide-in-from-left', 'leave' => 'data-[state=closed]:slide-out-to-left'],
        'top' => ['enter' => 'data-[state=open]:slide-in-from-top', 'leave' => 'data-[state=closed]:slide-out-to-top'],
        'bottom' => ['enter' => 'data-[state=open]:slide-in-from-bottom', 'leave' => 'data-[state=closed]:slide-out-to-bottom'],
    };

    if (isset($trigger)) {
        $trigger->attributes = $trigger->attributes->cn('h-max w-max');
    }

    $x_model = $attributes->get('x-model') ?? null;
@endphp

<div
    :id="id"
    x-data="{
        id: $id('dialog'),
        slideOver: @js($open),
    }"
    x-init="
        $watch('slideOver', (value) => {
            if (value) {
                $mog.dialog.open(id)
            } else {
                $mog.dialog.close(id)
            }
        })
    "
    x-modelable="slideOver"
    x-on:mog::dialog-open.document="
        if ($event.detail.id === id) {
            slideOver = true
        }
    "
    x-on:mog::dialog-close.document="
        if ($event.detail.id === id) {
            slideOver = false
        }
    "
    @if(filled($x_model)) x-model="{{ $x_model }}" @endif>
    <div {{ $trigger->attributes->merge(['x-on:click' => '$mog.dialog.open(id)']) }}>
        {{ $trigger }}
    </div>

    <template x-teleport="#mog-dialog-container">
        <div
            x-show="slideOver"
            :data-state="slideOver ? 'open' : 'closed'"
            x-transition:enter="{{ $transition['enter'] }}"
            x-transition:leave="{{ $transition['leave'] }}"
            {{ $attributes->cn('bg-background data-[state=open]:animate-in data-[state=closed]:animate-out fixed z-50 flex flex-col gap-4 shadow-lg ease-in-out data-[state=closed]:duration-350 data-[state=open]:duration-350 data-[state=closed]:opacity-0', $defaultClasses) }}>
            <div {{ $header->attributes->cn('flex flex-col gap-1.5 p-4') }}>
                @if ($title->hasActualContent())
                    <div {{ $title->attributes->cn('text-foreground font-semibold') }}>
                        {{ $title }}
                    </div>
                @endif

                @if ($description->hasActualContent())
                    <div {{ $description->attributes->cn('text-muted-foreground text-sm') }}>
                        {{ $description }}
                    </div>
                @endif
            </div>

            @if ($content->hasActualContent())
                <div>
                    {{ $content }}
                </div>
            @endif

            <div {{ $footer->attributes->cn('mt-auto flex flex-col gap-2 p-4') }}>
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
