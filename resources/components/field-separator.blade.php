<div
    data-slot="field-separator"
    data-content="@js($slot->isNotEmpty())"
    {{ $attributes->cn('relative -my-2 h-5 text-sm group-data-[variant=outline]/field-group:-mb-2') }}>
    <x-mog::separator class="absolute inset-0 top-1/2" />
    @if ($slot->isNotEmpty())
        <span
            data-slot="field-separator-content"
            class="bg-background text-muted-foreground relative mx-auto block w-fit px-2">
            {{ $slot }}
        </span>
    @endif
</div>
