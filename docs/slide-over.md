# Slide-over

The Slide-over component (also known as a drawer or side panel) creates a modal panel that slides in from the edge of the screen. It uses the same dialog management system as Dialog but with directional slide animations.

## Overview

Slide-overs present content in a panel that slides from the screen edge, typically used for secondary content, forms, or detail views that complement the main page content without completely replacing it.

### When to Use

- **Detail panels**: Show details for selected items
- **Forms**: Multi-step or complex forms
- **Filters**: Advanced filtering options
- **Navigation**: Mobile navigation menus
- **Shopping carts**: E-commerce cart displays
- **Notifications**: Notification panels or activity feeds

### Slide-over vs Other Components

- **Slide-over**: Slides from edge, partial screen, keeps context visible
- **Dialog**: Centers on screen, full overlay, complete focus
- **Popover**: Small overlay, non-blocking, contextual to trigger
- **Dropdown**: Menu of actions, small content area

## Props

### `trigger`

**Required**
**Type:** `Slot`

The element that opens the slide-over when clicked.

### `title`

**Type:** `Slot`

The slide-over title displayed in the header.

### `description`

**Type:** `Slot`

Optional description text shown below the title in the header.

### `content`

**Type:** `Slot`

The main content of the slide-over panel.

### `header`

**Type:** `Slot`

Custom header content. Contains title and description by default.

### `footer`

**Type:** `Slot`

Footer content area. Contains action/cancel buttons by default.

### `action`

**Type:** `Slot`

Primary action button (e.g., "Save", "Confirm").

### `cancel`

**Type:** `Slot`

Cancel/dismiss button.

### `open`

**Type:** `boolean`
**Default:** `false`

Controls whether the slide-over is initially open.

### `side`

**Type:** `string`
**Default:** `'right'`
**Options:** `'right'`, `'left'`, `'top'`, `'bottom'`

Which edge of the screen the slide-over slides from.

## Features

### Global Dialog Manager

Uses `$mog.dialog` for centralized management:

- **Multiple panels**: Stack slide-overs properly
- **Programmatic control**: Open/close from anywhere
- **Event system**: Listen to open/close events
- **Scroll locking**: Prevents background scrolling

### Directional Slides

Smooth slide-in animations from any edge:

- Right: Slides in from right edge (default)
- Left: Slides in from left edge
- Top: Slides down from top
- Bottom: Slides up from bottom

### Focus Trapping

Focus is trapped within the slide-over:

- Tab navigation cycles through panel elements
- Cannot focus elements behind the overlay
- Focus returns to trigger on close

### Responsive Width

Default widths based on side:

- Right/Left: 75% width, max 24rem (sm:max-w-sm)
- Top/Bottom: Full width, auto height

## Usage Examples

### Basic Slide-over

```blade
<x-slide-over>
    <x-slot:trigger>
        <x-button>Open Panel</x-button>
    </x-slot:trigger>

    <x-slot:title>Slide-over Title</x-slot:title>

    <x-slot:description>Optional description text that appears below the title.</x-slot:description>

    <x-slot:content>
        <p>This is the main content of the slide-over panel.</p>
    </x-slot:content>

    <x-slot:action>
        <x-button>Save</x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Cancel</x-button>
    </x-slot:cancel>
</x-slide-over>
```

### Detail Panel

```blade
<x-slide-over>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon-sm">
            @svg('lucide-eye', 'size-4')
        </x-button>
    </x-slot:trigger>

    <x-slot:title>{{ $product->name }}</x-slot:title>

    <x-slot:description>Product Details</x-slot:description>

    <x-slot:content class="space-y-6">
        {{-- Product Image --}}
        <img
            src="{{ $product->image }}"
            alt="{{ $product->name }}"
            class="w-full rounded-lg" />

        {{-- Description --}}
        <div>
            <h3 class="mb-2 font-medium">Description</h3>
            <p class="text-muted-foreground text-sm">
                {{ $product->description }}
            </p>
        </div>

        {{-- Specifications --}}
        <div>
            <h3 class="mb-2 font-medium">Specifications</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-muted-foreground">SKU</dt>
                    <dd class="font-medium">{{ $product->sku }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-muted-foreground">Price</dt>
                    <dd class="font-medium">${{ $product->price }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-muted-foreground">Stock</dt>
                    <dd class="font-medium">{{ $product->stock }} units</dd>
                </div>
            </dl>
        </div>
    </x-slot:content>

    <x-slot:action>
        <x-button
            wire:click="addToCart({{ $product->id }})"
            class="w-full">
            Add to Cart
        </x-button>
    </x-slot:action>
</x-slide-over>
```

