# Toaster

The Toaster component provides a toast notification system for displaying temporary messages. It includes automatic dismissal, multiple toast types, positioning options, and smooth animations powered by Alpine.js.

## Overview

Toasts are non-intrusive, temporary messages that provide feedback about an operation without interrupting the user's workflow. The Mog toaster system uses a global Alpine.js store to manage toast notifications from anywhere in your application.

### When to Use

- **Success feedback**: Confirm successful actions (save, delete, update)
- **Error notifications**: Alert users to problems (network errors, validation)
- **Info messages**: Provide helpful information or tips
- **Warning alerts**: Warn about important conditions
- **Loading states**: Show progress for long-running operations

### Toast vs Alert

- **Toast**: Temporary, auto-dismissing, appears as overlay
- **Alert**: Persistent, part of page content, remains until dismissed

## Setup

Add the toaster component to your layout (usually in `resources/views/components/layouts/app.blade.php`):

```blade
<body>
    {{-- Your page content --}}

    {{-- Add toaster at end of body --}}
    <x-toaster />
</body>
```

## Props

### `position`

**Type:** `string`
**Default:** `'bottom-right'`
**Options:** `'top-left'`, `'top-right'`, `'bottom-left'`, `'bottom-right'`

Controls where toasts appear on the screen.

### `expandByDefault`

**Type:** `boolean`
**Default:** `false`

Whether to show all toasts expanded by default or stacked.

### `visibleToasts`

**Type:** `number`
**Default:** `3`

Maximum number of toasts visible at once. Others are hidden but accessible by hovering.

### `viewportOffset`

**Type:** `string`
**Default:** `'24px'`

Distance from viewport edge on desktop.

### `mobileViewportOffset`

**Type:** `string`
**Default:** `'16px'`

Distance from viewport edge on mobile.

### `toastWidth`

**Type:** `string`
**Default:** `'356px'`

Width of each toast notification.

### `gap`

**Type:** `number`
**Default:** `14`

Gap in pixels between stacked toasts.

### `toastLifetime`

**Type:** `number`
**Default:** `4000`

Default lifetime of a toast in milliseconds (4 seconds).

### `richColors`

**Type:** `boolean`
**Default:** `false`

Use rich colors for different toast types.

## JavaScript API

Access the toast API globally via `window.Mog.toast` or `$mog.toast` in Alpine components:

### Basic Methods

```javascript
// Simple toast
$mog.toast('Your message here')

// Toast with title and description
$mog.toast('Success', {
    description: 'Your changes have been saved.',
})

// Success toast
$mog.toast.success('Operation completed')

// Error toast
$mog.toast.error('Something went wrong')

// Warning toast
$mog.toast.warning('Please review your changes')

// Info toast
$mog.toast.info('New features available')

// Loading toast
$mog.toast.loading('Processing your request...')

// Dismiss specific toast
$mog.toast.dismiss(toastId)

// Dismiss all toasts
$mog.toast.dismiss()
```

### Advanced Options

```javascript
$mog.toast('Message', {
    description: 'Additional details',
    duration: 5000, // Custom duration in ms
    position: 'top-right', // Override default position
    dismissible: true, // Can be dismissed (default: true)
    action: {
        label: 'Undo',
        onClick: (event) => {
            // Handle action
        },
    },
    cancel: {
        label: 'Cancel',
        onClick: (event) => {
            // Handle cancel
        },
    },
    onDismiss: (toast) => {
        // Called when toast is dismissed
    },
    onAutoClose: (toast) => {
        // Called when toast auto-closes
    },
})
```

## Usage Examples

### Basic Toast

```blade
<x-button wire:click="$dispatch('toast', { message: 'Hello World!' })">Show Toast</x-button>

{{-- Or in Alpine --}}
<x-button x-on:click="$mog.toast('Hello World!')">Show Toast</x-button>
```

### Toast Types

