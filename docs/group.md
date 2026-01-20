# Group

The Group component provides a container for collapsible elements like accordions and dropdowns, managing their open/close states so that only one item can be expanded at a time. It uses Alpine.js to coordinate state across grouped elements.

## Overview

Groups enable accordion-style behavior where clicking one item automatically closes others in the same group. This pattern is essential for creating clean, organized interfaces where multiple collapsible sections shouldn't be open simultaneously.

### When to Use

- **Accordion panels**: Group accordion items for single-open behavior
- **Dropdown menus**: Ensure only one dropdown is open at a time
- **FAQ sections**: Allow users to focus on one question at a time
- **Navigation menus**: Collapse other sections when opening a new one
- **Settings panels**: Organize collapsible setting groups
- **Filter groups**: Manage expandable filter sections

## Props

### `collapsible`

**Type:** `boolean`
**Default:** `true`

Controls whether the group enables collapsible behavior. When `true`, clicking an item automatically closes other items in the group.

## Features

### Single-Open Behavior

Automatic coordination:

- Only one grouped element open at a time
- Clicking a new item closes the previously open item
- Smooth transitions between states
- No manual state management required

### Alpine.js Integration

Uses Alpine.js for state management:

- `x-data` initializes Alpine context
- `data-mog-group` identifies the group container
- `data-mog-groupable` marks children as groupable items
- Click handler traverses DOM to find and close siblings

### Optional Collapsible

Can disable collapsible behavior:

- Set `collapsible="false"` to allow multiple open items
- Useful when grouping is needed for styling but not behavior
- Default is `true` for collapsible behavior

### Flexible Content

Works with any collapsible components:

- Accordion items
- Dropdown menus
- Custom collapsible elements with `data-mog-groupable` attribute

## Usage Examples

### Basic Accordion Group

```blade
<x-group>
    <x-accordion>
        <x-slot:trigger>First Item</x-slot:trigger>
        <x-slot:content>Content for the first accordion item.</x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>Second Item</x-slot:trigger>
        <x-slot:content>Content for the second accordion item.</x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>Third Item</x-slot:trigger>
        <x-slot:content>Content for the third accordion item.</x-slot:content>
    </x-accordion>
</x-group>
```

### FAQ Section

```blade
<div class="mx-auto max-w-3xl">
    <h2 class="mb-6 text-2xl font-bold">Frequently Asked Questions</h2>

    <x-group>
        @foreach ($faqs as $faq)
            <x-accordion>
                <x-slot:trigger>{{ $faq->question }}</x-slot:trigger>
                <x-slot:content>
                    <p class="text-muted-foreground">{{ $faq->answer }}</p>
                </x-slot:content>
            </x-accordion>
        @endforeach
    </x-group>
</div>
```

### Settings Panels

```blade
<x-card>
    <x-slot:header>
        <x-slot:title>Account Settings</x-slot:title>
        <x-slot:description>Manage your account preferences</x-slot:description>
    </x-slot:header>

    <x-slot:content>
        <x-group>
            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-user', 'size-4')
                    Profile Information
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-4">
                        <x-field>
                            <x-label>Display Name</x-label>
                            <x-input wire:model="displayName" />
                        </x-field>

                        <x-field>
                            <x-label>Bio</x-label>
                            <x-textarea wire:model="bio" />
                        </x-field>
                    </div>
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-bell', 'size-4')
                    Notifications
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <x-label>Email Notifications</x-label>
                            <x-switch wire:model="emailNotifications" />
                        </div>

                        <div class="flex items-center justify-between">
                            <x-label>Push Notifications</x-label>
                            <x-switch wire:model="pushNotifications" />
                        </div>
                    </div>
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-shield', 'size-4')
                    Privacy & Security
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-4">
                        <x-field>
                            <x-label>Change Password</x-label>
                            <x-input
                                type="password"
                                wire:model="newPassword" />
                        </x-field>

                        <div class="flex items-center justify-between">
                            <x-label>Two-Factor Authentication</x-label>
                            <x-switch wire:model="twoFactorEnabled" />
                        </div>
                    </div>
                </x-slot:content>
            </x-accordion>
        </x-group>
    </x-slot:content>
</x-card>
```

### Product Features

