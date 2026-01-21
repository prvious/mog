@props([
    'trigger',
    'open' => false,
    'collapsible' => true,
    'content',
])

@aware(['collapsible'])

@php
    if ($collapsible === false) {
        $open = true;
    }
@endphp

<div
    data-ignore
    data-slot="accordion"
    x-data="{
        open: @js($open),
    }"
    x-modelable="open"
    {{ $attributes->cn('border-b group')->merge(['x-bind:data-state' => "open ? 'open' : 'closed'"]) }}>
    <button
        data-ignore-trigger
        {{
            $trigger->attributes
                ->merge(['data-slot' => 'accordion-trigger', 'type' => 'button'])
                ->when($collapsible !== false, fn ($attr) => $attr->merge(['x-on:click' => 'open = !open']))
                ->cn('flex flex-1 items-center justify-between py-4 text-left text-sm font-medium transition-[rotate] hover:underline group-data-[state=closed]:[&>svg]:rotate-180 [&>svg]:transition-[rotate] [&>svg]:duration-200')
        }}>
        {{ $trigger }}
        {{ svg('lucide:chevron-up', 'text-muted-foreground h-4 w-4 shrink-0') }}
    </button>

    <div
        {{ $content->attributes->cn('grid group-data-[state=closed]:grid-rows-[0fr] transition-[grid-template-rows] ease-in-out duration-200 group-data-[state=open]:grid-rows-[1fr] overflow-hidden text-sm') }}>
        <div class="overflow-hidden pb-4 pt-0">
            {{ $content }}
        </div>
    </div>
</div>