```blade
{{-- Success --}}
<x-button x-on:click="$mog.toast.success('Changes saved successfully!')">Save</x-button>

{{-- Error --}}
<x-button x-on:click="$mog.toast.error('Failed to save changes')">Error</x-button>

{{-- Warning --}}
<x-button x-on:click="$mog.toast.warning('This action cannot be undone')">Warning</x-button>

{{-- Info --}}
<x-button x-on:click="$mog.toast.info('New version available')">Info</x-button>

{{-- Loading --}}
<x-button x-on:click="$mog.toast.loading('Processing...')">Loading</x-button>
```

### With Description

```blade
<x-button
    x-on:click="
    $mog.toast.success('Profile Updated', {
        description: 'Your profile information has been saved.'
    })
">
    Update Profile
</x-button>
```

### With Actions

```blade
<x-button
    x-on:click="
    $mog.toast('File deleted', {
        action: {
            label: 'Undo',
            onClick: () => {
                console.log('Undo clicked')
                // Restore file
            }
        }
    })
">
    Delete File
</x-button>
```

### With Cancel Button

```blade
<x-button
    x-on:click="
    $mog.toast('Confirm deletion?', {
        description: 'This action cannot be undone.',
        action: {
            label: 'Delete',
            onClick: () => {
                // Perform deletion
            }
        },
        cancel: {
            label: 'Cancel',
            onClick: () => {
                // Cancel action
            }
        }
    })
">
    Delete Item
</x-button>
```

### Livewire Integration

```php
// In your Livewire component
public function save()
{
    // Save logic...

    $this->dispatch('toast', [
        'type' => 'success',
        'message' => 'Saved successfully!'
    ]);
}

public function delete()
{
    // Delete logic...

    $this->dispatch('toast', [
        'type' => 'success',
        'message' => 'Item deleted',
        'description' => 'The item has been permanently removed.'
    ]);
}
```

```blade
{{-- In your Blade template --}}
<div x-on:toast.window="
    $mog.toast[$event.detail.type || 'default'](
        $event.detail.message,
        $event.detail,
    )
">
    <x-button wire:click="save">Save</x-button>
</div>
```

### Custom Duration

```blade
<x-button
    x-on:click="
    $mog.toast.info('This toast stays longer', {
        duration: 10000 // 10 seconds
    })
">
    Show Long Toast
</x-button>

<x-button
    x-on:click="
    $mog.toast.info('This toast never auto-closes', {
        duration: Infinity
    })
">
    Persistent Toast
</x-button>
```

### Different Positions

```blade
{{-- Configure toaster position --}}
<x-toaster position="top-right" />

{{-- Or per-toast override --}}
<x-button
    x-on:click="
    $mog.toast('Top left notification', {
        position: 'top-left'
    })
">
    Show at Top Left
</x-button>
```

### Promise-Based Toasts

```blade
<x-button
    x-on:click="
    const promise = fetch('/api/data')

    $mog.toast.promise(promise, {
        loading: 'Loading data...',
        success: 'Data loaded!',
        error: 'Failed to load data'
    })
">
    Load Data
</x-button>
```

### Dismissing Toasts

```blade
{{-- Dismiss specific toast --}}
<x-button
    x-on:click="
    const id = $mog.toast('Dismissible toast')
    setTimeout(() => $mog.toast.dismiss(id), 2000)
">
    Auto Dismiss
</x-button>

{{-- Dismiss all toasts --}}
<x-button x-on:click="$mog.toast.dismiss()">Clear All Toasts</x-button>
```

### Form Submission Feedback

```blade
<form
    wire:submit="createAccount"
    x-data="{
        submit(event) {
            const toastId = $mog.toast.loading('Creating account...')

            this.$wire
                .createAccount()
                .then(() => {
                    $mog.toast.dismiss(toastId)
                    $mog.toast.success('Account created!', {
                        description: 'Welcome aboard!',
                    })
                })
                .catch((error) => {
                    $mog.toast.dismiss(toastId)
                    $mog.toast.error('Failed to create account', {
                        description: error.message,
                    })
                })
        },
    }"
    x-on:submit.prevent="submit">
    {{-- Form fields --}}

    <x-button type="submit">Create Account</x-button>
</form>
```

