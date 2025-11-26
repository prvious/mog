@php
    throw_if(app('mog')->overlayAlreadyRendered(), '<x-mog::overlay /> component is being rendered multiple times. Please ensure it is only included once per page.');
@endphp

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
    x-transition:enter="animate-in fade-in duration-300"
    x-transition:leave="animate-out fade-out duration-300"
    x-bind:data-state="overlay ? 'open' : 'closed'"
    class="fade-out fixed inset-0 overflow-y-auto bg-black/75 data-[state=closed]:opacity-0 dark:bg-black/85"></div>

{{-- Render the dialogs after the overlay so they appear above it without having to abuse z-index --}}
<div
    id="mog-dialog-container"
    class="contents"></div>

@persist('mog::toaster')
    <x-mog::toaster />
@endpersist

@php
    app('mog')->markOverlayAsRendered();
@endphp