### Slide from Different Sides

```blade
{{-- Right (default) --}}
<x-slide-over side="right">
    <x-slot:trigger>
        <x-button>From Right</x-button>
    </x-slot:trigger>

    <x-slot:title>Right Panel</x-slot:title>

    <x-slot:content>This panel slides in from the right edge.</x-slot:content>
</x-slide-over>

{{-- Left --}}
<x-slide-over side="left">
    <x-slot:trigger>
        <x-button>From Left</x-button>
    </x-slot:trigger>

    <x-slot:title>Left Panel</x-slot:title>

    <x-slot:content>This panel slides in from the left edge.</x-slot:content>
</x-slide-over>

{{-- Top --}}
<x-slide-over side="top">
    <x-slot:trigger>
        <x-button>From Top</x-button>
    </x-slot:trigger>

    <x-slot:title>Top Panel</x-slot:title>

    <x-slot:content>This panel slides down from the top.</x-slot:content>
</x-slide-over>

{{-- Bottom --}}
<x-slide-over side="bottom">
    <x-slot:trigger>
        <x-button>From Bottom</x-button>
    </x-slot:trigger>

    <x-slot:title>Bottom Panel</x-slot:title>

    <x-slot:content>This panel slides up from the bottom.</x-slot:content>
</x-slide-over>
```

### Mobile Navigation

```blade
<x-slide-over side="left">
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon"
            class="md:hidden">
            @svg('lucide-menu', 'size-6')
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Menu</x-slot:title>

    <x-slot:content>
        <nav class="space-y-1">
            <a
                href="/dashboard"
                class="hover:bg-accent flex items-center gap-3 rounded-lg px-3 py-2">
                @svg('lucide-home', 'size-5')
                Dashboard
            </a>

            <a
                href="/projects"
                class="hover:bg-accent flex items-center gap-3 rounded-lg px-3 py-2">
                @svg('lucide-folder', 'size-5')
                Projects
            </a>

            <a
                href="/team"
                class="hover:bg-accent flex items-center gap-3 rounded-lg px-3 py-2">
                @svg('lucide-users', 'size-5')
                Team
            </a>

            <a
                href="/settings"
                class="hover:bg-accent flex items-center gap-3 rounded-lg px-3 py-2">
                @svg('lucide-settings', 'size-5')
                Settings
            </a>
        </nav>
    </x-slot:content>

    <x-slot:footer>
        <x-button
            variant="outline"
            class="w-full">
            @svg('lucide-log-out', 'size-4')
            Sign Out
        </x-button>
    </x-slot:footer>
</x-slide-over>
```

### Shopping Cart

```blade
<x-slide-over side="right">
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon"
            class="relative">
            @svg('lucide-shopping-cart', 'size-5')
            @if ($cartCount > 0)
                <span class="bg-destructive text-destructive-foreground absolute -right-1 -top-1 flex size-5 items-center justify-center rounded-full text-xs">
                    {{ $cartCount }}
                </span>
            @endif
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Shopping Cart</x-slot:title>

    <x-slot:description>{{ $cartCount }} {{ Str::plural('item', $cartCount) }} in your cart</x-slot:description>

    <x-slot:content>
        @forelse ($cartItems as $item)
            <div class="flex gap-4 border-b py-4">
                <img
                    src="{{ $item->image }}"
                    alt="{{ $item->name }}"
                    class="size-20 rounded-lg object-cover" />

                <div class="flex-1">
                    <h4 class="font-medium">{{ $item->name }}</h4>
                    <p class="text-muted-foreground text-sm">${{ $item->price }} × {{ $item->quantity }}</p>

                    <div class="mt-2 flex items-center gap-2">
                        <x-button
                            variant="outline"
                            size="icon-xs"
                            wire:click="decreaseQuantity({{ $item->id }})">
                            @svg('lucide-minus', 'size-3')
                        </x-button>

                        <span class="text-sm">{{ $item->quantity }}</span>

                        <x-button
                            variant="outline"
                            size="icon-xs"
                            wire:click="increaseQuantity({{ $item->id }})">
                            @svg('lucide-plus', 'size-3')
                        </x-button>

                        <x-button
                            variant="ghost"
                            size="icon-xs"
                            wire:click="removeItem({{ $item->id }})"
                            class="ml-auto">
                            @svg('lucide-trash-2', 'size-3')
                        </x-button>
                    </div>
                </div>
            </div>
        @empty
            <x-empty>
                <x-slot:media>
                    @svg('lucide-shopping-cart', 'size-12')
                </x-slot:media>
                <x-slot:title>Your cart is empty</x-slot:title>
                <x-slot:description>Add items to your cart to see them here</x-slot:description>
            </x-empty>
        @endforelse
    </x-slot:content>

    <x-slot:footer class="space-y-4">
        <div class="flex items-center justify-between text-lg font-bold">
            <span>Total</span>
            <span>${{ $cartTotal }}</span>
        </div>

        <x-button
            class="w-full"
            wire:click="checkout">
            Checkout
        </x-button>
    </x-slot:footer>
</x-slide-over>
```

