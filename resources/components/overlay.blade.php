<div
    x-data
    x-cloak
    x-show="$store.dialog.visible"
    x-transition:enter="animate-in fade-in-0 transition-all ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="animate-out fade-out-0 transition-all ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-on:click="$dispatch('close-dialog')"
    class="fixed inset-0 z-50 overflow-y-auto bg-black/85"></div>
