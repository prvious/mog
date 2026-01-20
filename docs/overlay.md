# Overlay

The Overlay component is a foundational system component that provides three critical pieces of infrastructure for Mog's modal and notification systems: the backdrop layer for dialogs and slide-overs, the global dialog container, and the global toaster for notifications.

## Overview

The Overlay component is responsible for:

1. **Modal Backdrop**: The semi-transparent overlay layer displayed behind dialogs and slide-overs, with scroll locking and click-to-close behavior
2. **Dialog Container**: The global `#mog-dialog-container` element where all dialogs and slide-overs are rendered
3. **Toaster System**: The persistent `mog::toaster` placeholder for displaying toast notifications

It's automatically included in your layout via the `@mog` directive and works in conjunction with the global dialog and notification management systems.

### When to Use

The Overlay component is automatically used by:

- **Dialog**: Modal dialogs
- **Slide-over**: Slide-in panels
- Any custom modal components

You typically don't use this component directly - it's included once in your layout and managed automatically by the dialog system.

## Features

### Global Infrastructure

The overlay provides three singleton components:

- **Overlay Backdrop**: Included once in your layout via `@mog` directive, shared by all dialogs and slide-overs
- **Dialog Container**: A single `#mog-dialog-container` element where all modal components teleport
- **Toaster System**: A persistent `@persist('mog::toaster')` wrapper for the notification toaster component

All three are managed by the global `$mog.dialog` and `$mog.toast` systems

### Scroll Locking

Prevents background scrolling:

- Adds `data-scroll-locked="true"` to `<body>`
- Disables scrolling behind the overlay
- Removes attribute when all dialogs close

### Click-to-Close

Clicking the overlay closes the topmost dialog:

- Automatically closes the most recent dialog
- Maintains dialog stack order
- Works with keyboard (Escape) dismissal

### Smooth Animations

Fade in/out transitions:

- 300ms fade-in on open
- 300ms fade-out on close
- Smooth opacity transitions
- Synchronized with dialog animations

### Dark/Light Adaptation

Automatically adapts to theme:

- Light mode: `bg-black/75`
- Dark mode: `bg-black/85`
- Semi-transparent for context visibility

## Setup

### Layout Integration

The overlay is automatically included when you use the `@mog` directive in your layout:

```blade
{{-- resources/views/components/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Head content -->
    </head>
    <body>
        {{-- Your page content --}}
        {{ $slot }}

        {{-- Includes overlay, dialog container, and toaster --}}
        @mog
    </body>
</html>
```

The `@mog` directive renders:

```blade
<x-mog::overlay />
```

Which outputs three essential components:

1. **Overlay Backdrop**: The semi-transparent backdrop with Alpine.js state management for dialog open/close behavior
2. **Dialog Container**: The `#mog-dialog-container` div where dialogs and slide-overs teleport their content
3. **Toaster**: The `<x-mog::toaster />` component wrapped in `@persist('mog::toaster')` for displaying toast notifications across Livewire page navigations

### Manual Inclusion

If you're not using the `@mog` directive, include it manually:

```blade
<body>
    {{-- Your content --}}

    {{-- Include overlay at end of body --}}
    <x-mog::overlay />
</body>
```

## Technical Details

### Component Structure

The overlay consists of three parts:

```blade
{{-- 1. Overlay backdrop --}}
<div
    x-cloak
    x-data="{ overlay: false, top: undefined, ... }"
    x-show="overlay"
    x-on:click="$mog.dialog.close(top)"
    x-on:mog::overlay-open.document="openOverlay($event.detail.dialog)"
    x-on:mog::overlay-close.document="closeOverlay()"
    class="z-1000 fixed inset-0 bg-black/75 dark:bg-black/85"></div>

{{-- 2. Dialog container --}}
<div
    id="mog-dialog-container"
    class="contents"></div>

{{-- 3. Toaster system --}}
@persist('mog::toaster')
    <x-mog::toaster />
@endpersist
```

### State Management

```javascript
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
    }
}"
```

### Event Listeners

The overlay listens for dialog events:

```javascript
x-on:mog::overlay-open.document="openOverlay($event.detail.dialog)"
x-on:mog::overlay-close.document="closeOverlay()"
```

