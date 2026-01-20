# Badge

The Badge component provides compact status indicators, labels, and tags for highlighting information. Badges can be used to show counts, status, categories, or any short piece of information that needs visual emphasis.

## Overview

Badges are small, pill-shaped components used to label, categorize, or organize items. They provide at-a-glance information and visual organization to your UI.

### When to Use

- **Status indicators**: Show item status (active, pending, completed)
- **Counts**: Display notification counts, item quantities
- **Categories**: Tag items with categories or labels
- **Metadata**: Show additional information about items
- **Highlighting**: Draw attention to important information

## Props

### `variant`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'secondary'`, `'destructive'`, `'outline'`

Controls the visual style of the badge.

- **`default`**: Primary badge with solid background
- **`secondary`**: Muted badge for less prominent information
- **`destructive`**: Red-themed badge for errors or warnings
- **`outline`**: Badge with border and transparent background

### `asLink`

**Type:** `boolean`
**Default:** `false`

When `true`, renders the badge as an `<a>` tag instead of a `<span>` tag. Use this for badges that are clickable links.

## Features

### Automatic Sizing

Badges automatically size to fit their content with proper padding and spacing.

### Icon Support

Badges can contain icons alongside text or icons alone:

- Icons shrink to `size-3` (12px)
- Icons are non-interactive (`pointer-events-none`)
- 4px gap between icon and text

### Focus States

Link badges include visible focus states:

- Focus ring with proper contrast
- Focus-visible support for keyboard navigation

### Invalid States

Badges support `aria-invalid` for validation contexts:

- Red focus ring for invalid states
- Visual feedback for form errors

## Usage Examples

### Basic Badge

```blade
<x-badge>Default</x-badge>
```

### All Variants

```blade
{{-- Default / Primary --}}
<x-badge variant="default">Primary</x-badge>

{{-- Secondary --}}
<x-badge variant="secondary">Secondary</x-badge>

{{-- Destructive --}}
<x-badge variant="destructive">Error</x-badge>

{{-- Outline --}}
<x-badge variant="outline">Outline</x-badge>
```

### Status Badges

```blade
{{-- Active status --}}
<x-badge variant="default">Active</x-badge>

{{-- Pending status --}}
<x-badge variant="secondary">Pending</x-badge>

{{-- Success status --}}
<x-badge variant="default">Completed</x-badge>

{{-- Error status --}}
<x-badge variant="destructive">Failed</x-badge>

{{-- Warning status --}}
<x-badge variant="secondary">Draft</x-badge>
```

### Badges with Icons

```blade
{{-- Icon before text --}}
<x-badge>
    @svg('lucide-check')
    Verified
</x-badge>

{{-- Icon after text --}}
<x-badge>
    3
    @svg('lucide-bell')
</x-badge>

{{-- Icon only --}}
<x-badge variant="destructive">
    @svg('lucide-x')
</x-badge>
```

### Count Badges

```blade
{{-- Notification count --}}
<div class="relative inline-block">
    @svg('lucide-bell', 'size-6')
    <x-badge
        variant="destructive"
        class="absolute -right-1 -top-1">
        12
    </x-badge>
</div>

{{-- Item count --}}
<div class="flex items-center gap-2">
    <span>Messages</span>
    <x-badge>24</x-badge>
</div>

{{-- Shopping cart --}}
<div class="relative">
    @svg('lucide-shopping-cart', 'size-6')
    <x-badge
        variant="default"
        class="absolute -right-2 -top-2">
        3
    </x-badge>
</div>
```

### Category Tags

```blade
{{-- Blog post categories --}}
<div class="flex flex-wrap gap-2">
    <x-badge variant="outline">Laravel</x-badge>
    <x-badge variant="outline">PHP</x-badge>
    <x-badge variant="outline">Livewire</x-badge>
</div>

{{-- Product tags --}}
<div class="flex gap-2">
    <x-badge variant="secondary">New</x-badge>
    <x-badge variant="default">On Sale</x-badge>
    <x-badge variant="secondary">Free Shipping</x-badge>
</div>
```

### Clickable Badges (Links)

```blade
{{-- Badge as link --}}
<x-badge
    asLink
    href="/category/laravel">
    Laravel
</x-badge>

{{-- Multiple badge links --}}
<div class="flex gap-2">
    <x-badge
        asLink
        href="/status/active"
        variant="default">
        Active
    </x-badge>
    <x-badge
        asLink
        href="/status/pending"
        variant="secondary">
        Pending
    </x-badge>
    <x-badge
        asLink
        href="/status/failed"
        variant="destructive">
        Failed
    </x-badge>
</div>
```

### In List Items

```blade
<x-item-group>
    <x-item>
        <x-item-content>
            <x-item-title>
                Project Alpha
                <x-badge variant="default">Active</x-badge>
            </x-item-title>
            <x-item-description>Active development project with 5 members</x-item-description>
        </x-item-content>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>
                Project Beta
                <x-badge variant="secondary">On Hold</x-badge>
            </x-item-title>
            <x-item-description>Temporarily paused until Q2</x-item-description>
        </x-item-content>
    </x-item>
</x-item-group>
```

