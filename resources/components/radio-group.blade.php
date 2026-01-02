<div
    data-slot="radio-group"
    x-modelable="radio_group_selected"
    x-data="{
        radio_group_selected: @js($attributes->get('value', null)),

        select(item) {
            this.radio_group_selected = item
        },
    }"
    {{
        $attributes
            ->cn('grid gap-3')
            ->merge([
                'role' => 'radiogroup',
                'tabindex' => '0',
                'style' => 'outline: none;',
                'aria-required' => (string) $attributes->has('required'),
                'data-disabled' => $attributes->has('disabled'),
                'aria-orientation' => $attributes->get('orientation', 'vertical'),
            ])
    }}>
    {{ $slot }}
</div>
