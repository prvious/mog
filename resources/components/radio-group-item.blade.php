<button
    type="button"
    role="radio"
    data-slot="radio-group-item"
    x-data="{
        radio_group_item_value: @js($attributes->get('value')),
    }"
    x-on:click="select(radio_group_item_value)"
    x-bind:aria-checked="String(radio_group_selected === radio_group_item_value)"
    x-bind:data-checked="String(radio_group_selected === radio_group_item_value)"
    x-bind:data-state="radio_group_selected === radio_group_item_value ? 'checked' : 'unchecked'"
    {{
        $attributes
            ->cn('border-input text-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 shadow-xs aspect-square size-4 shrink-0 rounded-full border outline-none transition-[color,box-shadow] focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50')
    }}
    tabindex="0">
    <template x-if="radio_group_selected === radio_group_item_value">
        <span
            data-state="checked"
            data-slot="radio-group-indicator"
            class="relative flex items-center justify-center">
            @svg('lucide-circle', 'fill-primary absolute left-1/2 top-1/2 size-2 -translate-x-1/2 -translate-y-1/2')
        </span>
    </template>
</button>
