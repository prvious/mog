# Error

The Error component displays Laravel validation error messages in a consistent, accessible format. It automatically integrates with Laravel's error bag system to show field-specific validation errors.

## Overview

The Error component is designed for form validation feedback. It integrates seamlessly with Laravel's validation system to display error messages for specific form fields.

### When to Use

- **Form validation**: Display field-specific validation errors
- **Real-time validation**: Show errors as users fill out forms (with Livewire)
- **Server-side validation**: Display errors after form submission
- **Multi-step forms**: Show validation errors for current step

### Error vs Alert

- **Error**: Field-specific validation messages, tied to form inputs
- **Alert**: General messages or form-level notifications

## Props

### `key`

**Required**
**Type:** `string`

The validation key that matches your form field name. Used to retrieve errors from Laravel's error bag.

### `multiple`

**Type:** `boolean`
**Default:** `true`

Whether to display all error messages for the field or just the first one.

- **`true`**: Shows all errors in a bulleted list
- **`false`**: Shows only the first error message

### `bag`

**Type:** `string`
**Default:** `'default'`

The error bag to retrieve errors from. Useful when you have multiple forms on a page.

## Features

### Automatic Error Detection

Uses Laravel's `@error` directive to automatically show/hide based on validation state.

### Multiple Error Messages

Displays all validation rules that failed for a field:

- Shown as a bulleted list
- Each error on its own line
- Proper semantic HTML

### Error Bag Support

Works with named error bags for multiple forms on one page.

## Usage Examples

### Basic Error Display

```blade
<x-field>
    <x-field-label for="email">Email</x-field-label>
    <x-input
        id="email"
        type="email"
        wire:model="email" />
    <x-error key="email" />
</x-field>
```

### Single Error Message

```blade
<x-field>
    <x-field-label for="password">Password</x-field-label>
    <x-input
        id="password"
        type="password"
        wire:model="password" />
    {{-- Show only first error --}}
    <x-error
        key="password"
        :multiple="false" />
</x-field>
```

### Complete Form Example

```blade
<form wire:submit="save">
    <x-field-group>
        <x-field>
            <x-field-label for="name">Full Name</x-field-label>
            <x-input
                id="name"
                wire:model="name"
                required />
            <x-error key="name" />
        </x-field>

        <x-field>
            <x-field-label for="email">Email Address</x-field-label>
            <x-input
                id="email"
                type="email"
                wire:model="email"
                required />
            <x-error key="email" />
        </x-field>

        <x-field>
            <x-field-label for="password">Password</x-field-label>
            <x-input
                id="password"
                type="password"
                wire:model="password"
                required />
            <x-error key="password" />
        </x-field>

        <x-button type="submit">Create Account</x-button>
    </x-field-group>
</form>
```

### With Custom Error Bag

```blade
{{-- Login form with custom error bag --}}
<form wire:submit="login">
    <x-field-group>
        <x-field>
            <x-field-label for="login-email">Email</x-field-label>
            <x-input
                id="login-email"
                wire:model="email" />
            <x-error
                key="email"
                bag="login" />
        </x-field>

        <x-field>
            <x-field-label for="login-password">Password</x-field-label>
            <x-input
                id="login-password"
                type="password"
                wire:model="password" />
            <x-error
                key="password"
                bag="login" />
        </x-field>

        <x-button type="submit">Log In</x-button>
    </x-field-group>
</form>
```

### Real-Time Validation with Livewire

```blade
<x-field>
    <x-field-label for="username">Username</x-field-label>
    <x-input
        id="username"
        wire:model.live="username" />
    <x-field-description>Choose a unique username (3-20 characters)</x-field-description>
    <x-error key="username" />
</x-field>
```

### Multiple Validation Rules

```blade
{{-- When field has multiple validation rules --}}
<x-field>
    <x-field-label for="password">Password</x-field-label>
    <x-input
        id="password"
        type="password"
        wire:model="password" />
    {{--
        Shows all validation errors:
        - The password field is required.
        - The password must be at least 8 characters.
        - The password must contain at least one uppercase letter.
    --}}
    <x-error key="password" />
</x-field>
```

### Nested Field Errors

```blade
{{-- Array field validation --}}
<div>
    @foreach ($addresses as $index => $address)
        <div class="space-y-4">
            <x-field>
                <x-field-label>Street Address</x-field-label>
                <x-input wire:model="addresses.{{ $index }}.street" />
                <x-error key="addresses.{{ $index }}.street" />
            </x-field>

            <x-field>
                <x-field-label>City</x-field-label>
                <x-input wire:model="addresses.{{ $index }}.city" />
                <x-error key="addresses.{{ $index }}.city" />
            </x-field>

            <x-field>
                <x-field-label>Zip Code</x-field-label>
                <x-input wire:model="addresses.{{ $index }}.zip" />
                <x-error key="addresses.{{ $index }}.zip" />
            </x-field>
        </div>
    @endforeach
</div>
```

### With Field Description

```blade
<x-field>
    <x-field-label for="bio">Bio</x-field-label>
    <x-textarea
        id="bio"
        wire:model="bio"
        rows="4" />
    <x-field-description>Tell us about yourself (max 500 characters)</x-field-description>
    <x-error key="bio" />
</x-field>
```

### File Upload Errors

```blade
<x-field>
    <x-field-label for="avatar">Profile Picture</x-field-label>
    <input
        id="avatar"
        type="file"
        wire:model="avatar"
        accept="image/*" />
    <x-field-description>Upload a profile picture (max 2MB, JPG or PNG)</x-field-description>
    <x-error key="avatar" />
</x-field>
```

