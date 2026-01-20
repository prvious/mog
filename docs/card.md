# Card

The Card component provides a flexible container for grouping related content. It includes dedicated slots for headers, titles, descriptions, content, and footers, making it perfect for displaying structured information.

## Overview

Cards are one of the most versatile layout components, used to contain and organize related information. They provide visual boundaries that help users scan and comprehend content quickly.

### When to Use

- **Content grouping**: Group related information together
- **Dashboard panels**: Display metrics, charts, or summaries
- **Product displays**: Show product information and images
- **Form sections**: Organize form fields into logical groups
- **List items**: Display items in a grid or list view
- **Settings panels**: Group configuration options

## Props

### `header`

**Type:** `Slot`
**Default:** `Empty slot`

Container for the card header content. Includes title and description by default.

### `title`

**Type:** `Slot | string`

The card title displayed in the header.

### `description`

**Type:** `Slot | string`

Optional description text shown below the title in the header.

### `content`

**Required**
**Type:** `Slot`

The main content area of the card.

### `footer`

**Type:** `Slot`
**Default:** `Empty slot`

Optional footer area, typically used for actions or metadata.

## Features

### Flexible Slot System

The card uses slots for maximum flexibility:

- **header**: Custom header layout
- **title**: Card heading
- **description**: Subtitle or description
- **content**: Main content area
- **footer**: Action buttons or metadata

### Shadow and Border

Cards have a subtle shadow and border:

- Border for definition
- Shadow for depth
- Rounded corners (rounded-xl)
- Adapts to light/dark themes

### Responsive Padding

Consistent spacing throughout:

- Header: p-6
- Content: p-6 pt-0 (no top padding to align with header)
- Footer: p-6 pt-0 (no top padding)

## Usage Examples

### Basic Card

```blade
<x-card>
    <x-slot:title>Card Title</x-slot:title>

    <x-slot:description>A brief description of the card content.</x-slot:description>

    <x-slot:content>
        <p>This is the main content of the card.</p>
    </x-slot:content>
</x-card>
```

### Card with Footer

```blade
<x-card>
    <x-slot:title>Product Information</x-slot:title>

    <x-slot:content>
        <p class="text-sm">Premium wireless headphones with active noise cancellation.</p>
    </x-slot:content>

    <x-slot:footer>
        <x-button>Add to Cart</x-button>
    </x-slot:footer>
</x-card>
```

### Dashboard Stat Card

```blade
<x-card>
    <x-slot:title>Total Revenue</x-slot:title>

    <x-slot:description>+20.1% from last month</x-slot:description>

    <x-slot:content>
        <div class="text-2xl font-bold">$45,231.89</div>
        <p class="text-muted-foreground text-xs">+$4,231 from last month</p>
    </x-slot:content>
</x-card>
```

### Form Card

```blade
<x-card>
    <x-slot:title>Account Settings</x-slot:title>

    <x-slot:description>Update your account information and preferences.</x-slot:description>

    <x-slot:content>
        <form
            wire:submit="save"
            class="space-y-4">
            <x-field>
                <x-label>Email</x-label>
                <x-input
                    wire:model="email"
                    type="email" />
                <x-error key="email" />
            </x-field>

            <x-field>
                <x-label>Name</x-label>
                <x-input wire:model="name" />
                <x-error key="name" />
            </x-field>
        </form>
    </x-slot:content>

    <x-slot:footer class="justify-end gap-2">
        <x-button variant="outline">Cancel</x-button>
        <x-button wire:click="save">Save Changes</x-button>
    </x-slot:footer>
</x-card>
```

### Product Card

```blade
<x-card>
    <x-slot:content class="p-0">
        <img
            src="/product.jpg"
            alt="Product"
            class="aspect-square w-full rounded-t-xl object-cover" />

        <div class="p-6">
            <h3 class="font-semibold">Premium Headphones</h3>
            <p class="text-muted-foreground text-sm">Wireless noise-cancelling headphones</p>

            <div class="mt-4 flex items-center justify-between">
                <span class="text-2xl font-bold">$299</span>
                <x-button size="sm">Buy Now</x-button>
            </div>
        </div>
    </x-slot:content>
</x-card>
```

