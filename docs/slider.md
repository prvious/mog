# Slider

Range slider component for selecting numeric values within a defined range. Uses Alpine.js for interactive dragging and supports both horizontal and vertical orientations.

## Overview

The slider component allows users to select a value (or range of values) by dragging thumbs along a track. It's ideal for settings like volume, brightness, price ranges, or any numeric input where approximate values are acceptable.

## Props

- `min` (number, default: `0`): Minimum value of the slider range
- `max` (number, default: `100`): Maximum value of the slider range
- `step` (number, default: `1`): Increment step for value changes
- `orientation` (string, default: `'horizontal'`): Slider direction
    - `'horizontal'`: Left to right slider
    - `'vertical'`: Bottom to top slider

## Features

- **Dual thumb support**: Currently supports range selection with start and end thumbs
- **Draggable thumbs**: Click and drag to adjust values
- **Visual track fill**: Shows selected range with colored track
- **Alpine.js state**: Reactive value management with `x-modelable`
- **Keyboard support**: Full keyboard navigation (planned)
- **Touch support**: Works on touch devices
- **Horizontal & vertical**: Flexible orientation

## Usage Examples

### Basic Slider

```blade
<x-slider />
```

### With Custom Range

```blade
<x-slider
    min="0"
    max="100"
    step="5" />
```

### With Field Wrapper

```blade
<x-field>
    <x-field-label>Volume</x-field-label>
    <x-slider
        min="0"
        max="100" />
</x-field>
```

### With Livewire

```blade
<x-field>
    <x-field-label>Price Range</x-field-label>
    <x-slider
        min="0"
        max="1000"
        step="10"
        wire:model="priceRange" />
    <x-field-description>${{ $priceRange[0] ?? 0 }} - ${{ $priceRange[1] ?? 1000 }}</x-field-description>
</x-field>
```

### With Value Display

```blade
<x-field>
    <div class="flex items-center justify-between">
        <x-field-label>Brightness</x-field-label>
        <span class="text-muted-foreground text-sm">{{ $brightness }}%</span>
    </div>
    <x-slider
        min="0"
        max="100"
        wire:model.live="brightness" />
</x-field>
```

### Vertical Orientation

```blade
<div class="flex h-64 items-center">
    <x-slider
        orientation="vertical"
        min="0"
        max="100" />
</div>
```

### Price Range Filter

```blade
<x-field>
    <x-field-label>Price Range</x-field-label>
    <x-slider
        min="0"
        max="5000"
        step="50"
        wire:model.live="priceRange" />
    <div class="flex justify-between text-sm">
        <span>${{ $priceRange[0] ?? 0 }}</span>
        <span>${{ $priceRange[1] ?? 5000 }}</span>
    </div>
</x-field>
```

### Custom Step Size

```blade
{{-- Fine control (step=1) --}}
<x-slider
    min="0"
    max="100"
    step="1" />

{{-- Coarse control (step=10) --}}
<x-slider
    min="0"
    max="100"
    step="10" />

{{-- Decimal steps --}}
<x-slider
    min="0"
    max="1"
    step="0.1" />
```

### Disabled State

```blade
<x-slider disabled />

<x-slider
    min="0"
    max="100"
    wire:model="value"
    :disabled="$locked" />
```

### Temperature Control

```blade
<x-field>
    <div class="flex items-center justify-between">
        <x-field-label>Temperature</x-field-label>
        <span class="text-sm font-medium">{{ $temperature }}°F</span>
    </div>
    <x-slider
        min="60"
        max="80"
        wire:model.live="temperature" />
    <div class="text-muted-foreground flex justify-between text-xs">
        <span>60°F</span>
        <span>70°F</span>
        <span>80°F</span>
    </div>
</x-field>
```

### Age Range Filter

```blade
<x-field>
    <x-field-label>Age Range</x-field-label>
    <x-slider
        min="18"
        max="100"
        wire:model="ageRange" />
    <x-field-description>{{ $ageRange[0] ?? 18 }} - {{ $ageRange[1] ?? 100 }} years old</x-field-description>
</x-field>
```

### With Markers

```blade
<x-field>
    <x-field-label>Volume</x-field-label>
    <x-slider
        min="0"
        max="10"
        step="1"
        wire:model="volume" />

    <div class="text-muted-foreground grid grid-cols-11 text-xs">
        @for ($i = 0; $i <= 10; $i++)
            <span class="text-center">{{ $i }}</span>
        @endfor
    </div>
</x-field>
```

## Accessibility

### Keyboard Navigation

The slider component should support:

- `←`/`↓`: Decrease value
- `→`/`↑`: Increase value
- `Home`: Set to minimum value
- `End`: Set to maximum value
- `Page Up`: Increase by larger step
- `Page Down`: Decrease by larger step

### ARIA Attributes

```blade
<x-slider
    aria-label="Volume control"
    aria-valuemin="0"
    aria-valuemax="100"
    aria-valuenow="{{ $volume }}" />
```

### Labels

Always provide labels for sliders:

