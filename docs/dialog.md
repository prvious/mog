# Dialog

The Dialog component creates modal overlays that block interaction with the rest of the page until dismissed. It includes focus trapping, smooth animations, and a global dialog management system powered by Alpine.js.

## Overview

Dialogs (also known as modals) present content in a layer above the main application. They're ideal for focused tasks, confirmations, and forms that require the user's full attention.

### When to Use

- **Confirmations**: Get user confirmation before destructive actions
- **Forms**: Collect focused input without leaving the current page
- **Alerts**: Display important information that requires acknowledgment
- **Multi-step workflows**: Guide users through sequential steps
- **Content preview**: Show detailed views without navigation

### Dialog vs Other Components

- **Dialog**: Modal overlay, blocks page interaction, focus trapped
- **Slide-over**: Similar to dialog but slides from screen edge
- **Popover**: Non-blocking, contextual content relative to trigger
- **Dropdown**: Menu of actions, typically non-blocking

## Props

### `trigger`

**Type:** `Slot`
**Default:** `Empty slot`

The element that opens the dialog when clicked.

### `title`

**Type:** `Slot | string`

The dialog title displayed in the header.

### `content`

**Required**
**Type:** `Slot`

The main content of the dialog.

### `header`

**Type:** `Slot`

Custom header content. Contains title by default.

### `footer`

**Type:** `Slot`

Custom footer content. Contains action/cancel buttons by default.

### `action`

**Type:** `Slot`

Primary action button (e.g., "Save", "Confirm", "Delete").

### `cancel`

**Type:** `Slot`

Cancel/dismiss button (e.g., "Cancel", "Close").

### `open`

**Type:** `boolean`
**Default:** `false`

Controls whether the dialog is initially open.

### `size`

**Type:** `string`
**Default:** `'lg'`
**Options:** `'md'`, `'lg'`, `'xl'`, `'2xl'`, `'3xl'`, `'full'`, `'screen'`, `'fit'`

Controls the maximum width of the dialog.

## Features

### Global Dialog Manager

Dialogs use `$mog.dialog` for centralized management:

- **Multiple dialogs**: Stack dialogs with proper z-index handling
- **Programmatic control**: Open/close from anywhere
- **Event system**: Listen to open/close events
- **Scroll locking**: Prevents background scrolling

### Focus Trapping

Focus is trapped within the dialog:

- Tab navigation cycles through dialog elements
- Cannot focus elements behind the overlay
- Focus returns to trigger on close

### Smooth Animations

Entry and exit animations:

- Scale and translate effect
- Fade in/out
- 200ms enter, 150ms leave
- Ease-out/ease-in timing

### Teleport to Container

Content is teleported to `#mog-dialog-container`:

- Renders at document root level
- Avoids z-index issues
- Proper stacking context

## Usage Examples

### Basic Dialog

```blade
<x-dialog>
    <x-slot:trigger>
        <x-button>Open Dialog</x-button>
    </x-slot:trigger>

    <x-slot:title>Dialog Title</x-slot:title>

    <x-slot:content>This is the dialog content. It can contain any HTML or Blade components.</x-slot:content>

    <x-slot:action>
        <x-button>Confirm</x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>
</x-dialog>
```

### Confirmation Dialog

```blade
<x-dialog>
    <x-slot:trigger>
        <x-button variant="destructive">Delete Account</x-button>
    </x-slot:trigger>

    <x-slot:title>Are you absolutely sure?</x-slot:title>

    <x-slot:content>
        This action cannot be undone. This will permanently delete your account and remove your data from our servers.
    </x-slot:content>

    <x-slot:action>
        <x-button
            variant="destructive"
            wire:click="deleteAccount">
            Yes, delete my account
        </x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>
</x-dialog>
```

### Form Dialog

```blade
<x-dialog size="xl">
    <x-slot:trigger>
        <x-button>Add User</x-button>
    </x-slot:trigger>

    <x-slot:title>Create New User</x-slot:title>

    <x-slot:content>
        <form
            wire:submit="createUser"
            class="space-y-4">
            <x-field>
                <x-label>Name</x-label>
                <x-input
                    wire:model="name"
                    type="text"
                    placeholder="John Doe" />
                <x-error key="name" />
            </x-field>

            <x-field>
                <x-label>Email</x-label>
                <x-input
                    wire:model="email"
                    type="email"
                    placeholder="john@example.com" />
                <x-error key="email" />
            </x-field>

            <x-field>
                <x-label>Role</x-label>
                <x-select wire:model="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </x-select>
                <x-error key="role" />
            </x-field>
        </form>
    </x-slot:content>

    <x-slot:action>
        <x-button wire:click="createUser">Create User</x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>
</x-dialog>
```

