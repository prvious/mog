# Table

The Table component system provides a flexible and accessible way to display tabular data. It includes components for table structure (x-table), rows (x-tr), headers (x-th), and cells (x-cell), with support for hover states, selection, sorting, and responsive layouts.

## Overview

Tables organize and display data in a grid format with rows and columns. The Mog table system uses semantic HTML with enhanced styling and interactive features for modern web applications.

### When to Use

- **Data display**: Present structured data in rows and columns
- **User lists**: Display collections of users, products, or records
- **Comparison tables**: Compare features, pricing, or specifications
- **Dashboards**: Show metrics, statistics, or activity logs
- **Admin panels**: Manage records with actions and selection
- **Reports**: Display financial, analytical, or operational data

## Components

### `x-table`

The main table container component.

**Slots:**

- **`caption`**: Optional table caption for accessibility
- **`header`**: Table header section (thead)
- **`body`**: Table body section (tbody) - can also use default slot
- **`footer`**: Optional table footer section (tfoot)

### `x-tr`

Table row component with hover and selection states.

**States:**

- **Hover**: Automatic hover highlighting
- **Selected**: Apply `data-state="selected"` attribute for selected rows

### `x-th`

Table header cell component.

**Features:**

- Left-aligned by default
- Medium font weight
- Proper spacing and padding
- Checkbox alignment support

### `x-cell`

Table data cell component (renders as `<td>`).

**Features:**

- Consistent padding and alignment
- Vertical alignment to middle
- Nowrap whitespace by default
- Checkbox alignment support

## Features

### Responsive Container

Tables are wrapped in a responsive container:

- Horizontal scrolling on small screens
- Full width by default
- Overflow handling for wide tables

### Hover States

Rows automatically highlight on hover:

- Smooth transition
- Muted background color
- Visual feedback for interactive rows

### Selection States

Mark rows as selected with `data-state="selected"`:

- Distinct background color
- Maintains visual hierarchy
- Works with checkboxes

### Accessible Structure

Proper semantic HTML:

- Caption support for screen readers
- Proper thead/tbody/tfoot structure
- Border and spacing for readability

## Usage Examples

### Basic Table

```blade
<x-table>
    <x-slot:header>
        <x-tr>
            <x-th>Name</x-th>
            <x-th>Email</x-th>
            <x-th>Role</x-th>
        </x-tr>
    </x-slot:header>

    <x-slot:body>
        <x-tr>
            <x-cell>John Doe</x-cell>
            <x-cell>
                john
                @example.com
            </x-cell>
            <x-cell>Admin</x-cell>
        </x-tr>

        <x-tr>
            <x-cell>Jane Smith</x-cell>
            <x-cell>
                jane
                @example.com
            </x-cell>
            <x-cell>User</x-cell>
        </x-tr>

        <x-tr>
            <x-cell>Bob Johnson</x-cell>
            <x-cell>
                bob
                @example.com
            </x-cell>
            <x-cell>Editor</x-cell>
        </x-tr>
    </x-slot:body>
</x-table>
```

### Table with Caption

```blade
<x-table>
    <x-slot:caption>A list of all users in the system</x-slot:caption>

    <x-slot:header>
        <x-tr>
            <x-th>ID</x-th>
            <x-th>Name</x-th>
            <x-th>Status</x-th>
        </x-tr>
    </x-slot:header>

    <x-slot:body>
        @foreach ($users as $user)
            <x-tr>
                <x-cell>{{ $user->id }}</x-cell>
                <x-cell>{{ $user->name }}</x-cell>
                <x-cell>{{ $user->status }}</x-cell>
            </x-tr>
        @endforeach
    </x-slot:body>
</x-table>
```

### Sortable Table

```blade
<div x-data="{ sortBy: 'name', sortDir: 'asc' }">
    <x-table>
        <x-slot:header>
            <x-tr>
                <x-th>
                    <button
                        class="flex items-center gap-1"
                        x-on:click="
                            sortBy = 'name'
                            sortDir = sortDir === 'asc' ? 'desc' : 'asc'
                        ">
                        Name
                        @svg('lucide-arrow-up-down', 'size-4')
                    </button>
                </x-th>
                <x-th>
                    <button
                        class="flex items-center gap-1"
                        x-on:click="
                            sortBy = 'email'
                            sortDir = sortDir === 'asc' ? 'desc' : 'asc'
                        ">
                        Email
                        @svg('lucide-arrow-up-down', 'size-4')
                    </button>
                </x-th>
                <x-th>
                    <button
                        class="flex items-center gap-1"
                        x-on:click="
                            sortBy = 'role'
                            sortDir = sortDir === 'asc' ? 'desc' : 'asc'
                        ">
                        Role
                        @svg('lucide-arrow-up-down', 'size-4')
                    </button>
                </x-th>
            </x-tr>
        </x-slot:header>

        <x-slot:body>
            @foreach ($users as $user)
                <x-tr>
                    <x-cell>{{ $user->name }}</x-cell>
                    <x-cell>{{ $user->email }}</x-cell>
                    <x-cell>
                        <x-badge>{{ $user->role }}</x-badge>
                    </x-cell>
                </x-tr>
            @endforeach
        </x-slot:body>
    </x-table>
</div>
```

