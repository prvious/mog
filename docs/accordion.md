# Accordion

The Accordion component provides collapsible content sections that can be expanded or collapsed by clicking a trigger button. It uses Alpine.js for state management and smooth CSS Grid animations for expanding and collapsing content.

## Overview

Accordions organize related content into expandable sections, allowing users to show and hide content to focus on what's relevant to them. The Mog accordion component supports both collapsible and always-open modes.

### When to Use

- **FAQ sections**: Display questions with expandable answers
- **Settings panels**: Group related settings that can be shown/hidden
- **Documentation**: Organize content into sections users can navigate
- **Details disclosure**: Hide secondary information until needed
- **Navigation menus**: Create expandable menu sections

### Accordion vs Other Components

- **Accordion**: Collapsible content sections within the page
- **Dialog**: Modal overlay that blocks interaction with the page
- **Dropdown**: Floating menu positioned relative to a trigger
- **Popover**: Contextual information in a positioned overlay

## Props

### `trigger`

**Required**
**Type:** `Slot`

The clickable element that toggles the accordion open and closed.

### `content`

**Required**
**Type:** `Slot`

The expandable content that is shown or hidden when the accordion is toggled.

### `open`

**Type:** `boolean`
**Default:** `false`

Controls whether the accordion is initially open or closed.

### `collapsible`

**Type:** `boolean`
**Default:** `true`

Whether the accordion can be collapsed. When `false`, the accordion stays open and the trigger is not clickable.

## Features

### Smooth Animations

Uses CSS Grid for height animations:

- Grid rows transition from `0fr` to `1fr`
- Smooth ease-in-out timing
- 200ms duration
- No JavaScript animation needed

### State Management

Alpine.js reactive state:

- `x-data` manages open/closed state
- `x-modelable` for two-way binding
- `data-state` attribute for CSS styling
- Chevron icon auto-rotates based on state

### Accessibility

Built-in accessibility features:

- Semantic button element for trigger
- Proper keyboard navigation
- Focus management
- Screen reader compatible

## Usage Examples

### Basic Accordion

```blade
<x-accordion>
    <x-slot:trigger>What is your return policy?</x-slot:trigger>

    <x-slot:content>
        We offer a 30-day return policy for all unused items in their original packaging. Contact our support team to initiate a return.
    </x-slot:content>
</x-accordion>
```

### Initially Open

```blade
<x-accordion :open="true">
    <x-slot:trigger>Shipping Information</x-slot:trigger>

    <x-slot:content>We ship worldwide and offer free shipping on orders over $50. Typical delivery time is 5-7 business days.</x-slot:content>
</x-accordion>
```

### Always Open (Non-Collapsible)

```blade
<x-accordion :collapsible="false">
    <x-slot:trigger>Important Notice</x-slot:trigger>

    <x-slot:content>
        This section contains critical information that should always be visible. The trigger button is disabled and cannot be clicked.
    </x-slot:content>
</x-accordion>
```

### FAQ Section

```blade
<div class="divide-y">
    <x-accordion>
        <x-slot:trigger>How do I create an account?</x-slot:trigger>

        <x-slot:content>
            Click the "Sign Up" button in the top right corner and fill out the registration form. You'll receive a confirmation email to verify your account.
        </x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>What payment methods do you accept?</x-slot:trigger>

        <x-slot:content>
            We accept all major credit cards, PayPal, Apple Pay, and Google Pay. All transactions are securely processed through our payment provider.
        </x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>Can I cancel my subscription?</x-slot:trigger>

        <x-slot:content>
            Yes, you can cancel your subscription at any time from your account settings. Your access will continue until the end of your billing period.
        </x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>How do I contact support?</x-slot:trigger>

        <x-slot:content>
            You can reach our support team via email at support
            @example.com
            or through the live chat widget in the bottom right corner of the page.
        </x-slot:content>
    </x-accordion>
</div>
```

### With Rich Content

```blade
<x-accordion>
    <x-slot:trigger>Installation Instructions</x-slot:trigger>

    <x-slot:content>
        <h4 class="mb-2 font-medium">Requirements</h4>
        <ul class="mb-4 list-inside list-disc space-y-1">
            <li>PHP 8.1 or higher</li>
            <li>Laravel 10.x or 11.x</li>
            <li>Alpine.js 3.x</li>
        </ul>

        <h4 class="mb-2 font-medium">Installation Steps</h4>
        <ol class="list-inside list-decimal space-y-2">
            <li>Install the package via Composer</li>
            <li>Publish the configuration file</li>
            <li>Run the migrations</li>
            <li>Configure your settings</li>
        </ol>

        <x-button class="mt-4">View Full Documentation</x-button>
    </x-slot:content>
</x-accordion>
```

