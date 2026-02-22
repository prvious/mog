@use(Illuminate\View\ComponentSlot)

@props([
    'heading' => app(ComponentSlot::class),
    'description' => app(ComponentSlot::class),
    'actions' => app(ComponentSlot::class),
])

<section {{ $attributes->cn('border-grid') }}>
    <div class="container-wrapper">
        <div class="container flex flex-col items-center gap-2 py-8 text-center md:py-16 lg:py-20 xl:gap-4">
            <x-mog::badge
                asLink
                variant="secondary"
                href="/docs/installation"
                class="gap-1.5 bg-transparent">
                <span
                    class="flex size-2 rounded-full bg-blue-500"
                    title="New"></span>

                <span>composer require prvious/mog</span>

                @svg('lucide-arrow-right', 'size-3')
            </x-mog::badge>

            @if ($heading->isNotEmpty())
                <h1
                    {{ $heading->attributes->cn('text-primary leading-tighter max-w-2xl text-4xl font-semibold tracking-tight text-balance lg:leading-[1.1] lg:font-semibold xl:text-5xl xl:tracking-tight') }}>
                    {{ $heading }}
                </h1>
            @endif

            @if ($description->isNotEmpty())
                <p {{ $description->attributes->cn('text-foreground max-w-3xl text-base text-balance sm:text-lg') }}>
                    {{ $description }}
                </p>
            @endif

            @if ($actions->isNotEmpty())
                <div {{ $actions->attributes->cn('flex w-full items-center justify-center gap-2 pt-2 **:data-[slot=button]:shadow-none') }}>
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
</section>
