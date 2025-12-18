@props([
    'checked' => false,
    'disabled' => false,
])
<button
    x-data="{
        value: @js($checked),
    }"
    x-on:click="value = !value"
    x-modelable="value"
    :data-state="value ? 'checked' : 'unchecked'"
    data-slot="checkbox"
    role="checkbox"
    type="button"
    @checked($checked)
    @disabled($disabled)
    {{
        $attributes->cn(
            'peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground dark:data-[state=checked]:bg-primary data-[state=checked]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50',
        )
    }}>
    <span
        @disabled($disabled)
        :data-state="value ? 'checked' : 'unchecked'"
        data-slot="checkbox-indicator"
        class="grid place-content-center text-current transition-none">
        @svg('mog-check', 'size-3.5')
    </span>

    <input
        type="checkbox"
        aria-hidden
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->whereDoesntStartWith(['wire', 'x-', 'class'])->merge(['x-model' => 'value']) }}
        class="pointer-events-none absolute inset-0 m-0 opacity-0" />
</button>
