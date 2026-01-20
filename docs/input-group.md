# Input Group

The Input Group component family allows you to combine text inputs with buttons, icons, or text labels to create composite form controls. Use input groups for enhanced inputs like search boxes with buttons, currency inputs with symbols, or URL inputs with protocol prefixes.

## Overview

Input groups enhance standard form inputs by allowing you to attach additional elements before or after the input field. This creates a unified, visually cohesive control that improves usability and provides context.

### When to Use

- **Search inputs**: Add search buttons or icons
- **Currency inputs**: Display currency symbols or units
- **URL inputs**: Show protocol prefixes (https://)
- **Email inputs**: Add domain suffixes (@company.com)
- **Measurement inputs**: Include unit labels (kg, px, %)
- **Action inputs**: Combine input with related action button

### Input Group vs Field

- **Input Group**: Visual grouping of input with addons/buttons in a single border
- **Field**: Semantic form field with label, description, and error messages

## Component Family

The input group system consists of 6 components:

- **`<x-input-group>`**: Main wrapper container
- **`<x-input-group-input>`**: Input element within group
- **`<x-input-group-textarea>`**: Textarea element within group
- **`<x-input-group-addon>`**: Icon or text addon container
- **`<x-input-group-button>`**: Button within group
- **`<x-input-group-text>`**: Static text label

## Props

### `<x-input-group-addon>`

#### `align`

**Type:** `string`
**Default:** `'inline-start'`
**Options:** `'inline-start'`, `'inline-end'`, `'block-start'`, `'block-end'`

Controls the position of the addon relative to the input.

- **`inline-start`**: Left side of input (default)
- **`inline-end`**: Right side of input
- **`block-start`**: Above input
- **`block-end`**: Below input

### `<x-input-group-button>`

#### `type`

**Type:** `string`
**Default:** `'button'`

The button type attribute.

#### `variant`

**Type:** `string`
**Default:** `'ghost'`

Button variant (uses Button component variants).

#### `size`

**Type:** `string`
**Default:** `'xs'`
**Options:** `'xs'`, `'sm'`, `'icon-xs'`, `'icon-sm'`

Size of the button within the group.

## Features

### Unified Focus State

Input groups manage focus state at the container level:

- Border and ring apply to entire group
- Smooth transition when input is focused
- Visual unity between input and addons

### Error State Propagation

Error states automatically propagate from the input to the group container:

- Red border and ring on entire group
- Works with `aria-invalid` attribute
- Consistent error styling

### Flexible Alignment

Four alignment options for addons:

- **Inline**: Left/right of input (horizontal layout)
- **Block**: Above/below input (vertical layout)
- Dynamic height adjustments
- Responsive to content

### Click-to-Focus

Clicking on addons automatically focuses the input for better UX.

## Usage Examples

### Basic Input Group

```blade
<x-input-group>
    <x-input-group-addon>
        @svg('lucide-search')
    </x-input-group-addon>

    <x-input-group-input
        type="search"
        placeholder="Search..." />
</x-input-group>
```

### Search Input with Button

```blade
<x-input-group>
    <x-input-group-input
        type="search"
        placeholder="Search products..."
        wire:model="search" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button wire:click="search">
            @svg('lucide-search')
            Search
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### Currency Input with Symbol

```blade
<x-input-group>
    <x-input-group-addon>
        <x-input-group-text>$</x-input-group-text>
    </x-input-group-addon>

    <x-input-group-input
        type="number"
        step="0.01"
        placeholder="0.00"
        wire:model="amount" />

    <x-input-group-addon align="inline-end">
        <x-input-group-text>USD</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### URL Input with Protocol

```blade
<x-input-group>
    <x-input-group-addon>
        <x-input-group-text>https://</x-input-group-text>
    </x-input-group-addon>

    <x-input-group-input
        type="url"
        placeholder="example.com"
        wire:model="domain" />
</x-input-group>
```

### Email Input with Domain

```blade
<x-input-group>
    <x-input-group-input
        type="text"
        placeholder="username"
        wire:model="username" />

    <x-input-group-addon align="inline-end">
        <x-input-group-text>@company.com</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Input with Icon Addon

```blade
<x-input-group>
    <x-input-group-addon>
        @svg('lucide-mail')
    </x-input-group-addon>

    <x-input-group-input
        type="email"
        placeholder="Enter your email"
        wire:model="email" />
</x-input-group>
```

### Measurement Input

```blade
<x-input-group>
    <x-input-group-input
        type="number"
        placeholder="Enter width"
        wire:model="width" />

    <x-input-group-addon align="inline-end">
        <x-input-group-text>px</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Textarea with Character Counter

```blade
<x-input-group>
    <x-input-group-textarea
        placeholder="Enter your message..."
        wire:model.live="message"
        rows="4" />

    <x-input-group-addon align="block-end">
        <x-input-group-text>{{ strlen($message ?? '') }} / 500 characters</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Multiple Addons (Prefix and Suffix)

```blade
<x-input-group>
    <x-input-group-addon align="inline-start">
        @svg('lucide-dollar-sign')
    </x-input-group-addon>

    <x-input-group-input
        type="number"
        step="0.01"
        placeholder="0.00"
        wire:model="price" />

    <x-input-group-addon align="inline-end">
        <x-input-group-text>per month</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Block-Aligned Addons

```blade
{{-- Addon above input --}}
<x-input-group>
    <x-input-group-addon align="block-start">
        <x-input-group-text>Website URL</x-input-group-text>
    </x-input-group-addon>

    <x-input-group-input
        type="url"
        placeholder="https://example.com"
        wire:model="website" />
</x-input-group>

{{-- Addon below input --}}
<x-input-group>
    <x-input-group-input
        type="password"
        placeholder="Enter password"
        wire:model="password" />

    <x-input-group-addon align="block-end">
        <x-input-group-text>
            @svg('lucide-info')
            Must be at least 8 characters
        </x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Button with Icon

```blade
<x-input-group>
    <x-input-group-input
        type="text"
        placeholder="Paste URL here..."
        wire:model="url" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button
            size="icon-xs"
            wire:click="pasteFromClipboard">
            @svg('lucide-clipboard')
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### File Size Input

```blade
<x-input-group>
    <x-input-group-input
        type="number"
        placeholder="0"
        wire:model="size" />

    <x-input-group-addon align="inline-end">
        <x-select
            wire:model="unit"
            class="h-6 border-0 text-sm shadow-none">
            <option value="KB">KB</option>
            <option value="MB">MB</option>
            <option value="GB">GB</option>
        </x-select>
    </x-input-group-addon>
</x-input-group>
```

### With Field Component

```blade
<x-field>
    <x-field-label for="search">Search Products</x-field-label>

    <x-input-group>
        <x-input-group-addon>
            @svg('lucide-search')
        </x-input-group-addon>

        <x-input-group-input
            id="search"
            type="search"
            placeholder="Search..."
            wire:model.live="search" />

        <x-input-group-addon align="inline-end">
            <x-input-group-button wire:click="clearSearch">
                @svg('lucide-x')
            </x-input-group-button>
        </x-input-group-addon>
    </x-input-group>

    <x-field-description>Search by product name, SKU, or category</x-field-description>
</x-field>
```

### With Validation Errors

```blade
<x-field>
    <x-field-label for="email">Email Address</x-field-label>

    <x-input-group>
        <x-input-group-addon>
            @svg('lucide-mail')
        </x-input-group-addon>

        <x-input-group-input
            id="email"
            type="email"
            placeholder="you@example.com"
            wire:model="email"
            :aria-invalid="$errors->has('email')" />
    </x-input-group>

    <x-error key="email" />
</x-field>
```

### Copy to Clipboard

```blade
<x-input-group>
    <x-input-group-input
        type="text"
        readonly
        value="{{ $inviteLink }}"
        x-ref="inviteLink" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button
            x-on:click="
                $refs.inviteLink.select()
                document.execCommand('copy')
                $mog.toast.success('Copied to clipboard')
            ">
            @svg('lucide-copy')
            Copy
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### Password Visibility Toggle

```blade
<x-input-group x-data="{ showPassword: false }">
    <x-input-group-addon>
        @svg('lucide-lock')
    </x-input-group-addon>

    <x-input-group-input
        :type="showPassword ? 'text' : 'password'"
        placeholder="Enter password"
        wire:model="password" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button
            size="icon-xs"
            x-on:click="showPassword = !showPassword">
            <span x-show="!showPassword">@svg('lucide-eye')</span>
            <span x-show="showPassword">@svg('lucide-eye-off')</span>
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### Tag Input with Add Button

```blade
<x-input-group>
    <x-input-group-input
        type="text"
        placeholder="Add a tag..."
        wire:model="newTag"
        x-on:keydown.enter.prevent="$wire.addTag()" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button wire:click="addTag">
            @svg('lucide-plus')
            Add
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### Date Range Inputs

```blade
<div class="flex items-center gap-2">
    <x-input-group>
        <x-input-group-addon>
            @svg('lucide-calendar')
        </x-input-group-addon>

        <x-input-group-input
            type="date"
            wire:model="startDate" />
    </x-input-group>

    <span class="text-muted-foreground">to</span>

    <x-input-group>
        <x-input-group-addon>
            @svg('lucide-calendar')
        </x-input-group-addon>

        <x-input-group-input
            type="date"
            wire:model="endDate" />
    </x-input-group>
</div>
```

### Percentage Input

```blade
<x-input-group>
    <x-input-group-input
        type="number"
        min="0"
        max="100"
        step="1"
        placeholder="0"
        wire:model="percentage" />

    <x-input-group-addon align="inline-end">
        <x-input-group-text>%</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Quantity Selector

```blade
<x-input-group>
    <x-input-group-addon>
        <x-input-group-button
            size="icon-xs"
            wire:click="decrementQuantity">
            @svg('lucide-minus')
        </x-input-group-button>
    </x-input-group-addon>

    <x-input-group-input
        type="number"
        min="1"
        wire:model="quantity"
        class="text-center" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button
            size="icon-xs"
            wire:click="incrementQuantity">
            @svg('lucide-plus')
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### Phone Number Input

```blade
<x-input-group>
    <x-input-group-addon>
        <x-select
            wire:model="countryCode"
            class="h-6 w-20 border-0 text-sm shadow-none">
            <option value="+1">+1</option>
            <option value="+44">+44</option>
            <option value="+91">+91</option>
        </x-select>
    </x-input-group-addon>

    <x-input-group-input
        type="tel"
        placeholder="(555) 123-4567"
        wire:model="phoneNumber" />
</x-input-group>
```

## Styling & States

### Focus Behavior

Input groups have a unified focus state:

```blade
{{-- When input is focused, entire group gets border and ring --}}
<x-input-group>
    <x-input-group-addon>@svg('icon')</x-input-group-addon>
    <x-input-group-input />
</x-input-group>
```

The focus state is managed through CSS:

- `has-[[data-slot=input-group-control]:focus-visible]` selector
- Border color changes to ring color
- Ring with 3px width appears around entire group
- Smooth transitions

### Error States

Error states propagate from input to container:

```blade
<x-input-group>
    <x-input-group-addon>@svg('icon')</x-input-group-addon>
    <x-input-group-input aria-invalid="true" />
</x-input-group>
```

Error styling:

- Red border on entire group
- Red ring around group
- Works automatically with validation errors

### Disabled States

```blade
<x-input-group data-disabled="true">
    <x-input-group-addon>@svg('icon')</x-input-group-addon>
    <x-input-group-input disabled />
</x-input-group>
```

Disabled styling:

- Reduced opacity on addons (50%)
- Standard disabled styling on input
- Cursor changes to not-allowed

### Dark Mode

All input group components support dark mode:

```blade
{{-- Automatically adapts to dark mode --}}
<x-input-group>
    <x-input-group-addon>$</x-input-group-addon>
    <x-input-group-input />
</x-input-group>
```

## Alignment Guide

### Inline Start (Default)

Addon on the left side of input:

```blade
<x-input-group>
    <x-input-group-addon align="inline-start">
        @svg('lucide-search')
    </x-input-group-addon>
    <x-input-group-input />
</x-input-group>
```

### Inline End

Addon on the right side of input:

```blade
<x-input-group>
    <x-input-group-input />
    <x-input-group-addon align="inline-end">
        <x-input-group-text>kg</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Block Start

Addon above input (vertical layout):

```blade
<x-input-group>
    <x-input-group-addon align="block-start">
        <x-input-group-text>Label Above</x-input-group-text>
    </x-input-group-addon>
    <x-input-group-input />
</x-input-group>
```

### Block End

Addon below input (vertical layout):

```blade
<x-input-group>
    <x-input-group-input />
    <x-input-group-addon align="block-end">
        <x-input-group-text>Helper text below</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

## Accessibility

### Labels

Always provide labels for input groups:

```blade
<x-field>
    <x-field-label for="search">Search</x-field-label>
    <x-input-group>
        <x-input-group-addon>@svg('lucide-search')</x-input-group-addon>
        <x-input-group-input id="search" />
    </x-input-group>
</x-field>
```

### ARIA Attributes

The input group has `role="group"` for semantic grouping:

```blade
<x-input-group>
    {{-- Automatically includes role="group" --}}
    <x-input-group-input aria-describedby="search-help" />
</x-input-group>
<span
    id="search-help"
    class="sr-only">
    Enter keywords to search
</span>
```

### Button Accessibility

Provide clear labels for icon-only buttons:

```blade
<x-input-group-button aria-label="Search">
    @svg('lucide-search')
</x-input-group-button>
```

## Best Practices

### Keep Addons Concise

```blade
{{-- Good: Short, clear addon --}}
<x-input-group-addon>
    <x-input-group-text>$</x-input-group-text>
</x-input-group-addon>

{{-- Avoid: Long text in addon --}}
<x-input-group-addon>
    <x-input-group-text>This is a very long prefix text</x-input-group-text>
</x-input-group-addon>
```

### Use Appropriate Alignment

```blade
{{-- Good: Inline for short addons --}}
<x-input-group>
    <x-input-group-addon>@svg('icon')</x-input-group-addon>
    <x-input-group-input />
</x-input-group>

{{-- Good: Block for longer helper text --}}
<x-input-group>
    <x-input-group-input />
    <x-input-group-addon align="block-end">
        <x-input-group-text>Character count: 150/500</x-input-group-text>
    </x-input-group-addon>
</x-input-group>
```

### Provide Context

```blade
{{-- Good: Clear context from addon --}}
<x-input-group>
    <x-input-group-addon>
        <x-input-group-text>https://</x-input-group-text>
    </x-input-group-addon>
    <x-input-group-input placeholder="example.com" />
</x-input-group>
```

## Related Components

- [Input](./input.md) - Base input component
- [Textarea](./textarea.md) - Base textarea component
- [Button](./button.md) - Button component used in groups
- [Field](./field.md) - Form field wrapper

## Common Patterns

### Search Bar

```blade
<x-input-group class="max-w-md">
    <x-input-group-addon>
        @svg('lucide-search')
    </x-input-group-addon>

    <x-input-group-input
        type="search"
        placeholder="Search..."
        wire:model.live.debounce.300ms="search" />

    <x-input-group-addon
        align="inline-end"
        x-show="$wire.search">
        <x-input-group-button wire:click="$set('search', '')">
            @svg('lucide-x')
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```

### Price Input

```blade
<x-input-group>
    <x-input-group-addon>
        <x-select
            wire:model="currency"
            class="h-6 border-0 text-sm shadow-none">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
        </x-select>
    </x-input-group-addon>

    <x-input-group-input
        type="number"
        step="0.01"
        placeholder="0.00"
        wire:model="price" />
</x-input-group>
```

### API Key Input

```blade
<x-input-group>
    <x-input-group-addon>
        @svg('lucide-key')
    </x-input-group-addon>

    <x-input-group-input
        type="text"
        readonly
        value="{{ $apiKey }}"
        class="font-mono text-xs" />

    <x-input-group-addon align="inline-end">
        <x-input-group-button wire:click="regenerateApiKey">
            @svg('lucide-refresh-cw')
            Regenerate
        </x-input-group-button>
    </x-input-group-addon>
</x-input-group>
```
