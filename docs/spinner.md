# Spinner

The Spinner component provides an animated loading indicator using rotating icons. It's commonly used to indicate loading states, async operations, and background processes.

## Overview

Spinners give users visual feedback that a process is running. The Mog spinner component is a lightweight wrapper around SVG icons with automatic rotation animation and proper accessibility attributes.

### When to Use

- **Button loading states**: Automatically shown by the Button component during Livewire actions
- **Page loading**: Indicate content is being fetched or processed
- **Async operations**: Show progress during background tasks
- **Form submissions**: Provide feedback during form processing

## Props

### `icon`

**Type:** `string`
**Default:** `'lucide-loader-circle'`

The icon to use for the spinner animation. Can be any icon from your icon set that looks good when rotating.

**Common spinner icons:**

- `lucide-loader-circle` (default) - Circular loading indicator
- `lucide-loader-2` - Alternative circular loader
- `lucide-rotate-cw` - Clockwise rotation arrow

## Features

### Automatic Animation

The spinner automatically rotates using CSS animations:

- Continuous rotation animation
- Smooth 60fps performance
- No JavaScript required for animation

### Accessibility

- Includes `role="status"` for screen readers
- Has `aria-label="Loading"` by default
- Announces loading state to assistive technologies

### Sizing

The spinner inherits sizing from its parent context:

- Default size is `size-4` (16px)
- Can be customized with Tailwind size classes
- Automatically sized in button loading states

## Usage Examples

### Basic Spinner

```blade
<x-spinner />
```

### Custom Size

```blade
{{-- Small spinner --}}
<x-spinner class="size-3" />

{{-- Default spinner --}}
<x-spinner class="size-4" />

{{-- Medium spinner --}}
<x-spinner class="size-6" />

{{-- Large spinner --}}
<x-spinner class="size-8" />

{{-- Extra large spinner --}}
<x-spinner class="size-12" />
```

### Custom Icon

```blade
{{-- Alternative loader icon --}}
<x-spinner icon="lucide-loader-2" />

{{-- Rotate arrow icon --}}
<x-spinner icon="lucide-rotate-cw" />

{{-- Custom icon --}}
<x-spinner icon="your-custom-spinner-icon" />
```

### Custom Colors

```blade
{{-- Primary color --}}
<x-spinner class="text-primary" />

{{-- Muted color --}}
<x-spinner class="text-muted-foreground" />

{{-- White spinner (for dark backgrounds) --}}
<x-spinner class="text-white" />

{{-- Destructive color --}}
<x-spinner class="text-destructive" />
```

### Inline with Text

```blade
<div class="flex items-center gap-2">
    <x-spinner />
    <span>Loading content...</span>
</div>

<p class="text-muted-foreground flex items-center gap-2">
    <x-spinner class="size-3" />
    <span>Processing...</span>
</p>
```

### Centered Spinner

```blade
{{-- Center in container --}}
<div class="flex items-center justify-center p-12">
    <x-spinner class="size-8" />
</div>

{{-- Full page loading --}}
<div class="flex min-h-screen items-center justify-center">
    <div class="flex flex-col items-center gap-4">
        <x-spinner class="size-12" />
        <p class="text-muted-foreground">Loading application...</p>
    </div>
</div>
```

### In Buttons (Manual)

```blade
{{-- Button with spinner --}}
<x-button disabled>
    <x-spinner class="size-4" />
    Loading...
</x-button>

{{-- Icon button with spinner --}}
<x-button
    size="icon"
    disabled>
    <x-spinner />
</x-button>
```

**Note:** The Button component automatically shows a spinner during Livewire actions, so manual spinner usage in buttons is rarely needed.

### Loading Overlays

```blade
{{-- Card with loading overlay --}}
<div class="relative">
    <x-card>
        <x-card-content>
            <!-- Card content -->
        </x-card-content>
    </x-card>

    @if ($loading)
        <div class="bg-background/80 absolute inset-0 flex items-center justify-center backdrop-blur-sm">
            <x-spinner class="size-8" />
        </div>
    @endif
</div>
```

### Conditional Loading

```blade
@if ($loading)
    <div class="flex items-center justify-center py-12">
        <x-spinner class="size-8" />
    </div>
@else
    <div>
        <!-- Content -->
    </div>
@endif
```

### Livewire Loading States

```blade
<div>
    {{-- Show spinner while Livewire action runs --}}
    <div
        wire:loading
        class="flex items-center gap-2">
        <x-spinner />
        <span>Loading...</span>
    </div>

    {{-- Content hidden during loading --}}
    <div wire:loading.remove>
        <x-button wire:click="fetchData">Load Data</x-button>
    </div>
</div>

{{-- Target specific action --}}
<div>
    <x-button wire:click="save">Save</x-button>

    <div
        wire:loading
        wire:target="save"
        class="flex items-center gap-2">
        <x-spinner />
        <span>Saving...</span>
    </div>
</div>
```

### Loading States with Different Sizes

```blade
<div class="flex flex-col gap-6">
    {{-- Small loading state --}}
    <div class="flex items-center gap-2 text-sm">
        <x-spinner class="size-3" />
        <span>Processing request...</span>
    </div>

    {{-- Default loading state --}}
    <div class="flex items-center gap-2">
        <x-spinner class="size-4" />
        <span>Loading data...</span>
    </div>

    {{-- Large loading state --}}
    <div class="flex items-center gap-3">
        <x-spinner class="size-6" />
        <span class="text-lg">Uploading files...</span>
    </div>
</div>
```

