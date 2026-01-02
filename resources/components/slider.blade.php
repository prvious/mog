@use(Illuminate\View\ComponentSlot)

@props([
    'min' => 0, // starting position of the first thumb (represents 0%)
    'max' => 100, // starting position of the last thumb (represents remaining 100%)
    'step' => 1,
    'orientation' => 'horizontal',

    'track' => app(ComponentSlot::class),
])

<div
    x-cloak
    x-data="{
        min: @js($min),
        max: @js($max),
        step: @js($step),
        orientation: @js($orientation),
        currentValue: [this.min, this.max],

        linearScale: (input, output) => {
            return (value) => {
                if (input[0] === input[1] || output[0] === output[1])
                    return output[0]

                const ratio = (output[1] - output[0]) / (input[1] - input[0])
                return output[0] + ratio * (value - input[0])
            }
        },

        getValueFromPointer(pointerPosition) {
            if (this.orientation === 'horizontal') {
                const rect = $el.getBoundingClientRect()
                const input = [0, rect.width]
                const output = [this.min, this.max]
                const value = this.linearScale(input, output)

                return value(pointerPosition - rect.left)
            }
        },

        getClosestValueIndex(values, nextValue) {
            if (values.length === 1) return 0
            const distances = values.map((value) => Math.abs(value - nextValue))
            const closestDistance = Math.min(...distances)
            return distances.indexOf(closestDistance)
        },

        styles(position) {
            if (position === 'start') {
                if (this.orientation === 'vertical') {
                    return {
                        bottom: `calc(${((this.currentValue[0] - this.min) / (this.max - this.min)) * 100}% - 0.5rem)`,
                    }
                }

                return {
                    left: `calc(${((this.currentValue[0] - this.min) / (this.max - this.min)) * 100}% - 0.5rem)`,
                }
            }

            if (position === 'end') {
                if (this.orientation === 'vertical') {
                    return {
                        bottom: `calc(${((this.currentValue[1] - this.min) / (this.max - this.min)) * 100}% - 0.5rem)`,
                    }
                }

                return {
                    left: `calc(${((this.currentValue[1] - this.min) / (this.max - this.min)) * 100}% - 0.5rem)`,
                }
            }

            if (position === 'track') {
                if (this.orientation === 'vertical') {
                    return {
                        bottom: `${((this.currentValue[0] - this.min) / (this.max - this.min)) * 100}%`,
                        top: `${100 - ((this.currentValue[1] - this.min) / (this.max - this.min)) * 100}%`,
                    }
                }

                return {
                    left: `${((this.currentValue[0] - this.min) / (this.max - this.min)) * 100}%`,
                    right: `${100 - ((this.currentValue[1] - this.min) / (this.max - this.min)) * 100}%`,
                }
            }
        },
    }"
    data-slot="slider"
    x-modelable="currentValue"
    data-orientation="{{ $orientation }}"
    {{ $attributes->cn('relative flex w-full touch-none items-center select-none data-[disabled]:opacity-50 data-[orientation=vertical]:h-full data-[orientation=vertical]:min-h-44 data-[orientation=vertical]:w-auto data-[orientation=vertical]:flex-col isolate') }}>
    <div
        data-slot="slider-track"
        data-orientation="{{ $orientation }}"
        class="bg-muted relative z-10 grow rounded-full data-[orientation=horizontal]:h-1.5 data-[orientation=vertical]:h-full data-[orientation=horizontal]:w-full data-[orientation=vertical]:w-1.5">
        <div
            data-slot="slider-range"
            class="bg-primary focus-visible:outline-hidden absolute absolute bottom-0 top-0 rounded-full shadow-sm transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-50 data-[orientation=horizontal]:h-full data-[orientation=vertical]:w-full"
            :style="styles('track')"></div>
    </div>

    <span
        :style="styles('start')"
        data-slot="slider-thumb"
        class="border-primary ring-ring/50 focus-visible:outline-hidden absolute z-50 block size-4 shrink-0 cursor-pointer rounded-full border bg-white shadow-sm transition-[color,box-shadow] hover:ring-4 focus-visible:ring-4 disabled:pointer-events-none disabled:opacity-50 data-[orientation=horizontal]:bottom-0 data-[orientation=horizontal]:top-0 data-[orientation=vertical]:left-0 data-[orientation=vertical]:right-0"
        x-on:pointerdown="
            $event.target.setPointerCapture($event.pointerId)

            // Prevent browser focus behaviour because we focus a thumb manually when values change.
            $event.preventDefault()

            if (orientation === 'horizontal') {
                getValueFromPointer($event.clientX)
            } else if (orientation === 'vertical') {
                getValueFromPointer($event.clientY)
            }
        "></span>

    <span
        :style="styles('end')"
        data-slot="slider-thumb"
        class="border-primary ring-ring/50 focus-visible:outline-hidden absolute z-50 block size-4 shrink-0 cursor-pointer rounded-full border bg-white shadow-sm transition-[color,box-shadow] hover:ring-4 focus-visible:ring-4 disabled:pointer-events-none disabled:opacity-50 data-[orientation=horizontal]:bottom-0 data-[orientation=horizontal]:top-0 data-[orientation=vertical]:left-0 data-[orientation=vertical]:right-0"
        x-on:pointerdown="console.log($event.pointerId, $event.target.setPointerCapture)"></span>
</div>