### Filter Panel

```blade
<x-slide-over side="right">
    <x-slot:trigger>
        <x-button variant="outline">
            @svg('lucide-filter', 'size-4')
            Filters
            @if ($activeFilters > 0)
                <x-badge class="ml-2">{{ $activeFilters }}</x-badge>
            @endif
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Filter Products</x-slot:title>

    <x-slot:content class="space-y-6">
        <div>
            <h3 class="mb-3 font-medium">Category</h3>
            <div class="space-y-2">
                @foreach ($categories as $category)
                    <label class="flex items-center gap-2">
                        <x-checkbox
                            wire:model.live="filters.categories"
                            value="{{ $category->id }}" />
                        <span class="text-sm">{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <x-separator />

        <div>
            <h3 class="mb-3 font-medium">Price Range</h3>
            <div class="space-y-3">
                <div class="flex gap-2">
                    <x-input
                        wire:model.live="filters.minPrice"
                        type="number"
                        placeholder="Min" />
                    <x-input
                        wire:model.live="filters.maxPrice"
                        type="number"
                        placeholder="Max" />
                </div>
            </div>
        </div>

        <x-separator />

        <div>
            <h3 class="mb-3 font-medium">Rating</h3>
            <div class="space-y-2">
                @for ($i = 5; $i >= 1; $i--)
                    <label class="flex items-center gap-2">
                        <x-checkbox
                            wire:model.live="filters.ratings"
                            value="{{ $i }}" />
                        <span class="flex items-center gap-1 text-sm">
                            @for ($j = 0; $j < $i; $j++)
                                @svg('lucide-star', 'size-3 fill-yellow-400 text-yellow-400')
                            @endfor

                            & up
                        </span>
                    </label>
                @endfor
            </div>
        </div>
    </x-slot:content>

    <x-slot:footer class="flex gap-2">
        <x-button
            wire:click="clearFilters"
            variant="outline"
            class="flex-1">
            Clear All
        </x-button>
        <x-button
            wire:click="applyFilters"
            class="flex-1">
            Apply Filters
        </x-button>
    </x-slot:footer>
</x-slide-over>
```

### Form Panel

```blade
<x-slide-over>
    <x-slot:trigger>
        <x-button>
            @svg('lucide-plus', 'size-4')
            New Project
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Create Project</x-slot:title>

    <x-slot:description>Fill in the details below to create a new project</x-slot:description>

    <x-slot:content>
        <form
            wire:submit="createProject"
            class="space-y-4">
            <x-field>
                <x-label>Project Name</x-label>
                <x-input
                    wire:model="name"
                    placeholder="Enter project name" />
                <x-error key="name" />
            </x-field>

            <x-field>
                <x-label>Description</x-label>
                <x-textarea
                    wire:model="description"
                    placeholder="Describe your project"
                    rows="4"></x-textarea>
                <x-error key="description" />
            </x-field>

            <x-field>
                <x-label>Category</x-label>
                <x-select wire:model="category">
                    <option value="">Select category</option>
                    <option value="design">Design</option>
                    <option value="development">Development</option>
                    <option value="marketing">Marketing</option>
                </x-select>
                <x-error key="category" />
            </x-field>

            <x-field>
                <x-label>Team Members</x-label>
                <x-select
                    wire:model="members"
                    multiple>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </x-select>
                <x-error key="members" />
            </x-field>

            <x-field>
                <x-label>Due Date</x-label>
                <x-input
                    wire:model="dueDate"
                    type="date" />
                <x-error key="dueDate" />
            </x-field>
        </form>
    </x-slot:content>

    <x-slot:action>
        <x-button
            wire:click="createProject"
            class="w-full">
            Create Project
        </x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button
            variant="outline"
            class="w-full">
            Cancel
        </x-button>
    </x-slot:cancel>
</x-slide-over>
```