### Testimonial Card

```blade
<x-card>
    <x-slot:content>
        <div class="flex items-start gap-4">
            <x-avatar class="size-12">
                <x-avatar-image src="/avatar.jpg" />
                <x-avatar-fallback>JD</x-avatar-fallback>
            </x-avatar>

            <div class="flex-1">
                <div class="mb-2 flex items-center justify-between">
                    <div>
                        <div class="font-semibold">John Doe</div>
                        <div class="text-muted-foreground text-sm">CEO, Company Inc</div>
                    </div>

                    <div class="flex gap-0.5">
                        @for ($i = 0; $i < 5; $i++)
                            @svg('lucide-star', 'size-4 fill-yellow-400 text-yellow-400')
                        @endfor
                    </div>
                </div>

                <p class="text-muted-foreground text-sm">"This product has completely transformed how we work. Highly recommended!"</p>
            </div>
        </div>
    </x-slot:content>
</x-card>
```

### Feature Card

```blade
<x-card>
    <x-slot:content>
        <div class="flex items-start gap-4">
            <div class="bg-primary/10 flex size-12 items-center justify-center rounded-lg">
                @svg('lucide-zap', 'text-primary size-6')
            </div>

            <div class="flex-1">
                <h3 class="mb-2 font-semibold">Lightning Fast</h3>
                <p class="text-muted-foreground text-sm">Optimized for performance with blazing fast load times and smooth interactions.</p>
            </div>
        </div>
    </x-slot:content>
</x-card>
```

### Pricing Card

```blade
<x-card class="border-primary">
    <x-slot:header class="text-center">
        <x-badge class="mb-2">Most Popular</x-badge>
    </x-slot:header>

    <x-slot:title class="text-center text-2xl">Pro Plan</x-slot:title>

    <x-slot:description class="text-center">For growing teams</x-slot:description>

    <x-slot:content>
        <div class="my-8 text-center">
            <div class="text-4xl font-bold">$29</div>
            <div class="text-muted-foreground text-sm">per user/month</div>
        </div>

        <ul class="space-y-3">
            <li class="flex items-center gap-2">
                @svg('lucide-check', 'size-5 text-green-500')
                <span class="text-sm">Unlimited projects</span>
            </li>
            <li class="flex items-center gap-2">
                @svg('lucide-check', 'size-5 text-green-500')
                <span class="text-sm">Advanced analytics</span>
            </li>
            <li class="flex items-center gap-2">
                @svg('lucide-check', 'size-5 text-green-500')
                <span class="text-sm">Priority support</span>
            </li>
            <li class="flex items-center gap-2">
                @svg('lucide-check', 'size-5 text-green-500')
                <span class="text-sm">Team collaboration</span>
            </li>
        </ul>
    </x-slot:content>

    <x-slot:footer class="flex-col gap-2">
        <x-button class="w-full">Get Started</x-button>
        <p class="text-muted-foreground text-center text-xs">14-day free trial</p>
    </x-slot:footer>
</x-card>
```

### Notification Card

```blade
<x-card>
    <x-slot:content>
        <div class="flex items-start gap-3">
            <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20">
                @svg('lucide-bell', 'size-5 text-blue-600 dark:text-blue-400')
            </div>

            <div class="flex-1">
                <div class="mb-1 flex items-start justify-between">
                    <h4 class="font-semibold">New message</h4>
                    <time class="text-muted-foreground text-xs">2 min ago</time>
                </div>

                <p class="text-muted-foreground text-sm">You have received a new message from Sarah.</p>

                <div class="mt-3 flex gap-2">
                    <x-button
                        size="sm"
                        variant="outline">
                        Dismiss
                    </x-button>
                    <x-button size="sm">View Message</x-button>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-card>
```