```blade
{{-- Good: With label --}}
<x-field>
    <x-field-label>Brightness</x-field-label>
    <x-slider />
</x-field>

{{-- Acceptable: With aria-label --}}
<x-slider aria-label="Brightness control" />

{{-- Avoid: No label --}}
<x-slider />
```

## Best Practices

### Show Current Value

Always display the current value to users:

```blade
<x-field>
    <div class="flex items-center justify-between">
        <x-field-label>Volume</x-field-label>
        <span>{{ $volume }}%</span>
    </div>
    <x-slider wire:model.live="volume" />
</x-field>
```

### Provide Range Context

Show min/max values or markers:

```blade
<x-field>
    <x-field-label>Price</x-field-label>
    <x-slider
        min="0"
        max="1000" />
    <div class="text-muted-foreground flex justify-between text-sm">
        <span>$0</span>
        <span>$1000</span>
    </div>
</x-field>
```

### Use Appropriate Steps

```blade
{{-- Precise control --}}
<x-slider step="1" />

{{-- Round numbers --}}
<x-slider step="5" />

{{-- Percentages --}}
<x-slider
    min="0"
    max="100"
    step="1" />
```

### Consider Touch Targets

Ensure thumbs are large enough for touch:

```blade
{{-- Default thumb size is 16px (size-4) --}}
<x-slider />

{{-- Custom larger thumb (if needed) --}}
<x-slider class="[&_[data-slot=slider-thumb]]:size-6" />
```

## Technical Details

### Alpine.js State

The slider uses Alpine.js for state management:

```javascript
x-data="{
    min: 0,
    max: 100,
    step: 1,
    orientation: 'horizontal',
    currentValue: [0, 100],
}"
x-modelable="currentValue"
```

### Value Calculation

The component uses linear scaling to convert pointer positions to values:

```javascript
linearScale: (input, output) => {
    return (value) => {
        const ratio = (output[1] - output[0]) / (input[1] - input[0])
        return output[0] + ratio * (value - input[0])
    }
}
```

### Dynamic Positioning

Thumb positions are calculated dynamically based on current values:

```javascript
styles(position) {
    if (position === 'start') {
        return {
            left: `calc(${percentage}% - 0.5rem)`
        }
    }
}
```

### Data Attributes

The component exposes orientation via data attribute:

```html
data-orientation="horizontal|vertical"
```

## Related Components

- [Field](./field.md) - Form field layouts
- [Input](./input.md) - Text input for precise numeric entry
- [Radio Group](./radio-group.md) - Discrete option selection

## Common Patterns

### Volume Control

```blade
<x-field>
    <div class="flex items-center gap-2">
        @svg('mog-volume-2', 'size-4')
        <x-slider
            min="0"
            max="100"
            wire:model.live="volume"
            class="flex-1" />
        <span class="w-12 text-right text-sm tabular-nums">{{ $volume }}%</span>
    </div>
</x-field>
```

### Filter Range

```blade
<x-field>
    <x-field-label>Price Range</x-field-label>
    <x-slider
        min="0"
        max="10000"
        step="100"
        wire:model.live.debounce.500ms="priceFilter" />
    <div class="flex justify-between">
        <span class="text-sm">${{ number_format($priceFilter[0] ?? 0) }}</span>
        <span class="text-sm">${{ number_format($priceFilter[1] ?? 10000) }}</span>
    </div>
</x-field>
```

### Settings Panel

```blade
<x-field-group>
    <x-field>
        <div class="flex items-center justify-between">
            <x-field-label>Brightness</x-field-label>
            <span class="text-sm">{{ $brightness }}%</span>
        </div>
        <x-slider
            min="0"
            max="100"
            wire:model.live="brightness" />
    </x-field>

    <x-field>
        <div class="flex items-center justify-between">
            <x-field-label>Contrast</x-field-label>
            <span class="text-sm">{{ $contrast }}%</span>
        </div>
        <x-slider
            min="0"
            max="100"
            wire:model.live="contrast" />
    </x-field>

    <x-field>
        <div class="flex items-center justify-between">
            <x-field-label>Saturation</x-field-label>
            <span class="text-sm">{{ $saturation }}%</span>
        </div>
        <x-slider
            min="0"
            max="100"
            wire:model.live="saturation" />
    </x-field>
</x-field-group>
```

### Time Range Selector

```blade
<x-field>
    <x-field-label>Available Hours</x-field-label>
    <x-slider
        min="0"
        max="24"
        wire:model="timeRange" />
    <x-field-description>{{ $timeRange[0] ?? 0 }}:00 - {{ $timeRange[1] ?? 24 }}:00</x-field-description>
</x-field>
```

## Styling Tips

### Custom Track Height

```blade
<x-slider class="[&_[data-slot=slider-track]]:h-2" />
```

### Custom Thumb Size

```blade
<x-slider class="[&_[data-slot=slider-thumb]]:size-5" />
```

### Custom Colors

```blade
<x-slider class="[&_[data-slot=slider-range]]:bg-green-500" />
```
