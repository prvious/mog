# Checkbox, Switch & Toggle

Interactive boolean controls for forms and settings. The Mog library provides three components for handling on/off states: `<x-checkbox>`, `<x-switch>`, and `<x-toggle>`.

## Overview

### When to Use Each Component

- **`<x-checkbox>`**: Traditional checkbox for selecting options in forms, lists, or multi-select scenarios
- **`<x-switch>`**: Toggle switch for settings, preferences, or instant on/off actions
- **`<x-toggle>`**: Button-style toggle for switching between two states or modes with optional visual feedback

## Checkbox Component

A styled checkbox with Alpine.js state management.

### Props

- `checked` (boolean, default: `false`): Initial checked state
- `disabled` (boolean, default: `false`): Whether the checkbox is disabled

### Features

- **Alpine.js state**: Uses `x-data` and `x-modelable` for reactive state
- **Visual indicator**: Check icon appears when checked
- **Keyboard accessible**: Full keyboard support
- **Hidden native input**: Maintains form compatibility with hidden input
- **Focus states**: Clear focus ring indicator
- **Error states**: Supports `aria-invalid` for validation

### Usage Examples

#### Basic Checkbox

```blade
<x-checkbox name="terms" />
```

#### With Label

```blade
<x-field orientation="horizontal">
    <x-field-label>
        <x-checkbox name="newsletter" />
        Subscribe to newsletter
    </x-field-label>
</x-field>
```

#### Checked by Default

```blade
<x-checkbox
    :checked="true"
    name="notifications" />
```

#### Disabled State

```blade
<x-checkbox
    disabled
    name="locked_option" />

<x-checkbox
    :checked="true"
    disabled
    name="always_enabled" />
```

#### With Livewire

```blade
<x-checkbox
    wire:model="accepted"
    name="terms" />
```

#### With Field Wrapper

```blade
<x-field>
    <x-field-label>
        <x-checkbox wire:model="agreed" />
        I agree to the terms and conditions
    </x-field-label>
    <x-field-error key="agreed" />
</x-field>
```

#### Checkbox List

```blade
<x-fieldset>
    <x-field-legend>Select your interests</x-field-legend>

    <x-field-group>
        <x-field orientation="horizontal">
            <x-field-label>
                <x-checkbox
                    name="interests[]"
                    value="design" />
                Design
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-checkbox
                    name="interests[]"
                    value="development" />
                Development
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-checkbox
                    name="interests[]"
                    value="marketing" />
                Marketing
            </x-field-label>
        </x-field>
    </x-field-group>
</x-fieldset>
```

#### With Description

```blade
<x-field orientation="horizontal">
    <x-field-label>
        <x-checkbox wire:model="emailNotifications" />
        <div>
            <div class="font-medium">Email Notifications</div>
            <x-field-description>Receive updates and announcements via email</x-field-description>
        </div>
    </x-field-label>
</x-field>
```

## Switch Component

A toggle switch styled for settings and instant actions.

### Props

- `checked` (boolean, default: `false`): Initial checked/on state
- `disabled` (boolean, default: `false`): Whether the switch is disabled

### Features

- **Smooth animation**: Thumb slides with transition
- **Alpine.js state**: Reactive state management
- **Accessible**: Proper role and state attributes
- **Focus ring**: Clear focus indicator with offset
- **Hidden input**: Maintains form compatibility

### Usage Examples

#### Basic Switch

```blade
<x-switch name="enabled" />
```

#### With Label

```blade
<x-field orientation="horizontal">
    <x-field-label>Dark Mode</x-field-label>
    <x-switch wire:model.live="darkMode" />
</x-field>
```

#### Checked by Default

```blade
<x-switch
    :checked="true"
    name="active" />
```

#### Disabled State

```blade
<x-switch disabled />

<x-switch
    :checked="true"
    disabled />
```

#### Settings Form

```blade
<x-field-group>
    <x-field orientation="horizontal">
        <x-field-content>
            <x-field-label>Email Notifications</x-field-label>
            <x-field-description>Receive email about your account activity</x-field-description>
        </x-field-content>
        <x-switch wire:model="settings.emailNotifications" />
    </x-field>

    <x-field orientation="horizontal">
        <x-field-content>
            <x-field-label>Push Notifications</x-field-label>
            <x-field-description>Receive push notifications on your devices</x-field-description>
        </x-field-content>
        <x-switch wire:model="settings.pushNotifications" />
    </x-field>

    <x-field orientation="horizontal">
        <x-field-content>
            <x-field-label>Marketing Emails</x-field-label>
            <x-field-description>Receive emails about new products and features</x-field-description>
        </x-field-content>
        <x-switch wire:model="settings.marketingEmails" />
    </x-field>
</x-field-group>
```

