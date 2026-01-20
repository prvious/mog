# Dropdown

The Dropdown component provides a floating menu that appears when a trigger element is clicked. It uses Alpine.js Anchor plugin for intelligent positioning and supports click-away and keyboard dismissal.

## Overview

Dropdowns display a list of actions, links, or options in a floating menu positioned relative to a trigger button. They're perfect for contextual menus, user account menus, and action lists.

### When to Use

- **Action menus**: Display actions for a specific item or context
- **User menus**: Account settings, profile, sign out options
- **Navigation menus**: Additional navigation options
- **Filter options**: Show filtering or sorting options
- **Context menus**: Right-click or long-press menus

### Dropdown vs Other Components

- **Dropdown**: Floating menu of actions/links, click-away to close
- **Popover**: Contextual information, can contain forms/rich content
- **Dialog**: Modal overlay, blocks page interaction, focus trapped
- **Select**: Form control for choosing from options

## Props

### `trigger`

**Required**
**Type:** `Slot`

The element that opens the dropdown when clicked.

### `content`

**Required**
**Type:** `Slot`

The dropdown menu content container.

### `items`

**Type:** `Array<Slot>`
**Default:** `[]`

Array of menu items. Each item can be configured with different types.

## Content Attributes

### `align`

**Type:** `string`
**Default:** `'top'`
**Options:** `'top'`, `'top-start'`, `'top-end'`, `'bottom'`, `'bottom-start'`, `'bottom-end'`, `'left'`, `'left-start'`, `'left-end'`, `'right'`, `'right-start'`, `'right-end'`

Controls the position of the dropdown relative to the trigger.

### `offset`

**Type:** `number`
**Default:** `4`

Distance in pixels between the dropdown and the trigger element.

## Item Attributes

### `type`

**Type:** `string`
**Default:** `'item'`
**Options:** `'item'`, `'link'`, `'label'`, `'separator'`

Determines the type and styling of the menu item.

### `variant`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'destructive'`

Visual variant for items (destructive shows in red for delete/remove actions).

### `inset`

**Type:** `boolean`
**Default:** `false`

Adds left padding to align items with a parent item that has an icon.

## Features

### Smart Positioning

Uses Alpine.js Anchor plugin:

- Automatically positions relative to trigger
- Flips to opposite side when near viewport edge
- Adjusts alignment to stay visible
- Configurable offset from trigger

### Item Types

Multiple item types supported:

- **item**: Clickable action (e.g., "Edit", "Delete")
- **link**: Anchor link to navigate
- **label**: Non-interactive section header
- **separator**: Horizontal divider

### Click-Away Handling

Automatically closes when:

- Clicking outside the dropdown
- Pressing Escape key
- Clicking a menu item

### Smooth Animations

Entry and exit transitions:

- Scale from 95% to 100%
- Fade in/out
- Slide-in directional animation
- 200ms enter, 150ms leave

## Usage Examples

### Basic Dropdown

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button>
            Options
            @svg('lucide-chevron-down', 'ml-2 size-4')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-slot:[item]>Edit</x-slot:[item]>
        <x-slot:[item]>Duplicate</x-slot:[item]>
        <x-slot:[separator]></x-slot:[separator]>
        <x-slot:[item] variant="destructive">Delete</x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### User Account Menu

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            <x-avatar>
                <x-avatar-image src="{{ auth()->user()->avatar }}" />
                <x-avatar-fallback>{{ auth()->user()->initials }}</x-avatar-fallback>
            </x-avatar>
        </x-button>
    </x-slot:trigger>

    <x-slot:content align="bottom-end">
        <x-slot:[label]>
            <div class="flex flex-col">
                <span class="font-medium">{{ auth()->user()->name }}</span>
                <span class="text-muted-foreground text-xs">{{ auth()->user()->email }}</span>
            </div>
        </x-slot:[label]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[link] href="/profile">
            @svg('lucide-user', 'size-4')
            Profile
        </x-slot:[link]>

        <x-slot:[link] href="/settings">
            @svg('lucide-settings', 'size-4')
            Settings
        </x-slot:[link]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item]>
            <form
                action="/logout"
                method="POST">
                @csrf
                <button
                    type="submit"
                    class="flex w-full items-center gap-2">
                    @svg('lucide-log-out', 'size-4')
                    Sign Out
                </button>
            </form>
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### Table Row Actions

