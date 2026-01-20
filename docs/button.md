# Button

The Button component provides interactive buttons with various styles, sizes, automatic loading states, and support for icons. It can render as either a `<button>` or `<a>` element.

## Overview

Buttons are used to trigger actions, submit forms, or navigate to different pages. The Mog button component automatically integrates with Livewire to show loading indicators during asynchronous operations, supports multiple visual variants, and handles both button and link semantics.

### Button vs Link

- **Button element** (default): Use for actions that trigger behavior (submit forms, open modals, etc.)
- **Link element** (`asLink` prop): Use for navigation to other pages or sections

## Props

### `variant`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'destructive'`, `'outline'`, `'secondary'`, `'ghost'`, `'link'`

Controls the visual style of the button.

- **`default`**: Primary button with solid background
- **`destructive`**: Red-themed button for dangerous actions
- **`outline`**: Button with border and transparent background
- **`secondary`**: Muted button style for secondary actions
- **`ghost`**: Minimal button with no background
- **`link`**: Styled as a text link with underline on hover

### `size`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'sm'`, `'lg'`, `'icon'`, `'icon-sm'`, `'icon-lg'`

Controls the size of the button.

- **`default`**: Standard button height (h-9)
- **`sm`**: Small button (h-8)
- **`lg`**: Large button (h-10)
- **`icon`**: Square button for icons (size-9)
- **`icon-sm`**: Small square button (size-8)
- **`icon-lg`**: Large square button (size-10)

### `asLink`

**Type:** `boolean`
**Default:** `false`

When `true`, renders the button as an `<a>` tag instead of a `<button>` tag. Use this for navigation links that should look like buttons.

## Features

### Automatic Loading Indicators

The button automatically shows a loading spinner when:

- It has a `wire:click` attribute (Livewire action)
- It has a `wire:target` attribute
- It's a submit button (`type="submit"`) and is disabled

**Note:** Buttons with `wire:click="$js.methodName"` (JavaScript methods) do not show loading indicators automatically.

### Icon Support

Icons are automatically sized and styled when placed inside a button:

- Icons are set to `size-4` by default
- Icons shrink-0 and are pointer-events-none
- Button padding adjusts when icons are present

### State Management

- **Focus states**: Visible focus ring with keyboard navigation
- **Disabled states**: Reduced opacity and pointer events disabled
- **Error states**: Can be marked invalid with `aria-invalid` attribute
- **Loading states**: Controlled via `data-loading` attribute

## Usage Examples

### Basic Button

```blade
<x-button>Click me</x-button>
```

### All Variants

```blade
{{-- Default / Primary --}}
<x-button variant="default">Primary</x-button>

{{-- Destructive --}}
<x-button variant="destructive">Delete</x-button>

{{-- Outline --}}
<x-button variant="outline">Outline</x-button>

{{-- Secondary --}}
<x-button variant="secondary">Secondary</x-button>

{{-- Ghost --}}
<x-button variant="ghost">Ghost</x-button>

{{-- Link --}}
<x-button variant="link">Link Style</x-button>
```

### All Sizes

```blade
{{-- Small --}}
<x-button size="sm">Small</x-button>

{{-- Default --}}
<x-button>Default</x-button>

{{-- Large --}}
<x-button size="lg">Large</x-button>
```

### Icon-Only Buttons

```blade
{{-- Default icon size --}}
<x-button size="icon">
    @svg('mog-search')
</x-button>

{{-- Small icon button --}}
<x-button size="icon-sm">
    @svg('mog-plus')
</x-button>

{{-- Large icon button --}}
<x-button size="icon-lg">
    @svg('mog-settings')
</x-button>
```

### Buttons with Icons and Text

```blade
{{-- Icon before text --}}
<x-button>
    @svg('mog-download')
    Download
</x-button>

{{-- Icon after text --}}
<x-button>
    Continue
    @svg('mog-arrow-right')
</x-button>

{{-- Icons on both sides --}}
<x-button>
    @svg('mog-mail')
    Send Email
    @svg('mog-send')
</x-button>
```

### Loading States with Livewire

```blade
{{-- Automatic loading indicator --}}
<x-button wire:click="save">Save Changes</x-button>

{{-- With specific target --}}
<x-button
    wire:click="deleteUser"
    wire:target="deleteUser">
    Delete User
</x-button>

{{-- Multiple actions, one indicator --}}
<x-button
    wire:click="process"
    wire:target="process,validate">
    Process
</x-button>
```

### Submit Buttons with Auto-Loading

```blade
<form wire:submit="createAccount">
    <x-field-group>
        <x-field>
            <x-field-label>Email</x-field-label>
            <x-input
                type="email"
                wire:model="email" />
        </x-field>

        {{-- Shows loading indicator when form is submitting --}}
        <x-button type="submit">Create Account</x-button>
    </x-field-group>
</form>
```

### Button as Link

```blade
{{-- Navigation link styled as button --}}
<x-button
    asLink
    href="/dashboard">
    Go to Dashboard
</x-button>

{{-- External link --}}
<x-button
    asLink
    href="https://example.com"
    target="_blank">
    Visit Website
    @svg('mog-external-link')
</x-button>

{{-- Link with variant --}}
<x-button
    asLink
    href="/settings"
    variant="outline">
    Settings
</x-button>
```

### Disabled Buttons

```blade
{{-- Static disabled --}}
<x-button disabled>Disabled Button</x-button>

{{-- Conditionally disabled with Livewire --}}
<x-button :disabled="$form->isEmpty()">Submit</x-button>

{{-- Disabled with explanation --}}
<x-button disabled>
    @svg('mog-lock')
    Locked Feature
</x-button>
```