#### With Livewire Actions

```blade
<x-field orientation="horizontal">
    <x-field-label>Maintenance Mode</x-field-label>
    <x-switch
        wire:model.live="maintenanceMode"
        wire:confirm="Are you sure you want to enable maintenance mode?" />
</x-field>
```

## Toggle Component

A button-style toggle for switching between states with optional visual content.

### Props

- `default` (boolean, default: `false`): Initial toggle state (on/off)
- `off` (slot): Optional content to show in "off" state
- `size` (string, default: `'default'`): Button size
    - `'sm'`: Small (h-8)
    - `'default'`: Default (h-9)
    - `'lg'`: Large (h-10)
- `variant` (string, default: `'default'`): Visual style
    - `'default'`: Default background style
    - `'outline'`: Bordered style
    - `'destructive'`: Red destructive style
    - `'secondary'`: Secondary background
    - `'ghost'`: Minimal style

### Features

- **Dual content**: Can show different content for on/off states
- **Multiple variants**: Matches button component variants
- **Alpine.js state**: Reactive state with `x-modelable`
- **Keyboard accessible**: Full keyboard support
- **Data state**: Exposes `data-state` attribute for styling

### Usage Examples

#### Basic Toggle

```blade
<x-toggle>
    @svg('lucide-heart')
</x-toggle>
```

#### Toggle with On/Off States

```blade
<x-toggle>
    <x-slot:off>
        @svg('lucide-volume-x')
        Unmuted
    </x-slot:off>

    @svg('lucide-volume-2')
    Muted
</x-toggle>
```

#### Different Sizes

```blade
<x-toggle size="sm">Small</x-toggle>
<x-toggle>Default</x-toggle>
<x-toggle size="lg">Large</x-toggle>
```

#### Different Variants

```blade
<x-toggle variant="outline">
    @svg('lucide-star')
</x-toggle>

<x-toggle variant="secondary">
    @svg('lucide-bookmark')
</x-toggle>

<x-toggle variant="ghost">
    @svg('lucide-heart')
</x-toggle>

<x-toggle variant="destructive">
    @svg('lucide-trash')
</x-toggle>
```

#### With Livewire

```blade
<x-toggle wire:model="favorited">
    <x-slot:off>
        @svg('lucide-star')
    </x-slot:off>

    @svg('lucide-star-filled')
</x-toggle>
```

#### Icon Toggles

```blade
{{-- Like button --}}
<x-toggle
    wire:model="liked"
    variant="ghost">
    <x-slot:off>
        @svg('lucide-heart')
    </x-slot:off>
    @svg('lucide-heart-filled', 'text-red-500')
</x-toggle>

{{-- Bookmark --}}
<x-toggle
    wire:model="bookmarked"
    variant="ghost">
    <x-slot:off>
        @svg('lucide-bookmark')
    </x-slot:off>
    @svg('lucide-bookmark-filled')
</x-toggle>

{{-- Visibility --}}
<x-toggle
    wire:model="visible"
    size="sm">
    <x-slot:off>
        @svg('lucide-eye-off')
        Hidden
    </x-slot:off>
    @svg('lucide-eye')
    Visible
</x-toggle>
```

#### Toolbar Toggles

```blade
<x-button-group>
    <x-toggle
        variant="outline"
        size="sm"
        wire:model="bold">
        @svg('lucide-bold')
    </x-toggle>
    <x-toggle
        variant="outline"
        size="sm"
        wire:model="italic">
        @svg('lucide-italic')
    </x-toggle>
    <x-toggle
        variant="outline"
        size="sm"
        wire:model="underline">
        @svg('lucide-underline')
    </x-toggle>
</x-button-group>
```

## Accessibility

### Checkbox Accessibility

```blade
{{-- Proper role --}}
<x-checkbox role="checkbox" />

{{-- With aria-label for standalone checkboxes --}}
<x-checkbox aria-label="Accept terms" />

{{-- Required checkbox --}}
<x-checkbox
    required
    aria-required="true" />

{{-- Invalid state --}}
<x-checkbox aria-invalid="true" />
```

### Switch Accessibility

```blade
{{-- Switches have proper checkbox role --}}
<x-switch role="checkbox" />

{{-- With label via field-label --}}
<x-field orientation="horizontal">
    <x-field-label>Enable feature</x-field-label>
    <x-switch />
</x-field>

{{-- With aria-label for standalone --}}
<x-switch aria-label="Toggle dark mode" />
```

### Toggle Accessibility

