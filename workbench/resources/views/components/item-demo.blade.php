<div class="flex w-full max-w-md flex-col gap-6">
    <x-mog::item variant="outline">
        <x-mog::item-content>
            <x-mog::item-title>Two-factor authentication</x-mog::item-title>
            <x-mog::item-description class="text-pretty xl:hidden 2xl:block">Verify via email or phone number.</x-mog::item-description>
        </x-mog::item-content>

        <x-mog::item-actions>
            <x-mog::button size="sm">Enable</x-mog::button>
        </x-mog::item-actions>
    </x-mog::item>

    <x-mog::item
        variant="outline"
        size="sm"
        href="#"
        tag="a">
        <x-mog::item-media>
            @svg('lucide-badge-check', 'size-5')
        </x-mog::item-media>

        <x-mog::item-content>
            <x-mog::item-title>Your profile has been verified.</x-mog::item-title>
        </x-mog::item-content>

        <x-mog::item-actions>
            @svg('lucide-chevron-right', 'size-4')
        </x-mog::item-actions>
    </x-mog::item>
</div>