### Notification Panel

```blade
<x-slide-over side="right">
    <x-slot:trigger>
        <x-button
            variant="ghost"
            size="icon"
            class="relative">
            @svg('lucide-bell', 'size-5')
            @if ($unreadCount > 0)
                <span class="bg-destructive text-destructive-foreground absolute -right-1 -top-1 flex size-5 items-center justify-center rounded-full text-xs">
                    {{ $unreadCount }}
                </span>
            @endif
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Notifications</x-slot:title>

    <x-slot:description>You have {{ $unreadCount }} unread {{ Str::plural('notification', $unreadCount) }}</x-slot:description>

    <x-slot:content class="space-y-4">
        @forelse ($notifications as $notification)
            <div
                class="border-b pb-4 last:border-0"
                wire:key="notification-{{ $notification->id }}">
                <div class="flex gap-3">
                    <div class="shrink-0">
                        @if ($notification->type === 'success')
                            <div class="flex size-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                                @svg('lucide-check-circle', 'size-5 text-green-600 dark:text-green-400')
                            </div>
                        @elseif ($notification->type === 'warning')
                            <div class="flex size-10 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/20">
                                @svg('lucide-alert-triangle', 'size-5 text-yellow-600 dark:text-yellow-400')
                            </div>
                        @else
                            <div class="flex size-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20">
                                @svg('lucide-info', 'size-5 text-blue-600 dark:text-blue-400')
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h4 class="font-medium">{{ $notification->title }}</h4>
                        <p class="text-muted-foreground text-sm">{{ $notification->message }}</p>
                        <time class="text-muted-foreground mt-1 text-xs">
                            {{ $notification->created_at->diffForHumans() }}
                        </time>
                    </div>

                    @if (! $notification->read_at)
                        <div class="shrink-0">
                            <span class="flex size-2 rounded-full bg-blue-500"></span>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <x-empty>
                <x-slot:media>
                    @svg('lucide-inbox', 'size-12')
                </x-slot:media>
                <x-slot:title>No notifications</x-slot:title>
                <x-slot:description>You're all caught up!</x-slot:description>
            </x-empty>
        @endforelse
    </x-slot:content>

    @if ($notifications->isNotEmpty())
        <x-slot:footer>
            <x-button
                variant="outline"
                class="w-full"
                wire:click="markAllAsRead">
                Mark all as read
            </x-button>
        </x-slot:footer>
    @endif
</x-slide-over>
```

### Programmatic Control

```blade
<div x-data="{ panelOpen: false }">
    <div class="flex gap-2">
        <x-button
            x-on:click="panelOpen = true"
            size="sm">
            Open Panel
        </x-button>
        <x-button
            x-on:click="panelOpen = false"
            size="sm"
            variant="outline">
            Close Panel
        </x-button>
    </div>

    <x-slide-over x-model="panelOpen">
        <x-slot:title>Controlled Slide-over</x-slot:title>

        <x-slot:content>
            <p>This slide-over is controlled via x-model binding.</p>
        </x-slot:content>

        <x-slot:cancel>
            <x-button
                variant="outline"
                class="w-full"
                x-on:click="panelOpen = false">
                Close
            </x-button>
        </x-slot:cancel>
    </x-slide-over>
</div>
```

## Accessibility

### Focus Management

The slide-over traps focus within its content:

- **Tab**: Navigate forward through focusable elements
- **Shift+Tab**: Navigate backward
- **Escape**: Close the slide-over
- Focus returns to trigger element on close

### Keyboard Navigation

All interactive elements are keyboard accessible:

```blade
<x-slide-over>
    <x-slot:trigger>
        <x-button>Accessible Panel</x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-input placeholder="First input" />
        <x-input placeholder="Second input" />
        <x-button>Submit</x-button>
    </x-slot:content>
</x-slide-over>
```

### Screen Reader Support