### Z-Index

The overlay uses a high z-index to ensure it appears above page content:

```css
.z-1000 {
    z-index: 1000;
}
```

Dialogs render in `#mog-dialog-container` which appears after the overlay in DOM order, ensuring dialogs appear above the backdrop without needing higher z-index values.

## Component Responsibilities

### 1. Overlay Backdrop

The first component is the darkened backdrop layer:

- **Purpose**: Provides visual separation between modal content and page content
- **Behavior**: Fades in/out with smooth transitions, locks scroll, closes topmost dialog on click
- **Styling**: Semi-transparent black (`bg-black/75` in light mode, `bg-black/85` in dark mode)
- **Z-index**: Uses `z-1000` to appear above page content

### 2. Dialog Container

The second component is the global dialog mounting point:

- **Purpose**: Provides a container where all dialogs and slide-overs render their content
- **Element**: `<div id="mog-dialog-container" class="contents"></div>`
- **Location**: Placed after the overlay in DOM order so dialogs appear above the backdrop
- **CSS**: Uses `display: contents` so it doesn't affect layout - children render as if they were direct children of the parent
- **Usage**: Dialog components use Alpine.js `x-teleport="#mog-dialog-container"` to render into this container

### 3. Toaster System

The third component is the global notification toaster:

- **Purpose**: Displays toast notifications that persist across Livewire page navigations
- **Component**: `<x-mog::toaster />` wrapped in `@persist('mog::toaster')`
- **Persistence**: The `@persist` directive ensures toasts remain visible during Livewire navigation
- **Integration**: Works with the global `$mog.toast` API for displaying notifications
- **Position**: Fixed positioning (typically top-right corner) above all other content

## Dialog Integration

### How Dialogs Use the Overlay

When a dialog opens:

1. Dialog calls `$mog.dialog.open(dialogId)`
2. Dialog manager dispatches `mog::overlay-open` event
3. Overlay shows backdrop and locks scroll
4. Dialog content renders in container

When a dialog closes:

1. Dialog calls `$mog.dialog.close(dialogId)`
2. Dialog manager dispatches `mog::overlay-close` event
3. Overlay checks if any dialogs remain
4. If empty, hides backdrop and unlocks scroll

### Multiple Dialogs

The overlay supports stacked dialogs:

```javascript
// Track topmost dialog
this.top = dialogId

// Only hide overlay when all dialogs are closed
if ($mog.dialog.empty()) {
    this.overlay = false
}
```

## Customization

### Custom Styling

You can customize the overlay appearance:

```blade
{{-- In your app.css or Tailwind config --}}
<style>
    /* Lighter overlay */
    [data-slot="overlay"] {
        @apply bg-black/50 dark:bg-black/60;
    }

    /* Blur effect */
    [data-slot="overlay"] {
        @apply backdrop-blur-sm;
    }

    /* Custom color */
    [data-slot="overlay"] {
        @apply bg-blue-900/30 dark:bg-blue-950/50;
    }
</style>
```

### Custom Transition

Modify the transition duration:

```blade
{{-- Override in your overlay component --}}
x-transition:enter="animate-in fade-in duration-500" x-transition:leave="animate-out fade-out duration-500"
```

### Disable Click-to-Close

To prevent closing dialogs by clicking the overlay, you would need to modify the overlay component:

```blade
{{-- Not recommended, but possible --}}
<div
    x-show="overlay"
    {{-- Remove: x-on:click="$mog.dialog.close(top)" --}}
    class="..."></div>
```

## Scroll Locking

### How It Works

The overlay manages scroll locking via a data attribute:

```javascript
// When opening
document.body.setAttribute('data-scroll-locked', 'true')

// When closing (if no dialogs remain)
document.body.removeAttribute('data-scroll-locked')
```

### CSS Implementation

Add this to your global styles:

```css
/* Prevent background scrolling when modal is open */
body[data-scroll-locked] {
    overflow: hidden;
}
```

This is typically already included in Mog's base styles.

### Mobile Considerations

On mobile devices, scroll locking prevents:

- Scrolling the page behind the dialog
- Rubber-band/bounce effects
- Address bar showing/hiding

## Accessibility

### Focus Management

The overlay works with dialog focus trapping:

