# Field Components

Field components provide flexible form layout containers for building accessible and well-structured forms with proper label-input associations, error messaging, help text, and flexible orientations.

## Overview

The Field component family helps you create accessible forms by providing semantic structure and proper associations between labels, inputs, descriptions, and error messages. These components work together to ensure your forms are usable by everyone, including users of assistive technologies.

### When to use Field vs Fieldset

- **`<x-field>`**: Use for single form controls (text input, checkbox, select, etc.)
- **`<x-fieldset>`**: Use for grouping related form controls (radio groups, checkbox groups, or logically related inputs)

### Accessibility Features

- Proper semantic HTML structure with `role` attributes
- Automatic label-input associations
- Error state propagation via `data-invalid` attribute
- Support for accessible descriptions and error messages
- Keyboard navigation support
- Screen reader friendly markup

## Components

### `<x-field>`

The main wrapper component for form fields. Provides flexible orientation options and manages field state.

**Props:**

- `orientation` (string, default: `'vertical'`): Layout orientation
    - `'vertical'`: Stack label and control vertically
    - `'horizontal'`: Place label and control side by side
    - `'responsive'`: Vertical on mobile, horizontal on larger screens

**Attributes:**

- Accepts all standard HTML attributes
- `data-invalid`: Set to `"true"` to indicate error state
- `data-disabled`: Set to `"true"` to indicate disabled state

**Example:**

```blade
<x-field>
    <x-field-label>Email</x-field-label>
    <x-input
        type="email"
        name="email" />
</x-field>
```

---

### `<x-field-label>`

Label component for form fields. Wraps the base `<x-label>` component with field-specific styling.

**Props:**

- None (inherits from `<x-label>`)

**Features:**

- Automatically styled for vertical/horizontal layouts
- Supports nested field components (for checkbox/radio labels)
- Respects disabled and checked states

**Example:**

```blade
<x-field-label>
    Username
    <x-badge variant="outline">Required</x-badge>
</x-field-label>
```

---

### `<x-field-error>`

Displays validation error messages. Wraps the base `<x-error>` component.

**Props:**

- `key` (string, required): The field name to display errors for
- `multiple` (boolean, default: `true`): Show all errors or just the first
- `bag` (string, default: `'default'`): Error bag name

**Features:**

- Displays errors from Laravel validation
- Shows as bulleted list for multiple errors
- Automatically hidden when no errors exist

**Example:**

```blade
<x-field-error key="email" />
```

---

### `<x-field-description>`

Help text or description for a field.

**Props:**

- None

**Features:**

- Styled as muted secondary text
- Supports links with hover states
- Automatically balanced text in horizontal layouts

**Example:**

```blade
<x-field-description>We'll never share your email with anyone else.</x-field-description>
```

---

### `<x-field-legend>`

Legend element for fieldsets.

**Props:**

- `variant` (string, default: `'legend'`): Display style
    - `'legend'`: Base-sized text (default)
    - `'label'`: Small text like field labels

**Example:**

```blade
<x-field-legend>Contact Information</x-field-legend>
```

---

### `<x-field-group>`

Container for grouping multiple fields together.

**Props:**

- None

**Features:**

- Container query support for responsive layouts
- Automatic spacing between fields
- Reduced spacing for checkbox/radio groups

**Example:**

```blade
<x-field-group>
    <x-field>...</x-field>
    <x-field>...</x-field>
</x-field-group>
```

---

### `<x-field-content>`

Wrapper for the main content area of a field (typically the input control).

**Props:**

- None

**Features:**

- Flexbox layout with consistent spacing
- Stacks children vertically

**Example:**

```blade
<x-field-content>
    <x-input
        type="text"
        name="name" />
    <x-field-description>Enter your full name</x-field-description>
</x-field-content>
```

---

### `<x-field-separator>`

Visual separator between field groups.

**Props:**

- None (slot content is optional)

**Features:**

- Renders a horizontal line
- Optional text label in the center