```blade
<div class="mx-auto max-w-4xl">
    <h2 class="mb-8 text-center text-3xl font-bold">Explore Our Features</h2>

    <x-group>
        <x-accordion>
            <x-slot:trigger>
                <div class="flex items-center gap-3">
                    <div class="bg-primary/10 flex size-10 items-center justify-center rounded-lg">
                        @svg('lucide-zap', 'text-primary size-5')
                    </div>
                    <div class="flex-1 text-left">
                        <h3 class="font-semibold">Lightning Fast Performance</h3>
                        <p class="text-muted-foreground text-sm">Optimized for speed</p>
                    </div>
                </div>
            </x-slot:trigger>
            <x-slot:content>
                <p class="text-muted-foreground">
                    Our platform is built on cutting-edge technology that delivers results in milliseconds. Experience unparalleled speed and responsiveness in
                    every interaction.
                </p>
                <ul class="text-muted-foreground mt-4 space-y-2">
                    <li class="flex items-center gap-2">
                        @svg('lucide-check', 'text-primary size-4')
                        Sub-second response times
                    </li>
                    <li class="flex items-center gap-2">
                        @svg('lucide-check', 'text-primary size-4')
                        Optimized caching layer
                    </li>
                    <li class="flex items-center gap-2">
                        @svg('lucide-check', 'text-primary size-4')
                        Global CDN distribution
                    </li>
                </ul>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                <div class="flex items-center gap-3">
                    <div class="flex size-10 items-center justify-center rounded-lg bg-blue-500/10">
                        @svg('lucide-shield', 'size-5 text-blue-500')
                    </div>
                    <div class="flex-1 text-left">
                        <h3 class="font-semibold">Enterprise-Grade Security</h3>
                        <p class="text-muted-foreground text-sm">Bank-level protection</p>
                    </div>
                </div>
            </x-slot:trigger>
            <x-slot:content>
                <p class="text-muted-foreground">
                    Your data is protected with military-grade encryption and industry-leading security practices. We maintain SOC 2 Type II compliance and
                    regular security audits.
                </p>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                <div class="flex items-center gap-3">
                    <div class="flex size-10 items-center justify-center rounded-lg bg-green-500/10">
                        @svg('lucide-users', 'size-5 text-green-500')
                    </div>
                    <div class="flex-1 text-left">
                        <h3 class="font-semibold">Team Collaboration</h3>
                        <p class="text-muted-foreground text-sm">Work together seamlessly</p>
                    </div>
                </div>
            </x-slot:trigger>
            <x-slot:content>
                <p class="text-muted-foreground">
                    Built-in collaboration tools make it easy for teams to work together in real-time. Share workspaces, assign tasks, and track progress all in
                    one place.
                </p>
            </x-slot:content>
        </x-accordion>
    </x-group>
</div>
```

### Navigation Sidebar

```blade
<aside class="w-64 p-4">
    <x-group>
        <x-accordion>
            <x-slot:trigger>
                @svg('lucide-layout-dashboard', 'size-4')
                Dashboard
            </x-slot:trigger>
            <x-slot:content>
                <div class="space-y-1">
                    <a
                        href="/dashboard/overview"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Overview
                    </a>
                    <a
                        href="/dashboard/analytics"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Analytics
                    </a>
                    <a
                        href="/dashboard/reports"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Reports
                    </a>
                </div>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                @svg('lucide-folder', 'size-4')
                Projects
            </x-slot:trigger>
            <x-slot:content>
                <div class="space-y-1">
                    <a
                        href="/projects/all"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        All Projects
                    </a>
                    <a
                        href="/projects/active"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Active
                    </a>
                    <a
                        href="/projects/archived"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Archived
                    </a>
                </div>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                @svg('lucide-settings', 'size-4')
                Settings
            </x-slot:trigger>
            <x-slot:content>
                <div class="space-y-1">
                    <a
                        href="/settings/profile"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Profile
                    </a>
                    <a
                        href="/settings/account"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Account
                    </a>
                    <a
                        href="/settings/billing"
                        class="hover:bg-accent block rounded px-3 py-2 text-sm">
                        Billing
                    </a>
                </div>
            </x-slot:content>
        </x-accordion>
    </x-group>
</aside>
```

### Non-Collapsible Group

```blade
{{-- Multiple items can be open at once --}}
<x-group collapsible="false">
    <x-accordion>
        <x-slot:trigger>Section 1</x-slot:trigger>
        <x-slot:content>Content 1</x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>Section 2</x-slot:trigger>
        <x-slot:content>Content 2</x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>Section 3</x-slot:trigger>
        <x-slot:content>Content 3</x-slot:content>
    </x-accordion>
</x-group>
```

### Filters Group

