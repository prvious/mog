# Separator

The Separator component creates visual dividers to separate content sections. It supports both horizontal and vertical orientations and adapts to the theme's color scheme.

## Overview

Separators (also called dividers) provide visual breaks between content sections, helping to organize information and improve readability. They're subtle, non-intrusive elements that enhance visual hierarchy.

### When to Use

- **Section dividers**: Separate distinct content areas
- **Menu items**: Divide groups of menu options
- **Form sections**: Group related form fields
- **Card sections**: Separate header, content, and footer
- **Toolbar groups**: Divide sets of toolbar buttons
- **List items**: Create visual breaks in lists

## Props

### `orientation`

**Type:** `string`
**Default:** `'horizontal'`
**Options:** `'horizontal'`, `'vertical'`

Controls the direction of the separator.

- **`horizontal`**: Full width, 1px height (default)
- **`vertical`**: 1px width, full height

## Features

### Responsive Sizing

Separators automatically adapt to their container:

- Horizontal: `w-full h-px`
- Vertical: `h-full w-px`

### Theme-Aware

Uses the `bg-border` color class:

- Adapts to light/dark themes
- Consistent with other border colors
- Subtle and non-intrusive

### Semantic Markup

Includes proper ARIA attributes:

- `role="none"` for decorative separators
- `data-orientation` for programmatic access

### Flexible Styling

Can be customized with additional classes:

- Margin and spacing control
- Custom colors and opacity
- Width and height adjustments

## Usage Examples

### Horizontal Separator

```blade
<div>
    <h2>Section One</h2>
    <p>Content for the first section.</p>

    <x-separator class="my-4" />

    <h2>Section Two</h2>
    <p>Content for the second section.</p>
</div>
```

### Vertical Separator

```blade
<div class="flex items-center gap-4">
    <x-button>Button One</x-button>

    <x-separator
        orientation="vertical"
        class="h-6" />

    <x-button>Button Two</x-button>

    <x-separator
        orientation="vertical"
        class="h-6" />

    <x-button>Button Three</x-button>
</div>
```

### In Cards

```blade
<x-card>
    <x-slot:header>
        <x-slot:title>Card Title</x-slot:title>
        <x-slot:description>Card description goes here</x-slot:description>
    </x-slot:header>

    <x-separator />

    <x-slot:content>
        <p>Main card content area.</p>
    </x-slot:content>

    <x-separator />

    <x-slot:footer>
        <x-button>Action</x-button>
    </x-slot:footer>
</x-card>
```

### In Menus

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button>Options</x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-dropdown-item>Profile</x-dropdown-item>
        <x-dropdown-item>Settings</x-dropdown-item>

        <x-separator class="my-1" />

        <x-dropdown-item>Logout</x-dropdown-item>
    </x-slot:content>
</x-dropdown>
```

### In Forms

```blade
<form class="space-y-6">
    <div class="space-y-4">
        <h3 class="text-lg font-medium">Personal Information</h3>

        <x-field>
            <x-label>Name</x-label>
            <x-input wire:model="name" />
        </x-field>

        <x-field>
            <x-label>Email</x-label>
            <x-input
                wire:model="email"
                type="email" />
        </x-field>
    </div>

    <x-separator />

    <div class="space-y-4">
        <h3 class="text-lg font-medium">Account Settings</h3>

        <x-field>
            <x-label>Username</x-label>
            <x-input wire:model="username" />
        </x-field>

        <x-field>
            <x-label>Password</x-label>
            <x-input
                wire:model="password"
                type="password" />
        </x-field>
    </div>
</form>
```

### In Toolbars

```blade
<div class="border-border flex items-center gap-2 rounded-lg border p-2">
    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-bold', 'size-4')
    </x-button>
    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-italic', 'size-4')
    </x-button>
    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-underline', 'size-4')
    </x-button>

    <x-separator
        orientation="vertical"
        class="mx-1 h-6" />

    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-align-left', 'size-4')
    </x-button>
    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-align-center', 'size-4')
    </x-button>
    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-align-right', 'size-4')
    </x-button>

    <x-separator
        orientation="vertical"
        class="mx-1 h-6" />

    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-link', 'size-4')
    </x-button>
    <x-button
        variant="ghost"
        size="icon-sm">
        @svg('lucide-image', 'size-4')
    </x-button>