```blade
{{-- Toggles are buttons, include aria-pressed --}}
<x-toggle aria-pressed="false">Toggle</x-toggle>

{{-- With aria-label for icon-only --}}
<x-toggle aria-label="Add to favorites">
    @svg('lucide-star')
</x-toggle>
```

### Keyboard Navigation

All three components support full keyboard interaction:

- `Tab`: Focus the control
- `Space`: Toggle the state
- `Enter`: Toggle the state (toggle button only)

## Best Practices

### Choosing the Right Component

```blade
{{-- Checkbox: Multiple selections, forms --}}
<x-checkbox name="terms" />

{{-- Switch: Single on/off setting --}}
<x-switch wire:model="darkMode" />

{{-- Toggle: Interactive state with visual feedback --}}
<x-toggle wire:model="favorited">
    @svg('lucide-star')
</x-toggle>
```

### Always Provide Labels

```blade
{{-- Good: Label provided --}}
<x-field orientation="horizontal">
    <x-field-label>
        <x-checkbox name="subscribe" />
        Subscribe to newsletter
    </x-field-label>
</x-field>

{{-- Avoid: No label --}}
<x-checkbox name="subscribe" />
```

### Group Related Checkboxes

```blade
<x-fieldset>
    <x-field-legend>Permissions</x-field-legend>
    <x-field-group>
        <x-field orientation="horizontal">
            <x-field-label>
                <x-checkbox name="read" />
                Read
            </x-field-label>
        </x-field>
        <x-field orientation="horizontal">
            <x-field-label>
                <x-checkbox name="write" />
                Write
            </x-field-label>
        </x-field>
    </x-field-group>
</x-fieldset>
```

### Use Switches for Instant Actions

```blade
{{-- Good: Switch for immediate setting change --}}
<x-switch
    wire:model.live="enabled"
    wire:click="$dispatch('setting-changed')" />

{{-- Avoid: Checkbox for instant action --}}
<x-checkbox wire:model.live="enabled" />
```

## Technical Details

### Alpine.js State Management

All three components use Alpine.js for reactive state:

```javascript
x-data="{
    value: false,
}"
x-modelable="value"
```

### Hidden Native Inputs

Checkbox and switch include hidden native inputs for form submission:

```blade
<input
    type="checkbox"
    aria-hidden
    class="pointer-events-none absolute m-0 opacity-0"
    x-model="value" />
```

### Data State Attributes

Components expose state via data attributes for CSS targeting:

```blade
data-state="checked"
{{-- Checkbox/Switch: checked --}}
data-state="unchecked"
{{-- Checkbox/Switch: unchecked --}}
data-state="on"
{{-- Toggle: on --}}
data-state="off"
{{-- Toggle: off --}}
```

### Focus States

All components use consistent focus styling:

```css
focus-visible:ring-ring/50
focus-visible:ring-[3px]
focus-visible:outline-none
```

## Related Components

- [Field](./field.md) - Form field layout components
- [Radio Group](./radio-group.md) - Single-selection radio buttons
- [Button](./button.md) - Action buttons
- [Toggle](./button.md) - Button component

## Common Patterns

### Accept Terms Checkbox

```blade
<x-field>
    <x-field-label>
        <x-checkbox
            wire:model="agreedToTerms"
            required />
        I agree to the
        <a
            href="/terms"
            class="text-primary underline">
            Terms of Service
        </a>
        and
        <a
            href="/privacy"
            class="text-primary underline">
            Privacy Policy
        </a>
    </x-field-label>
    <x-field-error key="agreedToTerms" />
</x-field>
```

### Settings Panel

```blade
<x-field-group>
    <x-field-title>Notifications</x-field-title>

    <x-field orientation="horizontal">
        <x-field-content>
            <x-field-label>Email Notifications</x-field-label>
            <x-field-description>Receive notifications via email</x-field-description>
        </x-field-content>
        <x-switch wire:model.live="emailNotifications" />
    </x-field>

    <x-field orientation="horizontal">
        <x-field-content>
            <x-field-label>Desktop Notifications</x-field-label>
            <x-field-description>Show desktop notifications</x-field-description>
        </x-field-content>
        <x-switch wire:model.live="desktopNotifications" />
    </x-field>
</x-field-group>
```

### Like/Favorite Toggle

```blade
<x-toggle
    wire:model="liked"
    wire:click="toggleLike"
    variant="ghost"
    size="sm">
    <x-slot:off>
        @svg('lucide-heart')
        <span>{{ $likeCount }}</span>
    </x-slot:off>

    @svg('lucide-heart-filled', 'text-red-500')
    <span>{{ $likeCount }}</span>
</x-toggle>
```
