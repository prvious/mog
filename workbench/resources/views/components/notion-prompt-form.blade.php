<form class="[--radius:1.2rem]">
    <x-mog::field>
        <x-mog::field-label
            for="notion-prompt"
            class="sr-only">
            Prompt
        </x-mog::field-label>

        <x-mog::input-group>
            <x-mog::input-group-textarea
                id="notion-prompt"
                placeholder="Ask, search, or make anything..." />

            <x-mog::input-group-addon
                align="block-end"
                class="gap-1">
                <x-mog::tooltip>
                    <x-slot:trigger>
                        <x-mog::input-group-button
                            size="icon-sm"
                            class="rounded-full"
                            aria-label="Attach file">
                            @svg('lucide-paperclip')
                        </x-mog::input-group-button>
                    </x-slot:trigger>

                    <x-slot:content>Attach file</x-slot:content>
                </x-mog::tooltip>

                <x-mog::input-group-button
                    aria-label="Send"
                    class="ml-auto rounded-full"
                    variant="default"
                    size="icon-sm">
                    @svg('lucide-arrow-up')
                </x-mog::input-group-button>
            </x-mog::input-group-addon>
        </x-mog::input-group>
    </x-mog::field>
</form>