</div>
```

### With Custom Spacing

```blade
<div>
    <p>Paragraph one</p>

    {{-- Minimal spacing --}}
    <x-separator class="my-2" />

    <p>Paragraph two</p>

    {{-- Default spacing --}}
    <x-separator class="my-4" />

    <p>Paragraph three</p>

    {{-- Large spacing --}}
    <x-separator class="my-8" />

    <p>Paragraph four</p>
</div>
```

### In Navigation

```blade
<nav class="flex items-center gap-4">
    <a href="/">Home</a>
    <x-separator
        orientation="vertical"
        class="h-4" />

    <a href="/about">About</a>
    <x-separator
        orientation="vertical"
        class="h-4" />

    <a href="/services">Services</a>
    <x-separator
        orientation="vertical"
        class="h-4" />

    <a href="/contact">Contact</a>
</nav>
```

### In Sidebars

```blade
<aside class="w-64 space-y-4 p-4">
    <div class="space-y-2">
        <h4 class="text-sm font-semibold">Dashboard</h4>
        <a
            href="/dashboard"
            class="block">
            Overview
        </a>
        <a
            href="/dashboard/analytics"
            class="block">
            Analytics
        </a>
    </div>

    <x-separator />

    <div class="space-y-2">
        <h4 class="text-sm font-semibold">Settings</h4>
        <a
            href="/settings/profile"
            class="block">
            Profile
        </a>
        <a
            href="/settings/account"
            class="block">
            Account
        </a>
    </div>

    <x-separator />

    <div class="space-y-2">
        <h4 class="text-sm font-semibold">Help</h4>
        <a
            href="/docs"
            class="block">
            Documentation
        </a>
        <a
            href="/support"
            class="block">
            Support
        </a>
    </div>
</aside>
```

### Custom Color

```blade
{{-- Primary color separator --}}
<x-separator class="bg-primary/20 my-4" />

{{-- Destructive color separator --}}
<x-separator class="bg-destructive/20 my-4" />

{{-- Success color separator --}}
<x-separator class="my-4 bg-green-500/20" />
```

### Thicker Separator

```blade
{{-- 2px thick horizontal --}}
<x-separator class="my-4 h-0.5" />

{{-- 2px thick vertical --}}
<x-separator
    orientation="vertical"
    class="mx-4 w-0.5" />
```

### Dashed or Dotted

```blade
{{-- Dashed separator --}}
<x-separator class="border-border my-4 border-t border-dashed bg-transparent" />

{{-- Dotted separator --}}
<x-separator class="border-border my-4 border-t border-dotted bg-transparent" />
```

## Accessibility

### Decorative Role

Separators are decorative elements:

```blade
{{-- Correct: Uses role="none" for decorative purpose --}}
<x-separator />

{{-- The component automatically includes role="none" --}}
```

### Not for Interactive Content

Separators should not be used for interactive elements:

```blade
{{-- Good: Pure visual divider --}}
<x-separator class="my-4" />

{{-- Avoid: Making separator interactive --}}
<x-separator
    class="my-4 cursor-pointer"
    x-on:click="doSomething()" />
```

### Semantic Alternatives

For meaningful breaks, consider semantic HTML:

```blade
{{-- Good: Use <hr> when the separator has semantic meaning --}}
<hr class="bg-border my-4 h-px border-0" />

{{-- Good: Use <x-separator> for purely visual dividers --}}
<x-separator class="my-4" />
```

## Best Practices

### Use Appropriate Spacing

```blade
{{-- Good: Consistent spacing --}}
<div class="space-y-4">
    <section>Content one</section>
    <x-separator />
    <section>Content two</section>
    <x-separator />
    <section>Content three</section>
</div>

{{-- Avoid: Inconsistent spacing --}}
<div>
    <section>Content one</section>
    <x-separator class="my-2" />
    <section>Content two</section>
    <x-separator class="my-8" />
    <section>Content three</section>
