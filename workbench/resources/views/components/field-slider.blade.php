<x-mog::field x-data="{ value: [200, 800] }">
    <x-mog::field-title>Price Range</x-mog::field-title>

    <x-mog::field-description>
        Set your budget range ($
        <span
            class="font-medium tabular-nums"
            x-text="value[0]"></span>
        -
        <span
            class="font-medium tabular-nums"
            x-text="value[1]"></span>
        )
    </x-mog::field-description>

    <x-mog::slider
        x-model="value"
        :max="1000"
        :min="0"
        :step="1"
        class="mt-2 w-full"
        orientation="horizontal"
        aria-label="Price Range" />
</x-mog::field>
