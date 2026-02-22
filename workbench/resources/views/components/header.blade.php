<header class="bg-background sticky top-0 z-50 w-full">
    <div class="container-wrapper 3xl:fixed:px-0 px-6">
        <div class="3xl:fixed:container flex h-(--header-height) items-center **:data-[slot=separator]:h-4!">
            <x-mobile-nav class="flex lg:hidden" />

            <x-mog::button
                variant="ghost"
                size="icon"
                class="hidden size-8 lg:flex">
                <a
                    wire:navigate
                    href="/">
                    <x-logo />
                    <span class="sr-only">Mog UI</span>
                </a>
            </x-mog::button>

            <nav class="hidden items-center gap-0 lg:flex">
                @php
                    $links = [
                        [
                            'href' => '/docs/installation',
                            'label' => 'Docs',
                        ],
                        [
                            'href' => '/docs/components',
                            'label' => 'Components',
                        ],
                        [
                            'href' => '/blocks',
                            'label' => 'Blocks',
                        ],
                        [
                            'href' => '/charts/area',
                            'label' => 'Charts',
                        ],
                        [
                            'href' => '/docs/directory',
                            'label' => 'Directory',
                        ],
                        [
                            'href' => '/create',
                            'label' => 'Create',
                        ],
                    ];
                @endphp

                @foreach ($links as $link)
                    <x-mog::button
                        variant="ghost"
                        size="sm"
                        class="relative items-center px-2.5"
                        wire:navigate
                        :href="$link['href']"
                        asLink>
                        {{ $link['label'] }}
                    </x-mog::button>
                @endforeach
            </nav>

            <div
                x-data="{ layout: $persist('full') }"
                x-init="
                    $watch('layout', (value) => {
                        document.documentElement.classList.remove('layout-full', 'layout-fixed')
                        document.documentElement.classList.add('layout-' + value)
                        localStorage.layout = value
                    })
                "
                class="ml-auto flex items-center gap-2 md:flex-1 md:justify-end">
                <x-github-link />

                <x-mog::separator
                    orientation="vertical"
                    class="3xl:flex hidden" />

                <x-mog::button
                    variant="ghost"
                    size="icon"
                    title="Toggle layout"
                    class="3xl:flex hidden size-8"
                    x-on:click="
                        layout = layout === 'fixed' ? 'full' : 'fixed';
                    ">
                    <span class="sr-only">Toggle layout</span>
                    @svg('lucide-gallery-horizontal')
                </x-mog::button>

                <x-mog::separator orientation="vertical" />

                <x-theme-switcher />
            </div>
        </div>
    </div>
</header>
