<div
    x-data="{ open: false }"
    class="lg:hidden">
    <x-mog::button
        variant="ghost"
        x-on:click="open = !open"
        class="extend-touch-target h-8 touch-manipulation items-center justify-start gap-2.5 p-0! hover:bg-transparent focus-visible:bg-transparent focus-visible:ring-0 active:bg-transparent dark:hover:bg-transparent">
        <div class="relative flex h-8 w-4 items-center justify-center">
            <div class="relative size-4">
                <span
                    class="bg-foreground absolute left-0 block h-0.5 w-4 transition-all duration-100"
                    :class="open ? 'top-[0.4rem] -rotate-45' : 'top-1'"></span>
                <span
                    class="bg-foreground absolute left-0 block h-0.5 w-4 transition-all duration-100"
                    :class='open ? "top-[0.4rem] rotate-45" : "top-2.5"'></span>
            </div>
            <span class="sr-only">Toggle Menu</span>
        </div>
        <span class="flex h-8 items-center text-lg leading-none font-medium">Menu</span>
    </x-mog::button>
</div>
