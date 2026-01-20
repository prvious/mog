# Label

The Label component creates accessible form labels with consistent styling and automatic integration with form field components. It provides semantic HTML with proper styling for both light and dark themes, including disabled states.

## Overview

Labels are essential for form accessibility, providing descriptive text for form controls. The Label component ensures consistent typography, proper spacing, and accessibility features like peer-disabled states for form fields.

### When to Use

- **Form fields**: Label all input elements
- **Checkboxes**: Describe checkbox options
- **Radio buttons**: Label radio button choices
- **Toggle switches**: Provide context for switches
- **Select dropdowns**: Label select menus
- **Text areas**: Describe text input areas
- **Required fields**: Indicate mandatory fields

## Props

The Label component accepts all standard HTML label attributes:

- **`for`**: ID of the associated form control
- **`id`**: Unique identifier for the label
- **`class`**: Additional CSS classes (merged with defaults)

## Features

### Semantic Markup

Uses proper `<label>` element:

- Improves accessibility for screen readers
- Enables click-to-focus behavior
- Associates labels with form controls
- Follows HTML5 standards

### Peer-Disabled State

Automatic disabled styling:

- `peer-disabled:cursor-not-allowed` prevents interaction
- `peer-disabled:opacity-70` reduces visual emphasis
- Works with `:disabled` state on peer input elements

### Consistent Typography

Standardized text styling:

- `text-sm` for appropriate size
- `font-medium` for emphasis
- `leading-none` for tight spacing
- Theme-aware colors

### Theme Support

Works in light and dark modes:

- Inherits theme colors automatically
- Maintains readability in both modes
- No manual color adjustments needed

## Usage Examples

### Basic Label

```blade
<x-label for="email">Email Address</x-label>
<x-input
    id="email"
    type="email" />
```

### With Field Component

```blade
<x-field>
    <x-label>Username</x-label>
    <x-input wire:model="username" />
</x-field>
```

### Required Field Indicator

```blade
<x-label for="password">
    Password
    <span class="text-destructive">*</span>
</x-label>
<x-input
    id="password"
    type="password"
    required />
```

### With Field Description

```blade
<x-field>
    <x-label>Display Name</x-label>
    <x-input wire:model="displayName" />
    <x-field-description>This name will be visible to other users</x-field-description>
</x-field>
```

### Checkbox Label

```blade
<div class="flex items-center gap-2">
    <x-checkbox
        id="terms"
        wire:model="agreedToTerms" />
    <x-label for="terms">I agree to the terms and conditions</x-label>
</div>
```

### Radio Group Labels

```blade
<x-field>
    <x-label>Notification Preferences</x-label>

    <x-radio-group wire:model="notificationPreference">
        <x-radio-group-item
            value="all"
            id="notify-all">
            <x-label for="notify-all">All notifications</x-label>
        </x-radio-group-item>

        <x-radio-group-item
            value="important"
            id="notify-important">
            <x-label for="notify-important">Important only</x-label>
        </x-radio-group-item>

        <x-radio-group-item
            value="none"
            id="notify-none">
            <x-label for="notify-none">No notifications</x-label>
        </x-radio-group-item>
    </x-radio-group>
</x-field>
```

### Switch with Label

```blade
<div class="flex items-center justify-between">
    <div class="space-y-0.5">
        <x-label for="dark-mode">Dark Mode</x-label>
        <p class="text-muted-foreground text-sm">Enable dark theme across the application</p>
    </div>
    <x-switch
        id="dark-mode"
        wire:model="darkModeEnabled" />
</div>
```

### Form with Multiple Fields

```blade
<form class="space-y-6">
    <x-field>
        <x-label>Full Name</x-label>
        <x-input
            wire:model="name"
            placeholder="Enter your full name" />
        <x-field-error />
    </x-field>

    <x-field>
        <x-label>Email Address</x-label>
        <x-input
            wire:model="email"
            type="email"
            placeholder="you@example.com" />
        <x-field-error />
    </x-field>

    <x-field>
        <x-label>Phone Number</x-label>
        <x-input
            wire:model="phone"
            type="tel"
            placeholder="+1 (555) 000-0000" />
        <x-field-description>Include country code for international numbers</x-field-description>
        <x-field-error />
    </x-field>

    <x-field>
        <x-label>Message</x-label>
        <x-textarea
            wire:model="message"
            rows="4"
            placeholder="Enter your message..." />
        <x-field-error />
    </x-field>

    <x-button type="submit">Submit</x-button>
</form>
```

### Select with Label

```blade
<x-field>
    <x-label>Country</x-label>
    <x-select wire:model="country">
        <x-slot:trigger>
            <x-slot:label>Select your country</x-slot:label>
        </x-slot:trigger>
        <x-slot:content>
            <x-select-item value="us">United States</x-select-item>
            <x-select-item value="uk">United Kingdom</x-select-item>
            <x-select-item value="ca">Canada</x-select-item>
            <x-select-item value="au">Australia</x-select-item>
        </x-slot:content>
    </x-select>
</x-field>
```