```blade
<x-card>
    <x-slot:header>
        <x-slot:title>Filters</x-slot:title>
    </x-slot:header>

    <x-slot:content>
        <x-group>
            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-tag', 'size-4')
                    Categories
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-2">
                        @foreach ($categories as $category)
                            <div class="flex items-center gap-2">
                                <x-checkbox
                                    id="cat-{{ $category->id }}"
                                    wire:model="selectedCategories"
                                    value="{{ $category->id }}" />
                                <x-label for="cat-{{ $category->id }}">
                                    {{ $category->name }}
                                </x-label>
                            </div>
                        @endforeach
                    </div>
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-dollar-sign', 'size-4')
                    Price Range
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-4">
                        <x-field>
                            <x-label>Minimum Price</x-label>
                            <x-input
                                type="number"
                                wire:model="minPrice"
                                placeholder="0" />
                        </x-field>

                        <x-field>
                            <x-label>Maximum Price</x-label>
                            <x-input
                                type="number"
                                wire:model="maxPrice"
                                placeholder="1000" />
                        </x-field>
                    </div>
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-star', 'size-4')
                    Rating
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-2">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="flex items-center gap-2">
                                <x-checkbox
                                    id="rating-{{ $i }}"
                                    wire:model="selectedRatings"
                                    value="{{ $i }}" />
                                <x-label
                                    for="rating-{{ $i }}"
                                    class="flex items-center gap-1">
                                    {{ $i }}
                                    @svg('lucide-star', 'size-3 fill-yellow-500 text-yellow-500')
                                    & up
                                </x-label>
                            </div>
                        @endfor
                    </div>
                </x-slot:content>
            </x-accordion>
        </x-group>
    </x-slot:content>
</x-card>
```

### Help Documentation

```blade
<div class="mx-auto max-w-4xl">
    <h1 class="mb-8 text-3xl font-bold">Getting Started</h1>

    <x-group>
        <x-accordion>
            <x-slot:trigger>
                <h2 class="text-lg font-semibold">Installation</h2>
            </x-slot:trigger>
            <x-slot:content>
                <p class="text-muted-foreground mb-4">Follow these steps to install the application:</p>
                <pre class="bg-muted overflow-x-auto rounded p-4"><code>npm install @package/name</code></pre>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                <h2 class="text-lg font-semibold">Configuration</h2>
            </x-slot:trigger>
            <x-slot:content>
                <p class="text-muted-foreground mb-4">Configure the application by editing the config file:</p>
                <pre class="bg-muted overflow-x-auto rounded p-4"><code>// config.js
export default {
  apiKey: 'your-api-key',
  environment: 'production'
}</code></pre>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                <h2 class="text-lg font-semibold">Usage</h2>
            </x-slot:trigger>
            <x-slot:content>
                <p class="text-muted-foreground mb-4">Here's a basic example of how to use the API:</p>
                <pre class="bg-muted overflow-x-auto rounded p-4"><code>import { createClient } from '@package/name';

const client = createClient({ apiKey: 'xxx' });
const data = await client.fetch();</code></pre>
            </x-slot:content>
        </x-accordion>
    </x-group>
</div>
```

## Accessibility

### Semantic Structure

Groups should contain semantically related elements:

```blade
{{-- Good: Related accordion items --}}
<x-group>
    <x-accordion>
        <x-slot:trigger>Personal Info</x-slot:trigger>
        <x-slot:content>...</x-slot:content>
    </x-accordion>
    <x-accordion>
        <x-slot:trigger>Contact Details</x-slot:trigger>
        <x-slot:content>...</x-slot:content>
    </x-accordion>
</x-group>
```

### Keyboard Navigation

Group components work with keyboard navigation:

- **Tab**: Navigate between accordion triggers
- **Enter/Space**: Toggle accordion open/closed
- Automatic closure of siblings maintains focus context

## Best Practices

### Use for Related Content

```blade
{{-- Good: Group related settings --}}
<x-group>
    <x-accordion>Profile Settings</x-accordion>
    <x-accordion>Account Settings</x-accordion>
    <x-accordion>Privacy Settings</x-accordion>
</x-group>

{{-- Avoid: Grouping unrelated items --}}
<x-group>
    <x-accordion>User Profile</x-accordion>
    <x-accordion>System Logs</x-accordion>
    <x-accordion>Billing</x-accordion>
</x-group>
```

### Consider collapsible Prop

```blade
{{-- Good: Single-open for FAQs (default) --}}
<x-group>
    @foreach ($faqs as $faq)
        <x-accordion>...</x-accordion>
    @endforeach
</x-group>

{{-- Good: Allow multiple open for filters --}}
<x-group collapsible="false">
    <x-accordion>Category Filters</x-accordion>
    <x-accordion>Price Filters</x-accordion>
    <x-accordion>Rating Filters</x-accordion>
</x-group>
```