### Selectable Rows

```blade
<div x-data="{ selected: [] }">
    <x-table>
        <x-slot:header>
            <x-tr>
                <x-th>
                    <x-checkbox
                        x-on:change="selected = $event.target.checked ? @js($users->pluck('id')->all()) : []" />
                </x-th>
                <x-th>Name</x-th>
                <x-th>Email</x-th>
                <x-th>Actions</x-th>
            </x-tr>
        </x-slot:header>

        <x-slot:body>
            @foreach ($users as $user)
                <x-tr :data-state="selected.includes({{ $user->id }}) ? 'selected' : null">
                    <x-cell>
                        <x-checkbox
                            :value="{{ $user->id }}"
                            x-model="selected" />
                    </x-cell>
                    <x-cell>{{ $user->name }}</x-cell>
                    <x-cell>{{ $user->email }}</x-cell>
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

    <div
        class="mt-4"
        x-show="selected.length > 0">
        <x-button
            variant="destructive"
            size="sm">
            Delete <span x-text="selected.length"></span> items
        </x-button>
    </div>
</div>
```

### Table with Actions

```blade
<x-table>
    <x-slot:header>
        <x-tr>
            <x-th>Product</x-th>
            <x-th>Price</x-th>
            <x-th>Stock</x-th>
            <x-th>Status</x-th>
            <x-th class="text-right">Actions</x-th>
        </x-tr>
    </x-slot:header>

    <x-slot:body>
        @foreach ($products as $product)
            <x-tr>
                <x-cell>
                    <div class="flex items-center gap-3">
                        <img
                            src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="size-10 rounded" />
                        <div>
                            <div class="font-medium">{{ $product->name }}</div>
                            <div class="text-muted-foreground text-sm">{{ $product->sku }}</div>
                        </div>
                    </div>
                </x-cell>
                <x-cell>${{ number_format($product->price, 2) }}</x-cell>
                <x-cell>{{ $product->stock }}</x-cell>
                <x-cell>
                    <x-badge :variant="$product->active ? 'success' : 'secondary'">
                        {{ $product->active ? 'Active' : 'Inactive' }}
                    </x-badge>
                </x-cell>
                <x-cell class="text-right">
                    <div class="flex items-center justify-end gap-2">
                        <x-button
                            variant="ghost"
                            size="icon-sm">
                            @svg('lucide-pencil', 'size-4')
                        </x-button>
                        <x-button
                            variant="ghost"
                            size="icon-sm">
                            @svg('lucide-trash-2', 'size-4')
                        </x-button>
                    </div>
                </x-cell>
            </x-tr>
        @endforeach
    </x-slot:body>
</x-table>
```

### Table with Footer

```blade
<x-table>
    <x-slot:header>
        <x-tr>
            <x-th>Description</x-th>
            <x-th class="text-right">Quantity</x-th>
            <x-th class="text-right">Price</x-th>
            <x-th class="text-right">Total</x-th>
        </x-tr>
    </x-slot:header>

    <x-slot:body>
        @foreach ($items as $item)
            <x-tr>
                <x-cell>{{ $item->description }}</x-cell>
                <x-cell class="text-right">{{ $item->quantity }}</x-cell>
                <x-cell class="text-right">${{ number_format($item->price, 2) }}</x-cell>
                <x-cell class="text-right">${{ number_format($item->total, 2) }}</x-cell>
            </x-tr>
        @endforeach
    </x-slot:body>

    <x-slot:footer>
        <x-tr>
            <x-cell
                colspan="3"
                class="text-right">
                Subtotal
            </x-cell>
            <x-cell class="text-right">${{ number_format($subtotal, 2) }}</x-cell>
        </x-tr>
        <x-tr>
            <x-cell
                colspan="3"
                class="text-right">
                Tax (10%)
            </x-cell>
            <x-cell class="text-right">${{ number_format($tax, 2) }}</x-cell>
        </x-tr>
        <x-tr>
            <x-cell
                colspan="3"
                class="text-right font-bold">
                Total
            </x-cell>
            <x-cell class="text-right font-bold">${{ number_format($total, 2) }}</x-cell>
        </x-tr>
    </x-slot:footer>
</x-table>
```

### Responsive Table with Scrollable

