# Scrollable

The Scrollable component creates scrollable areas with custom styling and focus indicators. It provides a consistent scrolling experience with keyboard focus support and visual feedback.

## Overview

Scrollable containers allow content to overflow with scrollbars, enabling users to view more content without leaving the current page context. The component includes focus ring indicators for keyboard navigation and inherits border radius from parent containers.

### When to Use

- **Long content**: Display lengthy content in a fixed-height container
- **Tables**: Make wide tables horizontally scrollable
- **Code blocks**: Show code with scrollable overflow
- **Chat windows**: Create scrollable message lists
- **Sidebar content**: Scrollable navigation or content panels
- **Modal content**: Long content within dialogs or modals

## Props

The Scrollable component accepts standard HTML attributes and merges them with the base styling using TailwindMerge.

**No specific props** - Uses default slot for content and attributes for customization.

## Features

### Focus Indicators

Keyboard focus shows a visible ring:

- Focus ring with theme-aware color
- Smooth transition on focus/blur
- 3px ring width for visibility
- 50% opacity for subtlety

### Inherited Border Radius

Automatically inherits parent border radius:

- Uses `rounded-[inherit]`
- Matches parent container styling
- Seamless visual integration

### Scrollable Viewport

Inner viewport handles scrolling:

- Full size (`size-full`)
- Smooth scrolling behavior
- Custom scrollbar styling (browser-dependent)

### Direction Support

Includes `dir="ltr"` for consistent layout:

- Left-to-right scrolling
- Proper scrollbar positioning
- RTL can be overridden if needed

## Usage Examples

### Basic Scrollable

```blade
<x-scrollable class="h-64 rounded-lg border">
    <div class="p-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco...</p>
        {{-- More content that causes scrolling --}}
    </div>
</x-scrollable>
```

### Scrollable Table

```blade
<x-scrollable class="max-h-96 rounded-lg border">
    <x-table>
        <x-slot:header>
            <x-tr>
                <x-th>ID</x-th>
                <x-th>Name</x-th>
                <x-th>Email</x-th>
                <x-th>Status</x-th>
                <x-th>Actions</x-th>
            </x-tr>
        </x-slot:header>

        <x-slot:body>
            @foreach ($users as $user)
                <x-tr>
                    <x-cell>{{ $user->id }}</x-cell>
                    <x-cell>{{ $user->name }}</x-cell>
                    <x-cell>{{ $user->email }}</x-cell>
                    <x-cell>
                        <x-badge>{{ $user->status }}</x-badge>
                    </x-cell>
                    <x-cell>
                        <x-button
                            size="sm"
                            variant="ghost">
                            Edit
                        </x-button>
                    </x-cell>
                </x-tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-scrollable>
```

### Code Block

```blade
<x-scrollable class="bg-muted max-h-64 rounded-lg">
    <pre class="p-4"><code class="text-sm">{{ $codeContent }}</code></pre>
</x-scrollable>
```

### Chat Messages

```blade
<div class="flex h-screen flex-col">
    <div class="border-b p-4">
        <h2 class="font-semibold">Chat Room</h2>
    </div>

    <x-scrollable class="flex-1">
        <div class="space-y-4 p-4">
            @foreach ($messages as $message)
                <div class="flex gap-3">
                    <x-avatar class="size-8">
                        <x-avatar-image src="{{ $message->user->avatar }}" />
                        <x-avatar-fallback>{{ $message->user->initials }}</x-avatar-fallback>
                    </x-avatar>

                    <div class="flex-1">
                        <div class="flex items-baseline gap-2">
                            <span class="font-medium">{{ $message->user->name }}</span>
                            <span class="text-muted-foreground text-xs">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm">{{ $message->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-scrollable>

    <div class="border-t p-4">
        <x-input placeholder="Type a message..." />
    </div>
</div>
```

### Sidebar Navigation