### Stats Grid

```blade
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
    <x-card>
        <x-slot:title>Total Users</x-slot:title>
        <x-slot:content>
            <div class="text-2xl font-bold">2,543</div>
            <p class="text-muted-foreground text-xs">+12% from last month</p>
        </x-slot:content>
    </x-card>

    <x-card>
        <x-slot:title>Revenue</x-slot:title>
        <x-slot:content>
            <div class="text-2xl font-bold">$45,231</div>
            <p class="text-muted-foreground text-xs">+20% from last month</p>
        </x-slot:content>
    </x-card>

    <x-card>
        <x-slot:title>Active Now</x-slot:title>
        <x-slot:content>
            <div class="text-2xl font-bold">573</div>
            <p class="text-muted-foreground text-xs">+201 since last hour</p>
        </x-slot:content>
    </x-card>

    <x-card>
        <x-slot:title>Conversions</x-slot:title>
        <x-slot:content>
            <div class="text-2xl font-bold">12.5%</div>
            <p class="text-muted-foreground text-xs">+3% from last week</p>
        </x-slot:content>
    </x-card>
</div>
```

### Profile Card

```blade
<x-card>
    <x-slot:content>
        <div class="flex flex-col items-center text-center">
            <x-avatar class="mb-4 size-24">
                <x-avatar-image src="/profile.jpg" />
                <x-avatar-fallback>JD</x-avatar-fallback>
            </x-avatar>

            <h3 class="text-xl font-semibold">John Doe</h3>
            <p class="text-muted-foreground text-sm">Software Engineer</p>

            <div class="my-6 flex gap-6">
                <div>
                    <div class="font-bold">1.2K</div>
                    <div class="text-muted-foreground text-xs">Followers</div>
                </div>
                <div>
                    <div class="font-bold">456</div>
                    <div class="text-muted-foreground text-xs">Following</div>
                </div>
                <div>
                    <div class="font-bold">89</div>
                    <div class="text-muted-foreground text-xs">Posts</div>
                </div>
            </div>

            <div class="flex w-full gap-2">
                <x-button class="flex-1">Follow</x-button>
                <x-button
                    variant="outline"
                    class="flex-1">
                    Message
                </x-button>
            </div>
        </div>
    </x-slot:content>
</x-card>
```

### Custom Header

```blade
<x-card>
    <x-slot:header class="flex-row items-center justify-between">
        <div>
            <h3 class="font-semibold">Recent Activity</h3>
            <p class="text-muted-foreground text-sm">Your latest actions</p>
        </div>

        <x-button
            variant="ghost"
            size="icon">
            @svg('lucide-more-vertical', 'size-4')
        </x-button>
    </x-slot:header>

    <x-slot:content>
        <div class="space-y-4">
            <!-- Activity items -->
        </div>
    </x-slot:content>
</x-card>
```

## Accessibility

### Semantic Structure

Cards use proper semantic HTML:

```blade
{{-- Good: Cards create logical content boundaries --}}
<x-card>
    <x-slot:title>Section Title</x-slot:title>
    <x-slot:content>Content here</x-slot:content>
</x-card>
```

### Heading Hierarchy

Maintain proper heading levels:

```blade
{{-- Good: Use appropriate heading levels --}}
<x-card>
    <x-slot:content>
        <h3 class="font-semibold">Card Heading</h3>
        <p>Card content</p>
    </x-slot:content>
</x-card>
```

### Interactive Elements

Ensure actionable cards are keyboard accessible:

```blade
{{-- Good: Clickable card with proper semantics --}}
<a
    href="/details"
    class="block">
    <x-card class="transition-shadow hover:shadow-lg">
        <x-slot:title>Clickable Card</x-slot:title>
        <x-slot:content>Click to view details</x-slot:content>
    </x-card>
</a>
```

## Best Practices

### Keep Content Focused

