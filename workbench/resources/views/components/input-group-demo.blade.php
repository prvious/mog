<div class="grid w-full max-w-sm gap-6">
    <x-mog::input-group>
        <x-mog::input-group-input placeholder="Search..." />

        <x-mog::input-group-addon>
            @svg('lucide-search')
        </x-mog::input-group-addon>

        <x-mog::input-group-addon align="inline-end">12 results</x-mog::input-group-addon>
    </x-mog::input-group>

    <x-mog::input-group>
        <x-mog::input-group-input
            placeholder="example.com"
            class="pl-1!" />

        <x-mog::input-group-addon>
            <x-mog::input-group-text>https://</x-mog::input-group-text>
        </x-mog::input-group-addon>

        <x-mog::input-group-addon align="inline-end">
            <x-mog::tooltip>
                <x-slot:trigger>
                    <x-mog::input-group-button
                        class="rounded-full"
                        size="icon-xs"
                        aria-label="Info">
                        @svg('lucide-info')
                    </x-mog::input-group-button>
                </x-slot:trigger>

                <x-slot:content>This is content in a tooltip.</x-slot:content>
            </x-mog::tooltip>
        </x-mog::input-group-addon>
    </x-mog::input-group>

    <x-mog::input-group>
        <x-mog::input-group-textarea placeholder="Ask, Search or Chat..." />

        <x-mog::input-group-addon align="block-end">
            <x-mog::input-group-button
                variant="outline"
                class="rounded-full"
                size="icon-xs"
                aria-label="Add">
                @svg('lucide-plus')
            </x-mog::input-group-button>

            <x-mog::dropdown>
                <x-slot:trigger>
                    <x-mog::input-group-button variant="ghost">Auto</x-mog::input-group-button>
                </x-slot:trigger>

                <x-slot:content
                    align="top-start"
                    class="[--radius:0.95rem]">
                    <x-slot:[items]>Auto</x-slot:[items]>
                    <x-slot:[items]>Agent</x-slot:[items]>
                    <x-slot:[items]>Manual</x-slot:[items]>
                </x-slot:content>
            </x-mog::dropdown>

            <x-mog::input-group-text class="ml-auto">52% used</x-mog::input-group-text>

            <x-mog::separator
                orientation="vertical"
                class="h-4!" />

            <x-mog::input-group-button
                variant="default"
                class="rounded-full"
                size="icon-xs">
                @svg('lucide-arrow-up')

                <span class="sr-only">Send</span>
            </x-mog::input-group-button>
        </x-mog::input-group-addon>
    </x-mog::input-group>

    <x-mog::input-group>
        <x-mog::input-group-input placeholder="@prvious" />

        <x-mog::input-group-addon align="inline-end">
            <div class="bg-primary text-foreground flex size-4 items-center justify-center rounded-full">
                @svg('lucide-check', 'text-primary-foreground size-3')
            </div>
        </x-mog::input-group-addon>
    </x-mog::input-group>
</div>
