@props([
    'checked' => false,
    'disabled' => false,
])

<button
    x-data="{
        value: @js($checked),
        toggle() {
            this.value = ! this.value
        },
    }"
    x-on:click="toggle()"
    :data-state="value ? 'checked' : 'unchecked'"
    x-modelable="value"
    role="checkbox"
    type="button"
    @disabled($disabled)
    {{ $attributes->twMerge('peer focus-visible:ring-ring focus-visible:ring-offset-background data-[state=checked]:bg-primary data-[state=unchecked]:bg-input inline-flex h-5 w-9 shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent shadow-sm transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50') }}>
    <span
        :data-state="value ? 'checked' : 'unchecked'"
        class="bg-background pointer-events-none block h-4 w-4 rounded-full shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-4 data-[state=unchecked]:translate-x-0"></span>
    <input
        type="checkbox"
        aria-hidden
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->whereDoesntStartWith(['wire', 'x-', 'class'])->merge(['x-model' => 'value']) }}
        class="pointer-events-none absolute m-0 opacity-0" />
</button>