```blade
<aside class="flex h-screen w-64 flex-col border-r">
    <div class="p-4">
        <h2 class="text-lg font-semibold">Navigation</h2>
    </div>

    <x-scrollable class="flex-1">
        <nav class="space-y-1 p-2">
            <a
                href="#"
                class="hover:bg-muted block rounded-lg px-3 py-2">
                Dashboard
            </a>
            <a
                href="#"
                class="hover:bg-muted block rounded-lg px-3 py-2">
                Projects
            </a>
            <a
                href="#"
                class="hover:bg-muted block rounded-lg px-3 py-2">
                Tasks
            </a>

            <x-separator class="my-2" />

            <div class="px-3 py-2">
                <h3 class="text-muted-foreground mb-2 text-xs font-semibold uppercase">Teams</h3>
                <div class="space-y-1">
                    @foreach ($teams as $team)
                        <a
                            href="#"
                            class="hover:bg-muted block rounded-lg px-3 py-2 text-sm">
                            {{ $team->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </x-scrollable>

    <div class="border-t p-4">
        <x-button class="w-full">Settings</x-button>
    </div>
</aside>
```

### Modal with Scrollable Content

```blade
<x-dialog size="xl">
    <x-slot:trigger>
        <x-button>View Terms</x-button>
    </x-slot:trigger>

    <x-slot:title>Terms and Conditions</x-slot:title>

    <x-slot:content>
        <x-scrollable class="max-h-96 rounded-lg border p-4">
            <div class="prose prose-sm">
                <h3>1. Introduction</h3>
                <p>Lorem ipsum dolor sit amet...</p>

                <h3>2. User Obligations</h3>
                <p>Consectetur adipiscing elit...</p>

                {{-- Long terms content --}}
            </div>
        </x-scrollable>
    </x-slot:content>

    <x-slot:action>
        <x-button>I Agree</x-button>
    </x-slot:action>

    <x-slot:cancel>
        <x-button variant="outline">Decline</x-button>
    </x-slot:cancel>
</x-dialog>
```

### Card with Scrollable Body

```blade
<x-card>
    <x-slot:title>Activity Feed</x-slot:title>

    <x-slot:description>Recent activity in your workspace</x-slot:description>

    <x-slot:content class="p-0">
        <x-scrollable class="max-h-80">
            <div class="divide-y">
                @foreach ($activities as $activity)
                    <div class="flex gap-3 p-4">
                        <div class="bg-primary/10 flex size-8 items-center justify-center rounded-full">
                            @svg($activity->icon, 'text-primary size-4')
                        </div>

                        <div class="flex-1">
                            <p class="text-sm">{{ $activity->description }}</p>
                            <p class="text-muted-foreground text-xs">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-scrollable>
    </x-slot:content>

    <x-slot:footer>
        <x-button
            variant="outline"
            class="w-full">
            View All Activity
        </x-button>
    </x-slot:footer>
</x-card>
```

### Horizontal Scrolling

```blade
<x-scrollable class="overflow-x-auto">
    <div class="flex gap-4 p-4">
        @foreach ($items as $item)
            <x-card class="w-64 shrink-0">
                <x-slot:content>
                    <img
                        src="{{ $item->image }}"
                        alt="{{ $item->title }}"
                        class="h-40 w-full rounded object-cover" />
                    <h3 class="mt-2 font-medium">{{ $item->title }}</h3>
                </x-slot:content>
            </x-card>
        @endforeach
    </div>
</x-scrollable>
```

### Data Table Wrapper

```blade
<div class="rounded-lg border">
    <div class="p-4">
        <div class="flex items-center justify-between">
            <h3 class="font-semibold">Users</h3>
            <x-button size="sm">Add User</x-button>
        </div>
    </div>

    <x-separator />

    <x-scrollable class="max-h-[600px]">
        <x-table>
            <x-slot:header class="bg-muted/50 sticky top-0">
                <x-tr>
                    <x-th>Name</x-th>
                    <x-th>Email</x-th>
                    <x-th>Role</x-th>
                    <x-th>Status</x-th>
                </x-tr>
            </x-slot:header>

            <x-slot:body>
                @foreach ($users as $user)
                    <x-tr>
                        <x-cell>{{ $user->name }}</x-cell>
                        <x-cell>{{ $user->email }}</x-cell>
                        <x-cell>{{ $user->role }}</x-cell>
                        <x-cell>
                            <x-badge>{{ $user->status }}</x-badge>
                        </x-cell>
                    </x-tr>
                @endforeach
            </x-slot:body>
        </x-table>
    </x-scrollable>

    <x-separator />

    <div class="p-4">
        <div class="text-muted-foreground text-sm">Showing {{ $users->count() }} of {{ $users->total() }} users</div>
    </div>
</div>
```