### Dialog Sizes

```blade
{{-- Medium --}}
<x-dialog size="md">
    <x-slot:trigger><x-button size="sm">Small Dialog</x-button></x-slot:trigger>
    <x-slot:title>Medium Dialog</x-slot:title>
    <x-slot:content>This dialog has a max width of 28rem.</x-slot:content>
</x-dialog>

{{-- Large (default) --}}
<x-dialog size="lg">
    <x-slot:trigger><x-button size="sm">Default Dialog</x-button></x-slot:trigger>
    <x-slot:title>Large Dialog</x-slot:title>
    <x-slot:content>This dialog has a max width of 32rem.</x-slot:content>
</x-dialog>

{{-- Extra Large --}}
<x-dialog size="xl">
    <x-slot:trigger><x-button size="sm">Large Dialog</x-button></x-slot:trigger>
    <x-slot:title>Extra Large Dialog</x-slot:title>
    <x-slot:content>This dialog has a max width of 36rem.</x-slot:content>
</x-dialog>

{{-- Full Width --}}
<x-dialog size="full">
    <x-slot:trigger><x-button size="sm">Full Width</x-button></x-slot:trigger>
    <x-slot:title>Full Width Dialog</x-slot:title>
    <x-slot:content>This dialog spans the full width of the viewport.</x-slot:content>
</x-dialog>
```

### Programmatic Control

```blade
<div x-data="{ dialogOpen: false }">
    {{-- Control from Alpine --}}
    <x-button x-on:click="dialogOpen = true">Open from Alpine</x-button>
    <x-button x-on:click="dialogOpen = false">Close from Alpine</x-button>

    <x-dialog x-model="dialogOpen">
        <x-slot:title>Programmatically Controlled</x-slot:title>

        <x-slot:content>This dialog is controlled via x-model binding.</x-slot:content>

        <x-slot:cancel>
            <x-button variant="outline">Close</x-button>
        </x-slot:cancel>
    </x-dialog>
</div>
```

### Using Dialog Manager

```blade
<div
    x-data="{
        openDialog() {
            $mog.dialog.open('my-dialog-id')
        },
        closeDialog() {
            $mog.dialog.close('my-dialog-id')
        },
    }">
    <x-button x-on:click="openDialog()">Open via Manager</x-button>

    <x-dialog x-ref="myDialog">
        <x-slot:title>Dialog Manager Example</x-slot:title>

        <x-slot:content>This dialog is controlled using the global $mog.dialog manager.</x-slot:content>

        <x-slot:action>
            <x-button x-on:click="closeDialog()">Close</x-button>
        </x-slot:action>
    </x-dialog>
</div>
```

### Livewire Integration

```blade
{{-- In your Livewire component --}}
<div>
    <x-button wire:click="$set('showDialog', true)">Open Dialog</x-button>

    <x-dialog wire:model="showDialog">
        <x-slot:title>Edit Profile</x-slot:title>

        <x-slot:content>
            <div class="space-y-4">
                <x-field>
                    <x-label>Name</x-label>
                    <x-input wire:model="name" />
                </x-field>

                <x-field>
                    <x-label>Email</x-label>
                    <x-input
                        wire:model="email"
                        type="email" />
                </x-field>
            </div>
        </x-slot:content>

        <x-slot:action>
            <x-button wire:click="save">Save Changes</x-button>
        </x-slot:action>

        <x-slot:cancel>
            <x-button
                variant="outline"
                wire:click="$set('showDialog', false)">
                Cancel
            </x-button>
        </x-slot:cancel>
    </x-dialog>
</div>
```

```php
// In your Livewire component class
class EditProfile extends Component
{
    public bool $showDialog = false;
    public string $name = '';
    public string $email = '';

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        // Save logic...

        $this->showDialog = false;
        $this->dispatch('toast', type: 'success', message: 'Profile updated!');
    }
}
```

### Initially Open Dialog

```blade
<x-dialog :open="true">
    <x-slot:title>Welcome!</x-slot:title>

    <x-slot:content>This dialog opens automatically when the page loads.</x-slot:content>

    <x-slot:action>
        <x-button>Get Started</x-button>
    </x-slot:action>
</x-dialog>
```

### No Trigger (Controlled Only)

```blade
<div x-data="{ open: false }">
    {{-- External trigger --}}
    <x-button x-on:click="open = true">Open Dialog</x-button>

    {{-- Dialog without trigger slot --}}
    <x-dialog x-model="open">
        <x-slot:title>Controlled Dialog</x-slot:title>

        <x-slot:content>This dialog has no trigger slot. It's opened by external controls.</x-slot:content>

        <x-slot:cancel>
            <x-button variant="outline">Close</x-button>
        </x-slot:cancel>
    </x-dialog>
</div>
```

