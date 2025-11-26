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
    'richColors' => false, // Use rich colors for toast types
])

@php
    [$y, $x] = explode('-', $position);
@endphp

<section
    x-data="{
        get toasts() {
            return $mog.toasts
        },
        heights: [],
        isDocumentHidden: false,
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

        removeToast(toastToRemove) {
            if (
                ! this.toasts.find((toast) => toast.id === toastToRemove.id)?.delete
            ) {
                $mog.toast.dismiss(toastToRemove)
            }

            // First remove toast
            this.toasts = this.toasts.filter((t) => t.id !== toastToRemove.id)

            // Delay cleaning heights to give animation time to complete
            setTimeout(() => {
                // Ensure toast has been actually removed before cleaning heights
                if (! this.toasts.find((t) => t.id === toastToRemove.id)) {
                    this.heights = this.heights.filter(
                        (h) => h.toastId !== toastToRemove.id,
                    )
                }
            }, @js($timeBeforeUnmount) + 50) // Slightly delay to ensure animation completion
        },
    }"
    x-on:visibilitychange.window="isDocumentHidden = document.hidden"
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
            x-effect="
                if (toasts.length <= 1) {
                    expanded = false
                }
            "
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
                    :data-rich-colors="String(richColors)"
                    :data-styled="String(!Boolean(toast?.unstyled || unstyled))"
                    :data-inverted="String(inverted)"
                    :data-mounted="String(mounted)"
                    :data-type="toast.type || 'default'"
                    :data-promise="String(Boolean(toast.promise))"
                    :data-removed="String(removed)"
                    :data-y-position="toastPosition.y"
                    :data-x-position="toastPosition.x"
                    :data-dismissible="String(toast.dismissible)"
                    :data-swiped="false"
                    :data-swiping="false"
                    :data-swipe-out="false"
                    :data-swipe-direction="'right'"
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
                        swiped: false,
                        inverted: false,
                        removed: false,
                        richColors: toast.richColors || @js($richColors),

                        interacting: false,

                        timer: null,
                        closeTimerStartTimeRef: 0,
                        lastCloseTimerStartTimeRef: 0,
                        remainingTime: toast.duration || @js($toastLifetime),

                        get disabled() {
                            return toast.type === 'loading'
                        },

                        get toastPosition() {
                            return {
                                y: (toast.position || toasterPosition).split('-')[0],
                                x: (toast.position || toasterPosition).split('-')[1],
                            }
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
                            const samePositionHeights = this.heights.filter(
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
                                const alreadyExistsIndex = this.heights.findIndex(
                                    (t) => t.toastId === alreadyExists.toastId,
                                )

                                this.heights[alreadyExistsIndex] = {
                                    ...alreadyExists,
                                    height: newHeight,
                                }
                            } else {
                                this.heights.unshift({
                                    toastId: toast.id,
                                    height: newHeight,
                                    position: toast.position,
                                })
                            }
                        },

                        handleCloseToast() {
                            if (this.disabled || ! toast.dismissible) return

                            this.deleteToast()

                            toast.onDismiss?.(toast)
                        },

                        deleteToast() {
                            // Save the offset for the exit swipe animation
                            this.removed = true
                            this.offsetBeforeRemove = this.offset

                            setTimeout(() => {
                                // $dispatch('removeToast', this.toast)
                                this.removeToast(this.toast)
                            }, @js($timeBeforeUnmount))
                        },

                        handleTimer() {
                            if (
                                (toast.promise && toast.type === 'loading') ||
                                toast.duration === Infinity ||
                                toast.type === 'loading'
                            )
                                return

                            // Pause the timer on each hover
                            const pauseTimer = () => {
                                if (this.lastCloseTimerStartTimeRef < this.closeTimerStartTimeRef) {
                                    // Get the elapsed time since the timer started
                                    const elapsedTime =
                                        new Date().getTime() - this.closeTimerStartTimeRef

                                    this.remainingTime = this.remainingTime - elapsedTime
                                }

                                this.lastCloseTimerStartTimeRef = new Date().getTime()

                                clearTimeout(this.timer)
                            }

                            const startTimer = () => {
                                // setTimeout(, Infinity) behaves as if the delay is 0.
                                // As a result, the toast would be closed immediately, giving the appearance that it was never rendered.
                                // See: https://github.com/denysdovhan/wtfjs?tab=readme-ov-file#an-infinite-timeout
                                if (this.remainingTime === Infinity) return

                                this.closeTimerStartTimeRef = new Date().getTime()

                                // Let the toast know it has started
                                this.timer = setTimeout(() => {
                                    toast.onAutoClose?.(toast)
                                    this.deleteToast()
                                }, this.remainingTime)
                            }

                            if (this.expanded || this.interacting || this.isDocumentHidden) {
                                pauseTimer()
                            } else {
                                startTimer()
                            }
                        },

                        init() {
                            $watch('mounted', (value) => {
                                this.measureToast()
                                this.handleTimer()
                            })

                            $watch('expanded', () => this.handleTimer())
                            $watch('interacting', () => this.handleTimer())
                            $watch('toast', () => this.handleTimer())
                            $watch('toast.type', () => this.handleTimer())
                            $watch('isDocumentHidden', () => this.handleTimer())

                            $nextTick(() => {
                                this.mounted = true
                            })
                        },

                        destroy() {
                            if (this.timer !== null) {
                                clearTimeout(this.timer)
                            }
                        },
                    }">
                    <template x-if="toast.dismissible && toast.type !== 'loading'">
                        <button
                            aria-label="Close toast"
                            :data-disabled="String(disabled)"
                            data-close-button="true"
                            x-on:click="handleCloseToast()">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="12"
                                height="12"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stoke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round">
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

                    <template x-if="toast.type !== 'default' || toast.promise">
                        <div data-icon="">
                            <template x-if="toast.type === 'loading'">
                                <div
                                    x-data="{
                                        bars: Array(12).fill(0),
                                    }"
                                    class="sonner-loading-wrapper"
                                    :data-visible="String(toast.type === 'loading')">
                                    <div class="sonner-spinner">
                                        <template
                                            x-for="(bar, barIdx) in bars"
                                            :key="`spinner-bar-${barIdx}`">
                                            <div class="sonner-loading-bar"></div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <template x-if="toast.type === 'success'">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    height="20"
                                    width="20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </template>

                            <template x-if="toast.type === 'error'">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    height="20"
                                    width="20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </template>

                            <template x-if="toast.type === 'warning'">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    height="20"
                                    width="20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </template>

                            <template x-if="toast.type === 'info'">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    height="20"
                                    width="20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </template>
                        </div>
                    </template>

                    <div data-content="">
                        <div
                            data-title=""
                            x-text="toast.title"></div>

                        <template x-if="toast.description">
                            <div
                                data-description=""
                                x-text="toast.description"></div>
                        </template>
                    </div>

                    <template x-if="toast.cancel">
                        <button
                            data-button
                            data-cancel
                            x-on:click="
                                if (toast.cancel.label === undefined) return
                                if (! toast.dismissible) return

                                toast.cancel.onClick?.($event)
                                deleteToast()
                            "
                            x-text="toast.cancel.label"></button>
                    </template>

                    <template x-if="toast.action">
                        <button
                            data-button
                            data-action
                            x-on:click="
                                if (toast.action.label === undefined) return

                                toast.action.onClick?.($event)
                                if ($event.defaultPrevented) return
                                deleteToast()
                            "
                            x-text="toast.action.label"></button>
                    </template>
                </li>
            </template>
        </ol>
    </template>
</section>
