<x-mog::button
    x-data
    size="icon"
    variant="ghost"
    x-on:click="
        if ($mog.coat === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) $mog.paint('light')
        else if ($mog.coat === 'dark') $mog.paint('light')
        else if ($mog.coat === 'light') $mog.paint('dark')
    "
    class="group/toggle extend-touch-target size-8">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="size-4.5!">
        <path
            stroke="none"
            d="M0 0h24v24H0z"
            fill="none" />
        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
        <path d="M12 3l0 18" />
        <path d="M12 9l4.65 -4.65" />
        <path d="M12 14.3l7.37 -7.37" />
        <path d="M12 19.6l8.85 -8.85" />
    </svg>
    <span class="sr-only">Toggle theme</span>
</x-mog::button>