</div>
```

### Don't Overuse

```blade
{{-- Good: Strategic use of separators --}}
<div>
    <h2>Category One</h2>
    <p>Items in category one</p>

    <x-separator class="my-6" />

    <h2>Category Two</h2>
    <p>Items in category two</p>
</div>

{{-- Avoid: Too many separators create clutter --}}
<div>
    <p>Line one</p>
    <x-separator class="my-2" />
    <p>Line two</p>
    <x-separator class="my-2" />
    <p>Line three</p>
    <x-separator class="my-2" />
    <p>Line four</p>
</div>
```

### Size Vertical Separators

```blade
{{-- Good: Explicit height for vertical separators --}}
<div class="flex items-center">
    <span>Left</span>
    <x-separator
        orientation="vertical"
        class="mx-2 h-4" />
    <span>Right</span>
</div>

{{-- Avoid: No height may not render visibly --}}
<div class="flex items-center">
    <span>Left</span>
    <x-separator
        orientation="vertical"
        class="mx-2" />
    <span>Right</span>
</div>
```

### Match Container Padding

```blade
{{-- Good: Separator matches content padding --}}
<x-card>
    <x-slot:content class="p-6">
        <p>Content section one</p>
    </x-slot:content>

    <x-separator />

    <x-slot:content class="p-6">
        <p>Content section two</p>
    </x-slot:content>
</x-card>

{{-- Avoid: Separator extends beyond content --}}
<div class="p-6">
    <p>Content with padding</p>
    <x-separator class="-mx-6 my-4 w-screen" />
    {{-- Creates visual imbalance --}}
</div>
```

## Technical Details

### Component Structure

```blade
<div
    role="none"
    data-orientation="{{ $orientation }}"
    data-slot="separator"
    class="bg-border shrink-0 data-[orientation=horizontal]:h-px data-[orientation=vertical]:h-full data-[orientation=horizontal]:w-full data-[orientation=vertical]:w-px"></div>
```

### CSS Classes

```css
/* Base styles */
bg-border           /* Theme-aware border color */
shrink-0            /* Prevent flex shrinking */

/* Horizontal orientation */
data-[orientation=horizontal]:h-px     /* 1px height */
data-[orientation=horizontal]:w-full   /* Full width */

/* Vertical orientation */
data-[orientation=vertical]:h-full     /* Full height */
data-[orientation=vertical]:w-px       /* 1px width */
```

### Data Attributes

- `data-orientation`: Current orientation (horizontal/vertical)
- `data-slot`: Component identifier for styling hooks
- `role="none"`: Marks element as decorative

## Related Components

- [Card](./card.md) - Use separators to divide card sections
- [Dropdown](./dropdown.md) - Separate dropdown menu groups
- [Dialog](./dialog.md) - Divide dialog sections
- [Item](./item.md) - Create visual breaks in lists

## Common Patterns

### Section Divider with Label

```blade
<div>
    <section>First section content</section>

    <div class="relative my-6">
        <x-separator />
        <div class="bg-background text-muted-foreground absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 px-2 text-xs">OR</div>
    </div>

    <section>Second section content</section>
</div>
```

### Sidebar Navigation

```blade
<aside class="space-y-4 p-4">
    <nav class="space-y-1">
        <a href="#">Dashboard</a>
        <a href="#">Projects</a>
        <a href="#">Tasks</a>
    </nav>

    <x-separator />

    <nav class="space-y-1">
        <a href="#">Settings</a>
        <a href="#">Help</a>
    </nav>

    <x-separator />

    <nav class="space-y-1">
        <a href="#">Logout</a>
    </nav>
</aside>
```

### Breadcrumb Separator

```blade
<nav class="flex items-center gap-2 text-sm">
    <a href="/">Home</a>

    <x-separator
        orientation="vertical"
        class="h-4" />

    <a href="/products">Products</a>

    <x-separator
        orientation="vertical"
        class="h-4" />

    <span class="text-muted-foreground">Product Details</span>
</nav>
```