- Overlay visible → Focus trapped in dialog
- Tab navigation stays within dialog
- Escape closes dialog and returns focus

### Screen Reader Behavior

- Overlay doesn't receive focus
- Screen readers ignore the overlay element
- Focus stays on dialog content

### Keyboard Navigation

- **Escape**: Closes topmost dialog (via dialog, not overlay)
- **Tab**: Navigates within dialog (not overlay)
- **Click**: Overlay click closes dialog

## Best Practices

### Always Use Global Instance

```blade
{{-- Good: Single overlay via @mog directive --}}
<body>
    {{ $slot }}
    @mog
</body>

{{-- Avoid: Multiple overlay instances --}}
<body>
    <x-mog::overlay />
    <x-mog::overlay />
    <!-- Don't do this -->
</body>
```

### Don't Modify Core Behavior

The overlay is designed to work with the dialog system:

```blade
{{-- Good: Let the dialog system manage the overlay --}}
<x-dialog>...</x-dialog>

{{-- Avoid: Manually controlling overlay state --}}
<div x-data="{ myOverlay: true }">
    <!-- Custom overlay implementation -->
</div>
```

### Place at End of Body

```blade
{{-- Good: Overlay at end of body --}}
<body>
    <header>...</header>
    <main>...</main>
    <footer>...</footer>

    @mog
    <!-- Overlay + dialog container -->
</body>
```

## Troubleshooting

### Overlay Not Appearing

**Problem**: Dialogs open but no backdrop shows

**Solutions**:

- Ensure `@mog` directive is in your layout
- Check that `x-cloak` styles are loaded
- Verify Alpine.js is initialized

### Scroll Not Locking

**Problem**: Can still scroll background when dialog is open

**Solutions**:

- Add `body[data-scroll-locked] { overflow: hidden; }` to CSS
- Check that JavaScript is enabled
- Verify no other scripts are interfering

### Multiple Overlays Appearing

**Problem**: Multiple backdrop layers stacking

**Solutions**:

- Remove duplicate `@mog` directives
- Ensure only one `<x-mog::overlay />` component
- Check for multiple layout files

### Click-to-Close Not Working

**Problem**: Clicking backdrop doesn't close dialog

**Solutions**:

- Ensure event listener is attached: `x-on:click="$mog.dialog.close(top)"`
- Check that `$mog.dialog` is available
- Verify dialog ID is correctly tracked

## Related Components

- [Dialog](./dialog.md) - Modal dialogs that use the overlay
- [Slide-over](./slide-over.md) - Side panels that use the overlay
- [Toaster](./toaster.md) - Notification system (included with overlay)

## Technical Reference

### Component Props

The overlay component doesn't accept props - it's a self-contained system component.

### Global Variables

```javascript
// Dialog stack (managed by $mog.dialog)
window.Mog.dialogs = []

// Dialog manager methods
window.Mog.dialog = {
    open(id),
    close(id),
    closeAll(),
    empty()
}
```

### Custom Events

```javascript
// Dispatched when dialog opens
window.dispatchEvent(
    new CustomEvent('mog::overlay-open', {
        detail: { dialog: dialogId },
    }),
)

// Dispatched when dialog closes
window.dispatchEvent(new CustomEvent('mog::overlay-close'))
```

### Data Attributes

```html
<!-- On body element when modal is open -->
<body data-scroll-locked="true">
    <!-- On overlay element for state -->
    <div data-state="open"><!-- or "closed" --></div>
</body>
```

## Advanced Usage

### Custom Dialog Container

If you need a custom container location:

```blade
{{-- Your custom location --}}
<div id="custom-dialog-container"></div>

{{-- Then in your dialog component --}}
<template x-teleport="#custom-dialog-container">
    <!-- Dialog content -->
</template>
```

### Conditional Overlay

To conditionally render the overlay (not recommended):

```blade
@if (config('app.modals_enabled'))
    <x-mog::overlay />
@endif
```

### Programmatic Control

Access the overlay state:

```javascript
// Check if overlay is visible
Alpine.store('overlay')?.overlay

// Manually trigger overlay (not recommended)
Alpine.evaluate(document.querySelector('[x-data]'), 'openOverlay("my-dialog-id")')
```
