# Empty

The Empty component provides a user-friendly empty state for when there's no data to display. It includes slots for icons, titles, descriptions, and action buttons to guide users toward their next steps.

## Overview

Empty states communicate that there's no content available and help users understand why and what they can do about it. A well-designed empty state turns a potentially frustrating moment into an opportunity for engagement.

### When to Use

- **No search results**: When a search or filter returns zero results
- **Empty lists**: When a list, table, or collection has no items
- **First-time use**: When a feature hasn't been used yet
- **Deleted content**: After all items have been removed
- **No permissions**: When users can't access content due to permissions

## Slots

### `media`

**Optional**

Icon or illustration displayed above the title. Supports `variant="icon"` attribute for styled icon container.

### `title`

**Optional**

The main heading explaining the empty state.

### `description`

**Optional**

Supporting text providing more context or guidance. Can include links.

### `content`

**Optional**

Action buttons or additional content to help users proceed.

### `header`

**Optional**

Container for media, title, and description. Automatically includes all three if present.

## Features

### Flexible Layout

- Centered content with proper spacing
- Responsive padding (smaller on mobile, larger on desktop)
- Maximum width constraint for readability

### Rich Content Support

- Icons with optional styled container
- Multiple paragraphs in description
- Links with hover states
- Action buttons

## Usage Examples

### Basic Empty State

```blade
<x-empty>
    <x-slot:title>No results found</x-slot:title>
    <x-slot:description>Try adjusting your search or filter to find what you're looking for.</x-slot:description>
</x-empty>
```

### With Icon

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-inbox')
    </x-slot:media>

    <x-slot:title>No messages</x-slot:title>

    <x-slot:description>You don't have any messages yet. When someone sends you a message, it will appear here.</x-slot:description>
</x-empty>
```

### With Actions

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-file-plus')
    </x-slot:media>

    <x-slot:title>No projects yet</x-slot:title>

    <x-slot:description>Get started by creating your first project.</x-slot:description>

    <x-slot:content>
        <x-button wire:click="createProject">
            @svg('lucide-plus')
            Create Project
        </x-button>
    </x-slot:content>
</x-empty>
```

### Empty Search Results

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-search-x')
    </x-slot:media>

    <x-slot:title>No results for "{{ $query }}"</x-slot:title>

    <x-slot:description>We couldn't find any matches for your search. Try different keywords or check your spelling.</x-slot:description>

    <x-slot:content>
        <x-button
            variant="outline"
            wire:click="clearSearch">
            Clear Search
        </x-button>
    </x-slot:content>
</x-empty>
```

### Empty List with Call-to-Action

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-users')
    </x-slot:media>

    <x-slot:title>No team members</x-slot:title>

    <x-slot:description>Start collaborating by inviting team members to your workspace.</x-slot:description>

    <x-slot:content>
        <div class="flex flex-col gap-2 sm:flex-row">
            <x-button wire:click="openInviteModal">
                @svg('lucide-user-plus')
                Invite Members
            </x-button>
            <x-button
                variant="outline"
                href="/docs/teams">
                Learn More
            </x-button>
        </div>
    </x-slot:content>
</x-empty>
```

### First-Time Use

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-sparkles')
    </x-slot:media>

    <x-slot:title>Welcome to your dashboard!</x-slot:title>

    <x-slot:description>
        This is where you'll see all your activity and important updates. Get started by connecting your first integration.
    </x-slot:description>

    <x-slot:content>
        <div class="flex flex-col gap-2">
            <x-button>
                @svg('lucide-plug')
                Connect Integration
            </x-button>
            <x-button
                variant="link"
                href="/quickstart">
                View Quick Start Guide
            </x-button>
        </div>
    </x-slot:content>
</x-empty>
```

### Filtered Results

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-filter-x')
    </x-slot:media>

    <x-slot:title>No items match your filters</x-slot:title>

    <x-slot:description>Try removing some filters or adjusting your criteria.</x-slot:description>

    <x-slot:content>
        <x-button
            variant="outline"
            wire:click="clearFilters">
            Clear All Filters
        </x-button>
    </x-slot:content>
</x-empty>
```

### Empty Inbox

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-mail-check')
    </x-slot:media>

    <x-slot:title>Inbox Zero!</x-slot:title>

    <x-slot:description>You've read all your messages. Great job staying on top of things!</x-slot:description>
</x-empty>
```

### No Permissions

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-lock')
    </x-slot:media>

    <x-slot:title>Access Restricted</x-slot:title>

    <x-slot:description>You don't have permission to view this content. Contact your administrator to request access.</x-slot:description>

    <x-slot:content>
        <x-button
            variant="outline"
            href="/support">
            Contact Support
        </x-button>
    </x-slot:content>
</x-empty>
```