### File Browser

```blade
<x-scrollable class="h-96 rounded-lg border">
    <div class="divide-y">
        @foreach ($files as $file)
            <div class="hover:bg-muted flex cursor-pointer items-center gap-3 p-3 transition-colors">
                <div class="bg-primary/10 flex size-10 items-center justify-center rounded">
                    @if ($file->type === 'folder')
                        @svg('lucide-folder', 'text-primary size-5')
                    @else
                        @svg('lucide-file', 'text-muted-foreground size-5')
                    @endif
                </div>

                <div class="flex-1">
                    <div class="font-medium">{{ $file->name }}</div>
                    <div class="text-muted-foreground text-xs">
                        {{ $file->type === 'folder' ? $file->items_count.' items' : $file->size }}
                    </div>
                </div>

                <div class="text-muted-foreground text-xs">
                    {{ $file->modified_at->format('M d, Y') }}
                </div>
            </div>
        @endforeach
    </div>
</x-scrollable>
```

### JSON Viewer

```blade
<x-scrollable class="bg-muted max-h-96 rounded-lg font-mono text-sm">
    <pre class="p-4">{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
</x-scrollable>
```

### Notification Panel

```blade
<div class="w-80 rounded-lg border shadow-lg">
    <div class="flex items-center justify-between border-b p-4">
        <h3 class="font-semibold">Notifications</h3>
        <x-button
            variant="ghost"
            size="sm">
            Mark all read
        </x-button>
    </div>

    <x-scrollable class="max-h-96">
        <div class="divide-y">
            @forelse ($notifications as $notification)
                <div
                    class="hover:bg-muted p-4 transition-colors"
                    :class="{ 'bg-muted/50': !$notification->read }">
                    <div class="flex gap-3">
                        <div class="bg-primary/10 flex size-8 shrink-0 items-center justify-center rounded-full">
                            @svg($notification->icon, 'text-primary size-4')
                        </div>

                        <div class="flex-1">
                            <p class="text-sm font-medium">{{ $notification->title }}</p>
                            <p class="text-muted-foreground text-xs">{{ $notification->message }}</p>
                            <p class="text-muted-foreground mt-1 text-xs">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <x-empty>
                        <x-slot:icon>
                            @svg('lucide-bell-off', 'size-8')
                        </x-slot:icon>
                        <x-slot:title>No notifications</x-slot:title>
                        <x-slot:description>You're all caught up!</x-slot:description>
                    </x-empty>
                </div>
            @endforelse
        </div>
    </x-scrollable>
</div>
```

## Accessibility

### Keyboard Navigation

Scrollable areas are keyboard accessible:

- **Tab**: Focus the scrollable container
- **Arrow keys**: Scroll content when focused
- **Space/Page Down**: Scroll down one page
- **Page Up**: Scroll up one page
- **Home/End**: Scroll to top/bottom

### Focus Indicators

Clear focus rings for keyboard users:

```blade
{{-- Good: Component includes focus-visible ring --}}
<x-scrollable class="h-64 rounded-lg border">
    <!-- Content -->
</x-scrollable>

{{-- The focus ring appears automatically on keyboard focus --}}
```

### Screen Reader Support

```blade
{{-- Good: Add ARIA labels for context --}}
<x-scrollable
    class="h-64 rounded-lg border"
    aria-label="Message history">
    @foreach ($messages as $message)
        <div>{{ $message->content }}</div>
    @endforeach
</x-scrollable>
```

### Scrollable Hints

Indicate scrollable content:

```blade
{{-- Good: Visual cue for scrollable content --}}
<div class="relative">
    <x-scrollable class="h-64 rounded-lg border">
        <!-- Long content -->
    </x-scrollable>

    {{-- Gradient overlay at bottom --}}
    <div class="from-background pointer-events-none absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t to-transparent"></div>
</div>
```

## Best Practices

### Set Explicit Heights

```blade
{{-- Good: Explicit max height --}}
<x-scrollable class="max-h-96 rounded-lg border">
    <!-- Content -->
</x-scrollable>

{{-- Avoid: No height constraint (won't scroll) --}}
<x-scrollable class="rounded-lg border">
    <!-- Content won't scroll without height limit -->
</x-scrollable>
```

