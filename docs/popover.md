# Popover

The Popover component displays rich content in a floating overlay positioned relative to a trigger element. It uses Alpine.js Anchor plugin for intelligent positioning and includes focus trapping for keyboard accessibility.

## Overview

Popovers present contextual information, forms, or interactive content without blocking the rest of the page. Unlike dropdowns which are primarily for actions, popovers can contain any content including forms, images, and complex layouts.

### When to Use

- **Additional information**: Show details without leaving the page
- **Inline forms**: Small forms or input fields
- **Color pickers**: UI for selecting colors
- **Date pickers**: Calendar selection overlays
- **Rich previews**: Preview cards with multiple elements
- **Help text**: Extended help content with formatting

### Popover vs Other Components

- **Popover**: Rich content, forms, interactive elements, non-blocking
- **Tooltip**: Simple text only, hover-triggered, no interaction
- **Dropdown**: Menu of actions/links, click-to-close on item selection
- **Dialog**: Modal overlay, blocks page, focus trapped, full attention

## Props

### `trigger`

**Type:** `Slot`
**Default:** `Empty slot`

The element that toggles the popover when clicked.

### `content`

**Required**
**Type:** `Slot`

The popover content to display in the overlay.

### `align`

**Type:** `string`
**Default:** `'top'`
**Options:** `'top'`, `'top-start'`, `'top-end'`, `'bottom'`, `'bottom-start'`, `'bottom-end'`, `'left'`, `'left-start'`, `'left-end'`, `'right'`, `'right-start'`, `'right-end'`

Controls the position of the popover relative to the trigger.

### `offset`

**Type:** `number`
**Default:** `5`

Distance in pixels between the popover and the trigger element.

### `open`

**Type:** `boolean`
**Default:** `false`

Controls whether the popover is initially open. Can be bound with `x-model` for programmatic control.

## Features

### Smart Positioning

Uses Alpine.js Anchor plugin:

- Automatically positions relative to trigger
- Flips to opposite side when near viewport edge
- Adjusts alignment to prevent overflow
- Configurable offset from trigger

### Focus Trapping

Focus is trapped within the popover:

- Tab navigation cycles through popover elements
- Cannot focus elements outside popover
- Focus returns to trigger on close
- `x-trap` directive manages focus

### Click-Away & Escape

Automatically closes when:

- Clicking outside the popover
- Pressing Escape key
- Provides consistent dismiss behavior

### Smooth Animations

Entry and exit transitions:

- Scale from 95% to 100%
- Fade in/out
- 200ms enter, 150ms leave
- Ease-out/ease-in timing

## Usage Examples

### Basic Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button variant="outline">Open Popover</x-button>
    </x-slot:trigger>

    <x-slot:content>
        <div class="space-y-2">
            <h4 class="font-medium">Popover Title</h4>
            <p class="text-muted-foreground text-sm">This is the popover content. It can contain any HTML.</p>
        </div>
    </x-slot:content>
</x-popover>
```

### Help Popover

```blade
<div class="flex items-center gap-2">
    <x-label>API Key</x-label>

    <x-popover>
        <x-slot:trigger>
            <x-button
                variant="ghost"
                size="icon-xs">
                @svg('lucide-help-circle', 'size-3.5')
            </x-button>
        </x-slot:trigger>

        <x-slot:content class="max-w-xs">
            <div class="space-y-2">
                <h4 class="text-sm font-medium">What is an API Key?</h4>
                <p class="text-muted-foreground text-xs leading-relaxed">
                    API keys are used to authenticate requests to the API. Keep your API key secure and never share it publicly. You can regenerate your key at
                    any time from your account settings.
                </p>
            </div>
        </x-slot:content>
    </x-popover>
</div>
```

### Color Picker Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="outline"
            class="gap-2">
            <div class="size-4 rounded-full bg-blue-500"></div>
            Choose Color
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-64">
        <div class="space-y-3">
            <h4 class="text-sm font-medium">Select Color</h4>

            <div class="grid grid-cols-6 gap-2">
                @foreach (['red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'] as $color)
                    <button
                        type="button"
                        wire:click="selectColor('{{ $color }}')"
                        class="bg-{{ $color }}-500 size-8 rounded-md transition-transform hover:scale-110"></button>
                @endforeach
            </div>
        </div>
    </x-slot:content>
</x-popover>
```

