@props([
    'position' => 'bottom-right',
])

@php
    [$y, $x] = explode('-', $position);
@endphp

<div
    x-data
    x-on:mog::toast-create.document="$event.detail.toast.render($refs.ol)">
    <ol
        x-ref="ol"
        dir="ltr"
        tabindex="-1"
        class="toaster group"
        data-sonner-toaster
        data-sonner-theme="dark"
        data-x-position="{{ $x }}"
        data-y-position="{{ $y }}"
        style="
            --front-toast-height: 73px;
            --width: 356px;
            --gap: 14px;
            --normal-bg: var(--popover);
            --normal-text: var(--popover-foreground);
            --normal-border: var(--border);
            --border-radius: var(--radius);
            --offset-top: 24px;
            --offset-right: 24px;
            --offset-bottom: 24px;
            --offset-left: 24px;
            --mobile-offset-top: 16px;
            --mobile-offset-right: 16px;
            --mobile-offset-bottom: 16px;
            --mobile-offset-left: 16px;
        "
        x-data="{
            toasts: [
                { id: 1, name: 'Toast one' },
                { id: 2, name: 'Toast two' },
                { id: 3, name: 'Toast three' },
                { id: 4, name: 'Toast four' },
            ],
        }">
        <template
            x-for="(toast, index) in toasts"
            :key="toast.id">
            {{--
                <li
                tabindex="0"
                class=""
                data-sonner-toast
                data-styled="true"
                data-mounted="true"
                data-promise="false"
                data-swiped="false"
                data-removed="false"
                data-visible="true"
                data-x-position="{{ $x }}"
                data-y-position="{{ $y }}"
                data-index="0"
                data-front="true"
                data-swiping="false"
                data-dismissible="true"
                data-swipe-out="false"
                data-expanded="false"
                x-on:mouseenter="$el.setAttribute('data-expanded', 'true')"
                x-on:mousemove="$el.setAttribute('data-expanded', 'true')"
                x-on:mouseleave="$el.setAttribute('data-expanded', 'false')"
                style="--index: 0; --toasts-before: 0; --z-index: 2; --offset: 0px; --initial-height: 73px">
                <div
                data-content=""
                class="">
                <div
                data-title=""
                class="">
                Event has been created
                </div>
                <div
                data-description=""
                class="">
                Sunday, December 03, 2023 at 9:00 AM
                </div>
                </div>
                <button
                data-button="true"
                data-action="true"
                class="">
                Undo
                </button>
                </li>
            --}}
            <li
                tabindex="0"
                class=""
                data-sonner-toast
                data-styled="true"
                data-mounted="true"
                data-promise="false"
                data-swiped="false"
                data-removed="false"
                data-visible="true"
                data-x-position="{{ $x }}"
                data-y-position="{{ $y }}"
                data-swiping="false"
                data-dismissible="true"
                data-swipe-out="false"
                data-expanded="false"
                :data-index="index"
                :data-front="index === 0 ? 'true' : 'false'"
                :style="{ '--index': index, '--toasts-before': toasts.length - index - 1, '--z-index': toasts.length - index }"
                style="--offset: 87px; --initial-height: 73px"
                x-on:mouseenter="$el.setAttribute('data-expanded', 'true')"
                x-on:mousemove="$el.setAttribute('data-expanded', 'true')"
                x-on:mouseleave="$el.setAttribute('data-expanded', 'false')">
                <div
                    data-content=""
                    class="">
                    <div
                        data-title=""
                        class="">
                        Event has been created
                    </div>
                    <div
                        data-description=""
                        class="">
                        Sunday, December 03, 2023 at 9:00 AM
                    </div>
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
</div>
