@props([
    'trigger',
    'content',

    'items' => [],
])

<div
    x-data="{
        open: false,
        close() {
            if (! this.open) return

            this.open = false
        },
    }"
    {{ $attributes->merge(['data-slot' => 'dropdown-menu'])->cn('contents') }}>
    <div
        x-ref="trigger"
        {{
            $trigger->attributes
                ->merge([
                    'data-slot' => 'dropdown-menu-trigger',
                    'x-on:click' => 'open = !open',
                ])
                ->cn('contents')
        }}>
        {{ $trigger }}
    </div>

    <div
        x-cloak
        x-show="open"
        x-on:click.away="close()"
        x-on:keydown.escape="close()"
        x-bind:data-state="open ? 'open' : 'closed'"
        x-anchor.{{ $content->attributes->get('align', 'top') }}.offset.{{ $content->attributes->get('offset', 4) }}="$refs.trigger"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="scale-95 transform opacity-0"
        x-transition:enter-end="scale-100 transform opacity-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="scale-100 transform opacity-100"
        x-transition:leave-end="scale-95 transform opacity-0"
        {{
            $content->attributes
                ->merge([
                    'data-slot' => 'dropdown-menu-content',
                    'data-side' => explode('-', $content->attributes->get('align', 'top'))[0],
                    'data-align' => explode('-', $content->attributes->get('align', 'top'))[1] ?? 'center',
                    'role' => 'menu',
                ])
                ->cn('bg-popover text-popover-foreground data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 z-50  min-w-[8rem] overflow-x-hidden overflow-y-auto rounded-md border p-1 shadow-md')
        }}>
        @foreach ($items as $index => $item)
            @php
                $tag = $item->attributes->get('type') === 'link' ? 'a' : 'div';
            @endphp

            <{{ $tag }}
                {{
                    $item->attributes
                        ->merge(
                            match ($attributes->get('type', 'item')) {
                                'item' => [
                                    'data-slot' => 'dropdown-menu-item',
                                    'role' => 'menuitem',
                                    'data-inset' => $attributes->has('inset'),
                                    'data-variant' => $attributes->get('variant', 'default'),
                                    'x-on:click' => 'close()',
                                ],
                                'link' => [
                                    'data-slot' => 'dropdown-menu-link',
                                    'role' => 'menuitem',
                                    'data-inset' => $attributes->has('inset'),
                                    'data-variant' => $attributes->get('variant', 'default'),
                                ],
                                'label' => [
                                    'data-slot' => 'dropdown-menu-label',
                                    'data-inset' => $attributes->has('inset'),
                                ],
                                'separator' => [
                                    'data-slot' => 'dropdown-menu-separator',
                                ],
                                // 'shortcut' => [
                                //     'data-slot' => 'dropdown-menu-shortcut',
                                // ],
                            }
                        )
                        ->cn(
                            match ($attributes->get('type', 'item')) {
                                'item','link' => "focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground data-[variant=destructive]:text-destructive data-[variant=destructive]:focus:bg-destructive/10 data-[variant=destructive]:hover:bg-destructive/10 dark:data-[variant=destructive]:focus:bg-destructive/20 dark:data-[variant=destructive]:hover:bg-destructive/20 data-[variant=destructive]:focus:text-destructive data-[variant=destructive]:hover:text-destructive data-[variant=destructive]:*:[svg]:!text-destructive [&_svg:not([class*='text-'])]:text-muted-foreground relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 data-[inset]:pl-8 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4",

                                'label' => 'px-2 py-1.5 text-sm font-medium data-[inset]:pl-8',

                                'separator' => 'bg-border -mx-1 my-1 h-px',

                                // 'shortcut' => 'text-muted-foreground ml-auto text-xs tracking-widest',
                            }
                        )
                }}>
                {{ $item }}
            </{{ $tag }}>
        @endforeach
    </div>
</div>