### Custom Trigger Styling

```blade
<x-accordion class="rounded-lg border">
    <x-slot:trigger class="hover:bg-accent px-4">
        <div class="flex items-center gap-3">
            @svg('lucide-package', 'size-5')
            <span>Package Details</span>
        </div>
    </x-slot:trigger>

    <x-slot:content class="px-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class="text-sm font-medium">Weight</div>
                <div class="text-muted-foreground">2.5 kg</div>
            </div>
            <div>
                <div class="text-sm font-medium">Dimensions</div>
                <div class="text-muted-foreground">30x20x15 cm</div>
            </div>
        </div>
    </x-slot:content>
</x-accordion>
```

### Programmatic Control

```blade
<div x-data="{ expanded: false }">
    <div class="mb-4 flex gap-2">
        <x-button
            x-on:click="expanded = true"
            size="sm">
            Expand
        </x-button>
        <x-button
            x-on:click="expanded = false"
            size="sm"
            variant="outline">
            Collapse
        </x-button>
        <x-button
            x-on:click="expanded = !expanded"
            size="sm"
            variant="ghost">
            Toggle
        </x-button>
    </div>

    <x-accordion x-model="expanded">
        <x-slot:trigger>Controlled Accordion</x-slot:trigger>

        <x-slot:content>This accordion's state is controlled by the buttons above using x-model.</x-slot:content>
    </x-accordion>
</div>
```

### Livewire Integration

```blade
<div>
    {{-- Toggle from Livewire --}}
    <x-button
        wire:click="$toggle('showDetails')"
        size="sm">
        Toggle from Server
    </x-button>

    <x-accordion wire:model="showDetails">
        <x-slot:trigger>Server-Controlled Accordion</x-slot:trigger>

        <x-slot:content>
            <div wire:loading>
                <x-spinner class="size-4" />
                Loading details...
            </div>

            <div wire:loading.remove>
                {{ $details }}
            </div>
        </x-slot:content>
    </x-accordion>
</div>
```

### Settings Panel

```blade
<div class="space-y-4">
    <h3 class="text-lg font-semibold">Account Settings</h3>

    <div class="divide-y rounded-lg border">
        <x-accordion>
            <x-slot:trigger>
                <div class="flex items-center gap-3">
                    @svg('lucide-user', 'size-4')
                    <span>Profile Settings</span>
                </div>
            </x-slot:trigger>

            <x-slot:content>
                <div class="space-y-4">
                    <x-field>
                        <x-label>Display Name</x-label>
                        <x-input
                            type="text"
                            placeholder="John Doe" />
                    </x-field>

                    <x-field>
                        <x-label>Bio</x-label>
                        <x-textarea placeholder="Tell us about yourself"></x-textarea>
                    </x-field>

                    <x-button>Save Changes</x-button>
                </div>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                <div class="flex items-center gap-3">
                    @svg('lucide-bell', 'size-4')
                    <span>Notification Preferences</span>
                </div>
            </x-slot:trigger>

            <x-slot:content>
                <div class="space-y-3">
                    <x-field>
                        <div class="flex items-center justify-between">
                            <x-label>Email Notifications</x-label>
                            <x-switch />
                        </div>
                    </x-field>

                    <x-field>
                        <div class="flex items-center justify-between">
                            <x-label>Push Notifications</x-label>
                            <x-switch />
                        </div>
                    </x-field>

                    <x-field>
                        <div class="flex items-center justify-between">
                            <x-label>SMS Notifications</x-label>
                            <x-switch />
                        </div>
                    </x-field>
                </div>
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>
                <div class="flex items-center gap-3">
                    @svg('lucide-shield', 'size-4')
                    <span>Security Settings</span>
                </div>
            </x-slot:trigger>

            <x-slot:content>
                <div class="space-y-4">
                    <x-button
                        variant="outline"
                        class="w-full justify-start">
                        @svg('lucide-key', 'size-4')
                        Change Password
                    </x-button>

                    <x-button
                        variant="outline"
                        class="w-full justify-start">
                        @svg('lucide-smartphone', 'size-4')
                        Two-Factor Authentication
                    </x-button>

                    <x-button
                        variant="outline"
                        class="w-full justify-start">
                        @svg('lucide-log-out', 'size-4')
                        Sign Out All Devices
                    </x-button>
                </div>
            </x-slot:content>
        </x-accordion>
    </div>
</div>
```

### Nested Accordions