```blade
{{-- Good: Single, clear purpose --}}
<x-card>
    <x-slot:title>User Statistics</x-slot:title>
    <x-slot:content>
        <!-- Related stats only -->
    </x-slot:content>
</x-card>

{{-- Avoid: Too many unrelated items --}}
<x-card>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:content>
        <!-- Stats, notifications, messages, settings all mixed -->
    </x-slot:content>
</x-card>
```

### Use Consistent Padding

```blade
{{-- Good: Use built-in padding --}}
<x-card>
    <x-slot:content>Content with default padding</x-slot:content>
</x-card>

{{-- Edge case: Remove padding for full-bleed content --}}
<x-card>
    <x-slot:content class="p-0">
        <img
            src="/full-width.jpg"
            class="w-full" />
    </x-slot:content>
</x-card>
```

### Provide Context

```blade
{{-- Good: Title and description provide context --}}
<x-card>
    <x-slot:title>Monthly Revenue</x-slot:title>
    <x-slot:description>Total sales for the month</x-slot:description>
    <x-slot:content>...</x-slot:content>
</x-card>

{{-- Avoid: No context --}}
<x-card>
    <x-slot:content>$45,231</x-slot:content>
</x-card>
```

## Technical Details

### Styling Classes

The card uses Tailwind classes:

```css
/* Base styles */
rounded-xl        /* Rounded corners */
border           /* Border */
bg-card          /* Background color (theme-aware) */
text-card-foreground  /* Text color (theme-aware) */
shadow           /* Subtle shadow */
```

### Slot Structure

```blade
<div class="card">
    <div class="header">
        <div class="title">{{ $title }}</div>
        <div class="description">{{ $description }}</div>
    </div>
    <div class="content">{{ $content }}</div>
    <div class="footer">{{ $footer }}</div>
</div>
```

### Dark Mode

Cards automatically adapt to dark mode:

- `bg-card`: Adjusts background
- `text-card-foreground`: Adjusts text color
- `border`: Adapts border color

## Related Components

- [Table](./table.md) - Tabular data display within cards
- [Separator](./separator.md) - Divide card sections
- [Item](./item.md) - Alternative list-based layout
- [Empty](./empty.md) - Empty state within cards

## Common Patterns

### List of Cards

```blade
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $item)
        <x-card>
            <x-slot:title>{{ $item->title }}</x-slot:title>
            <x-slot:content>{{ $item->description }}</x-slot:content>
            <x-slot:footer>
                <x-button size="sm">View Details</x-button>
            </x-slot:footer>
        </x-card>
    @endforeach
</div>
```

### Card with Tabs

```blade
<x-card>
    <x-slot:header class="pb-3">
        <x-slot:title>Analytics</x-slot:title>

        <div class="mt-4 flex gap-4 border-b">
            <button class="border-primary border-b-2 pb-2 text-sm font-medium">Overview</button>
            <button class="text-muted-foreground pb-2 text-sm">Analytics</button>
            <button class="text-muted-foreground pb-2 text-sm">Reports</button>
        </div>
    </x-slot:header>

    <x-slot:content>
        <!-- Tab content -->
    </x-slot:content>
</x-card>
```

### Collapsible Card

```blade
<x-card x-data="{ expanded: false }">
    <x-slot:header
        class="cursor-pointer"
        x-on:click="expanded = !expanded">
        <div class="flex items-center justify-between">
            <div>
                <x-slot:title>Advanced Settings</x-slot:title>
                <x-slot:description>Additional configuration options</x-slot:description>
            </div>

            <x-button
                variant="ghost"
                size="icon">
                @svg('lucide-chevron-down', 'size-4 transition-transform', ['x-bind:class' => "expanded ? 'rotate-180' : ''"])
            </x-button>
        </div>
    </x-slot:header>

    <x-slot:content
        x-show="expanded"
        x-collapse>
        <!-- Collapsible content -->
    </x-slot:content>
</x-card>
```