### Disabled Field with Label

```blade
<x-field>
    <x-label>Account ID</x-label>
    <x-input
        value="{{ $user->account_id }}"
        disabled />
    <x-field-description>Account ID cannot be changed</x-field-description>
</x-field>
```

### Fieldset with Legend

```blade
<x-fieldset>
    <x-field-legend>Personal Information</x-field-legend>

    <div class="grid gap-4 sm:grid-cols-2">
        <x-field>
            <x-label>First Name</x-label>
            <x-input wire:model="firstName" />
        </x-field>

        <x-field>
            <x-label>Last Name</x-label>
            <x-input wire:model="lastName" />
        </x-field>
    </div>

    <x-field>
        <x-label>Date of Birth</x-label>
        <x-input
            wire:model="dateOfBirth"
            type="date" />
    </x-field>

    <x-field>
        <x-label>Gender</x-label>
        <x-select wire:model="gender">
            <x-slot:trigger>
                <x-slot:label>Select gender</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="male">Male</x-select-item>
                <x-select-item value="female">Female</x-select-item>
                <x-select-item value="other">Other</x-select-item>
                <x-select-item value="prefer-not-to-say">Prefer not to say</x-select-item>
            </x-slot:content>
        </x-select>
    </x-field>
</x-fieldset>
```

### Input Group with Label

```blade
<x-field>
    <x-label>Website URL</x-label>
    <x-input-group>
        <x-slot:addon>https://</x-slot:addon>
        <x-slot:input
            wire:model="website"
            placeholder="example.com" />
    </x-input-group>
    <x-field-description>Enter your website without the protocol</x-field-description>
</x-field>

<x-field>
    <x-label>Price</x-label>
    <x-input-group>
        <x-slot:addon>$</x-slot:addon>
        <x-slot:input
            wire:model="price"
            type="number"
            step="0.01"
            placeholder="0.00" />
    </x-input-group>
</x-field>
```

### Optional Field Indicator

```blade
<x-label for="middle-name">
    Middle Name
    <span class="text-muted-foreground text-xs font-normal">(Optional)</span>
</x-label>
<x-input id="middle-name" />
```

### Inline Form Labels

```blade
<div class="space-y-4">
    <div class="flex items-center gap-4">
        <x-label class="w-32 text-right">Name</x-label>
        <x-input
            wire:model="name"
            class="flex-1" />
    </div>

    <div class="flex items-center gap-4">
        <x-label class="w-32 text-right">Email</x-label>
        <x-input
            wire:model="email"
            type="email"
            class="flex-1" />
    </div>

    <div class="flex items-center gap-4">
        <x-label class="w-32 text-right">Role</x-label>
        <x-select
            wire:model="role"
            class="flex-1">
            <x-slot:trigger>
                <x-slot:label>Select role</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="admin">Admin</x-select-item>
                <x-select-item value="user">User</x-select-item>
            </x-slot:content>
        </x-select>
    </div>
</div>
```

## Accessibility

### Always Use Labels

```blade
{{-- Good: Label associated with input --}}
<x-label for="username">Username</x-label>
<x-input id="username" />

{{-- Avoid: Input without label --}}
<x-input placeholder="Username" />
```

### Descriptive Label Text

```blade
{{-- Good: Clear, descriptive label --}}
<x-label for="email">Email Address</x-label>
<x-input
    id="email"
    type="email" />

{{-- Avoid: Vague or ambiguous label --}}
<x-label for="input1">Field 1</x-label>
<x-input id="input1" />
```

### Required Field Indication

```blade
{{-- Good: Visual and semantic indication --}}
<x-label for="password">
    Password
    <span
        class="text-destructive"
        aria-label="required">
        *
    </span>
</x-label>
<x-input
    id="password"
    type="password"
    required
    aria-required="true" />
```

### Hidden Labels

```blade
{{-- For visually hidden labels that still provide accessibility --}}
<x-label
    for="search"
    class="sr-only">
    Search
</x-label>
<x-input
    id="search"
    type="search"
    placeholder="Search..." />
```

## Best Practices

### Associate Labels with Inputs

```blade
{{-- Good: Explicit association with for/id --}}
<x-label for="email">Email</x-label>
<x-input id="email" />

{{-- Also good: Implicit association (label wrapping) --}}
<x-label>
    Email
    <x-input class="mt-1" />
</x-label>
```

### Use Field Component

```blade
{{-- Good: Use field component for automatic association --}}
<x-field>
    <x-label>Email</x-label>
    <x-input wire:model="email" />
    <x-field-error />
</x-field>

{{-- Avoid: Manual wiring without field --}}
<div>
    <x-label for="email-123">Email</x-label>
    <x-input id="email-123" />
    @error('email')
        <span class="text-destructive text-sm">{{ $message }}</span>
    @enderror
</div>
```

### Indicate Required Fields