```blade
<x-table>
    <tbody>
        @foreach ($users as $user)
            <x-tr>
                <x-td>{{ $user->name }}</x-td>
                <x-td>{{ $user->email }}</x-td>
                <x-td class="text-right">
                    <x-dropdown>
                        <x-slot:trigger>
                            <x-button
                                variant="ghost"
                                size="icon-sm">
                                @svg('lucide-more-horizontal', 'size-4')
                            </x-button>
                        </x-slot:trigger>

                        <x-slot:content align="bottom-end">
                            <x-slot:[item] wire:click="edit({{ $user->id }})">
                                @svg('lucide-pencil', 'size-4')
                                Edit
                            </x-slot:[item]>

                            <x-slot:[item] wire:click="viewActivity({{ $user->id }})">
                                @svg('lucide-activity', 'size-4')
                                View Activity
                            </x-slot:[item]>

                            <x-slot:[separator]></x-slot:[separator]>

                            <x-slot:[item]
                                variant="destructive"
                                wire:click="delete({{ $user->id }})">
                                @svg('lucide-trash-2', 'size-4')
                                Delete
                            </x-slot:[item]>
                        </x-slot:content>
                    </x-dropdown>
                </x-td>
            </x-tr>
        @endforeach
    </tbody>
</x-table>
```

### Dropdown Positioning

```blade
{{-- Top (default) --}}
<x-dropdown>
    <x-slot:trigger>
        <x-button>Top</x-button>
    </x-slot:trigger>

    <x-slot:content align="top">
        <x-slot:[item]>Option 1</x-slot:[item]>
        <x-slot:[item]>Option 2</x-slot:[item]>
    </x-slot:content>
</x-dropdown>

{{-- Bottom --}}
<x-dropdown>
    <x-slot:trigger>
        <x-button>Bottom</x-button>
    </x-slot:trigger>

    <x-slot:content align="bottom">
        <x-slot:[item]>Option 1</x-slot:[item]>
        <x-slot:[item]>Option 2</x-slot:[item]>
    </x-slot:content>
</x-dropdown>

{{-- Bottom End (right-aligned) --}}
<x-dropdown>
    <x-slot:trigger>
        <x-button>Bottom End</x-button>
    </x-slot:trigger>

    <x-slot:content align="bottom-end">
        <x-slot:[item]>Option 1</x-slot:[item]>
        <x-slot:[item]>Option 2</x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### With Icons

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button>
            Actions
            @svg('lucide-chevron-down', 'ml-2 size-4')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-slot:[item]>
            @svg('lucide-download', 'size-4')
            Download
        </x-slot:[item]>

        <x-slot:[item]>
            @svg('lucide-share-2', 'size-4')
            Share
        </x-slot:[item]>

        <x-slot:[item]>
            @svg('lucide-copy', 'size-4')
            Duplicate
        </x-slot:[item]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item] variant="destructive">
            @svg('lucide-trash-2', 'size-4')
            Delete
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### Grouped Menu Items

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button variant="outline">
            File
            @svg('lucide-chevron-down', 'ml-2 size-4')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-slot:[label]>File Operations</x-slot:[label]>

        <x-slot:[item]>
            @svg('lucide-file-plus', 'size-4')
            New File
        </x-slot:[item]>

        <x-slot:[item]>
            @svg('lucide-folder-open', 'size-4')
            Open
        </x-slot:[item]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[label]>Recent Files</x-slot:[label]>

        <x-slot:[item]>
            @svg('lucide-file', 'size-4')
            Document.pdf
        </x-slot:[item]>

        <x-slot:[item]>
            @svg('lucide-file', 'size-4')
            Report.xlsx
        </x-slot:[item]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item]>
            @svg('lucide-settings', 'size-4')
            Settings
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### With Keyboard Shortcuts

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button>Edit</x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-slot:[item]>
            <div class="flex flex-1 items-center justify-between">
                <span class="flex items-center gap-2">
                    @svg('lucide-copy', 'size-4')
                    Copy
                </span>
                <kbd class="ml-auto text-xs">⌘C</kbd>
            </div>
        </x-slot:[item]>

        <x-slot:[item]>
            <div class="flex flex-1 items-center justify-between">
                <span class="flex items-center gap-2">
                    @svg('lucide-clipboard-paste', 'size-4')
                    Paste
                </span>
                <kbd class="ml-auto text-xs">⌘V</kbd>
            </div>
        </x-slot:[item]>

        <x-slot:[item]>
            <div class="flex flex-1 items-center justify-between">
                <span class="flex items-center gap-2">
                    @svg('lucide-scissors', 'size-4')
                    Cut
                </span>
                <kbd class="ml-auto text-xs">⌘X</kbd>
            </div>
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### Programmatic Control

```blade
<div x-data="{
    dropdownOpen: false,
    closeDropdown() {
        this.dropdownOpen = false
    },
}">
    <x-button x-on:click="dropdownOpen = true">Open Dropdown</x-button>

    <x-dropdown x-model="dropdownOpen">
        <x-slot:content>
            <x-slot:[item] x-on:click="closeDropdown()">Option 1</x-slot:[item]>
            <x-slot:[item] x-on:click="closeDropdown()">Option 2</x-slot:[item]>
        </x-slot:content>
    </x-dropdown>