### Use with Borders

```blade
{{-- Good: Border defines scrollable area --}}
<x-scrollable class="max-h-64 rounded-lg border">
    <div class="p-4">Content</div>
</x-scrollable>

{{-- Good: Card provides container --}}
<x-card>
    <x-slot:content class="p-0">
        <x-scrollable class="max-h-64">
            <div class="p-6">Content</div>
        </x-scrollable>
    </x-slot:content>
</x-card>
```

### Sticky Headers

```blade
{{-- Good: Sticky header in scrollable table --}}
<x-scrollable class="max-h-96 rounded-lg border">
    <x-table>
        <x-slot:header class="bg-background sticky top-0 z-10">
            <x-tr>...</x-tr>
        </x-slot:header>
        <x-slot:body>...</x-slot:body>
    </x-table>
</x-scrollable>
```

### Smooth Scrolling

```blade
{{-- Good: Enable smooth scrolling --}}
<x-scrollable class="max-h-96 scroll-smooth rounded-lg border">
    <!-- Content -->
</x-scrollable>
```

## Technical Details

### Component Structure

```blade
<div
    dir="ltr"
    data-slot="scrollable"
    class="relative">
    <div
        class="focus-visible:ring-ring/50 size-full rounded-[inherit] outline-none transition-[color,box-shadow] focus-visible:outline-1 focus-visible:ring-[3px]"
        data-slot="scrollable-viewport">
        {{ $slot }}
    </div>
</div>
```

### CSS Classes

```css
/* Outer container */
relative                    /* Position context */
dir="ltr"                  /* Left-to-right direction */

/* Inner viewport */
size-full                  /* Full width and height */
rounded-[inherit]          /* Inherit parent border radius */
outline-none               /* Remove default outline */
transition-[color,box-shadow]  /* Smooth transitions */

/* Focus state */
focus-visible:outline-1    /* 1px outline on focus */
focus-visible:ring-[3px]   /* 3px focus ring */
focus-visible:ring-ring/50 /* Ring color with 50% opacity */
```

### Browser Scrollbar Styling

Custom scrollbar styles can be added:

```blade
<x-scrollable class="[&::-webkit-scrollbar-thumb]:bg-border max-h-96 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar]:w-2">
    <!-- Content -->
</x-scrollable>
```

### Overflow Behavior

Add overflow classes as needed:

```blade
{{-- Vertical scroll only --}}
<x-scrollable class="max-h-64 overflow-y-auto">
    {{-- Horizontal scroll only --}}
    <x-scrollable class="overflow-x-auto">
        {{-- Both directions --}}
        <x-scrollable class="max-h-64 overflow-auto"></x-scrollable>
    </x-scrollable>
</x-scrollable>
```

## Related Components

- [Table](./table.md) - Wrap tables for scrolling
- [Card](./card.md) - Use scrollable in card content
- [Dialog](./dialog.md) - Scrollable modal content
- [Separator](./separator.md) - Divide scrollable sections

## Common Patterns

### Sticky Footer

```blade
<div class="flex h-96 flex-col rounded-lg border">
    <div class="border-b p-4">
        <h3 class="font-semibold">Header</h3>
    </div>

    <x-scrollable class="flex-1">
        <div class="p-4">
            <!-- Scrollable content -->
        </div>
    </x-scrollable>

    <div class="border-t p-4">
        <x-button class="w-full">Action</x-button>
    </div>
</div>
```

### Virtual Scrolling Hint

```blade
{{-- For very long lists, consider virtual scrolling --}}
<x-scrollable
    class="max-h-96"
    x-data="{ visibleItems: [] }"
    x-init="/* Virtual scrolling logic */">
    <!-- Render only visible items -->
</x-scrollable>
```

### Auto-Scroll to Bottom

```blade
<x-scrollable
    class="max-h-96"
    x-ref="scrollable"
    x-init="$nextTick(() => $refs.scrollable.scrollTop = $refs.scrollable.scrollHeight)">
    @foreach ($messages as $message)
        <div>{{ $message->content }}</div>
    @endforeach
</x-scrollable>
```