### Radio Group Errors

```blade
<x-field>
    <x-field-legend>Account Type</x-field-legend>
    <x-radio-group wire:model="accountType">
        <x-radio-group-item
            value="personal"
            id="personal">
            Personal
        </x-radio-group-item>
        <x-radio-group-item
            value="business"
            id="business">
            Business
        </x-radio-group-item>
    </x-radio-group>
    <x-error key="accountType" />
</x-field>
```

### Select Field Errors

```blade
<x-field>
    <x-field-label for="country">Country</x-field-label>
    <x-select
        id="country"
        wire:model="country">
        <option value="">Select a country...</option>
        <option value="us">United States</option>
        <option value="ca">Canada</option>
        <option value="uk">United Kingdom</option>
    </x-select>
    <x-error key="country" />
</x-field>
```

### Checkbox Errors

```blade
<x-field>
    <div class="flex items-center gap-2">
        <x-checkbox
            id="terms"
            wire:model="terms" />
        <x-field-label for="terms">I agree to the Terms and Conditions</x-field-label>
    </div>
    <x-error key="terms" />
</x-field>
```

## Accessibility

### ARIA Attributes

The error component includes `role="alert"` for screen readers:

```blade
{{-- Automatically announced to screen readers --}}
<x-error key="email" />
```

### Error Association

Link errors to form fields using `aria-describedby`:

```blade
<x-field>
    <x-field-label for="email">Email</x-field-label>
    <x-input
        id="email"
        wire:model="email"
        aria-describedby="email-error"
        :aria-invalid="$errors->has('email')" />
    <x-error
        key="email"
        id="email-error" />
</x-field>
```

### Color and Icons

Don't rely solely on color to convey errors:

```blade
{{-- Good: Text clearly indicates error --}}
<x-error key="email" />

{{-- Better: Add icon for additional clarity --}}
<div class="flex items-start gap-2">
    @svg('lucide-alert-circle', 'text-destructive mt-0.5 size-4')
    <x-error key="email" />
</div>
```

## Best Practices

### Error Message Clarity

```blade
{{-- Good: Clear validation rules in backend --}}
protected function rules() { return [ 'email' => [ 'required' => 'Email address is required', 'email' => 'Please enter a valid email address', 'unique:users' =>
'This email is already registered', ], ]; }

{{-- Results in clear error messages --}}
<x-error key="email" />
```

### Placement

```blade
{{-- Good: Error below field --}}
<x-field>
    <x-field-label>Email</x-field-label>
    <x-input wire:model="email" />
    <x-error key="email" />
</x-field>

{{-- Avoid: Error above field --}}
<x-field>
    <x-field-label>Email</x-field-label>
    <x-error key="email" />
    <x-input wire:model="email" />
</x-field>
```

### Multiple vs Single Errors

```blade
{{-- Use multiple for complex fields --}}
<x-field>
    <x-field-label>Password</x-field-label>
    <x-input
        type="password"
        wire:model="password" />
    {{-- Shows all password requirements that failed --}}
    <x-error
        key="password"
        :multiple="true" />
</x-field>

{{-- Use single for simple fields --}}
<x-field>
    <x-field-label>Email</x-field-label>
    <x-input wire:model="email" />
    {{-- Shows only first error --}}
    <x-error
        key="email"
        :multiple="false" />
</x-field>
```

## Technical Details

### Laravel Integration

The error component uses Laravel's `@error` Blade directive:

```php
@error($key)
    // Component content
@enderror
```

### Error Bag Access

Retrieves errors from Laravel's `ViewErrorBag`:

```php
$errorBag = $errors->getBag($bag);
$errorBag->get($key); // Get all errors for key
$errorBag->first($key); // Get first error for key
```

### List Rendering

Errors are displayed in a semantic HTML list:

```html
<div role="alert">
    <ul class="ml-4 flex list-disc flex-col gap-1">
        <li>Error message 1</li>
        <li>Error message 2</li>
    </ul>
</div>
```

## Related Components

- [Field](./field.md) - Form field wrapper component
- [Input](./input.md) - Text input component
- [Alert](./alert.md) - General alert messages

## Common Patterns

### Inline Validation

```blade
<x-field>
    <x-field-label for="username">Username</x-field-label>
    <x-input
        id="username"
        wire:model.live.debounce.500ms="username"
        :aria-invalid="$errors->has('username')" />
    <x-error
        key="username"
        :multiple="false" />
</x-field>
```

### Form-Level and Field-Level Errors

```blade
<form wire:submit="save">
    {{-- Form-level errors --}}
    @if ($errors->any() && ! $errors->has('specific-field'))
        <x-alert
            variant="destructive"
            class="mb-6">
            <x-slot:title>Validation Error</x-slot:title>
            <x-slot:content>Please correct the errors below and try again.</x-slot:content>
        </x-alert>
    @endif

    {{-- Field-level errors --}}
    <x-field-group>
        <x-field>
            <x-field-label for="email">Email</x-field-label>
            <x-input
                id="email"
                wire:model="email" />
            <x-error key="email" />
        </x-field>
    </x-field-group>
</form>
```

### Conditional Error Styling

```blade
<x-field>
    <x-field-label for="email">Email</x-field-label>
    <x-input
        id="email"
        wire:model="email"
        {{-- Add error styling when invalid --}}
        :class="$errors->has('email') ? 'border-destructive' : ''"
        :aria-invalid="$errors->has('email')" />
    <x-error key="email" />
</x-field>
```
