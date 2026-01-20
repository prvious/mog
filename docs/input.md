# Input & Textarea

Text input components for collecting user input in forms. The Mog library provides both single-line (`<x-input>`) and multi-line (`<x-textarea>`) input controls with consistent styling and behavior.

## Overview

Input and textarea components are the foundation of form data collection. They support various input types, automatic error state detection with Livewire, multiple sizes, and full accessibility features.

### When to Use

- **`<x-input>`**: For single-line text entry (text, email, password, number, tel, url, search, date, etc.)
- **`<x-textarea>`**: For multi-line text entry (comments, descriptions, messages, etc.)

## Input Component

### Props

- `invalid` (boolean, default: `false`): Manually set error state
- `autoWireInvalid` (boolean, default: `true`): Automatically detect errors from Livewire model
- `size` (string, default: `'md'`): Input size variant
    - `'xs'`: Extra small (px-2, py-0.5)
    - `'sm'`: Small (px-2.5, py-1)
    - `'md'`: Medium/default (px-3, py-1.5)
    - `'xl'`: Extra large (px-3.5, py-2)
- `type` (string, default: `'text'`): HTML input type

### Features

- **Auto error detection**: When `wire:model` is present and `autoWireInvalid` is true, automatically applies error styling
- **Multiple sizes**: Four size variants for different UI densities
- **File input styling**: Special styling for `type="file"` inputs
- **Focus states**: Clear focus indicators with ring and border color
- **Read-only support**: Proper styling for read-only inputs
- **Dark mode**: Optimized colors for dark backgrounds

### Usage Examples

#### Basic Input

```blade
<x-input
    type="text"
    name="username"
    placeholder="Enter username" />
```

#### With Field Wrapper

```blade
<x-field>
    <x-field-label>Email Address</x-field-label>
    <x-input
        type="email"
        name="email"
        placeholder="you@example.com" />
</x-field>
```

#### Error States

```blade
{{-- Manual error state --}}
<x-input
    type="text"
    name="username"
    :invalid="true" />

{{-- Auto-detect errors with Livewire --}}
<x-input
    type="email"
    wire:model="email" />
{{-- If $errors->has('email'), invalid styling is applied automatically --}}

{{-- Disable auto error detection --}}
<x-input
    type="text"
    wire:model="name"
    :autoWireInvalid="false" />
```

#### Different Sizes

```blade
{{-- Extra small --}}
<x-input
    size="xs"
    placeholder="Extra small" />

{{-- Small --}}
<x-input
    size="sm"
    placeholder="Small" />

{{-- Medium (default) --}}
<x-input placeholder="Medium" />

{{-- Extra large --}}
<x-input
    size="xl"
    placeholder="Extra large" />
```

#### Input Types

```blade
{{-- Email --}}
<x-input
    type="email"
    placeholder="email@example.com" />

{{-- Password --}}
<x-input
    type="password"
    placeholder="Password" />

{{-- Number --}}
<x-input
    type="number"
    min="0"
    max="100"
    step="1" />

{{-- Tel --}}
<x-input
    type="tel"
    placeholder="(555) 555-5555" />

{{-- URL --}}
<x-input
    type="url"
    placeholder="https://example.com" />

{{-- Search --}}
<x-input
    type="search"
    placeholder="Search..." />

{{-- Date --}}
<x-input type="date" />

{{-- Time --}}
<x-input type="time" />

{{-- Color --}}
<x-input type="color" />
```

#### File Input

```blade
<x-input type="file" />

{{-- Multiple files --}}
<x-input
    type="file"
    multiple />

{{-- Specific file types --}}
<x-input
    type="file"
    accept="image/*" />
```

#### Disabled and Read-only States

```blade
{{-- Disabled --}}
<x-input
    disabled
    placeholder="Disabled input" />

{{-- Read-only --}}
<x-input
    readonly
    value="Read-only value" />
```

#### With Livewire Binding

```blade
<x-input
    type="text"
    wire:model="name"
    placeholder="Your name" />

{{-- Live binding --}}
<x-input
    type="text"
    wire:model.live="search"
    placeholder="Search..." />

{{-- Debounced binding --}}
<x-input
    type="text"
    wire:model.live.debounce.500ms="query"
    placeholder="Type to search..." />
```