### Empty Cart

```blade
<x-empty>
    <x-slot:media variant="icon">
        @svg('lucide-shopping-cart')
    </x-slot:media>

    <x-slot:title>Your cart is empty</x-slot:title>

    <x-slot:description>Add items to your cart to get started with your order.</x-slot:description>

    <x-slot:content>
        <x-button
            asLink
            href="/products">
            Browse Products
        </x-button>
    </x-slot:content>
</x-empty>
```

### Conditional Empty States

```blade
@if ($items->isEmpty())
    @if ($hasActiveFilters)
        {{-- Filtered empty state --}}
        <x-empty>
            <x-slot:media variant="icon">
                @svg('lucide-filter-x')
            </x-slot:media>
            <x-slot:title>No matching results</x-slot:title>
            <x-slot:description>No items match your current filters.</x-slot:description>
            <x-slot:content>
                <x-button
                    variant="outline"
                    wire:click="clearFilters">
                    Clear Filters
                </x-button>
            </x-slot:content>
        </x-empty>
    @else
        {{-- Default empty state --}}
        <x-empty>
            <x-slot:media variant="icon">
                @svg('lucide-inbox')
            </x-slot:media>
            <x-slot:title>No items yet</x-slot:title>
            <x-slot:description>Get started by adding your first item.</x-slot:description>
            <x-slot:content>
                <x-button wire:click="createItem">Create Item</x-button>
            </x-slot:content>
        </x-empty>
    @endif
@else
    {{-- Show items --}}
    @foreach ($items as $item)
        ...
    @endforeach
@endif
```

## Best Practices

### Be Helpful, Not Apologetic

```blade
{{-- Good: Helpful and actionable --}}
<x-empty>
    <x-slot:title>No notifications yet</x-slot:title>
    <x-slot:description>We'll notify you when there's important activity.</x-slot:description>
</x-empty>

{{-- Avoid: Apologetic without guidance --}}
<x-empty>
    <x-slot:title>Sorry, nothing here!</x-slot:title>
    <x-slot:description>We're sorry but there's nothing to show.</x-slot:description>
</x-empty>
```

### Provide Clear Next Steps

```blade
{{-- Good: Clear action --}}
<x-empty>
    <x-slot:title>No saved addresses</x-slot:title>
    <x-slot:description>Add a delivery address to speed up checkout.</x-slot:description>
    <x-slot:content>
        <x-button wire:click="addAddress">Add Address</x-button>
    </x-slot:content>
</x-empty>

{{-- Avoid: No guidance --}}
<x-empty>
    <x-slot:title>Empty</x-slot:title>
    <x-slot:description>No data available.</x-slot:description>
</x-empty>
```

### Use Appropriate Icons

- **Lists/Collections**: `lucide-inbox`, `lucide-layers`
- **Search**: `lucide-search-x`, `lucide-search`
- **Users/Teams**: `lucide-users`, `lucide-user-plus`
- **Files/Documents**: `lucide-file`, `lucide-file-plus`
- **Shopping**: `lucide-shopping-cart`, `lucide-shopping-bag`
- **Filters**: `lucide-filter-x`, `lucide-sliders-horizontal`

## Related Components

- [Skeleton](./skeleton.md) - Loading placeholders before showing empty states
- [Spinner](./spinner.md) - Loading indicator
- [Alert](./alert.md) - Important messages

## Common Patterns

### Table Empty State

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
        @forelse ($users as $user)
            <x-tr>
                <x-td>{{ $user->name }}</x-td>
                <x-td>{{ $user->email }}</x-td>
                <x-td>{{ $user->status }}</x-td>
            </x-tr>
        @empty
            <tr>
                <td colspan="3">
                    <x-empty>
                        <x-slot:media variant="icon">
                            @svg('lucide-users')
                        </x-slot:media>
                        <x-slot:title>No users found</x-slot:title>
                        <x-slot:description>Start by adding users to your organization.</x-slot:description>
                    </x-empty>
                </td>
            </tr>
        @endforelse
    </tbody>
</x-table>
```

### Card Empty State

```blade
<x-card>
    <x-card-header>
        <x-card-title>Recent Activity</x-card-title>
    </x-card-header>
    <x-card-content>
        @if ($activities->isEmpty())
            <x-empty>
                <x-slot:media variant="icon">
                    @svg('lucide-activity')
                </x-slot:media>
                <x-slot:title>No recent activity</x-slot:title>
                <x-slot:description>Your recent activity will appear here.</x-slot:description>
            </x-empty>
        @else
            {{-- Show activities --}}
        @endif
    </x-card-content>
</x-card>
```
