@props([
    'position' => 'bottom-right', // top-left, top-right, bottom-left, bottom-right
    'expandByDefault' => false,
    'visibleToasts' => 3, // Visible toasts
    'viewportOffset' => '24px', // Viewport padding
    'mobileViewportOffset' => '16px', // Mobile viewport padding
    'toastWidth' => '356px', // Toast width
    'gap' => 14, // Gap between toasts
    'toastLifetime' => 4000, // Default lifetime of a toasts (in ms)
    'timeBeforeUnmount' => 200, // Equal to exit animation duration
])

@php
    [$y, $x] = explode('-', $position);
@endphp

<section
    x-data="{
        toasts: $mog.toasts,
        heights: [],
        get possiblePositions() {
            const posList = this.toasts
                .filter((toast) => toast.position)
                .map((toast) => toast.position)

            return posList.length > 0
                ? Array.from(new Set(['{{ $position }}'].concat(posList)))
                : ['{{ $position }}']
        },

        filteredToasts(position, index) {
            return this.toasts.filter(
                (toast) =>
                    (! toast.position && index === 0) || toast.position === position,
            )
        },

        get toastsByPosition() {
            const result = {}

            this.possiblePositions.forEach((pos) => {
                result[pos] = this.toasts.filter((t) => t.position === pos)
            })

            return result
        },
    }"
    tabindex="-1"
    aria-live="polite"
    aria-relevant="additions text"
    aria-atomic="false">
    <template
        x-for="(toasterPosition, index) in possiblePositions"
        :key="toasterPosition">
        <ol
            reversed
            data-sonner-toaster
            tabindex="-1"
            class="toaster group"
            :dir="setDocumentDirection || 'ltr'"
            :data-y-position="olPosition.y"
            :data-x-position="olPosition.x"
            :data-sonner-theme="theme"
            x-ref="ol"
            style="
                --width: {{ $toastWidth }};
                --gap: {{ $gap }}px;
                --normal-bg: var(--popover);
                --normal-border: var(--border);
                --border-radius: var(--radius);
                --normal-text: var(--popover-foreground);
                --offset-top: {{ $viewportOffset }};
                --offset-right: {{ $viewportOffset }};
                --offset-bottom: {{ $viewportOffset }};
                --offset-left: {{ $viewportOffset }};
                --mobile-offset-top: {{ $mobileViewportOffset }};
                --mobile-offset-right: {{ $mobileViewportOffset }};
                --mobile-offset-bottom: {{ $mobileViewportOffset }};
                --mobile-offset-left: {{ $mobileViewportOffset }};
            "
            x-data="{
                expandByDefault: @js($expandByDefault),
                expanded: false,
                theme: $mog.scheme,
                removed: false,
                olPosition: {
                    y: toasterPosition.split('-')[0],
                    x: toasterPosition.split('-')[1],
                },

                get setDocumentDirection() {
                    if (typeof window === 'undefined') return 'ltr'
                    if (typeof document === 'undefined') return 'ltr'

                    const dirAttribute = document.documentElement.getAttribute('dir')

                    if (dirAttribute === 'auto' || ! dirAttribute) {
                        return window.getComputedStyle(document.documentElement).direction
                    }

                    return dirAttribute
                },
            }"
            :style="{
                '--front-toast-height': `${heights[0]?.height || 0}px`,
            }"
            x-on:mouseenter="expanded = true"
            x-on:mousemove="expanded = true"
            x-on:mouseleave="expanded = false">
            <template
                x-for="(toast, index) in filteredToasts(toasterPosition, index)"
                :key="toast.id">
                <li
                    :id="$id('toast')"
                    data-sonner-toast
                    data-rich-colors="false"
                    :data-styled="!Boolean(toast.component || toast?.unstyled || unstyled)"
                    data-inverted="false"
                    :data-mounted="String(mounted)"
                    :data-type="toast.type || 'default'"
                    {{-- :data-promise="Boolean(toast.promise)" --}}
                    data-promise="false"
                    {{-- :data-swiped="swiped" --}}
                    data-swiped="false"
                    :data-removed="String(removed)"
                    :data-y-position="toastPosition.y"
                    :data-x-position="toastPosition.x"
                    data-swiping="false"
                    :data-dismissible="String(toast.dismissible)"
                    data-swipe-out="false"
                    :data-expanded="String(expanded || (expandByDefault && mounted))"
                    :data-visible="String(isVisible)"
                    :data-index="index"
                    :data-front="String(isFront)"
                    :style="{
                    '--index': index,
                    '--toasts-before': index,
                    '--z-index': toastsByPosition[toasterPosition].length - index,
                    '--offset': `${removed ? offsetBeforeRemove : offset}px`,
                    '--initial-height': expandByDefault ? 'auto' : `${initialHeight}px`,
                }"
                    x-data="{
                    initialHeight: 0,
                    offsetBeforeRemove: 0,
                    mounted: false,
                    unstyled: toast.unstyled || false,

                    toastPosition: {
                        y: (toast.position || toasterPosition).split('-')[0],
                        x: (toast.position || toasterPosition).split('-')[1],
                    },

                    get isFront() {
                        return this.index === 0
                    },

                    get isVisible() {
                        return this.index + 1 <= {{ $visibleToasts }}
                    },

                    get heightIndex() {
                        const currentPosition = toast.position || toasterPosition
                        const samePositionHeights = this.heights.filter(
                            (h) => h.position === currentPosition,
                        )

                        const idx = samePositionHeights.findIndex(
                            (height) => height.toastId === toast.id,
                        )

                        return idx >= 0 ? idx : 0
                    },

                    get toastsHeightBefore() {
                        const currentPosition = toast.position || toasterPosition
                        const samePositionHeights = heights.filter(
                            (h) => h.position === currentPosition,
                        )

                        return samePositionHeights.reduce((prev, curr, reducerIndex) => {
                            if (reducerIndex >= this.heightIndex) {
                                return prev
                            }

                            return prev + curr.height
                        }, 0)
                    },

                    get offset() {
                        return this.heightIndex * {{ $gap }} + this.toastsHeightBefore || 0
                    },

                    measureToast() {
                        const originalHeight = $el.style.height
                        $el.style.height = 'auto'

                        const newHeight = $el.getBoundingClientRect().height

                        $el.style.height = originalHeight

                        this.initialHeight = newHeight

                        const alreadyExists = this.heights.find((h) => h.toastId === toast.id)

                        if (alreadyExists) {
                            const alreadyExistsIndex = this.heights.findIndex(t => t.toastId === alreadyExists.toastId)

                            this.heights[alreadyExistsIndex] = {
                                ...alreadyExists,
                                height: newHeight,
                            };
                        } else {
                            this.heights.unshift({
                                toastId: toast.id,
                                height: newHeight,
                                position: toast.position,
                            });
                        }

                        {{-- console.log('HELO',this.heights, alreadyExists, toast.id); --}}
                    },

                    init() {
                        $watch('mounted', value => this.measureToast())
                        {{-- $watch('initialHeight', (value) => this.measureToast()) --}}

                        $nextTick(() => {
                            this.mounted = true
                        })
                    }
                }">
                    <template x-if="toast.dismissible">
                        <button
                            aria-label="Close toast"
                            :data-disabled="toast.type === 'loading' ? 'true' : 'false'"
                            data-close-button
                            x-on:click="
                                if (toast.type === 'loading' || ! toast.dismissible) return

                                toast.removed = true

                                heights = heights.filter((h) => h.toastId !== toast.id)
                            ">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="12"
                                height="12"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="1.5"
                                strokeLinecap="round"
                                strokeLinejoin="round">
                                <line
                                    x1="18"
                                    y1="6"
                                    x2="6"
                                    y2="18"></line>
                                <line
                                    x1="6"
                                    y1="6"
                                    x2="18"
                                    y2="18"></line>
                            </svg>
                        </button>
                    </template>

                    <div data-content>
                        <div
                            data-title
                            x-text="toast.title"></div>
                        <div
                            data-description
                            x-text="toast.description"></div>
                    </div>
                    <button
                        data-button="true"
                        data-action="true"
                        class="">
                        Undo
                    </button>
                </li>
            </template>
        </ol>
    </template>
</section>
