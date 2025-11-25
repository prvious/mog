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
    role="checkbox"
    type="button"
    @checked($checked)
    @disabled($disabled)
    {{ $attributes->twMerge('peer relative h-4 w-4 shrink-0 rounded-xs border border-primary shadow focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 text-transparent data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground') }}>
    <span
        @disabled($disabled)
        :data-state="value ? 'checked' : 'unchecked'"
        class="pointer-events-none flex items-center justify-center text-current">
        @svg('mog-check', 'h-4 w-4')
    </span>

    <input
        type="checkbox"
        aria-hidden
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->whereDoesntStartWith(['wire', 'x-', 'class'])->merge(['x-model' => 'value']) }}
        class="pointer-events-none absolute inset-0 m-0 opacity-0" />
</button>