```blade
{{-- Good: Clear required indicator --}}
<x-label>
    Full Name
    <span class="text-destructive">*</span>
</x-label>
<x-input required />

{{-- Also good: Mention required fields at form top --}}
<form>
    <p class="text-muted-foreground mb-4 text-sm">
        Fields marked with
        <span class="text-destructive">*</span>
        are required
    </p>

    {{-- Form fields... --}}
</form>
```

### Provide Context

```blade
{{-- Good: Label with additional context --}}
<x-field>
    <x-label>API Key</x-label>
    <x-input
        type="password"
        wire:model="apiKey" />
    <x-field-description>Your API key will be used to authenticate requests</x-field-description>
</x-field>
```

## Technical Details

### Component Structure

```blade
<label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
    {{ $slot }}
</label>
```

### CSS Classes

```css
/* Base styles */
text-sm                            /* Small text size */
font-medium                        /* Medium font weight */
leading-none                       /* Tight line height */

/* Peer-disabled states */
peer-disabled:cursor-not-allowed   /* Prevent interaction when input disabled */
peer-disabled:opacity-70           /* Reduce opacity when input disabled */
```

### How Peer-Disabled Works

The `peer-` modifier in Tailwind CSS works with sibling elements:

```blade
{{-- Input marked with 'peer' class --}}
<x-input
    class="peer"
    disabled />

{{-- Label reacts to peer's disabled state --}}
<x-label class="peer-disabled:opacity-70">Label</x-label>
```

## Related Components

- [Field](./field.md) - Complete form field with label, input, and error
- [Input](./input.md) - Text input that pairs with labels
- [Checkbox](./checkbox.md) - Checkbox with associated label
- [Radio Group](./radio-group.md) - Radio buttons with labels
- [Select](./select.md) - Dropdown select with label
- [Switch](./switch.md) - Toggle switch with label
- [Textarea](./textarea.md) - Multi-line input with label

## Common Patterns

### Contact Form

```blade
<form
    wire:submit="submit"
    class="space-y-6">
    <x-field>
        <x-label>Your Name</x-label>
        <x-input
            wire:model="name"
            placeholder="John Doe" />
        <x-field-error />
    </x-field>

    <x-field>
        <x-label>Email Address</x-label>
        <x-input
            wire:model="email"
            type="email"
            placeholder="john@example.com" />
        <x-field-error />
    </x-field>

    <x-field>
        <x-label>Subject</x-label>
        <x-input
            wire:model="subject"
            placeholder="How can we help?" />
        <x-field-error />
    </x-field>

    <x-field>
        <x-label>Message</x-label>
        <x-textarea
            wire:model="message"
            rows="5"
            placeholder="Enter your message here..." />
        <x-field-description>Please provide as much detail as possible</x-field-description>
        <x-field-error />
    </x-field>

    <x-button type="submit">Send Message</x-button>
</form>
```

### Settings Form

```blade
<form class="space-y-6">
    <x-fieldset>
        <x-field-legend>Profile Settings</x-field-legend>

        <div class="space-y-4">
            <x-field>
                <x-label>Display Name</x-label>
                <x-input wire:model="displayName" />
            </x-field>

            <x-field>
                <x-label>Bio</x-label>
                <x-textarea
                    wire:model="bio"
                    rows="3" />
                <x-field-description>Brief description for your profile</x-field-description>
            </x-field>
        </div>
    </x-fieldset>

    <x-fieldset>
        <x-field-legend>Preferences</x-field-legend>

        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <x-label for="email-notifications">Email Notifications</x-label>
                    <p class="text-muted-foreground text-sm">Receive email updates about your account</p>
                </div>
                <x-switch
                    id="email-notifications"
                    wire:model="emailNotifications" />
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <x-label for="marketing-emails">Marketing Emails</x-label>
                    <p class="text-muted-foreground text-sm">Receive emails about new features and updates</p>
                </div>
                <x-switch
                    id="marketing-emails"
                    wire:model="marketingEmails" />
            </div>
        </div>
    </x-fieldset>

    <x-button type="submit">Save Changes</x-button>
</form>
```

### Search Filters

```blade
<div class="space-y-4">
    <x-field>
        <x-label>Search Query</x-label>
        <x-input
            wire:model.live.debounce.300ms="search"
            type="search"
            placeholder="Search..." />
    </x-field>

    <x-field>
        <x-label>Category</x-label>
        <x-select wire:model.live="category">
            <x-slot:trigger>
                <x-slot:label>All Categories</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="">All Categories</x-select-item>
                <x-select-item value="electronics">Electronics</x-select-item>
                <x-select-item value="clothing">Clothing</x-select-item>
                <x-select-item value="books">Books</x-select-item>
            </x-slot:content>
        </x-select>
    </x-field>

    <x-field>
        <x-label>Price Range</x-label>
        <div class="grid grid-cols-2 gap-2">
            <x-input
                wire:model.live="minPrice"
                type="number"
                placeholder="Min" />
            <x-input
                wire:model.live="maxPrice"
                type="number"
                placeholder="Max" />
        </div>
    </x-field>
</div>
```
