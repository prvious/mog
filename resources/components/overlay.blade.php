<div
    x-cloak
    x-data="{
        overlay: false,
        top: undefined,
        openOverlay(dialogId) {
            this.top = dialogId
            this.overlay = true
            document.body.setAttribute('data-scroll-locked', 'true')
        },
        closeOverlay() {
            this.top = $mog.dialogs[0]

            if ($mog.dialog.empty()) {
                this.overlay = false
                document.body.removeAttribute('data-scroll-locked')
            }
        },
    }"
    x-show="overlay"
    x-on:click="$mog.dialog.close(top)"
    x-on:mog::overlay-open.document="openOverlay($event.detail.dialog)"
    x-on:mog::overlay-close.document="closeOverlay()"
    x-transition:enter="animate-in fade-in-0 transition-all ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="animate-out fade-out-0 transition-all ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 overflow-y-auto bg-black/75 dark:bg-black/85"></div>

{{-- Render the dialogs after the overlay so they appear above it without having to abuse z-index --}}
<div
    id="mog-dialog-container"
    class="contents"></div>

@persist('mog::toast')
    <x-mog::toast />
@endpersist