## Best Practices

### Message Clarity

```blade
{{-- Good: Clear and specific --}}
<x-button x-on:click="$mog.toast.success('Password updated successfully')">Update Password</x-button>

{{-- Avoid: Vague --}}
<x-button x-on:click="$mog.toast.success('Done')">Update Password</x-button>
```

### Duration Guidelines

- **Quick feedback** (success, error): 3-4 seconds (default)
- **Information**: 5-6 seconds
- **Warnings**: 6-8 seconds
- **Actions required**: Consider using `Infinity` or a high value

### Don't Overuse

```blade
{{-- Good: Important feedback only --}}
function save() { // Save... $mog.toast.success('Changes saved') }

{{-- Avoid: Toast for every minor action --}}
function onClick() { $mog.toast.info('Button clicked') // Too noisy }
```

### Provide Context

```blade
{{-- Good: Specific and actionable --}}
$mog.toast.error('Failed to upload image', { description: 'File size exceeds 5MB limit. Please choose a smaller file.' })

{{-- Avoid: Generic error --}}
$mog.toast.error('Error')
```

## Accessibility

- Toasts include `aria-live="polite"` for screen reader announcements
- Keyboard users can focus and dismiss toasts
- Loading toasts cannot be dismissed until complete
- Toast descriptions provide additional context for assistive technologies

## Technical Details

### Stacking Behavior

- Maximum `visibleToasts` (default: 3) shown at once
- Older toasts stack behind newer ones
- Hovering expands the stack to show all toasts
- Smooth height transitions

### Pause on Interaction

- Toasts pause auto-close timer when:
    - Mouse hovers over toaster
    - User is interacting with toast
    - Document is hidden (tab inactive)

### Performance

- Uses Alpine.js reactive store
- Efficient DOM updates
- Smooth CSS animations
- Proper cleanup of dismissed toasts

## Related Components

- [Alert](./alert.md) - Persistent in-page notifications
- [Spinner](./spinner.md) - Loading indicators
- [Empty](./empty.md) - Empty state messages

## Common Patterns

### CRUD Operations

```blade
{{-- Create --}}
<x-button
    wire:click="create"
    x-on:created.window="
    $mog.toast.success('Item created', {
        description: 'Your new item has been added.'
    })
">
    Create
</x-button>

{{-- Update --}}
<x-button
    wire:click="update"
    x-on:updated.window="
    $mog.toast.success('Changes saved')
">
    Save
</x-button>

{{-- Delete with undo --}}
<x-button
    wire:click="delete"
    x-on:deleted.window="
    $mog.toast('Item deleted', {
        action: {
            label: 'Undo',
            onClick: () => $wire.undo()
        }
    })
">
    Delete
</x-button>
```

### File Upload Progress

```blade
<input
    type="file"
    x-on:change="
        const file = $event.target.files[0]
        const toastId = $mog.toast.loading(`Uploading ${file.name}...`)

        uploadFile(file).then(() => {
            $mog.toast.dismiss(toastId)
            $mog.toast.success('Upload complete!')
        })
    " />
```

### Network Error Handling

```blade
<div
    x-data="{
        async fetchData() {
            try {
                const response = await fetch('/api/data')
                if (! response.ok) throw new Error('Network error')

                $mog.toast.success('Data refreshed')
            } catch (error) {
                $mog.toast.error('Connection failed', {
                    description:
                        'Please check your internet connection and try again.',
                    action: {
                        label: 'Retry',
                        onClick: () => this.fetchData(),
                    },
                })
            }
        },
    }">
    <x-button x-on:click="fetchData()">Refresh Data</x-button>
</div>
```