```blade
{{-- Good: Descriptive title --}}
<x-slide-over>
    <x-slot:trigger>
        <x-button aria-label="Open shopping cart">
            @svg('lucide-shopping-cart')
        </x-button>
    </x-slot:trigger>

    <x-slot:title>Shopping Cart</x-slot:title>
    <x-slot:description>Review items before checkout</x-slot:description>

    <x-slot:content>
        <!-- Cart contents -->
    </x-slot:content>
</x-slide-over>
```

## Best Practices

### Choose Appropriate Side

```blade
{{-- Good: Right for details/actions (LTR layouts) --}}
<x-slide-over side="right">
    <x-slot:title>Product Details</x-slot:title>
    <x-slot:content>...</x-slot:content>
</x-slide-over>

{{-- Good: Left for navigation --}}
<x-slide-over side="left">
    <x-slot:title>Menu</x-slot:title>
    <x-slot:content>...</x-slot:content>
</x-slide-over>

{{-- Good: Bottom for mobile actions --}}
<x-slide-over side="bottom">
    <x-slot:title>Share</x-slot:title>
    <x-slot:content>...</x-slot:content>
</x-slide-over>
```

### Provide Clear Context

```blade
{{-- Good: Title and description --}}
<x-slide-over>
    <x-slot:title>Edit User</x-slot:title>
    <x-slot:description>Update user information and permissions</x-slot:description>
    <x-slot:content>...</x-slot:content>
</x-slide-over>
```

### Include Close Action

```blade
{{-- Good: Provide explicit close button --}}
<x-slide-over>
    <x-slot:content>...</x-slot:content>

    <x-slot:cancel>
        <x-button
            variant="outline"
            class="w-full">
            Close
        </x-button>
    </x-slot:cancel>
</x-slide-over>
```

### Avoid Nested Slide-overs

```blade
{{-- Avoid: Opening slide-over from another slide-over --}}
{{-- Use Dialog instead for secondary modals --}}
```

## Technical Details

### Dialog Manager API

The slide-over uses `$mog.dialog`:

```javascript
// Open slide-over
$mog.dialog.open(slideOverId)

// Close slide-over
$mog.dialog.close(slideOverId)

// Close all dialogs/slide-overs
$mog.dialog.closeAll()
```

### Event System

```blade
<div
    x-on:mog::dialog-open.document="console.log('Opened:', $event.detail.id)"
    x-on:mog::dialog-close.document="console.log('Closed:', $event.detail.id)">
    <!-- Your slide-overs -->
</div>
```

### Scroll Locking

When a slide-over opens:

- `data-scroll-locked="true"` added to `<body>`
- Background scrolling prevented
- Removed when all dialogs/slide-overs close

### Teleportation

Content teleports to `#mog-dialog-container`:

- Renders at document root level
- Avoids z-index issues
- Proper stacking for multiple panels

## Related Components

- [Dialog](./dialog.md) - Centered modal alternative
- [Popover](./popover.md) - Non-blocking contextual overlays
- [Dropdown](./dropdown.md) - Menu of actions
- [Overlay](./overlay.md) - Base overlay component

## Common Patterns

### Mobile-First Navigation

```blade
{{-- Show on mobile, hide on desktop --}}
<div class="lg:hidden">
    <x-slide-over side="left">
        <x-slot:trigger>
            <x-button
                variant="ghost"
                size="icon">
                @svg('lucide-menu', 'size-6')
            </x-button>
        </x-slot:trigger>

        <x-slot:title>Navigation</x-slot:title>

        <x-slot:content>
            <!-- Mobile navigation -->
        </x-slot:content>
    </x-slide-over>
</div>

{{-- Desktop navigation --}}
<div class="hidden lg:block">
    <!-- Desktop navigation -->
</div>
```

### Quick Actions Panel

```blade
<x-slide-over side="bottom">
    <x-slot:trigger>
        <x-button>Quick Actions</x-button>
    </x-slot:trigger>

    <x-slot:title>Actions</x-slot:title>

    <x-slot:content>
        <div class="grid grid-cols-3 gap-4 p-4">
            <x-button
                variant="outline"
                class="h-auto flex-col gap-2 py-4">
                @svg('lucide-download', 'size-6')
                Download
            </x-button>
            <x-button
                variant="outline"
                class="h-auto flex-col gap-2 py-4">
                @svg('lucide-share-2', 'size-6')
                Share
            </x-button>
            <x-button
                variant="outline"
                class="h-auto flex-col gap-2 py-4">
                @svg('lucide-copy', 'size-6')
                Copy
            </x-button>
        </div>
    </x-slot:content>
</x-slide-over>
```
