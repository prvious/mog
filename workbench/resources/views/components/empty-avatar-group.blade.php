<x-mog::empty class="flex-none border">
    <x-slot:header>
        <x-slot:media>
            <div
                class="*:data-[slot=avatar]:ring-background flex -space-x-2 *:data-[slot=avatar]:size-12 *:data-[slot=avatar]:ring-2 *:data-[slot=avatar]:grayscale">
                <x-mog::avatar>
                    <x-slot:img
                        src="https://github.com/shadcn.png"
                        alt="@shadcn"></x-slot:img>
                    <x-slot:initials>CN</x-slot:initials>
                </x-mog::avatar>

                <x-mog::avatar>
                    <x-slot:img
                        src="https://github.com/taylorotwell.png"
                        alt="@taylorotwell"></x-slot:img>
                    <x-slot:initials>TO</x-slot:initials>
                </x-mog::avatar>

                <x-mog::avatar>
                    <x-slot:img
                        src="https://github.com/calebporzio.png"
                        alt="@calebporzio"></x-slot:img>
                    <x-slot:initials>CP</x-slot:initials>
                </x-mog::avatar>

                <x-mog::avatar>
                    <x-slot:img
                        src="https://github.com/munezaclovis.png"
                        alt="@munezaclovis"></x-slot:img>
                    <x-slot:initials>MC</x-slot:initials>
                </x-mog::avatar>
            </div>
        </x-slot:media>

        <x-slot:title>No Team Members</x-slot:title>

        <x-slot:description>Invite your team to collaborate on this project.</x-slot:description>
    </x-slot:header>

    <x-slot:content>
        <x-mog::button size="sm">
            @svg('lucide-plus')
            Invite Members
        </x-mog::button>
    </x-slot:content>
</x-mog::empty>