</div>
```

### Filter Dropdown

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button variant="outline">
            @svg('lucide-filter', 'size-4')
            Filter
            <x-badge
                class="ml-2"
                x-show="$wire.activeFilters > 0">
                {{ $activeFilters }}
            </x-badge>
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-56">
        <x-slot:[label]>Filter by Status</x-slot:[label]>

        <x-slot:[item] wire:click="filterBy('active')">
            <x-checkbox wire:model="filters.active" />
            Active
        </x-slot:[item]>

        <x-slot:[item] wire:click="filterBy('pending')">
            <x-checkbox wire:model="filters.pending" />
            Pending
        </x-slot:[item]>

        <x-slot:[item] wire:click="filterBy('completed')">
            <x-checkbox wire:model="filters.completed" />
            Completed
        </x-slot:[item]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item] wire:click="clearFilters">
            @svg('lucide-x', 'size-4')
            Clear Filters
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### Sort Dropdown

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="sm">
            @svg('lucide-arrow-up-down', 'size-4')
            Sort
        </x-button>
    </x-slot:trigger>

    <x-slot:content align="bottom-end">
        <x-slot:[label]>Sort by</x-slot:[label]>

        <x-slot:[item] wire:click="sortBy('name', 'asc')">
            @svg('lucide-arrow-up', 'size-4')
            Name (A-Z)
        </x-slot:[item]>

        <x-slot:[item] wire:click="sortBy('name', 'desc')">
            @svg('lucide-arrow-down', 'size-4')
            Name (Z-A)
        </x-slot:[item]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item] wire:click="sortBy('created_at', 'desc')">
            @svg('lucide-calendar', 'size-4')
            Newest First
        </x-slot:[item]>

        <x-slot:[item] wire:click="sortBy('created_at', 'asc')">
            @svg('lucide-calendar', 'size-4')
            Oldest First
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### With Badges

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button variant="outline">
            Notifications
            <x-badge
                class="ml-2"
                variant="destructive">
                3
            </x-badge>
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-80">
        <x-slot:[label]>
            <div class="flex items-center justify-between">
                <span>Notifications</span>
                <x-button
                    variant="ghost"
                    size="sm">
                    Mark all read
                </x-button>
            </div>
        </x-slot:[label]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item]>
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-2">
                    <span class="font-medium">New message</span>
                    <x-badge
                        variant="destructive"
                        class="text-xs">
                        New
                    </x-badge>
                </div>
                <span class="text-muted-foreground text-xs">John sent you a message</span>
            </div>
        </x-slot:[item]>

        <x-slot:[item]>
            <div class="flex flex-col gap-1">
                <span class="font-medium">Task completed</span>
                <span class="text-muted-foreground text-xs">Your export is ready</span>
            </div>
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

## Accessibility

### Keyboard Navigation

- **Click trigger**: Open/close dropdown
- **Escape**: Close dropdown
- **Tab**: Navigate away (closes dropdown)
- **Arrow keys**: Navigate between items (future enhancement)

### ARIA Attributes

The dropdown includes proper ARIA roles:

- `role="menu"` on content container
- `role="menuitem"` on each item
- Proper focus management

### Focus Management

```blade
{{-- Focus returns to trigger when closed --}}
<x-dropdown>
    <x-slot:trigger>
        <x-button>Accessible Dropdown</x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-slot:[item]>Option 1</x-slot:[item]>
        <x-slot:[item]>Option 2</x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### Screen Reader Support