### In Tables

```blade
<x-table>
    <thead>
        <tr>
            <x-th>Name</x-th>
            <x-th>Email</x-th>
            <x-th>Status</x-th>
            <x-th>Role</x-th>
        </tr>
    </thead>
    <tbody>
        <x-tr>
            <x-td>John Doe</x-td>
            <x-td>
                john
                @example.com
            </x-td>
            <x-td>
                <x-badge variant="default">Active</x-badge>
            </x-td>
            <x-td>
                <x-badge variant="outline">Admin</x-badge>
            </x-td>
        </x-tr>
        <x-tr>
            <x-td>Jane Smith</x-td>
            <x-td>
                jane
                @example.com
            </x-td>
            <x-td>
                <x-badge variant="secondary">Pending</x-badge>
            </x-td>
            <x-td>
                <x-badge variant="outline">User</x-badge>
            </x-td>
        </x-tr>
    </tbody>
</x-table>
```

### In Cards

```blade
<x-card>
    <x-card-header>
        <div class="flex items-center justify-between">
            <x-card-title>Project Status</x-card-title>
            <x-badge variant="default">Active</x-badge>
        </div>
    </x-card-header>
    <x-card-content>
        <p>Current project progress and team updates.</p>
    </x-card-content>
</x-card>
```

### With Avatars

```blade
<div class="flex items-center gap-3">
    <img
        src="/avatar.jpg"
        class="size-10 rounded-full" />
    <div class="flex-1">
        <div class="flex items-center gap-2">
            <span class="font-medium">John Doe</span>
            <x-badge variant="default">Pro</x-badge>
        </div>
        <p class="text-muted-foreground text-sm">
            john
            @example.com
        </p>
    </div>
</div>
```

### Notification Badges

```blade
{{-- Navigation item with count --}}
<a
    href="/notifications"
    class="relative">
    <div class="flex items-center gap-2">
        @svg('lucide-bell', 'size-5')
        <span>Notifications</span>
    </div>
    <x-badge
        variant="destructive"
        class="ml-auto">
        5
    </x-badge>
</a>

{{-- Menu item with badge --}}
<x-item
    tag="a"
    href="/inbox">
    <x-item-media variant="icon">
        @svg('lucide-inbox')
    </x-item-media>
    <x-item-content>
        <x-item-title>Inbox</x-item-title>
    </x-item-content>
    <x-badge>12</x-badge>
</x-item>
```

### Feature Flags

```blade
<div class="space-y-4">
    <x-item>
        <x-item-content>
            <x-item-title>
                Dark Mode
                <x-badge variant="default">Enabled</x-badge>
            </x-item-title>
            <x-item-description>Toggle dark mode for your interface</x-item-description>
        </x-item-content>
    </x-item>

    <x-item>
        <x-item-content>
            <x-item-title>
                Beta Features
                <x-badge variant="secondary">Preview</x-badge>
            </x-item-title>
            <x-item-description>Access experimental features</x-item-description>
        </x-item-content>
    </x-item>
</div>
```

### Dynamic Badges with Livewire

```blade
<div class="flex flex-wrap gap-2">
    @foreach ($tags as $tag)
        <x-badge
            asLink
            wire:click="filterByTag('{{ $tag->id }}')"
            variant="{{ $selectedTag === $tag->id ? 'default' : 'outline' }}">
            {{ $tag->name }}
        </x-badge>
    @endforeach
</div>
```

### Removable Tags

```blade
<div class="flex flex-wrap gap-2">
    @foreach ($selectedTags as $tag)
        <x-badge variant="secondary">
            {{ $tag }}
            <button
                wire:click="removeTag('{{ $tag }}')"
                class="hover:text-destructive ml-1">
                @svg('lucide-x', 'size-3')
            </button>
        </x-badge>
    @endforeach
</div>
```

### Priority Indicators

```blade
<x-item-group>
    @foreach ($tasks as $task)
        <x-item>
            <x-item-content>
                <x-item-title>
                    {{ $task->title }}
                    @if ($task->priority === 'high')
                        <x-badge variant="destructive">High</x-badge>
                    @elseif ($task->priority === 'medium')
                        <x-badge variant="secondary">Medium</x-badge>
                    @else
                        <x-badge variant="outline">Low</x-badge>
                    @endif
                </x-item-title>
                <x-item-description>{{ $task->description }}</x-item-description>
            </x-item-content>
        </x-item>
    @endforeach
</x-item-group>
```

## Accessibility

### Semantic HTML

Badges are rendered as `<span>` by default and `<a>` when clickable:

```blade
{{-- Non-interactive badge --}}
<x-badge>Status</x-badge>

{{-- Interactive badge (link) --}}
<x-badge
    asLink
    href="/filter">
    Category
</x-badge>
```

