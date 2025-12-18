@props([
    'size' => 'default',
    'align' => 'center',
    'placeholder' => null,
    'options' => [],
    'content',
])

<div
    x-data="{
        open: false,
        close(focusAfter) {
            if (! this.open) return

            this.open = false

            focusAfter && focusAfter.focus()
        },
    }"
    data-slot="select"
    class="contents"
    x-id="['select-button']"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.selectContent.contains($event.target) && close()">
    <button
        type="button"
        data-slot="select-trigger"
        data-size="{{ $size }}"
        x-ref="trigger"
        :state="open ? 'open' : 'closed'"
        :aria-expanded="open"
        :aria-controls="$id('select-button')"
        x-on:click="open = !open"
        class="border-input data-[placeholder]:text-muted-foreground [&_svg:not([class*='text-'])]:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 dark:hover:bg-input/50 shadow-xs flex items-center justify-between gap-2 whitespace-nowrap rounded-md border bg-transparent px-3 py-2 text-sm outline-none transition-[color,box-shadow] focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 data-[size=default]:h-9 data-[size=sm]:h-8 *:data-[slot=select-value]:line-clamp-1 *:data-[slot=select-value]:flex *:data-[slot=select-value]:items-center *:data-[slot=select-value]:gap-2 [&_svg:not([class*='size-'])]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0">
        <span
            data-slot="select-value"
            class="pointer-none">
            {{ $placeholder ?? '' }}
        </span>

        {{ svg('mog-chevron-up', 'rotate-180 size-4 opacity-50', ['data-slot' => 'select-icon', ':data-' => '{ "rotate-180": open }']) }}
    </button>

    <div
        {{
            $attributes->twMerge(
                'z-50 bg-popover text-popover-foreground rounded-md border shadow-md relative min-w-[8rem] overflow-y-auto overflow-x-hidden p-1 flex flex-col outline-none',
            )
        }}
        x-cloak
        x-show="open"
        x-trap="open"
        x-ref="selectContent"
        :id="$id('select-button')"
        x-on:click.outside="close($refs.button)"
        x-anchor.{{ $align }}.offset.5="$refs.trigger"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="scale-95 transform opacity-0"
        x-transition:enter-end="scale-100 transform opacity-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="scale-100 transform opacity-100"
        x-transition:leave-end="scale-95 transform opacity-0"
        role="listbox">
        @foreach ($options as $option)
            <div
                role="option"
                data-slot="select-item"
                x-data="{
                    data: @js($option->attributes->get('value') ?? (string) $option),
                }"
                {{
                    $option->attributes->twMerge(
                        "group/select-item focus:bg-accent hover:bg-accent hover:text-accent-foreground focus:text-accent-foreground [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm py-1.5 pr-8 pl-2 text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 *:[span]:last:flex *:[span]:last:items-center *:[span]:last:gap-2",
                    )
                }}>
                <span>
                    @if ($option->isNotEmpty())
                        {{ $option }}
                    @else
                        {{ $option->attributes->get('value') }}
                    @endif
                </span>
                <span
                    data-slot="select-item-indicator"
                    class="absolute right-2 flex size-3.5 items-center justify-center">
                    <span class="hidden group-data-[selected=true]/select-item:block">
                        @svg('lucide-check', 'size-4')
                    </span>
                </span>
            </div>
        @endforeach
    </div>
</div>
