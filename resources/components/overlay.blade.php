<div
    x-cloak
    x-data="{ overlay: false }"
    x-show="overlay"
    x-modelable="overlay"
    :data-state="overlay ? 'open' : 'closed'"
    {{ $attributes->twMerge('data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fixed inset-0 z-50 overflow-y-auto bg-black/80') }}></div>