#### Complete Form Example

```blade
<x-field-group>
    <x-field>
        <x-field-label>Full Name</x-field-label>
        <x-input
            type="text"
            name="name"
            wire:model="name"
            required />
        <x-field-error key="name" />
    </x-field>

    <x-field>
        <x-field-label>Email</x-field-label>
        <x-field-content>
            <x-input
                type="email"
                name="email"
                wire:model="email"
                required />
            <x-field-description>We'll never share your email.</x-field-description>
            <x-field-error key="email" />
        </x-field-content>
    </x-field>

    <x-field>
        <x-field-label>Password</x-field-label>
        <x-input
            type="password"
            name="password"
            wire:model="password"
            required />
        <x-field-error key="password" />
    </x-field>
</x-field-group>
```

## Textarea Component

### Props

The textarea component accepts all standard `<textarea>` attributes.

### Features

- **Auto-sizing**: Uses `field-sizing: content` for automatic height adjustment
- **Minimum height**: Set to `min-h-16` by default
- **Consistent styling**: Matches input component styling
- **Error states**: Supports `aria-invalid` for error styling
- **Dark mode**: Optimized colors for dark backgrounds

### Usage Examples

#### Basic Textarea

```blade
<x-textarea
    name="message"
    placeholder="Enter your message..."></x-textarea>
```

#### With Field Wrapper

```blade
<x-field>
    <x-field-label>Comments</x-field-label>
    <x-textarea
        name="comments"
        placeholder="Share your thoughts..."></x-textarea>
</x-field>
```

#### With Livewire

```blade
<x-textarea
    wire:model="description"
    placeholder="Describe your project..."></x-textarea>
```

#### With Error State

```blade
<x-field>
    <x-field-label>Message</x-field-label>
    <x-textarea
        wire:model="message"
        aria-invalid="{{ $errors->has('message') }}"></x-textarea>
    <x-field-error key="message" />
</x-field>
```

#### With Character Count

```blade
<x-field>
    <x-field-label>Bio</x-field-label>
    <x-field-content>
        <x-textarea
            wire:model.live="bio"
            maxlength="500"></x-textarea>
        <x-field-description>{{ strlen($bio ?? '') }}/500 characters</x-field-description>
    </x-field-content>
</x-field>
```

#### Custom Height

```blade
{{-- Fixed height --}}
<x-textarea class="min-h-32"></x-textarea>

{{-- Larger minimum height --}}
<x-textarea class="min-h-48"></x-textarea>
```

#### Disabled State

```blade
<x-textarea disabled>This content cannot be edited</x-textarea>
```

## Accessibility

### Keyboard Navigation

Both input and textarea components are fully keyboard accessible:

- `Tab`: Move focus to/from the field
- `Shift + Tab`: Move focus backward
- Standard text editing shortcuts work as expected

### ARIA Attributes

```blade
{{-- Required field --}}
<x-input
    type="text"
    name="username"
    required
    aria-required="true" />

{{-- Invalid field --}}
<x-input
    type="email"
    name="email"
    aria-invalid="true"
    aria-describedby="email-error" />
<span
    id="email-error"
    class="text-destructive text-sm">
    Invalid email address
</span>

{{-- With description --}}
<x-input
    type="password"
    name="password"
    aria-describedby="password-help" />
<span
    id="password-help"
    class="text-muted-foreground text-sm">
    Must be at least 8 characters
</span>
```

### Labels

Always use proper labels for accessibility:

```blade
{{-- Good: With field-label component --}}
<x-field>
    <x-field-label>Username</x-field-label>
    <x-input name="username" />
</x-field>

{{-- Good: With native label and ID --}}
<label for="email">Email</label>
<x-input
    id="email"
    type="email"
    name="email" />

{{-- Avoid: No label --}}
<x-input placeholder="Enter email" />
```

## Best Practices

### Input Types

Use the correct input `type` for better UX:

