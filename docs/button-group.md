# Button Group

Button Group components allow you to visually connect multiple related buttons, creating a cohesive set of actions. The group removes internal borders and border radius to make buttons appear as a single unit.

## Overview

Button groups are useful when you have multiple related actions that should be visually grouped together. They provide better visual hierarchy and organization, especially for toolbars, toggle groups, or segmented controls.

### When to Use Button Groups

- **Related actions**: Group buttons that perform related operations (e.g., text formatting, view modes)
- **Segmented controls**: Create toggle-style controls where one option is selected
- **Toolbars**: Organize toolbar actions into logical groups
- **Split buttons**: Combine a primary action with additional options

## Components

### `<x-button-group>`

The main wrapper component that groups buttons together.

**Props:**

- `orientation` (string, default: `'horizontal'`): Layout direction
    - `'horizontal'`: Buttons arranged left to right (default)
    - `'vertical'`: Buttons arranged top to bottom

**Features:**

- Removes borders between adjacent buttons
- Removes border radius on internal edges
- Handles focus states properly (focused button appears above siblings)
- Supports nested button groups with gap spacing
- Compatible with select components

**Example:**

```blade
<x-button-group>
    <x-button variant="outline">Left</x-button>
    <x-button variant="outline">Center</x-button>
    <x-button variant="outline">Right</x-button>
</x-button-group>
```

---

### `<x-button-group-text>`

A text label or display element within a button group.

**Props:**

- `tag` (string, default: `'div'`): HTML element to render as

**Features:**

- Styled to match button height and appearance
- Includes border and background matching button style
- Automatically sizes icons
- Can be used for labels, counters, or status indicators

**Example:**

```blade
<x-button-group>
    <x-button-group-text>Format:</x-button-group-text>
    <x-button variant="outline">Bold</x-button>
    <x-button variant="outline">Italic</x-button>
</x-button-group>
```

---

### `<x-button-separator>`

A visual separator between buttons or button groups.

**Props:**

- `orientation` (string, default: `'vertical'`): Separator direction
    - `'vertical'`: Vertical line separator (for horizontal groups)
    - `'horizontal'`: Horizontal line separator (for vertical groups)

**Features:**

- Extends full height (vertical) or width (horizontal) of the group
- Uses subtle border color
- Zero margin for tight spacing

**Example:**

```blade
<x-button-group>
    <x-button variant="outline">Cut</x-button>
    <x-button variant="outline">Copy</x-button>
    <x-button variant="outline">Paste</x-button>

    <x-button-separator />

    <x-button variant="outline">Undo</x-button>
    <x-button variant="outline">Redo</x-button>
</x-button-group>
```

## Usage Examples

### Basic Button Group

```blade
<x-button-group>
    <x-button variant="outline">Previous</x-button>
    <x-button variant="outline">Next</x-button>
</x-button-group>
```

### Button Group with Separators

```blade
<x-button-group>
    <x-button variant="outline">
        @svg('mog-bold')
    </x-button>
    <x-button variant="outline">
        @svg('mog-italic')
    </x-button>
    <x-button variant="outline">
        @svg('mog-underline')
    </x-button>

    <x-button-separator />

    <x-button variant="outline">
        @svg('mog-align-left')
    </x-button>
    <x-button variant="outline">
        @svg('mog-align-center')
    </x-button>
    <x-button variant="outline">
        @svg('mog-align-right')
    </x-button>
</x-button-group>
```

### Button Group with Text Labels

```blade
<x-button-group>
    <x-button-group-text>
        @svg('mog-eye')
        View:
    </x-button-group-text>
    <x-button variant="outline">Grid</x-button>
    <x-button variant="outline">List</x-button>
</x-button-group>
```

### Vertical Button Group

```blade
<x-button-group orientation="vertical">
    <x-button variant="outline">Top</x-button>
    <x-button variant="outline">Middle</x-button>
    <x-button variant="outline">Bottom</x-button>
</x-button-group>
```

### Mixed Button Variants in Group