### Advanced Examples

```blade
{{-- Destructive action with confirmation --}}
<x-button
    variant="destructive"
    wire:click="deleteAccount"
    wire:confirm="Are you sure you want to delete your account? This action cannot be undone.">
    @svg('mog-trash')
    Delete Account
</x-button>

{{-- Button with custom classes --}}
<x-button class="w-full">Full Width Button</x-button>

{{-- Button with invalid state --}}
<x-button aria-invalid="true">Error State</x-button>

{{-- Button group of actions --}}
<div class="flex gap-2">
    <x-button variant="outline">Cancel</x-button>
    <x-button wire:click="save">Save</x-button>
</div>
```

## Accessibility

### Keyboard Navigation

- Buttons are keyboard accessible via `Tab` key
- Can be activated with `Enter` or `Space`
- Focus states are clearly visible with focus rings

### ARIA Attributes

```blade
{{-- Invalid state --}}
<x-button aria-invalid="true">Error</x-button>

{{-- With description --}}
<x-button aria-describedby="save-help">Save</x-button>
<span
    id="save-help"
    class="sr-only">
    Saves your changes to the server
</span>

{{-- Expanded state for toggles --}}
<x-button
    aria-expanded="false"
    wire:click="toggleMenu">
    Menu
</x-button>
```

### Disabled Buttons

```blade
{{-- Screen readers will announce as disabled --}}
<x-button disabled>Cannot Click</x-button>

{{--
    If button is visually disabled but clickable,
    use aria-disabled instead
--}}
<x-button
    aria-disabled="true"
    wire:click="showUpgradeModal">
    Premium Feature
</x-button>
```

## Best Practices

### When to Use Each Variant

- **`default`**: Primary actions (submit forms, confirm dialogs)
- **`destructive`**: Dangerous actions (delete, remove, cancel subscriptions)
- **`outline`**: Secondary actions, alternative options
- **`secondary`**: Tertiary actions, less important actions
- **`ghost`**: Minimal prominence, toolbar buttons, table actions
- **`link`**: Navigation that should look like text links

### Button Sizing

- Use **`sm`** for compact UIs, toolbars, or tight spaces
- Use **`default`** for most use cases
- Use **`lg`** for prominent calls-to-action or hero sections
- Use **`icon`** sizes for icon-only buttons to maintain square aspect ratio

### Loading States

The component automatically handles loading states, but you can control them manually:

```blade
{{-- Manual loading control --}}
<x-button data-loading="true">Processing...</x-button>

{{-- Disable auto-loading for $js methods --}}
<x-button wire:click="$js.console.log('No loading indicator')">JS Method</x-button>
```

### Icon Usage

```blade
{{-- Good: Icon with text --}}
<x-button>
    @svg('mog-save')
    Save
</x-button>

{{-- Good: Icon-only with appropriate size --}}
<x-button
    size="icon"
    aria-label="Search">
    @svg('mog-search')
</x-button>

{{-- Avoid: Icon-only without aria-label --}}
<x-button size="icon">
    @svg('mog-settings')
</x-button>
```

Always provide `aria-label` for icon-only buttons to ensure screen reader users understand the button's purpose.

## Technical Details

### Loading Indicator

The loading indicator is shown/hidden using CSS transitions:

- Loading indicator uses `mog-loader-2` icon
- Positioned absolutely in the center of the button
- Button content fades to opacity-0 while loading
- Uses `wire:loading.attr="data-loading"` for automatic state management

### Icon Sizing

Icons are automatically sized based on button size:

```blade
{{-- Default/sm buttons: size-4 icons --}}
<x-button>@svg('icon')</x-button>

{{-- lg buttons: size-5 icons --}}
<x-button size="lg">@svg('icon')</x-button>
```

### Class Merging

The button uses `cn()` helper for intelligent class merging:

```blade
<x-button class="mt-4 w-full">
    {{-- Custom classes are merged with base classes --}}
</x-button>
```

### Dark Mode

All button variants include dark mode color adjustments:

```blade
{{-- Dark mode automatically applied --}}
<x-button variant="destructive">Delete</x-button>
```

## Related Components

- [Button Group](./button-group.md) - Group multiple buttons together
- [Field](./field.md) - Form field layouts with buttons
- [Input Group](./input-group.md) - Input controls with button addons

## Common Patterns

### Form Actions

```blade
<div class="flex justify-end gap-2">
    <x-button
        variant="outline"
        type="button"
        wire:click="cancel">
        Cancel
    </x-button>
    <x-button type="submit">Save Changes</x-button>
</div>
```

### Confirmation Dialogs

```blade
<div class="flex gap-2">
    <x-button
        variant="outline"
        wire:click="$set('showDialog', false)">
        No, Cancel
    </x-button>
    <x-button
        variant="destructive"
        wire:click="confirmDelete">
        Yes, Delete
    </x-button>
</div>
```

### Action Bars

```blade
<div class="flex items-center justify-between">
    <x-button
        variant="ghost"
        size="icon">
        @svg('mog-arrow-left')
    </x-button>

    <div class="flex gap-2">
        <x-button
            variant="ghost"
            size="icon">
            @svg('mog-share')
        </x-button>
        <x-button
            variant="ghost"
            size="icon">
            @svg('mog-heart')
        </x-button>
        <x-button
            variant="ghost"
            size="icon">
            @svg('mog-more-vertical')
        </x-button>
    </div>
</div>
```