### Nest Groups Carefully

```blade
{{-- Good: Separate groups for different sections --}}
<div>
    <h2>Account Settings</h2>
    <x-group>
        <x-accordion>Profile</x-accordion>
        <x-accordion>Security</x-accordion>
    </x-group>

    <h2>Preferences</h2>
    <x-group>
        <x-accordion>Notifications</x-accordion>
        <x-accordion>Display</x-accordion>
    </x-group>
</div>
```

## Technical Details

### Component Structure

```blade
<div
    x-data
    data-mog-group
    x-on:click="
        Array.from($event.target.closest('[data-mog-group]').children)
            .filter((x) => x !== $event.target.closest('[data-mog-groupable]'))
            .forEach((x) => Alpine.$data(x).close())
    ">
    {{ $slot }}
</div>
```

### Click Handler Logic

When an item is clicked:

1. Find the closest `[data-mog-group]` container
2. Get all children of that container
3. Filter out the clicked element's `[data-mog-groupable]` container
4. For each remaining child, call its Alpine `close()` method

### Data Attributes

- `data-mog-group`: Identifies the group container
- `data-mog-groupable`: Marks child elements that can be grouped (e.g., accordions)

### Alpine.js Integration

```javascript
// Group initializes Alpine context
x - data

// Click handler accesses Alpine $data
Alpine.$data(element).close()
```

## Related Components

- [Accordion](./accordion.md) - Primary use case for groups
- [Dropdown](./dropdown.md) - Can be grouped for exclusive opening
- [Dialog](./dialog.md) - Can use groups for modal management

## Common Patterns

### Tabbed Content Alternative

```blade
{{-- Use group for accordion-style tabs --}}
<x-card>
    <x-slot:header>
        <x-slot:title>Product Information</x-slot:title>
    </x-slot:header>

    <x-slot:content>
        <x-group>
            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-info', 'size-4')
                    Description
                </x-slot:trigger>
                <x-slot:content>
                    {{ $product->description }}
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-list', 'size-4')
                    Specifications
                </x-slot:trigger>
                <x-slot:content>
                    <dl class="grid grid-cols-2 gap-2">
                        @foreach ($product->specs as $key => $value)
                            <dt class="font-medium">{{ $key }}:</dt>
                            <dd class="text-muted-foreground">{{ $value }}</dd>
                        @endforeach
                    </dl>
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>
                    @svg('lucide-star', 'size-4')
                    Reviews
                </x-slot:trigger>
                <x-slot:content>
                    <div class="space-y-4">
                        @foreach ($product->reviews as $review)
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium">{{ $review->author }}</span>
                                    <div class="flex">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            @svg('lucide-star', 'size-3 fill-yellow-500 text-yellow-500')
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-muted-foreground mt-1 text-sm">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </x-slot:content>
            </x-accordion>
        </x-group>
    </x-slot:content>
</x-card>
```

### Nested Settings

```blade
<x-card>
    <x-slot:header>
        <x-slot:title>All Settings</x-slot:title>
    </x-slot:header>

    <x-slot:content>
        <x-group>
            <x-accordion>
                <x-slot:trigger>Account</x-slot:trigger>
                <x-slot:content>
                    {{-- Nested group for account sub-sections --}}
                    <x-group>
                        <x-accordion>
                            <x-slot:trigger>Profile</x-slot:trigger>
                            <x-slot:content>Profile settings...</x-slot:content>
                        </x-accordion>
                        <x-accordion>
                            <x-slot:trigger>Password</x-slot:trigger>
                            <x-slot:content>Password settings...</x-slot:content>
                        </x-accordion>
                    </x-group>
                </x-slot:content>
            </x-accordion>

            <x-accordion>
                <x-slot:trigger>Preferences</x-slot:trigger>
                <x-slot:content>
                    {{-- Nested group for preferences --}}
                    <x-group>
                        <x-accordion>
                            <x-slot:trigger>Notifications</x-slot:trigger>
                            <x-slot:content>Notification settings...</x-slot:content>
                        </x-accordion>
                        <x-accordion>
                            <x-slot:trigger>Display</x-slot:trigger>
                            <x-slot:content>Display settings...</x-slot:content>
                        </x-accordion>
                    </x-group>
                </x-slot:content>
            </x-accordion>
        </x-group>
    </x-slot:content>
</x-card>
```