### Custom Header and Footer

```blade
<x-dialog>
    <x-slot:trigger>
        <x-button>Custom Layout</x-button>
    </x-slot:trigger>

    <x-slot:header class="bg-primary text-primary-foreground p-6">
        <h2 class="text-2xl font-bold">Custom Header</h2>
        <p class="text-sm opacity-90">With custom styling and layout</p>
    </x-slot:header>

    <x-slot:content>
        <p>Dialog content here.</p>
    </x-slot:content>

    <x-slot:footer class="bg-muted flex justify-between p-4">
        <x-button variant="ghost">Learn More</x-button>
        <div class="flex gap-2">
            <x-button variant="outline">Cancel</x-button>
            <x-button>Confirm</x-button>
        </div>
    </x-slot:footer>
</x-dialog>
```

### Multi-Step Dialog

```blade
<div x-data="{ step: 1 }">
    <x-dialog>
        <x-slot:trigger>
            <x-button>Start Wizard</x-button>
        </x-slot:trigger>

        <x-slot:title>
            <span x-show="step === 1">Step 1: Personal Information</span>
            <span x-show="step === 2">Step 2: Account Details</span>
            <span x-show="step === 3">Step 3: Confirmation</span>
        </x-slot:title>

        <x-slot:content>
            <div
                x-show="step === 1"
                class="space-y-4">
                <x-field>
                    <x-label>Full Name</x-label>
                    <x-input placeholder="John Doe" />
                </x-field>
                <x-field>
                    <x-label>Phone</x-label>
                    <x-input placeholder="+1 234 567 8900" />
                </x-field>
            </div>

            <div
                x-show="step === 2"
                class="space-y-4">
                <x-field>
                    <x-label>Email</x-label>
                    <x-input
                        type="email"
                        placeholder="john@example.com" />
                </x-field>
                <x-field>
                    <x-label>Password</x-label>
                    <x-input type="password" />
                </x-field>
            </div>

            <div x-show="step === 3">
                <p class="py-8 text-center">Review your information and click Submit to continue.</p>
            </div>
        </x-slot:content>

        <x-slot:footer class="flex justify-between">
            <x-button
                variant="ghost"
                x-show="step > 1"
                x-on:click="step--">
                Previous
            </x-button>

            <div class="ml-auto flex gap-2">
                <x-button variant="outline">Cancel</x-button>

                <x-button
                    x-show="step < 3"
                    x-on:click="step++">
                    Next
                </x-button>

                <x-button x-show="step === 3">Submit</x-button>
            </div>
        </x-slot:footer>
    </x-dialog>
</div>
```

### Alert Dialog

```blade
<x-dialog>
    <x-slot:trigger>
        <x-button variant="destructive">Delete Post</x-button>
    </x-slot:trigger>

    <x-slot:title>
        <div class="flex items-center gap-2">
            @svg('lucide-alert-triangle', 'text-destructive size-5')
            <span>Delete Post</span>
        </div>
    </x-slot:title>

    <x-slot:content>
        <x-alert variant="destructive">
            <x-slot:title>Warning</x-slot:title>
            <x-slot:content>This action cannot be undone. The post will be permanently removed.</x-slot:content>
        </x-alert>

        <p class="mt-4">Are you sure you want to delete this post?</p>
    </x-slot:content>

    <x-slot:action>
        <x-button
            variant="destructive"
            wire:click="delete">
            Delete Permanently
        </x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Keep Post</x-button>
    </x-slot:cancel>
</x-dialog>
```

## Accessibility

### Focus Management

Dialogs automatically trap focus:

- **Tab**: Navigate forward through focusable elements
- **Shift+Tab**: Navigate backward
- **Escape**: Close the dialog (if dismissible)
- Focus returns to trigger element on close

### Keyboard Shortcuts

```blade
{{-- Escape key closes by default --}}
<x-dialog>
    <x-slot:trigger><x-button>Open</x-button></x-slot:trigger>
    <x-slot:title>Press Escape to close</x-slot:title>
    <x-slot:content>...</x-slot:content>
</x-dialog>
```

### ARIA Attributes

The dialog includes proper ARIA roles and labels:

- Modal semantics for screen readers
- Proper focus trap announcement
- State changes announced to assistive tech

### Screen Reader Support

```blade
{{-- Good: Clear, descriptive title --}}
<x-dialog>
    <x-slot:trigger><x-button>Delete</x-button></x-slot:trigger>
    <x-slot:title>Confirm Deletion</x-slot:title>
    <x-slot:content>Are you sure you want to delete this item?</x-slot:content>
</x-dialog>

{{-- Better: Include context in content --}}
<x-dialog>
    <x-slot:trigger><x-button>Delete</x-button></x-slot:trigger>
    <x-slot:title>Confirm Deletion</x-slot:title>
    <x-slot:content>Are you sure you want to delete "Document.pdf"? This action cannot be undone.</x-slot:content>
</x-dialog>
```