### ARIA Attributes

```blade
{{-- With description --}}
<x-badge aria-describedby="status-help">Active</x-badge>
<span
    id="status-help"
    class="sr-only">
    User account is currently active
</span>

{{-- Invalid state --}}
<x-badge aria-invalid="true">Error</x-badge>
```

### Screen Reader Context

```blade
{{-- Good: Provides context --}}
<div>
    <span class="font-medium">Status:</span>
    <x-badge>Active</x-badge>
</div>

{{-- Good: Descriptive text --}}
<x-badge>
    <span class="sr-only">User status:</span>
    Active
</x-badge>

{{-- Avoid: Badge without context --}}
<x-badge>3</x-badge>
```

## Best Practices

### When to Use Each Variant

- **`default`**: Active states, primary information, notifications
- **`secondary`**: Neutral information, metadata, secondary states
- **`destructive`**: Errors, warnings, critical alerts, danger states
- **`outline`**: Categories, tags, filters, non-primary information

### Color Semantics

```blade
{{-- Good: Consistent color meaning --}}
<x-badge variant="default">Active</x-badge>
{{-- Success/Active --}}
<x-badge variant="secondary">Pending</x-badge>
{{-- Neutral/Waiting --}}
<x-badge variant="destructive">Error</x-badge>
{{-- Error/Danger --}}

{{-- Good: Count badges use primary --}}
<x-badge variant="default">5</x-badge>
```

### Badge Sizing

```blade
{{-- Badges automatically size to content --}}
<x-badge>A</x-badge>
<x-badge>Active</x-badge>
<x-badge>Very Long Status Text</x-badge>

{{-- Keep badge content short --}}
{{-- Good --}}
<x-badge>New</x-badge>

{{-- Avoid: Too long --}}
<x-badge>This is a very long badge text that wraps</x-badge>
```

### Icon Usage

```blade
{{-- Good: Single icon or icon with short text --}}
<x-badge>
    @svg('lucide-check')
    Verified
</x-badge>
<x-badge>
    3
    @svg('lucide-bell')
</x-badge>

{{-- Avoid: Too many icons --}}
<x-badge>
    @svg('icon1')
    @svg('icon2')
    @svg('icon3')
</x-badge>
```

## Technical Details

### Class Merging

Badges use `cn()` helper for intelligent class merging:

```blade
<x-badge class="absolute right-0 top-0">
    {{-- Custom classes merged with base classes --}}
</x-badge>
```

### Focus States

Link badges include proper focus states:

```blade
<x-badge
    asLink
    href="/category">
    {{-- Includes focus-visible:ring and focus-visible:border states --}}
</x-badge>
```

### Dark Mode

All badge variants include dark mode color adjustments:

```blade
{{-- Destructive badge has specific dark mode styles --}}
<x-badge variant="destructive">Error</x-badge>
```

## Related Components

- [Alert](./alert.md) - For longer notification messages
- [Button](./button.md) - For clickable actions
- [Item](./item.md) - List items often contain badges

## Common Patterns

### Filter Tags

```blade
<div>
    <div class="mb-4 flex flex-wrap gap-2">
        <x-badge
            asLink
            variant="{{ $filter === 'all' ? 'default' : 'outline' }}"
            wire:click="$set('filter', 'all')">
            All
        </x-badge>
        <x-badge
            asLink
            variant="{{ $filter === 'active' ? 'default' : 'outline' }}"
            wire:click="$set('filter', 'active')">
            Active
        </x-badge>
        <x-badge
            asLink
            variant="{{ $filter === 'completed' ? 'default' : 'outline' }}"
            wire:click="$set('filter', 'completed')">
            Completed
        </x-badge>
    </div>

    {{-- Filtered content --}}
</div>
```

### Status Timeline

```blade
<div class="space-y-4">
    @foreach ($statusHistory as $status)
        <div class="flex items-center gap-4">
            <x-badge variant="{{ $status->isActive ? 'default' : 'secondary' }}">
                {{ $status->name }}
            </x-badge>
            <span class="text-muted-foreground text-sm">
                {{ $status->created_at->diffForHumans() }}
            </span>
        </div>
    @endforeach
</div>
```

### Product Badges

```blade
<x-card>
    <div class="relative">
        <img
            src="/product.jpg"
            class="aspect-square w-full object-cover" />

        {{-- Top-right badge --}}
        <x-badge
            variant="destructive"
            class="absolute right-2 top-2">
            -20%
        </x-badge>

        {{-- Top-left badge --}}
        <x-badge
            variant="default"
            class="absolute left-2 top-2">
            New
        </x-badge>
    </div>

    <x-card-content>
        <h3 class="font-semibold">Product Name</h3>
        <div class="mt-2 flex items-center gap-2">
            <span class="text-lg font-bold">$79.99</span>
            <x-badge variant="secondary">Free Shipping</x-badge>
        </div>
    </x-card-content>
</x-card>
```
