@use(Illuminate\View\ComponentSlot)

@props([
    'content' => app(ComponentSlot::class),
    'trigger' => app(ComponentSlot::class),
    'align' => 'center',
])

@php
@endphp

<div
    x-cloak
    x-data="{
        open: false,
        position: { top: 0, left: 0, transform: '', isFlipped: false },
        positionPopover() {
            const trigger = $refs.trigger.firstElementChild || $refs.trigger
            const rect = trigger.getBoundingClientRect()
            const align = '{{ $align }}'
            const popover = $refs.content

            // Get popover dimensions (estimate if not visible)
            const popoverWidth = popover?.offsetWidth || 288 // w-72 = 18rem = 288px
            const popoverHeight = popover?.offsetHeight || 200 // estimate

            let leftPos = rect.left
            let topPos = rect.bottom
            let transform = ''
            let isFlipped = false

            // Calculate horizontal alignment
            if (align === 'center') {
                leftPos = rect.left + rect.width / 2
                transform = 'translateX(-50%)'

                // Check if popover would overflow viewport horizontally
                const popoverLeft = leftPos - popoverWidth / 2
                const popoverRight = leftPos + popoverWidth / 2

                if (popoverLeft < 0) {
                    // Would overflow left, align to left edge
                    leftPos = rect.left
                    transform = ''
                } else if (popoverRight > window.innerWidth) {
                    // Would overflow right, align to right edge
                    leftPos = rect.right
                    transform = 'translateX(-100%)'
                }
            } else if (align === 'left') {
                leftPos = rect.left
                transform = ''

                // Check if would overflow right
                if (leftPos + popoverWidth > window.innerWidth) {
                    leftPos = rect.right
                    transform = 'translateX(-100%)'
                }
            } else if (align === 'right') {
                leftPos = rect.right
                transform = 'translateX(-100%)'

                // Check if would overflow left
                if (leftPos - popoverWidth < 0) {
                    leftPos = rect.left
                    transform = ''
                }
            }

            // Check vertical space and flip if needed
            const spaceBelow = window.innerHeight - rect.bottom
            const spaceAbove = rect.top

            if (spaceBelow < popoverHeight && spaceAbove > spaceBelow) {
                topPos = rect.top - popoverHeight
                isFlipped = true
            } else {
                topPos = rect.bottom
                isFlipped = false
            }

            this.position = {
                top: topPos,
                left: leftPos,
                transform: transform,
                isFlipped: isFlipped,
            }
        },
    }"
    x-on:scroll.window="open && positionPopover()"
    x-on:click.outside="! $refs.content?.contains($event.target) ? (open = false) : null"
    x-on:keydown.escape.window="open = false"
    x-on:click="
        positionPopover()
        open = ! open
    "
    x-bind:data-state="open ? 'open' : 'closed'"
    :id="$id('popover')"
    data-slot="popover"
    {{ $attributes->twMerge('relative group') }}>
    <div
        {{ $trigger->attributes }}
        x-ref="trigger">
        {{ $trigger }}
    </div>

    <template x-teleport="body">
        <div
            x-ref="content"
            x-show="open"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="scale-95 opacity-0"
            x-transition:enter-end="scale-100 opacity-100"
            x-transition:leave="transition duration-75 ease-in"
            x-transition:leave-start="scale-100 opacity-100"
            x-transition:leave-end="scale-95 opacity-0"
            x-bind:style="`--top: ${position.top}px; --left: ${position.left}px; --transform: ${position.transform}; --margin-top: calc(var(--spacing) * ${position.isFlipped ? -4 : 4});`"
            {{
                $content->attributes->twMerge(
                    'top-(--top) left-(--left) transform-(--transform) mt-(--margin-top) fixed z-50',
                    'bg-popover text-popover-foreground',
                    'rounded-md border p-4 shadow-md outline-none w-72',
                )
            }}>
            {{ $content }}
        </div>
    </template>
</div>