```blade
{{-- Primary action with secondary options --}}
<x-button-group>
    <x-button>Save</x-button>
    <x-button variant="outline">
        @svg('mog-chevron-down')
    </x-button>
</x-button-group>

{{-- All outline buttons --}}
<x-button-group>
    <x-button variant="outline">Day</x-button>
    <x-button variant="outline">Week</x-button>
    <x-button variant="outline">Month</x-button>
    <x-button variant="outline">Year</x-button>
</x-button-group>
```

### Toolbar with Multiple Groups

```blade
<div class="flex gap-2">
    <x-button-group>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-bold')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-italic')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-underline')
        </x-button>
    </x-button-group>

    <x-button-group>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-list')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-list-ordered')
        </x-button>
    </x-button-group>

    <x-button-group>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-link')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-image')
        </x-button>
    </x-button-group>
</div>
```

### With Icons and Text

```blade
<x-button-group>
    <x-button variant="outline">
        @svg('mog-download')
        Download
    </x-button>
    <x-button variant="outline">
        @svg('mog-share')
        Share
    </x-button>
    <x-button variant="outline">
        @svg('mog-printer')
        Print
    </x-button>
</x-button-group>
```

### Toggle Group with Active State

```blade
<x-button-group>
    <x-button
        variant="outline"
        data-state="active">
        Grid
    </x-button>
    <x-button variant="outline">List</x-button>
</x-button-group>
```

### Pagination-Style Group

```blade
<x-button-group>
    <x-button variant="outline">
        @svg('mog-chevron-left')
    </x-button>

    <x-button-group-text>Page 1 of 10</x-button-group-text>

    <x-button variant="outline">
        @svg('mog-chevron-right')
    </x-button>
</x-button-group>
```

### With Dropdown/Select

```blade
<x-button-group>
    <x-button variant="outline">
        @svg('mog-filter')
        Filter
    </x-button>

    <x-select name="filter_type">
        <option>All Items</option>
        <option>Active</option>
        <option>Archived</option>
    </x-select>
</x-button-group>
```

## Best Practices

### Visual Cohesion

Use the same `variant` and `size` for all buttons in a group:

```blade
{{-- Good: Consistent styling --}}
<x-button-group>
    <x-button
        variant="outline"
        size="sm">
        One
    </x-button>
    <x-button
        variant="outline"
        size="sm">
        Two
    </x-button>
    <x-button
        variant="outline"
        size="sm">
        Three
    </x-button>
</x-button-group>

{{-- Avoid: Mixed variants can look inconsistent --}}
<x-button-group>
    <x-button>One</x-button>
    <x-button variant="outline">Two</x-button>
    <x-button variant="ghost">Three</x-button>
</x-button-group>
```

**Exception**: Split buttons often combine variants:

```blade
<x-button-group>
    <x-button>Primary Action</x-button>
    <x-button variant="outline">
        @svg('mog-chevron-down')
    </x-button>
</x-button-group>
```

### Grouping Related Actions

Only group buttons that are logically related:

```blade
{{-- Good: Related formatting actions --}}
<x-button-group>
    <x-button variant="outline">Bold</x-button>
    <x-button variant="outline">Italic</x-button>
</x-button-group>

{{-- Avoid: Unrelated actions --}}
<x-button-group>
    <x-button variant="outline">Save</x-button>
    <x-button variant="outline">Bold</x-button>
</x-button-group>
```

### Using Separators

Use separators to create sub-groups within a button group:

```blade
<x-button-group>
    {{-- Text formatting --}}
    <x-button variant="outline">Bold</x-button>
    <x-button variant="outline">Italic</x-button>

    <x-button-separator />

    {{-- Alignment --}}
    <x-button variant="outline">Left</x-button>
    <x-button variant="outline">Center</x-button>
    <x-button variant="outline">Right</x-button>
</x-button-group>
```

### Accessibility

Provide clear labels or ARIA attributes for icon-only buttons:

```blade
<x-button-group>
    <x-button
        variant="outline"
        aria-label="Bold">
        @svg('mog-bold')
    </x-button>
    <x-button
        variant="outline"
        aria-label="Italic">
        @svg('mog-italic')
    </x-button>
    <x-button
        variant="outline"
        aria-label="Underline">
        @svg('mog-underline')
    </x-button>
</x-button-group>
```

For toggle groups, use `role="group"` and `aria-pressed`:

