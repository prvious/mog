# Tooltip

The Tooltip component provides contextual information in a small popup that appears when hovering over or focusing on an element. It uses floating-ui for intelligent positioning and automatically adjusts to stay within the viewport.

## Overview

Tooltips display helpful information when users hover over or focus on UI elements. They're perfect for providing additional context without cluttering the interface.

### When to Use

- **Icon buttons**: Explain what icon-only buttons do
- **Abbreviations**: Provide full text for shortened labels
- **Disabled elements**: Explain why an element is disabled
- **Additional context**: Provide helpful hints or explanations
- **Keyboard shortcuts**: Show available shortcuts for actions

## Props

### `trigger`

**Required**
**Type:** `Slot`

The element that triggers the tooltip (the element users hover over or focus on).

### `content`

**Required**
**Type:** `Slot`

The tooltip content to display.

### `align`

**Type:** `string`
**Default:** `'top'`
**Options:** `'top'`, `'top-start'`, `'top-end'`, `'bottom'`, `'bottom-start'`, `'bottom-end'`, `'left'`, `'left-start'`, `'left-end'`, `'right'`, `'right-start'`, `'right-end'`

Controls the position of the tooltip relative to the trigger element.

### `offset`

**Type:** `number`
**Default:** `7`

Distance in pixels between the tooltip and the trigger element.

### `open`

**Type:** `boolean`
**Default:** `false`

Controls the tooltip's visibility state. Can be bound with `x-model` for manual control.

## Features

### Smart Positioning

Uses floating-ui to automatically position tooltips:

- Stays within viewport bounds
- Flips to opposite side when needed
- Adjusts alignment to prevent overflow

### Multiple Interactions

Tooltips respond to:

- **Mouse hover**: Shows on `pointermove`
- **Focus**: Shows on keyboard focus
- **Touch**: Ignores touch events to prevent mobile issues

### Smooth Transitions

Includes fade and scale animations:

- Fade in/out
- Slight scale effect
- 200ms enter, 150ms leave

## Usage Examples

### Basic Tooltip

```blade
<x-tooltip>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-help-circle')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>Get help and support</x-slot:content>
</x-tooltip>
```

### Icon Button Tooltips

```blade
{{-- Delete button --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-trash-2')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>Delete item</x-slot:content>
</x-tooltip>

{{-- Edit button --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-pencil')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>Edit</x-slot:content>
</x-tooltip>

{{-- Share button --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-share-2')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>Share</x-slot:content>
</x-tooltip>
```

### Positioning Options

```blade
{{-- Top (default) --}}
<x-tooltip align="top">
    <x-slot:trigger>
        <x-button>Hover me</x-button>
    </x-slot:trigger>
    <x-slot:content>Tooltip above</x-slot:content>
</x-tooltip>

{{-- Bottom --}}
<x-tooltip align="bottom">
    <x-slot:trigger>
        <x-button>Hover me</x-button>
    </x-slot:trigger>
    <x-slot:content>Tooltip below</x-slot:content>
</x-tooltip>

{{-- Left --}}
<x-tooltip align="left">
    <x-slot:trigger>
        <x-button>Hover me</x-button>
    </x-slot:trigger>
    <x-slot:content>Tooltip on left</x-slot:content>
</x-tooltip>

{{-- Right --}}
<x-tooltip align="right">
    <x-slot:trigger>
        <x-button>Hover me</x-button>
    </x-slot:trigger>
    <x-slot:content>Tooltip on right</x-slot:content>
</x-tooltip>
```

### Alignment Variations

```blade
{{-- Top start --}}
<x-tooltip align="top-start">
    <x-slot:trigger>
        <x-button>Top Start</x-button>
    </x-slot:trigger>
    <x-slot:content>Aligned to left edge</x-slot:content>
</x-tooltip>

{{-- Top end --}}
<x-tooltip align="top-end">
    <x-slot:trigger>
        <x-button>Top End</x-button>
    </x-slot:trigger>
    <x-slot:content>Aligned to right edge</x-slot:content>
</x-tooltip>
```

### With Keyboard Shortcuts

```blade
<x-tooltip>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-save')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        Save
        <kbd class="ml-2 rounded bg-black/20 px-1 py-0.5 text-xs">⌘S</kbd>
    </x-slot:content>
</x-tooltip>
```

### Disabled Element Tooltips

```blade
<x-tooltip>
    <x-slot:trigger>
        <x-button disabled>Submit</x-button>
    </x-slot:trigger>

    <x-slot:content>Complete all required fields to submit</x-slot:content>
</x-tooltip>
```

### Multi-Line Tooltips

```blade
<x-tooltip>
    <x-slot:trigger>
        <x-badge variant="outline">
            @svg('lucide-info', 'size-3')
            Beta
        </x-badge>
    </x-slot:trigger>

    <x-slot:content>This feature is currently in beta testing. Some functionality may change.</x-slot:content>
</x-tooltip>
```