```blade
<x-scrollable class="max-h-96">
    <x-table>
        <x-slot:header>
            <x-tr>
                <x-th>Date</x-th>
                <x-th>Transaction</x-th>
                <x-th>Amount</x-th>
                <x-th>Status</x-th>
                <x-th>Description</x-th>
            </x-tr>
        </x-slot:header>

        <x-slot:body>
            @foreach ($transactions as $transaction)
                <x-tr>
                    <x-cell>{{ $transaction->date->format('M d, Y') }}</x-cell>
                    <x-cell>{{ $transaction->type }}</x-cell>
                    <x-cell>${{ number_format($transaction->amount, 2) }}</x-cell>
                    <x-cell>
                        <x-badge :variant="$transaction->status">
                            {{ ucfirst($transaction->status) }}
                        </x-badge>
                    </x-cell>
                    <x-cell>{{ $transaction->description }}</x-cell>
                </x-tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-scrollable>
```

### Data Table with Pagination

```blade
<div>
    <x-table>
        <x-slot:header>
            <x-tr>
                <x-th>Name</x-th>
                <x-th>Email</x-th>
                <x-th>Created</x-th>
                <x-th>Status</x-th>
            </x-tr>
        </x-slot:header>

        <x-slot:body>
            @forelse ($users as $user)
                <x-tr>
                    <x-cell>{{ $user->name }}</x-cell>
                    <x-cell>{{ $user->email }}</x-cell>
                    <x-cell>{{ $user->created_at->diffForHumans() }}</x-cell>
                    <x-cell>
                        <x-badge :variant="$user->isActive() ? 'success' : 'secondary'">
                            {{ $user->status }}
                        </x-badge>
                    </x-cell>
                </x-tr>
            @empty
                <x-tr>
                    <x-cell colspan="4">
                        <x-empty>
                            <x-slot:title>No users found</x-slot:title>
                            <x-slot:description>Get started by adding your first user.</x-slot:description>
                            <x-slot:action>
                                <x-button>Add User</x-button>
                            </x-slot:action>
                        </x-empty>
                    </x-cell>
                </x-tr>
            @endforelse
        </x-slot:body>
    </x-table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
```

### Empty State Table

```blade
<x-table>
    <x-slot:header>
        <x-tr>
            <x-th>Name</x-th>
            <x-th>Email</x-th>
            <x-th>Role</x-th>
        </x-tr>
    </x-slot:header>

    <x-slot:body>
        <x-tr>
            <x-cell
                colspan="3"
                class="h-64">
                <x-empty>
                    <x-slot:icon>
                        @svg('lucide-users', 'size-12')
                    </x-slot:icon>

                    <x-slot:title>No users yet</x-slot:title>

                    <x-slot:description>
                        You haven't added any users to your team yet. Get started by inviting your first team member.
                    </x-slot:description>

                    <x-slot:action>
                        <x-button>
                            @svg('lucide-plus', 'size-4')
                            Invite User
                        </x-button>
                    </x-slot:action>
                </x-empty>
            </x-cell>
        </x-tr>
    </x-slot:body>
</x-table>
```

### Compact Table

```blade
<x-table class="text-xs">
    <x-slot:header>
        <x-tr>
            <x-th class="px-1">ID</x-th>
            <x-th class="px-1">Status</x-th>
            <x-th class="px-1">Time</x-th>
        </x-tr>
    </x-slot:header>

    <x-slot:body>
        @foreach ($logs as $log)
            <x-tr>
                <x-cell class="px-1">{{ $log->id }}</x-cell>
                <x-cell class="px-1">
                    <x-badge size="sm">{{ $log->status }}</x-badge>
                </x-cell>
                <x-cell class="px-1">{{ $log->created_at->format('H:i:s') }}</x-cell>
            </x-tr>
        @endforeach
    </x-slot:body>
</x-table>
```

## Accessibility

### Semantic HTML

Tables use proper semantic markup:

```blade
{{-- Good: Proper table structure --}}
<x-table>
    <x-slot:caption>User Directory</x-slot:caption>
    <x-slot:header>...</x-slot:header>
    <x-slot:body>...</x-slot:body>
</x-table>

{{-- Avoid: Using divs instead of table elements --}}
<div class="table">
    <div class="row">...</div>
</div>
```

### Column Headers

Always use proper header cells:

```blade
{{-- Good: Headers in thead with th elements --}}
<x-slot:header>
    <x-tr>
        <x-th>Name</x-th>
        <x-th>Email</x-th>
    </x-tr>
</x-slot:header>

{{-- Avoid: Missing or improper headers --}}
<x-slot:body>
    <x-tr>
        <x-cell><strong>Name</strong></x-cell>
        <x-cell><strong>Email</strong></x-cell>
    </x-tr>
</x-slot:body>
```