**Example:**

```blade
<x-field-separator>Additional Information</x-field-separator>
```

---

### `<x-field-title>`

Title for a field or field group (non-semantic alternative to legend).

**Props:**

- None

**Example:**

```blade
<x-field-title>Shipping Address</x-field-title>
```

---

### `<x-fieldset>`

Fieldset element for grouping related form controls.

**Props:**

- None

**Features:**

- Reduced spacing for checkbox/radio groups
- Semantic grouping for accessibility

**Example:**

```blade
<x-fieldset>
    <x-field-legend>Notification Preferences</x-field-legend>
    <x-field>...</x-field>
    <x-field>...</x-field>
</x-fieldset>
```

## Usage Examples

### Basic Field with Label and Input

```blade
<x-field>
    <x-field-label>Full Name</x-field-label>
    <x-input
        type="text"
        name="name" />
</x-field>
```

### Field with Error State

```blade
<x-field data-invalid="true">
    <x-field-label>Email Address</x-field-label>
    <x-input
        type="email"
        name="email"
        aria-invalid="true" />
    <x-field-error key="email" />
</x-field>
```

### Field with Description

```blade
<x-field>
    <x-field-label>Password</x-field-label>
    <x-field-content>
        <x-input
            type="password"
            name="password" />
        <x-field-description>Must be at least 8 characters long.</x-field-description>
    </x-field-content>
</x-field>
```

### Horizontal Orientation

```blade
<x-field orientation="horizontal">
    <x-field-label>Subscribe to newsletter</x-field-label>
    <x-checkbox name="newsletter" />
</x-field>
```

### Responsive Orientation

```blade
<x-field orientation="responsive">
    <x-field-label>Country</x-field-label>
    <x-select name="country">
        <option>United States</option>
        <option>Canada</option>
        <option>Mexico</option>
    </x-select>
</x-field>
```

### Fieldset with Multiple Inputs

```blade
<x-fieldset>
    <x-field-legend>Shipping Address</x-field-legend>

    <x-field-group>
        <x-field>
            <x-field-label>Street Address</x-field-label>
            <x-input
                type="text"
                name="address_line1" />
        </x-field>

        <x-field>
            <x-field-label>City</x-field-label>
            <x-input
                type="text"
                name="city" />
        </x-field>

        <x-field>
            <x-field-label>State</x-field-label>
            <x-select name="state">
                <option>California</option>
                <option>New York</option>
            </x-select>
        </x-field>

        <x-field>
            <x-field-label>ZIP Code</x-field-label>
            <x-input
                type="text"
                name="zip" />
        </x-field>
    </x-field-group>
</x-fieldset>
```

### Complex Nested Field Groups

```blade
<x-field-group>
    <x-field-title>Account Settings</x-field-title>

    <x-field>
        <x-field-label>Email</x-field-label>
        <x-field-content>
            <x-input
                type="email"
                name="email"
                wire:model="email" />
            <x-field-description>We'll send verification emails here.</x-field-description>
            <x-field-error key="email" />
        </x-field-content>
    </x-field>

    <x-field-separator>Security</x-field-separator>

    <x-field>
        <x-field-label>Two-Factor Authentication</x-field-label>
        <x-field-content>
            <x-switch name="two_factor" />
            <x-field-description>Add an extra layer of security to your account.</x-field-description>
        </x-field-content>
    </x-field>
</x-field-group>
```

### Radio Group with Fieldset

```blade
<x-fieldset>
    <x-field-legend>Delivery Method</x-field-legend>

    <x-radio-group name="delivery">
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="standard" />
                Standard Delivery
            </x-field-label>
            <x-field-description>5-7 business days</x-field-description>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="express" />
                Express Delivery
            </x-field-label>
            <x-field-description>2-3 business days</x-field-description>
        </x-field>
    </x-radio-group>
</x-fieldset>
```

## Best Practices

### Accessibility Guidelines

