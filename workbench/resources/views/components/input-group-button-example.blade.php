<div class="grid w-full max-w-sm gap-6">
    <x-mog::label
        for="input-secure-19"
        class="sr-only">
        Input Secure
    </x-mog::label>

    <x-mog::input-group class="[--radius:9999px]">
        <x-mog::input-group-input
            id="input-secure-19"
            class="pl-0.5!" />

        <x-mog::popover>
            <x-slot:trigger>
                <x-mog::input-group-addon>
                    <x-mog::input-group-button
                        variant="secondary"
                        size="icon-xs"
                        aria-label="Info">
                        @svg('lucide-info')
                    </x-mog::input-group-button>
                </x-mog::input-group-addon>
            </x-slot:trigger>
            <x-slot:content
                align="top-start"
                :offset="10"
                class="flex flex-col gap-1 rounded-xl text-sm">
                <p class="font-medium">Your connection is not secure.</p>
                <p>You should not enter any sensitive information on this site.</p>
            </x-slot:content>
        </x-mog::popover>

        <x-mog::input-group-addon class="text-muted-foreground pl-1!">https://</x-mog::input-group-addon>

        <x-mog::input-group-addon align="inline-end">
            <x-mog::input-group-button
                x-data="{ isFavorite: false }"
                x-on:click="isFavorite = !isFavorite"
                size="icon-xs"
                aria-label="Favorite">
                @svg('lucide-star', [
                    'x-bind:data-favorite' => 'String(isFavorite)',
                    'class' => 'data-[favorite=true]:fill-primary data-[favorite=true]:stroke-primary',
                ])
            </x-mog::input-group-button>
        </x-mog::input-group-addon>
    </x-mog::input-group>
</div>