### Captions

Provide captions for context:

```blade
{{-- Good: Descriptive caption --}}
<x-table>
    <x-slot:caption>Monthly sales report for Q4 2025</x-slot:caption>
    ...
</x-table>
```

### Scope Attributes

For complex tables, add scope attributes:

```blade
<x-th scope="col">Name</x-th>
<x-th scope="col">Email</x-th>
```

## Best Practices

### Keep Tables Simple

```blade
{{-- Good: Simple, scannable data --}}
<x-table>
    <x-slot:header>
        <x-tr>
            <x-th>Name</x-th>
            <x-th>Status</x-th>
        </x-tr>
    </x-slot:header>
    ...
</x-table>

{{-- Avoid: Too many columns --}}
<x-table>
    <x-slot:header>
        <x-tr>
            <x-th>Col 1</x-th>
            <x-th>Col 2</x-th>
            <!-- 15+ more columns -->
        </x-tr>
    </x-slot:header>
</x-table>
```

### Use Consistent Alignment

```blade
{{-- Good: Right-align numbers --}}
<x-th class="text-right">Price</x-th>
<x-cell class="text-right">${{ $price }}</x-cell>

{{-- Good: Left-align text --}}
<x-th>Name</x-th>
<x-cell>{{ $name }}</x-cell>
```

### Handle Empty States

```blade
{{-- Good: Helpful empty state --}}
@forelse ($items as $item)
    <x-tr>...</x-tr>
@empty
    <x-tr>
        <x-cell colspan="4">
            <x-empty>
                <x-slot:title>No items found</x-slot:title>
                <x-slot:action>
                    <x-button>Add Item</x-button>
                </x-slot:action>
            </x-empty>
        </x-cell>
    </x-tr>
@endforelse
```

### Make Interactive Tables Obvious

```blade
{{-- Good: Clear clickable rows --}}
<x-tr
    class="hover:bg-muted cursor-pointer"
    wire:click="select({{ $item->id }})">
    <x-cell>{{ $item->name }}</x-cell>
</x-tr>

{{-- Good: Action buttons in cells --}}
<x-cell class="text-right">
    <x-button
        size="sm"
        variant="ghost">
        Edit
    </x-button>
</x-cell>
```

## Technical Details

### Table Structure

```blade
<div
    data-slot="table-container"
    class="relative w-full overflow-x-auto">
    <table
        data-slot="table"
        class="w-full caption-bottom text-sm">
        <caption>Optional caption</caption>
        <thead data-slot="table-header">[&_tr]:border-b</thead>
        <tbody data-slot="table-body">[&_tr:last-child]:border-0</tbody>
        <tfoot data-slot="table-footer">border-t font-medium</tfoot>
    </table>
</div>
```

### Row States

```css
/* Hover state */
.hover:bg-muted/50

/* Selected state */
[data-state=selected]:bg-muted

/* Transition */
transition-colors
```

### Cell Styling

```css
/* Header cells (th) */
h-10 px-2 text-left align-middle font-medium

/* Data cells (td) */
p-2 align-middle whitespace-nowrap

/* Checkbox alignment */
[&:has([role=checkbox])]:pr-0
[&>[role=checkbox]]:translate-y-[2px]
```

### Responsive Behavior

Tables scroll horizontally on small screens:

- Container has `overflow-x-auto`
- Table maintains full width
- Consider vertical stacking for mobile-first designs

## Related Components

- [Scrollable](./scrollable.md) - Wrap tables for vertical scrolling
- [Empty](./empty.md) - Display empty states in tables
- [Card](./card.md) - Alternative container for data display
- [Checkbox](./checkbox.md) - Select table rows

## Common Patterns

### Striped Rows

```blade
<x-table>
    <x-slot:body class="[&_tr:nth-child(even)]:bg-muted/30">
        @foreach ($items as $item)
            <x-tr>...</x-tr>
        @endforeach
    </x-slot:body>
</x-table>
```

### Fixed Header

```blade
<div class="max-h-96 overflow-y-auto">
    <x-table>
        <x-slot:header class="bg-background sticky top-0">
            <x-tr>...</x-tr>
        </x-slot:header>
        <x-slot:body>...</x-slot:body>
    </x-table>
</div>
```

### Bordered Cells

```blade
<x-table class="border-collapse border">
    <x-slot:header>
        <x-tr>
            <x-th class="border">Name</x-th>
            <x-th class="border">Email</x-th>
        </x-tr>
    </x-slot:header>
    <x-slot:body>
        <x-tr>
            <x-cell class="border">John</x-cell>
            <x-cell class="border">
                john
                @example.com
            </x-cell>
        </x-tr>
    </x-slot:body>
</x-table>
```