1. **Always use labels**: Every form control should have an associated label for screen readers
2. **Use fieldsets for groups**: Group related controls (like radio buttons) in a fieldset with a legend
3. **Provide helpful descriptions**: Use `<x-field-description>` to give context about what's expected
4. **Show clear errors**: Use `<x-field-error>` to display validation errors inline
5. **Mark required fields**: Use `<x-badge>` or text indicators in labels for required fields
6. **Use semantic HTML**: The components generate proper HTML5 form elements with ARIA attributes

### Error Handling Patterns

```blade
{{-- With Livewire --}}
<x-field
    @error('username')
    data-invalid="true"
    @enderror>
    <x-field-label>Username</x-field-label>
    <x-input
        type="text"
        name="username"
        wire:model="username"
        @error('username')
        aria-invalid="true"
        @enderror />
    <x-field-error key="username" />
</x-field>

{{-- With standard Laravel forms --}}
<x-field
    @if ($errors->has('email'))
    data-invalid="true"
    @endif>
    <x-field-label>Email</x-field-label>
    <x-input
        type="email"
        name="email"
        value="{{ old('email') }}"
        @if ($errors->has('email'))
        aria-invalid="true"
        @endif />
    <x-field-error key="email" />
</x-field>
```

### Layout Recommendations

**Vertical Layout (Default)**: Best for most forms, especially on mobile

```blade
<x-field>
    <x-field-label>Name</x-field-label>
    <x-input
        type="text"
        name="name" />
</x-field>
```

**Horizontal Layout**: Good for simple forms, settings pages, or when space is limited

```blade
<x-field orientation="horizontal">
    <x-field-label>Notifications</x-field-label>
    <x-switch name="notifications" />
</x-field>
```

**Responsive Layout**: Vertical on mobile, horizontal on desktop

```blade
<x-field orientation="responsive">
    <x-field-label>Marketing Emails</x-field-label>
    <x-checkbox name="marketing" />
</x-field>
```

### Grouping Fields

Use `<x-field-group>` to create consistent spacing:

```blade
<x-field-group>
    <x-field>...</x-field>
    <x-field>...</x-field>
    <x-field>...</x-field>
</x-field-group>
```

Use `<x-field-separator>` to create visual sections:

```blade
<x-field-group>
    <x-field>...</x-field>
    <x-field-separator>Advanced Options</x-field-separator>
    <x-field>...</x-field>
</x-field-group>
```

## Related Components

- [Input](./input.md) - Text input and textarea controls
- [Checkbox](./checkbox.md) - Checkbox, switch, and toggle components
- [Select](./select.md) - Select dropdown component
- [Radio Group](./radio-group.md) - Radio button groups
- [Button](./button.md) - Submit and action buttons
- [Input Group](./input-group.md) - Composite input controls

## Technical Notes

### Data Attributes

- `data-slot`: Used for CSS targeting and styling hooks
- `data-invalid`: Controls error state styling
- `data-disabled`: Controls disabled state styling
- `data-orientation`: Reflects the current orientation setting

### Orientation Behavior

The `orientation` prop on `<x-field>` controls layout:

- **`vertical`**: Standard stacked layout with full-width children
- **`horizontal`**: Side-by-side layout with items centered
- **`responsive`**: Uses Tailwind container queries (`@md/field-group`) to switch from vertical to horizontal at medium breakpoints

### Tailwind Merge

All components use the `cn()` helper from `tailwind-merge-php` for intelligent class merging. You can pass additional Tailwind classes that will be merged properly:

```blade
<x-field class="mb-8">
    {{-- Custom margin will be merged with default classes --}}
</x-field>
```

### Livewire Integration

Field components work seamlessly with Livewire:

```blade
<x-field
    @error('name')
    data-invalid="true"
    @enderror>
    <x-field-label>Name</x-field-label>
    <x-input wire:model.live="name" />
    <x-field-error key="name" />
</x-field>
```

Error messages automatically update when validation runs, and the `data-invalid` state toggles styling.