```blade
<x-accordion>
    <x-slot:trigger>Countries</x-slot:trigger>

    <x-slot:content>
        <div class="space-y-2">
            <x-accordion class="border-l-2 pl-4">
                <x-slot:trigger>United States</x-slot:trigger>

                <x-slot:content>
                    <ul class="list-inside list-disc space-y-1">
                        <li>New York</li>
                        <li>California</li>
                        <li>Texas</li>
                    </ul>
                </x-slot:content>
            </x-accordion>

            <x-accordion class="border-l-2 pl-4">
                <x-slot:trigger>United Kingdom</x-slot:trigger>

                <x-slot:content>
                    <ul class="list-inside list-disc space-y-1">
                        <li>England</li>
                        <li>Scotland</li>
                        <li>Wales</li>
                    </ul>
                </x-slot:content>
            </x-accordion>
        </div>
    </x-slot:content>
</x-accordion>
```

### Product Features

```blade
<div class="divide-y rounded-lg border">
    <x-accordion :open="true">
        <x-slot:trigger>
            <div class="flex items-center gap-3">
                @svg('lucide-check-circle', 'size-4 text-green-500')
                <span class="font-medium">Key Features</span>
            </div>
        </x-slot:trigger>

        <x-slot:content>
            <ul class="space-y-2">
                <li class="flex items-start gap-2">
                    @svg('lucide-check', 'mt-0.5 size-4 text-green-500')
                    <span>Unlimited storage and bandwidth</span>
                </li>
                <li class="flex items-start gap-2">
                    @svg('lucide-check', 'mt-0.5 size-4 text-green-500')
                    <span>24/7 customer support</span>
                </li>
                <li class="flex items-start gap-2">
                    @svg('lucide-check', 'mt-0.5 size-4 text-green-500')
                    <span>Advanced analytics dashboard</span>
                </li>
                <li class="flex items-start gap-2">
                    @svg('lucide-check', 'mt-0.5 size-4 text-green-500')
                    <span>Team collaboration tools</span>
                </li>
            </ul>
        </x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>Technical Specifications</x-slot:trigger>

        <x-slot:content>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium">CPU</dt>
                    <dd class="text-muted-foreground text-sm">8 Cores @ 3.2GHz</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium">RAM</dt>
                    <dd class="text-muted-foreground text-sm">16 GB DDR4</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium">Storage</dt>
                    <dd class="text-muted-foreground text-sm">512 GB NVMe SSD</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium">Graphics</dt>
                    <dd class="text-muted-foreground text-sm">Integrated GPU</dd>
                </div>
            </dl>
        </x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>What's in the Box</x-slot:trigger>

        <x-slot:content>
            <ul class="list-inside list-disc space-y-1">
                <li>1x Main device</li>
                <li>1x Power adapter</li>
                <li>1x USB-C cable</li>
                <li>1x Quick start guide</li>
                <li>1x Warranty card</li>
            </ul>
        </x-slot:content>
    </x-accordion>
</div>
```

## Accessibility

### Keyboard Navigation

The accordion trigger is a proper `<button>` element:

- **Click**: Toggle open/closed state
- **Space/Enter**: Activate trigger (native button behavior)
- **Tab**: Navigate to next focusable element

### Screen Reader Support

```blade
{{-- Good: Clear trigger text --}}
<x-accordion>
    <x-slot:trigger>Frequently Asked Questions</x-slot:trigger>
    <x-slot:content>...</x-slot:content>
</x-accordion>

{{-- Better: Include count for context --}}
<x-accordion>
    <x-slot:trigger>
        Shipping Options
        <span class="text-muted-foreground ml-2 text-xs">(3 available)</span>
    </x-slot:trigger>
    <x-slot:content>...</x-slot:content>
</x-accordion>
```

### State Indication

The `data-state` attribute indicates current state:

- `data-state="open"`: Accordion is expanded
- `data-state="closed"`: Accordion is collapsed

This allows custom styling based on state:

```blade
<x-accordion class="group-data-[state=open]:bg-accent/50">
    <x-slot:trigger>Custom State Styling</x-slot:trigger>
    <x-slot:content>...</x-slot:content>
</x-accordion>
```

## Best Practices

### Keep Triggers Concise

```blade
{{-- Good: Short, scannable trigger text --}}
<x-accordion>
    <x-slot:trigger>Payment Methods</x-slot:trigger>
    <x-slot:content>...</x-slot:content>
</x-accordion>

{{-- Avoid: Long trigger text --}}
<x-accordion>
    <x-slot:trigger>Click here to view all available payment methods including credit cards, PayPal, and more</x-slot:trigger>
    <x-slot:content>...</x-slot:content>
</x-accordion>
```