### Table Action Tooltips

```blade
<x-table>
    <tbody>
        <x-tr>
            <x-td>John Doe</x-td>
            <x-td>
                john
                @example.com
            </x-td>
            <x-td>
                <div class="flex gap-1">
                    <x-tooltip>
                        <x-slot:trigger>
                            <x-button
                                variant="ghost"
                                size="icon-sm">
                                @svg('lucide-pencil')
                            </x-button>
                        </x-slot:trigger>
                        <x-slot:content>Edit user</x-slot:content>
                    </x-tooltip>

                    <x-tooltip>
                        <x-slot:trigger>
                            <x-button
                                variant="ghost"
                                size="icon-sm">
                                @svg('lucide-trash-2')
                            </x-button>
                        </x-slot:trigger>
                        <x-slot:content>Delete user</x-slot:content>
                    </x-tooltip>
                </div>
            </x-td>
        </x-tr>
    </tbody>
</x-table>
```

### With Custom Offset

```blade
<x-tooltip :offset="12">
    <x-slot:trigger>
        <x-button>Hover me</x-button>
    </x-slot:trigger>
    <x-slot:content>Tooltip with more spacing</x-slot:content>
</x-tooltip>
```

## Accessibility

### Focus Behavior

Tooltips automatically show on focus for keyboard users:

```blade
{{-- Accessible to keyboard navigation --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button>Accessible Button</x-button>
    </x-slot:trigger>
    <x-slot:content>Shown on focus or hover</x-slot:content>
</x-tooltip>
```

### ARIA Attributes

```blade
{{-- Use aria-label on trigger if tooltip provides essential info --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button
            size="icon"
            aria-label="Delete item">
            @svg('lucide-trash-2')
        </x-button>
    </x-slot:trigger>
    <x-slot:content>Delete</x-slot:content>
</x-tooltip>
```

## Best Practices

### Keep Content Concise

```blade
{{-- Good: Short, helpful --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button size="icon">@svg('lucide-save')</x-button>
    </x-slot:trigger>
    <x-slot:content>Save changes</x-slot:content>
</x-tooltip>

{{-- Avoid: Too much text --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button size="icon">@svg('lucide-save')</x-button>
    </x-slot:trigger>
    <x-slot:content>
        Click this button to save all of your changes to the database. Make sure you've reviewed everything before saving.
    </x-slot:content>
</x-tooltip>
```

### Don't Hide Essential Information

```blade
{{-- Good: Tooltip adds context --}}
<x-button>Delete</x-button>

<x-tooltip>
    <x-slot:trigger>
        <x-button>Delete</x-button>
    </x-slot:trigger>
    <x-slot:content>Permanently removes this item</x-slot:content>
</x-tooltip>

{{-- Avoid: Essential info only in tooltip --}}
<x-tooltip>
    <x-slot:trigger>
        <x-button size="icon">
            @svg('lucide-x')
        </x-button>
    </x-slot:trigger>
    <x-slot:content>Close and lose all changes</x-slot:content>
</x-tooltip>
```

## Related Components

- [Button](./button.md) - Often used as tooltip triggers
- [Badge](./badge.md) - Can be enhanced with tooltips
- [Popover](./popover.md) - For more complex interactive content

## Common Patterns

### Icon-Only Toolbar

```blade
<div class="flex items-center gap-1 rounded-lg border p-1">
    <x-tooltip>
        <x-slot:trigger>
            <x-button
                variant="ghost"
                size="icon-sm">
                @svg('lucide-bold')
            </x-button>
        </x-slot:trigger>
        <x-slot:content>Bold</x-slot:content>
    </x-tooltip>

    <x-tooltip>
        <x-slot:trigger>
            <x-button
                variant="ghost"
                size="icon-sm">
                @svg('lucide-italic')
            </x-button>
        </x-slot:trigger>
        <x-slot:content>Italic</x-slot:content>
    </x-tooltip>

    <x-tooltip>
        <x-slot:trigger>
            <x-button
                variant="ghost"
                size="icon-sm">
                @svg('lucide-underline')
            </x-button>
        </x-slot:trigger>
        <x-slot:content>Underline</x-slot:content>
    </x-tooltip>
</div>
```

### Status Indicators

```blade
<div class="flex items-center gap-2">
    <span class="font-medium">Server Status:</span>

    <x-tooltip>
        <x-slot:trigger>
            <div class="flex items-center gap-2">
                <div class="size-2 rounded-full bg-green-500"></div>
                <span>Online</span>
            </div>
        </x-slot:trigger>
        <x-slot:content>
            All systems operational
            <br />
            Uptime: 99.9%
        </x-slot:content>
    </x-tooltip>
</div>
```
