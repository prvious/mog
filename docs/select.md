# Select

Custom dropdown select component with Alpine.js for enhanced UX. Provides better styling and interactivity than native `<select>` elements.

## Overview

The select component creates a custom dropdown menu with keyboard navigation, search functionality, and consistent styling. It uses Alpine.js for state management and Floating UI for positioning.

## Components

### `<x-select>`

The main select component with trigger button and dropdown menu.

**Props:**

- `size` (string, default: `'default'`): Size variant
    - `'default'`: Standard height (h-9)
    - `'sm'`: Small height (h-8)
- `align` (string, default: `'center'`): Dropdown alignment relative to trigger
    - `'center'`, `'top'`, `'bottom'`, `'left'`, `'right'`
- `placeholder` (string, default: `null`): Placeholder text when no option selected
- `options` (array, required): Array of option slots to render

**Features:**

- Custom styled dropdown with animations
- Keyboard navigation (Arrow keys, Escape, Enter)
- Click outside to close
- Focus trap when open
- Selected state indicator
- Muted placeholder styling

### `<x-select-group>`

Groups related options with an optional label.

**Props:**

- `name` (slot): Label text for the group

## Usage Examples

### Basic Select

```blade
<x-select placeholder="Select an option">
    <x-slot:options>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
    </x-slot:options>
</x-select>
```

### With Field Wrapper

```blade
<x-field>
    <x-field-label>Country</x-field-label>
    <x-select placeholder="Select country">
        <x-slot:options>
            <option value="us">United States</option>
            <option value="ca">Canada</option>
            <option value="mx">Mexico</option>
        </x-slot:options>
    </x-select>
</x-field>
```

### With Livewire

```blade
<x-select
    wire:model="selectedCountry"
    placeholder="Choose a country">
    <x-slot:options>
        <option value="us">United States</option>
        <option value="ca">Canada</option>
        <option value="uk">United Kingdom</option>
    </x-slot:options>
</x-select>
```

### Different Sizes

```blade
{{-- Small --}}
<x-select
    size="sm"
    placeholder="Small select">
    <x-slot:options>
        <option value="1">Option 1</option>
    </x-slot:options>
</x-select>

{{-- Default --}}
<x-select placeholder="Default select">
    <x-slot:options>
        <option value="1">Option 1</option>
    </x-slot:options>
</x-select>
```

### With Option Groups

```blade
<x-select placeholder="Select fruit">
    <x-slot:options>
        <x-select-group>
            <x-slot:name>Citrus</x-slot:name>
            <option value="orange">Orange</option>
            <option value="lemon">Lemon</option>
            <option value="lime">Lime</option>
        </x-select-group>

        <x-select-group>
            <x-slot:name>Berries</x-slot:name>
            <option value="strawberry">Strawberry</option>
            <option value="blueberry">Blueberry</option>
            <option value="raspberry">Raspberry</option>
        </x-select-group>
    </x-slot:options>
</x-select>
```

### Disabled Options

```blade
<x-select placeholder="Select option">
    <x-slot:options>
        <option value="1">Available</option>
        <option
            value="2"
            disabled>
            Unavailable
        </option>
        <option value="3">Available</option>
    </x-slot:options>
</x-select>
```

### With Icons

```blade
<x-select placeholder="Select status">
    <x-slot:options>
        <option value="active">
            @svg('mog-check-circle', 'text-green-500')
            Active
        </option>
        <option value="pending">
            @svg('mog-clock', 'text-yellow-500')
            Pending
        </option>
        <option value="inactive">
            @svg('mog-x-circle', 'text-red-500')
            Inactive
        </option>
    </x-slot:options>
</x-select>
```

### Complete Form Example