### Group Related Content

```blade
{{-- Good: Related accordions grouped together --}}
<div class="divide-y rounded-lg border">
    <x-accordion>
        <x-slot:trigger>Shipping</x-slot:trigger>
        ...
    </x-accordion>
    <x-accordion>
        <x-slot:trigger>Returns</x-slot:trigger>
        ...
    </x-accordion>
    <x-accordion>
        <x-slot:trigger>Warranty</x-slot:trigger>
        ...
    </x-accordion>
</div>
```

### Use for Optional Content

```blade
{{-- Good: Hide optional/advanced details --}}
<x-accordion>
    <x-slot:trigger>Advanced Options</x-slot:trigger>
    <x-slot:content>
        <!-- Advanced settings most users don't need -->
    </x-slot:content>
</x-accordion>

{{-- Avoid: Hiding critical information --}}
<x-accordion>
    <x-slot:trigger>Terms and Conditions</x-slot:trigger>
    <x-slot:content>
        <!-- Important legal information should be more visible -->
    </x-slot:content>
</x-accordion>
```

### Default States

```blade
{{-- Important content: Open by default --}}
<x-accordion :open="true">
    <x-slot:trigger>Before You Start</x-slot:trigger>
    <x-slot:content>Critical setup instructions</x-slot:content>
</x-accordion>

{{-- Optional content: Closed by default --}}
<x-accordion>
    <x-slot:trigger>Optional Configuration</x-slot:trigger>
    <x-slot:content>Advanced options</x-slot:content>
</x-accordion>
```

## Technical Details

### Animation Mechanics

The accordion uses CSS Grid for smooth height animations:

```css
/* Closed state */
.group-data-[state='closed'] {
    grid-template-rows: 0fr;
}

/* Open state */
.group-data-[state='open'] {
    grid-template-rows: 1fr;
}
```

This creates a smooth transition without needing to know the exact height of the content.

### State Management

Alpine.js provides reactive state:

```javascript
x-data="{
    open: false  // or true if initially open
}"
```

The `x-modelable="open"` directive enables two-way binding:

```blade
<div x-data="{ expanded: false }">
    <x-accordion x-model="expanded">...</x-accordion>
</div>
```

### Chevron Icon

The chevron automatically rotates based on state:

- Closed: Pointing down (rotated 180°)
- Open: Pointing up (default orientation)

## Related Components

- [Dialog](./dialog.md) - Modal dialogs for focused interactions
- [Dropdown](./dropdown.md) - Floating menus with actions
- [Popover](./popover.md) - Contextual overlays
- [Slide-over](./slide-over.md) - Side panel overlays

## Common Patterns

### Documentation Sections

```blade
<div class="mx-auto max-w-3xl space-y-6">
    <h1 class="text-3xl font-bold">API Documentation</h1>

    <div class="divide-y rounded-lg border">
        <x-accordion :open="true">
            <x-slot:trigger>Authentication</x-slot:trigger>
            <x-slot:content>
                <!-- Authentication docs -->
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>Endpoints</x-slot:trigger>
            <x-slot:content>
                <!-- API endpoints -->
            </x-slot:content>
        </x-accordion>

        <x-accordion>
            <x-slot:trigger>Error Handling</x-slot:trigger>
            <x-slot:content>
                <!-- Error docs -->
            </x-slot:content>
        </x-accordion>
    </div>
</div>
```

### Pricing Comparison

```blade
<div class="divide-y">
    <x-accordion>
        <x-slot:trigger>
            <div class="flex w-full items-center justify-between pr-4">
                <span>Free Plan</span>
                <span class="font-bold">$0/mo</span>
            </div>
        </x-slot:trigger>

        <x-slot:content>
            <ul class="space-y-2">
                <li>✓ 100 API calls per day</li>
                <li>✓ Community support</li>
                <li>✗ No analytics</li>
            </ul>
            <x-button class="mt-4 w-full">Get Started</x-button>
        </x-slot:content>
    </x-accordion>

    <x-accordion>
        <x-slot:trigger>
            <div class="flex w-full items-center justify-between pr-4">
                <span>Pro Plan</span>
                <span class="font-bold">$29/mo</span>
            </div>
        </x-slot:trigger>

        <x-slot:content>
            <ul class="space-y-2">
                <li>✓ Unlimited API calls</li>
                <li>✓ Priority support</li>
                <li>✓ Advanced analytics</li>
            </ul>
            <x-button class="mt-4 w-full">Upgrade Now</x-button>
        </x-slot:content>
    </x-accordion>
</div>
```