```blade
{{-- Good: Clear item labels --}}
<x-dropdown>
    <x-slot:trigger>
        <x-button aria-label="User account menu">
            @svg('lucide-user')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-slot:[item]>View Profile</x-slot:[item]>
        <x-slot:[item]>Settings</x-slot:[item]>
        <x-slot:[item]>Sign Out</x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

## Best Practices

### Keep Items Concise

```blade
{{-- Good: Short, scannable items --}}
<x-slot:[item]>Edit</x-slot:[item]>
<x-slot:[item]>Delete</x-slot:[item]>

{{-- Avoid: Long item text --}}
<x-slot:[item]>Click here to edit this item and make changes to its properties</x-slot:[item]>
```

### Group Related Actions

```blade
{{-- Good: Use separators to group related items --}}
<x-dropdown>
    <x-slot:content>
        <x-slot:[item]>Edit</x-slot:[item]>
        <x-slot:[item]>Duplicate</x-slot:[item]>

        <x-slot:[separator]></x-slot:[separator]>

        <x-slot:[item] variant="destructive">Delete</x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```

### Destructive Actions

```blade
{{-- Good: Use destructive variant for delete/remove --}}
<x-slot:[item] variant="destructive">
    @svg('lucide-trash-2', 'size-4')
    Delete
</x-slot:[item]>

{{-- Better: Separate destructive actions --}}
<x-slot:[separator]></x-slot:[separator]>
<x-slot:[item] variant="destructive">Delete</x-slot:[item]>
```

### Icon Consistency

```blade
{{-- Good: All items have icons --}}
<x-dropdown>
    <x-slot:content>
        <x-slot:[item]>
            @svg('lucide-download', 'size-4')
            Download
        </x-slot:[item]>
        <x-slot:[item]>
            @svg('lucide-share-2', 'size-4')
            Share
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>

{{-- Avoid: Mixing items with and without icons --}}
<x-dropdown>
    <x-slot:content>
        <x-slot:[item]>
            @svg('lucide-download', 'size-4')
            Download
        </x-slot:[item]>
        <x-slot:[item]>Share</x-slot:[item]>
        {{-- No icon --}}
    </x-slot:content>
</x-dropdown>
```

## Technical Details

### Positioning with x-anchor

The dropdown uses Alpine.js Anchor plugin:

```blade
x-anchor.top.offset.4="$refs.trigger"
```

This automatically:

- Positions dropdown relative to trigger
- Applies offset
- Handles viewport boundaries
- Adjusts on scroll/resize

### Click-Away Detection

```blade
x-on:click.away="close()"
```

Automatically closes when clicking outside the dropdown.

### State Management

```javascript
x-data="{
    open: false,
    close() {
        if (!this.open) return
        this.open = false
    }
}"
```

### Item Auto-Close

Items automatically close the dropdown on click:

```blade
x-on:click="close()"
```

## Related Components

- [Popover](./popover.md) - Richer content with forms and interactions
- [Dialog](./dialog.md) - Modal overlays for focused tasks
- [Select](./select.md) - Form control for selecting options
- [Tooltip](./tooltip.md) - Contextual hints on hover

## Common Patterns

### Context Menu

```blade
<div x-on:contextmenu.prevent="$refs.contextMenu.open = true">
    Right-click me

    <x-dropdown x-ref="contextMenu">
        <x-slot:content>
            <x-slot:[item]>Copy</x-slot:[item]>
            <x-slot:[item]>Paste</x-slot:[item]>
            <x-slot:[separator]></x-slot:[separator]>
            <x-slot:[item]>Inspect</x-slot:[item]>
        </x-slot:content>
    </x-dropdown>
</div>
```

### Command Palette Style

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button
            variant="outline"
            class="w-64 justify-between">
            <span class="text-muted-foreground">Search commands...</span>
            <kbd class="text-xs">⌘K</kbd>
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-64">
        <x-slot:[label]>Commands</x-slot:[label]>

        <x-slot:[item]>
            @svg('lucide-search', 'size-4')
            Search
            <kbd class="ml-auto text-xs">⌘F</kbd>
        </x-slot:[item]>

        <x-slot:[item]>
            @svg('lucide-file-plus', 'size-4')
            New File
            <kbd class="ml-auto text-xs">⌘N</kbd>
        </x-slot:[item]>
    </x-slot:content>
</x-dropdown>
```