```blade
{{-- Email inputs show email keyboard on mobile --}}
<x-input type="email" />

{{-- Tel inputs show phone keyboard --}}
<x-input type="tel" />

{{-- Number inputs allow increment/decrement --}}
<x-input type="number" />

{{-- URL inputs validate URL format --}}
<x-input type="url" />
```

### Placeholders

Use placeholders for examples, not labels:

```blade
{{-- Good: Label + helpful placeholder --}}
<x-field>
    <x-field-label>Email</x-field-label>
    <x-input
        type="email"
        placeholder="you@example.com" />
</x-field>

{{-- Avoid: Placeholder as label --}}
<x-input placeholder="Email" />
```

### Error Handling

Provide clear error messages:

```blade
<x-field
    @error('email')
    data-invalid="true"
    @enderror>
    <x-field-label>Email</x-field-label>
    <x-input
        type="email"
        wire:model="email"
        @error('email')
        aria-invalid="true"
        @enderror />
    <x-field-error key="email" />
</x-field>
```

### Sizing

Choose appropriate sizes for your UI:

```blade
{{-- Compact UI, dense forms --}}
<x-input size="xs" />

{{-- Tables, inline editing --}}
<x-input size="sm" />

{{-- Standard forms --}}
<x-input />

{{-- Prominent forms, CTAs --}}
<x-input size="xl" />
```

### Required Fields

Mark required fields clearly:

```blade
<x-field>
    <x-field-label>
        Email
        <span class="text-destructive">*</span>
    </x-field-label>
    <x-input
        type="email"
        required />
</x-field>
```

## Technical Details

### Auto Error Detection

The input component automatically detects errors when used with Livewire:

```php
if ($attributes->has('wire:model') && $autoWireInvalid) {
    $invalid = $errors->has($attributes->get('wire:model'));
}
```

This means you don't need to manually set error states:

```blade
{{-- Auto-detects if $errors->has('email') --}}
<x-input wire:model="email" />

{{-- Equivalent to: --}}
<x-input
    wire:model="email"
    :invalid="$errors->has('email')" />
```

### Focus States

Both components use consistent focus styling:

```css
focus-visible:border-ring
focus-visible:ring-ring/50
focus-visible:ring-[3px]
```

### Error States

Error styling is applied via `aria-invalid`:

```css
aria-invalid:ring-destructive/20
dark:aria-invalid:ring-destructive/40
aria-invalid:border-destructive
```

### File Input Styling

File inputs have special button styling:

```css
file:inline-flex
file:h-7
file:border-0
file:bg-transparent
file:text-sm
file:font-medium
```

### Dark Mode

Both components include dark mode variants:

```css
dark: bg-input/30;
```

## Related Components

- [Field](./field.md) - Form field layout components
- [Input Group](./input-group.md) - Composite input controls with addons
- [Select](./select.md) - Dropdown select component
- [Checkbox](./checkbox.md) - Checkbox, switch, and toggle
- [Button](./button.md) - Form submit buttons

## Common Patterns

### Search Input

```blade
<x-input
    type="search"
    wire:model.live.debounce.300ms="search"
    placeholder="Search..." />
```

### Password with Toggle

```blade
<x-field>
    <x-field-label>Password</x-field-label>
    <x-input-group>
        <x-input-group-input
            :type="$showPassword ? 'text' : 'password'"
            wire:model="password" />
        <x-input-group-button
            wire:click="$toggle('showPassword')"
            variant="outline">
            @svg($showPassword ? 'mog-eye-off' : 'mog-eye')
        </x-input-group-button>
    </x-input-group>
</x-field>
```

### Email with Validation

```blade
<x-field>
    <x-field-label>Email</x-field-label>
    <x-input
        type="email"
        wire:model.blur="email"
        required />
    <x-field-description>We'll send a confirmation email</x-field-description>
    <x-field-error key="email" />
</x-field>
```

### Textarea with Preview

```blade
<div class="grid gap-4">
    <x-field>
        <x-field-label>Markdown Content</x-field-label>
        <x-textarea
            wire:model.live.debounce.500ms="content"
            class="font-mono"></x-textarea>
    </x-field>

    <div class="prose">
        {!! Str::markdown($content ?? '') !!}
    </div>
</div>
```