```blade
<x-button-group
    role="group"
    aria-label="Text alignment">
    <x-button
        variant="outline"
        aria-pressed="true">
        Left
    </x-button>
    <x-button
        variant="outline"
        aria-pressed="false">
        Center
    </x-button>
    <x-button
        variant="outline"
        aria-pressed="false">
        Right
    </x-button>
</x-button-group>
```

### Responsive Considerations

For mobile, consider using vertical orientation or wrapping:

```blade
{{-- Desktop: horizontal, Mobile: vertical --}}
<x-button-group
    orientation="horizontal"
    class="flex-col md:flex-row">
    <x-button variant="outline">Option 1</x-button>
    <x-button variant="outline">Option 2</x-button>
    <x-button variant="outline">Option 3</x-button>
</x-button-group>
```

## Technical Details

### Focus Management

When a button in a group receives focus, it's automatically elevated above siblings using `z-index`:

```css
[&>*]:focus-visible:z-10
[&>*]:focus-visible:relative
```

This ensures the focus ring is fully visible and not clipped by adjacent buttons.

### Orientation Classes

**Horizontal** (default):

- Removes left border-radius from all but first button
- Removes right border-radius from all but last button
- Removes left border from all but first button

**Vertical**:

- Removes top border-radius from all but first button
- Removes bottom border-radius from all but last button
- Removes top border from all but first button

### Nested Groups

Button groups can contain other button groups with automatic gap spacing:

```blade
<x-button-group>
    <x-button-group>
        <x-button variant="outline">A</x-button>
        <x-button variant="outline">B</x-button>
    </x-button-group>

    <x-button-group>
        <x-button variant="outline">C</x-button>
        <x-button variant="outline">D</x-button>
    </x-button-group>
</x-button-group>
```

## Common Patterns

### Split Button

```blade
<x-button-group>
    <x-button wire:click="save">Save Changes</x-button>
    <x-button
        variant="outline"
        wire:click="showSaveOptions">
        @svg('mog-chevron-down')
    </x-button>
</x-button-group>
```

### Segmented Control

```blade
<x-button-group>
    <x-button
        variant="outline"
        wire:click="setView('day')"
        :class="$view === 'day' ? 'bg-primary/10' : ''">
        Day
    </x-button>
    <x-button
        variant="outline"
        wire:click="setView('week')"
        :class="$view === 'week' ? 'bg-primary/10' : ''">
        Week
    </x-button>
    <x-button
        variant="outline"
        wire:click="setView('month')"
        :class="$view === 'month' ? 'bg-primary/10' : ''">
        Month
    </x-button>
</x-button-group>
```

### Toolbar

```blade
<div class="flex items-center gap-4 border-b p-2">
    <x-button-group>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-undo')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-redo')
        </x-button>
    </x-button-group>

    <x-button-separator orientation="vertical" />

    <x-button-group>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-bold')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-italic')
        </x-button>
        <x-button
            variant="outline"
            size="sm">
            @svg('mog-underline')
        </x-button>
    </x-button-group>
</div>
```

### Counter Display

```blade
<x-button-group>
    <x-button
        variant="outline"
        wire:click="decrement">
        @svg('mog-minus')
    </x-button>

    <x-button-group-text>
        {{ $count }}
    </x-button-group-text>

    <x-button
        variant="outline"
        wire:click="increment">
        @svg('mog-plus')
    </x-button>
</x-button-group>
```

## Related Components

- [Button](./button.md) - Individual button component
- [Field](./field.md) - Form field layouts
- [Separator](./separator.md) - Visual separators

## Styling Tips

### Custom Widths

```blade
<x-button-group class="w-full">
    <x-button
        variant="outline"
        class="flex-1">
        Left
    </x-button>
    <x-button
        variant="outline"
        class="flex-1">
        Center
    </x-button>
    <x-button
        variant="outline"
        class="flex-1">
        Right
    </x-button>
</x-button-group>
```

### Justified Buttons

```blade
<x-button-group class="w-full">
    <x-button
        variant="outline"
        class="w-1/3">
        One
    </x-button>
    <x-button
        variant="outline"
        class="w-1/3">
        Two
    </x-button>
    <x-button
        variant="outline"
        class="w-1/3">
        Three
    </x-button>
</x-button-group>
```