### Loading Cards

```blade
<x-card>
    <x-card-content class="flex items-center justify-center py-12">
        <div class="flex flex-col items-center gap-4">
            <x-spinner class="size-10" />
            <div class="text-center">
                <p class="font-medium">Loading Dashboard</p>
                <p class="text-muted-foreground text-sm">Please wait while we fetch your data</p>
            </div>
        </div>
    </x-card-content>
</x-card>
```

### Table Loading States

```blade
<x-table>
    <thead>
        <tr>
            <x-th>Name</x-th>
            <x-th>Email</x-th>
            <x-th>Status</x-th>
        </tr>
    </thead>
    <tbody>
        @if ($loading)
            <tr>
                <td
                    colspan="3"
                    class="py-12 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <x-spinner />
                        <span>Loading users...</span>
                    </div>
                </td>
            </tr>
        @else
            @foreach ($users as $user)
                <x-tr>
                    <x-td>{{ $user->name }}</x-td>
                    <x-td>{{ $user->email }}</x-td>
                    <x-td>{{ $user->status }}</x-td>
                </x-tr>
            @endforeach
        @endif
    </tbody>
</x-table>
```

## Accessibility

### ARIA Attributes

The spinner automatically includes proper ARIA attributes:

```blade
{{-- Automatically includes role="status" and aria-label="Loading" --}}
<x-spinner />

{{-- Custom aria-label --}}
<x-spinner aria-label="Processing payment" />

{{-- With assistive text --}}
<div>
    <x-spinner aria-describedby="loading-message" />
    <span
        id="loading-message"
        class="sr-only">
        Loading your dashboard data, please wait...
    </span>
</div>
```

### Screen Reader Announcements

```blade
{{-- Announce state change --}}
<div
    role="status"
    aria-live="polite">
    @if ($loading)
        <x-spinner />
        <span class="sr-only">Loading data...</span>
    @endif
</div>
```

## Best Practices

### When to Show Spinners

**Do:**

- Show spinners for operations taking longer than 1 second
- Use small spinners for inline operations
- Use larger spinners for full-page loading
- Combine with descriptive text for clarity

**Don't:**

- Show spinners for instant operations (< 1 second)
- Use spinners alone without context for long operations
- Overuse spinners - consider skeleton loading for content

### Sizing Guidelines

- **`size-3` (12px)**: Inline text, small buttons, compact UIs
- **`size-4` (16px)**: Default size, regular buttons, forms
- **`size-6` (24px)**: Section loading, card loading
- **`size-8` (32px)**: Page loading, primary actions
- **`size-12` (48px)**: Full page loading, splash screens

### Color Choices

```blade
{{-- Good: Visible on background --}}
<div class="bg-white">
    <x-spinner class="text-primary" />
</div>

<div class="bg-primary">
    <x-spinner class="text-white" />
</div>

{{-- Good: Contextual colors --}}
<x-button
    variant="destructive"
    disabled>
    <x-spinner class="text-white" />
    Deleting...
</x-button>
```

### Progressive Enhancement

```blade
{{-- Provide fallback message --}}
<div wire:loading>
    <x-spinner />
    <noscript>Loading...</noscript>
</div>

{{-- Graceful degradation --}}
@if ($loading)
    <div class="flex items-center gap-2">
        <x-spinner />
        <span>Processing...</span>
    </div>
@endif
```

## Technical Details

### Animation

The spinner uses CSS animation for smooth rotation:

```css
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
```

### Performance

- No JavaScript required for animation
- Hardware-accelerated CSS transforms
- Minimal DOM footprint
- Scales without quality loss (SVG)

### Dark Mode

The spinner inherits color from its parent context, automatically adapting to dark mode:

```blade
{{-- Automatically adapts to dark mode --}}
<x-spinner class="text-foreground" />
```

## Related Components

- [Button](./button.md) - Automatically includes spinner for loading states
- [Skeleton](./skeleton.md) - Alternative loading placeholder for content
- [Empty](./empty.md) - Empty state component for when no data exists

## Common Patterns

### Async Button Action

```blade
<x-button wire:click="processData">
    {{-- Spinner shown automatically during action --}}
    Process Data
</x-button>
```

### Multi-Step Loading

```blade
<div class="flex flex-col gap-4">
    @if ($step === 'uploading')
        <div class="flex items-center gap-2">
            <x-spinner />
            <span>Uploading files...</span>
        </div>
    @elseif ($step === 'processing')
        <div class="flex items-center gap-2">
            <x-spinner />
            <span>Processing images...</span>
        </div>
    @elseif ($step === 'finalizing')
        <div class="flex items-center gap-2">
            <x-spinner />
            <span>Finalizing...</span>
        </div>
    @endif
</div>
```

### Search Loading

```blade
<div>
    <x-input
        wire:model.live="search"
        placeholder="Search..." />

    <div
        wire:loading
        wire:target="search"
        class="mt-2 flex items-center gap-2">
        <x-spinner class="size-3" />
        <span class="text-muted-foreground text-sm">Searching...</span>
    </div>
</div>
```