## Best Practices

### Use for Focused Tasks

```blade
{{-- Good: Focused, time-bound task --}}
<x-dialog>
    <x-slot:title>Add Payment Method</x-slot:title>
    <x-slot:content>
        <!-- Form to add credit card -->
    </x-slot:content>
</x-dialog>

{{-- Avoid: Complex, multi-page workflow --}}
<x-dialog>
    <x-slot:title>Complete Setup</x-slot:title>
    <x-slot:content>
        <!-- 10 steps with lots of content -->
        <!-- Consider using a dedicated page instead -->
    </x-slot:content>
</x-dialog>
```

### Clear Action Labels

```blade
{{-- Good: Specific action labels --}}
<x-slot:action>
    <x-button>Save Changes</x-button>
</x-slot:action>

{{-- Avoid: Generic labels --}}
<x-slot:action>
    <x-button>OK</x-button>
</x-slot:action>
```

### Button Order

```blade
{{-- Good: Cancel first, action second (left to right) --}}
<x-dialog>
    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>

    <x-slot:action>
        <x-button>Confirm</x-button>
    </x-slot:action>
</x-dialog>

{{-- Buttons render in order they appear in template --}}
```

### Don't Overuse

```blade
{{-- Good: Important confirmation --}}
<x-dialog>
    <x-slot:trigger>
        <x-button variant="destructive">Delete Account</x-button>
    </x-slot:trigger>
    <x-slot:title>Confirm Account Deletion</x-slot:title>
    <x-slot:content>...</x-slot:content>
</x-dialog>

{{-- Avoid: Trivial actions don't need dialogs --}}
<x-dialog>
    <x-slot:trigger>
        <x-button>Mark as Read</x-button>
    </x-slot:trigger>
    <x-slot:title>Mark as Read?</x-slot:title>
    <x-slot:content>
        Are you sure?
        <!-- Too much friction -->
    </x-slot:content>
</x-dialog>
```

## Technical Details

### Dialog Manager API

The global `$mog.dialog` provides:

```javascript
// Open dialog by ID
$mog.dialog.open(dialogId)

// Close specific dialog
$mog.dialog.close(dialogId)

// Close all dialogs
$mog.dialog.closeAll()

// Check if empty
$mog.dialog.empty() // returns boolean

// Dialog stack
$mog.dialogs // array of open dialog IDs
```

### Event System

Dialogs emit custom events:

```blade
<div
    x-on:mog::dialog-open.document="console.log('Dialog opened:', $event.detail.id)"
    x-on:mog::dialog-close.document="console.log('Dialog closed:', $event.detail.id)">
    <!-- Your dialogs -->
</div>
```

### Scroll Locking

When a dialog opens:

- `data-scroll-locked="true"` added to `<body>`
- Background scrolling prevented
- Removed when all dialogs are closed

### Teleportation

Dialog content teleports to `#mog-dialog-container`:

- Renders at document root
- Above regular content
- Proper stacking for multiple dialogs

## Related Components

- [Slide-over](./slide-over.md) - Side panel alternative to dialogs
- [Popover](./popover.md) - Non-blocking contextual overlays
- [Dropdown](./dropdown.md) - Menu of actions
- [Overlay](./overlay.md) - Base overlay component

## Common Patterns

### Confirmation Before Destructive Action

```blade
<x-dialog>
    <x-slot:trigger>
        <x-button
            variant="destructive"
            size="sm">
            @svg('lucide-trash-2')
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Delete Item</x-slot:title>

    <x-slot:content>Are you sure you want to delete this item? This action cannot be undone.</x-slot:content>

    <x-slot:action>
        <x-button
            variant="destructive"
            wire:click="delete({{ $item->id }})">
            Delete
        </x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>
</x-dialog>
```

### Quick Edit Form

```blade
<x-dialog size="lg">
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon-sm">
            @svg('lucide-pencil')
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Edit User</x-slot:title>

    <x-slot:content>
        <form
            wire:submit="update"
            class="space-y-4">
            <x-field>
                <x-label>Name</x-label>
                <x-input wire:model="name" />
                <x-error key="name" />
            </x-field>

            <x-field>
                <x-label>Email</x-label>
                <x-input
                    wire:model="email"
                    type="email" />
                <x-error key="email" />
            </x-field>
        </form>
    </x-slot:content>

    <x-slot:action>
        <x-button wire:click="update">Save Changes</x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>
</x-dialog>
```