### Inline Form Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button size="sm">
            @svg('lucide-user-plus', 'size-4')
            Invite User
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-80">
        <div class="space-y-4">
            <div>
                <h4 class="font-medium">Invite a Team Member</h4>
                <p class="text-muted-foreground text-sm">Send an invitation to join your team.</p>
            </div>

            <form
                wire:submit="sendInvite"
                class="space-y-3">
                <x-field>
                    <x-label>Email</x-label>
                    <x-input
                        wire:model="email"
                        type="email"
                        placeholder="colleague@example.com" />
                    <x-error key="email" />
                </x-field>

                <x-field>
                    <x-label>Role</x-label>
                    <x-select wire:model="role">
                        <option value="member">Member</option>
                        <option value="admin">Admin</option>
                    </x-select>
                    <x-error key="role" />
                </x-field>

                <div class="flex gap-2">
                    <x-button
                        type="submit"
                        class="flex-1">
                        Send Invite
                    </x-button>
                    <x-button
                        type="button"
                        variant="outline"
                        x-on:click="$el.closest('[x-data]').open = false">
                        Cancel
                    </x-button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-popover>
```

### Popover Positioning

```blade
{{-- Top (default) --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Top</x-button>
    </x-slot:trigger>

    <x-slot:content align="top">Content appears above</x-slot:content>
</x-popover>

{{-- Bottom --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Bottom</x-button>
    </x-slot:trigger>

    <x-slot:content align="bottom">Content appears below</x-slot:content>
</x-popover>

{{-- Left --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Left</x-button>
    </x-slot:trigger>

    <x-slot:content align="left">Content appears to the left</x-slot:content>
</x-popover>

{{-- Right --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Right</x-button>
    </x-slot:trigger>

    <x-slot:content align="right">Content appears to the right</x-slot:content>
</x-popover>
```

### Alignment Variations

```blade
{{-- Top Start (left-aligned) --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Top Start</x-button>
    </x-slot:trigger>

    <x-slot:content align="top-start">Aligned to left edge</x-slot:content>
</x-popover>

{{-- Bottom End (right-aligned) --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Bottom End</x-button>
    </x-slot:trigger>

    <x-slot:content align="bottom-end">Aligned to right edge</x-slot:content>
</x-popover>
```

### User Profile Preview

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="sm"
            class="gap-2">
            <x-avatar class="size-6">
                <x-avatar-image src="{{ $user->avatar }}" />
                <x-avatar-fallback>{{ $user->initials }}</x-avatar-fallback>
            </x-avatar>
            {{ $user->name }}
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-80">
        <div class="space-y-4">
            {{-- Header --}}
            <div class="flex items-center gap-3">
                <x-avatar class="size-12">
                    <x-avatar-image src="{{ $user->avatar }}" />
                    <x-avatar-fallback>{{ $user->initials }}</x-avatar-fallback>
                </x-avatar>

                <div class="flex-1">
                    <div class="font-medium">{{ $user->name }}</div>
                    <div class="text-muted-foreground text-sm">{{ $user->email }}</div>
                </div>
            </div>

            {{-- Bio --}}
            @if ($user->bio)
                <p class="text-muted-foreground text-sm">
                    {{ $user->bio }}
                </p>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <div class="font-bold">{{ $user->posts_count }}</div>
                    <div class="text-muted-foreground text-xs">Posts</div>
                </div>
                <div>
                    <div class="font-bold">{{ $user->followers_count }}</div>
                    <div class="text-muted-foreground text-xs">Followers</div>
                </div>
                <div>
                    <div class="font-bold">{{ $user->following_count }}</div>
                    <div class="text-muted-foreground text-xs">Following</div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-2">
                <x-button
                    class="flex-1"
                    wire:click="follow({{ $user->id }})">
                    Follow
                </x-button>
                <x-button
                    variant="outline"
                    class="flex-1">
                    Message
                </x-button>
            </div>
        </div>
    </x-slot:content>
</x-popover>
```

### Settings Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-settings', 'size-4')
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-72">
        <div class="space-y-4">
            <h4 class="font-medium">Display Settings</h4>

            <x-field>
                <div class="flex items-center justify-between">
                    <div>
                        <x-label>Dark Mode</x-label>
                        <p class="text-muted-foreground text-xs">Use dark theme</p>
                    </div>
                    <x-switch wire:model.live="darkMode" />
                </div>
            </x-field>

            <x-field>
                <div class="flex items-center justify-between">
                    <div>
                        <x-label>Compact View</x-label>
                        <p class="text-muted-foreground text-xs">Reduce spacing</p>
                    </div>
                    <x-switch wire:model.live="compact" />
                </div>
            </x-field>

            <x-field>
                <x-label>Text Size</x-label>
                <x-select wire:model.live="textSize">
                    <option value="sm">Small</option>
                    <option value="base">Medium</option>
                    <option value="lg">Large</option>
                </x-select>
            </x-field>
        </div>
    </x-slot:content>
</x-popover>
```

### Share Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="outline"
            size="sm">
            @svg('lucide-share-2', 'size-4')
            Share
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-80">
        <div class="space-y-4">
            <h4 class="font-medium">Share this article</h4>

            <div class="space-y-2">
                <x-button
                    variant="ghost"
                    class="w-full justify-start gap-3"
                    wire:click="shareVia('twitter')">
                    @svg('lucide-twitter', 'size-5')
                    Share on Twitter
                </x-button>

                <x-button
                    variant="ghost"
                    class="w-full justify-start gap-3"
                    wire:click="shareVia('facebook')">
                    @svg('lucide-facebook', 'size-5')
                    Share on Facebook
                </x-button>

                <x-button
                    variant="ghost"
                    class="w-full justify-start gap-3"
                    wire:click="shareVia('linkedin')">
                    @svg('lucide-linkedin', 'size-5')
                    Share on LinkedIn
                </x-button>
            </div>

            <x-separator />

            <div class="space-y-2">
                <x-label>Share link</x-label>
                <x-input-group>
                    <x-input-group-input
                        readonly
                        value="{{ url()->current() }}" />
                    <x-input-group-addon align="inline-end">
                        <x-input-group-button wire:click="copyLink">
                            @svg('lucide-copy', 'size-4')
                        </x-input-group-button>
                    </x-input-group-addon>
                </x-input-group>
            </div>
        </div>
    </x-slot:content>
</x-popover>
```

### Programmatic Control

```blade
<div x-data="{ popoverOpen: false }">
    <div class="flex gap-2">
        <x-button
            x-on:click="popoverOpen = true"
            size="sm">
            Open
        </x-button>
        <x-button
            x-on:click="popoverOpen = false"
            size="sm"
            variant="outline">
            Close
        </x-button>
    </div>

    <x-popover x-model="popoverOpen">
        <x-slot:content>
            <div class="space-y-2">
                <h4 class="font-medium">Controlled Popover</h4>
                <p class="text-muted-foreground text-sm">This popover is controlled via x-model.</p>
                <x-button
                    x-on:click="popoverOpen = false"
                    size="sm"
                    class="w-full">
                    Close
                </x-button>
            </div>
        </x-slot:content>
    </x-popover>
</div>
```

### Confirmation Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="destructive"
            size="sm">
            @svg('lucide-trash-2', 'size-4')
            Delete
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-72">
        <div class="space-y-4">
            <div>
                <h4 class="font-medium">Are you sure?</h4>
                <p class="text-muted-foreground text-sm">This action cannot be undone. This will permanently delete the item.</p>
            </div>

            <div class="flex gap-2">
                <x-button
                    variant="destructive"
                    class="flex-1"
                    wire:click="confirmDelete">
                    Delete
                </x-button>
                <x-button
                    variant="outline"
                    class="flex-1"
                    x-on:click="$el.closest('[x-data]').open = false">
                    Cancel
                </x-button>
            </div>
        </div>
    </x-slot:content>
</x-popover>
```

### Calendar Popover

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="outline"
            class="gap-2">
            @svg('lucide-calendar', 'size-4')
            {{ $selectedDate ?? 'Select date' }}
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-auto p-0">
        {{-- Your calendar component here --}}
        <div class="p-4">
            <p class="text-muted-foreground text-sm">Calendar component would go here</p>
        </div>
    </x-slot:content>
</x-popover>
```

### Image Preview Popover

```blade
<x-popover>
    <x-slot:trigger>
        <img
            src="{{ $thumbnail }}"
            alt="Thumbnail"
            class="size-12 cursor-pointer rounded-md object-cover" />
    </x-slot:trigger>

    <x-slot:content class="p-0">
        <img
            src="{{ $fullImage }}"
            alt="Full size"
            class="max-w-md rounded-md" />
    </x-slot:content>
</x-popover>
```

## Accessibility

### Focus Trapping

The popover traps focus within its content:

- **Tab**: Navigate forward through focusable elements
- **Shift+Tab**: Navigate backward
- **Escape**: Close the popover
- Focus returns to trigger element on close

### Keyboard Navigation

```blade
{{-- Proper focus management --}}
<x-popover>
    <x-slot:trigger>
        <x-button>Accessible Popover</x-button>
    </x-slot:trigger>

    <x-slot:content>
        <div class="space-y-2">
            <x-input placeholder="First input" />
            <x-input placeholder="Second input" />
            <x-button>Submit</x-button>
        </div>
    </x-slot:content>
</x-popover>
```

### Screen Reader Support

```blade
{{-- Good: Descriptive trigger --}}
<x-popover>
    <x-slot:trigger>
        <x-button aria-label="Open help information">
            @svg('lucide-help-circle')
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        <div class="space-y-2">
            <h4 class="font-medium">Help</h4>
            <p class="text-sm">Helpful information here</p>
        </div>
    </x-slot:content>
</x-popover>
```

## Best Practices

### Keep Content Focused

```blade
{{-- Good: Focused, specific content --}}
<x-popover>
    <x-slot:content class="w-72">
        <div class="space-y-2">
            <h4 class="font-medium">Quick Actions</h4>
            <x-button class="w-full">Action 1</x-button>
            <x-button class="w-full">Action 2</x-button>
        </div>
    </x-slot:content>
</x-popover>

{{-- Avoid: Too much content --}}
<x-popover>
    <x-slot:content class="w-full max-w-4xl">
        <!-- Entire page worth of content -->
        <!-- Consider using a Dialog or separate page instead -->
    </x-slot:content>
</x-popover>
```

### Appropriate Width

```blade
{{-- Good: Set explicit width for forms --}}
<x-popover>
    <x-slot:content class="w-80">
        <form><!-- Form content --></form>
    </x-slot:content>
</x-popover>

{{-- Good: Auto width for simple content --}}
<x-popover>
    <x-slot:content>
        <p>Simple text content</p>
    </x-slot:content>
</x-popover>
```

### Clear Close Actions

```blade
{{-- Good: Provide clear way to close --}}
<x-popover>
    <x-slot:content>
        <div class="space-y-4">
            <!-- Content -->
            <x-button
                x-on:click="$el.closest('[x-data]').open = false"
                class="w-full">
                Close
            </x-button>
        </div>
    </x-slot:content>
</x-popover>
```

### Use for Interactive Content

```blade
{{-- Good: Interactive forms and controls --}}
<x-popover>
    <x-slot:content>
        <form wire:submit="save">
            <x-input />
            <x-button type="submit">Save</x-button>
        </form>
    </x-slot:content>
</x-popover>

{{-- Avoid: Simple text that could be a tooltip --}}
<x-popover>
    <x-slot:content>
        Simple help text
        <!-- Use x-tooltip instead -->
    </x-slot:content>
</x-popover>
```

## Technical Details

### Positioning with x-anchor

The popover uses Alpine.js Anchor plugin:

```blade
x-anchor.top.offset.5="$refs.trigger"
```

This automatically:

- Positions popover relative to trigger
- Applies offset
- Handles viewport boundaries
- Adjusts on scroll/resize

### Focus Trap

```blade
x-trap="open"
```

Traps focus within the popover when open.

### Click-Away Detection

```blade
x-on:click.away="open = false"
```

Closes when clicking outside the popover.

### State Management

```javascript
x-data="{
    open: false
}"
x-modelable="open"
```

Enables two-way binding with `x-model`.

## Related Components

- [Tooltip](./tooltip.md) - Simple text hints on hover
- [Dropdown](./dropdown.md) - Menu of actions and links
- [Dialog](./dialog.md) - Modal overlays for focused tasks
- [Slide-over](./slide-over.md) - Side panel overlays

## Common Patterns

### Filter Panel

```blade
<x-popover>
    <x-slot:trigger>
        <x-button variant="outline">
            @svg('lucide-filter', 'size-4')
            Filters
            @if ($activeFilters > 0)
                <x-badge class="ml-2">{{ $activeFilters }}</x-badge>
            @endif
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-80">
        <div class="space-y-4">
            <h4 class="font-medium">Filter Results</h4>

            <x-field>
                <x-label>Category</x-label>
                <x-select wire:model.live="category">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                </x-select>
            </x-field>

            <x-field>
                <x-label>Price Range</x-label>
                <div class="flex gap-2">
                    <x-input
                        wire:model.live="minPrice"
                        type="number"
                        placeholder="Min" />
                    <x-input
                        wire:model.live="maxPrice"
                        type="number"
                        placeholder="Max" />
                </div>
            </x-field>

            <div class="flex gap-2">
                <x-button
                    wire:click="applyFilters"
                    class="flex-1">
                    Apply
                </x-button>
                <x-button
                    wire:click="clearFilters"
                    variant="outline"
                    class="flex-1">
                    Clear
                </x-button>
            </div>
        </div>
    </x-slot:content>
</x-popover>
```

### Quick Edit

```blade
<x-popover>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon-sm">
            @svg('lucide-pencil', 'size-4')
        </x-button>
    </x-slot:trigger>

    <x-slot:content class="w-72">
        <form
            wire:submit="quickUpdate"
            class="space-y-3">
            <h4 class="font-medium">Quick Edit</h4>

            <x-field>
                <x-label>Title</x-label>
                <x-input wire:model="title" />
            </x-field>

            <x-field>
                <x-label>Description</x-label>
                <x-textarea
                    wire:model="description"
                    rows="3"></x-textarea>
            </x-field>

            <x-button
                type="submit"
                class="w-full">
                Save Changes
            </x-button>
        </form>
    </x-slot:content>
</x-popover>
```