```blade
<x-field-group>
    <x-field>
        <x-field-label>Country</x-field-label>
        <x-select
            wire:model="country"
            placeholder="Select your country">
            <x-slot:options>
                <option value="us">United States</option>
                <option value="ca">Canada</option>
                <option value="mx">Mexico</option>
                <option value="uk">United Kingdom</option>
            </x-slot:options>
        </x-select>
        <x-field-error key="country" />
    </x-field>

    <x-field>
        <x-field-label>State/Province</x-field-label>
        <x-select
            wire:model="state"
            placeholder="Select state"
            :disabled="! $country">
            <x-slot:options>
                @foreach ($states as $code => $name)
                    <option value="{{ $code }}">{{ $name }}</option>
                @endforeach
            </x-slot:options>
        </x-select>
    </x-field>
</x-field-group>
```

## Accessibility

### Keyboard Navigation

- `Space`/`Enter`: Open dropdown
- `↑`/`↓`: Navigate options
- `Escape`: Close dropdown
- `Tab`: Move focus (closes dropdown)

### ARIA Attributes

The component includes proper ARIA attributes:

```html
role="listbox" aria-expanded="true|false" aria-controls="select-button-id" role="option" data-selected="true|false"
```

### Labels

Always provide labels for select components:

```blade
<x-field>
    <x-field-label for="country-select">Country</x-field-label>
    <x-select
        id="country-select"
        placeholder="Select">
        <x-slot:options>...</x-slot:options>
    </x-select>
</x-field>
```

## Best Practices

### Use Descriptive Placeholders

```blade
{{-- Good --}}
<x-select placeholder="Select a country">...</x-select>

{{-- Avoid --}}
<x-select placeholder="Choose">...</x-select>
```

### Provide Clear Option Labels

```blade
{{-- Good --}}
<option value="us">United States</option>

{{-- Avoid --}}
<option value="us">US</option>
```

### Group Related Options

```blade
<x-select placeholder="Select timezone">
    <x-slot:options>
        <x-select-group>
            <x-slot:name>North America</x-slot:name>
            <option value="est">Eastern Time</option>
            <option value="cst">Central Time</option>
            <option value="pst">Pacific Time</option>
        </x-select-group>
    </x-slot:options>
</x-select>
```

### Handle Loading States

```blade
<x-select
    placeholder="{{ $loading ? 'Loading...' : 'Select option' }}"
    :disabled="$loading">
    <x-slot:options>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </x-slot:options>
</x-select>
```

## Technical Details

### Alpine.js State

The component uses Alpine.js for state management:

```javascript
x-data="{
    open: false,
    placeholder: 'Select...',
    value: null,
    selectedIndex: null,
}"
```

### Floating UI Positioning

Dropdown positioning uses Alpine's `x-anchor` directive (Floating UI):

```html
x-anchor.center.offset.5="$refs.selectTrigger"
```

### Transitions

Smooth open/close animations:

```html
x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="scale-95 transform opacity-0" x-transition:enter-end="scale-100 transform
opacity-100"
```

### Click Outside

Automatically closes when clicking outside:

```html
x-on:click.outside="close($refs.selectTrigger)"
```

## Related Components

- [Field](./field.md) - Form field layouts
- [Radio Group](./radio-group.md) - Single selection with radio buttons
- [Input](./input.md) - Text input controls

## Common Patterns

### Country Selector

```blade
<x-field>
    <x-field-label>Country</x-field-label>
    <x-select
        wire:model="country"
        placeholder="Select country">
        <x-slot:options>
            @foreach (countries() as $code => $name)
                <option value="{{ $code }}">
                    {{ $name }}
                </option>
            @endforeach
        </x-slot:options>
    </x-select>
</x-field>
```

### Status Selector

```blade
<x-select
    wire:model="status"
    placeholder="Filter by status">
    <x-slot:options>
        <option value="all">All Statuses</option>
        <option value="active">Active</option>
        <option value="pending">Pending</option>
        <option value="inactive">Inactive</option>
    </x-slot:options>
</x-select>
```

### Dynamic Options

```blade
<x-select
    wire:model="category"
    placeholder="Select category">
    <x-slot:options>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </x-slot:options>
</x-select>
```
