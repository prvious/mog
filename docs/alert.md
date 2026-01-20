# Alert

The Alert component provides prominent notification messages for important information, warnings, errors, and updates. Alerts display contextual feedback with optional icons, titles, and descriptions.

## Overview

Alerts communicate important messages to users in a noticeable way. They can display success confirmations, error messages, warnings, or general information.

### When to Use

- **Success messages**: Confirm successful operations
- **Error messages**: Display error information and recovery steps
- **Warnings**: Alert users to potential issues or important information
- **Informational messages**: Provide helpful context or updates
- **Persistent feedback**: Show messages that shouldn't disappear automatically

### Alert vs Toast

- **Alert**: Static messages that remain until dismissed, part of page content
- **Toast**: Temporary notifications that auto-dismiss, appear as overlays

## Props

### `variant`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'destructive'`

Controls the visual style of the alert.

- **`default`**: Standard alert for general information and success messages
- **`destructive`**: Red-themed alert for errors, warnings, and critical messages

## Slots

### `title`

**Required**

The alert title or heading. Should be concise and descriptive.

### `content`

**Required**

The main alert message. Can contain paragraphs, links, or formatted text.

### `icon`

**Optional**

Icon displayed on the left side of the alert. Icons automatically size to `size-4` (16px).

## Features

### Grid Layout

Alerts use CSS Grid for proper icon and content alignment:

- Icon column appears only when icon is present
- Title and content stack vertically
- Proper spacing and gaps

### Rich Content Support

The content area supports:

- Multiple paragraphs
- Links with hover states
- Formatted text
- Lists and other HTML

### Accessibility

- Includes `role="alert"` for screen readers
- Icon inherits current color
- Proper heading hierarchy

## Usage Examples

### Basic Alert

```blade
<x-alert>
    <x-slot:title>Heads up!</x-slot:title>
    <x-slot:content>You can add components to your app using the cli.</x-slot:content>
</x-alert>
```

### Alert with Icon

```blade
<x-alert>
    <x-slot:icon>
        @svg('lucide-info')
    </x-slot:icon>

    <x-slot:title>Information</x-slot:title>

    <x-slot:content>Your session will expire in 5 minutes. Please save your work.</x-slot:content>
</x-alert>
```

### Destructive Alert

```blade
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-triangle-alert')
    </x-slot:icon>

    <x-slot:title>Error</x-slot:title>

    <x-slot:content>Your session has expired. Please log in again.</x-slot:content>
</x-alert>
```

### Success Alert

```blade
<x-alert>
    <x-slot:icon>
        @svg('lucide-check-circle-2')
    </x-slot:icon>

    <x-slot:title>Success!</x-slot:title>

    <x-slot:content>Your account has been created successfully. Welcome aboard!</x-slot:content>
</x-alert>
```

### Warning Alert

```blade
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-alert-triangle')
    </x-slot:icon>

    <x-slot:title>Warning</x-slot:title>

    <x-slot:content>This action cannot be undone. Please review your changes carefully.</x-slot:content>
</x-alert>
```

### Alert with Multiple Paragraphs

```blade
<x-alert>
    <x-slot:icon>
        @svg('lucide-lightbulb')
    </x-slot:icon>

    <x-slot:title>Pro Tip</x-slot:title>

    <x-slot:content>
        <p>You can use keyboard shortcuts to navigate faster.</p>
        <p class="mt-2">
            Press
            <kbd>Ctrl</kbd>
            +
            <kbd>K</kbd>
            to open the command palette.
        </p>
    </x-slot:content>
</x-alert>
```

### Alert with Links

```blade
<x-alert>
    <x-slot:icon>
        @svg('lucide-info')
    </x-slot:icon>

    <x-slot:title>Update Available</x-slot:title>

    <x-slot:content>
        A new version of the application is available.
        <a
            href="/updates"
            class="font-medium underline">
            View changelog
        </a>
        to see what's new.
    </x-slot:content>
</x-alert>
```

### Form Validation Alert

```blade
@if ($errors->any())
    <x-alert variant="destructive">
        <x-slot:icon>
            @svg('lucide-alert-circle')
        </x-slot:icon>

        <x-slot:title>Validation Error</x-slot:title>

        <x-slot:content>
            <p>Please correct the following errors:</p>
            <ul class="ml-4 mt-2 list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-slot:content>
    </x-alert>
@endif
```

### Success Confirmation

```blade
@if (session('success'))
    <x-alert>
        <x-slot:icon>
            @svg('lucide-check-circle-2')
        </x-slot:icon>

        <x-slot:title>Success</x-slot:title>

        <x-slot:content>
            {{ session('success') }}
        </x-slot:content>
    </x-alert>
@endif
```

### Error Alert with Recovery Steps

```blade
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-x-circle')
    </x-slot:icon>

    <x-slot:title>Connection Failed</x-slot:title>

    <x-slot:content>
        <p>Unable to connect to the server. Please try the following:</p>
        <ul class="ml-4 mt-2 list-disc space-y-1">
            <li>Check your internet connection</li>
            <li>Refresh the page</li>
            <li>Contact support if the problem persists</li>
        </ul>
    </x-slot:content>
</x-alert>
```

### Dismissible Alert with Livewire

```blade
<div
    x-data="{ show: true }"
    x-show="show"
    x-transition>
    <x-alert>
        <x-slot:icon>
            @svg('lucide-info')
        </x-slot:icon>

        <x-slot:title>Cookie Notice</x-slot:title>

        <x-slot:content>
            <div class="flex items-start justify-between gap-4">
                <p>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
                <x-button
                    variant="ghost"
                    size="icon-sm"
                    x-on:click="show = false"
                    aria-label="Dismiss">
                    @svg('lucide-x')
                </x-button>
            </div>
        </x-slot:content>
    </x-alert>
</div>
```

### Alert with Action Buttons

```blade
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-shield-alert')
    </x-slot:icon>

    <x-slot:title>Security Alert</x-slot:title>

    <x-slot:content>
        <p class="mb-4">We detected a new login from an unrecognized device in New York, USA.</p>
        <div class="flex gap-2">
            <x-button
                size="sm"
                variant="destructive">
                Secure My Account
            </x-button>
            <x-button
                size="sm"
                variant="outline">
                This Was Me
            </x-button>
        </div>
    </x-slot:content>
</x-alert>
```

### Informational Alerts

```blade
{{-- General information --}}
<x-alert>
    <x-slot:icon>
        @svg('lucide-info')
    </x-slot:icon>

    <x-slot:title>System Maintenance</x-slot:title>

    <x-slot:content>
        Scheduled maintenance will occur on Saturday from 2:00 AM to 4:00 AM EST. The system will be unavailable during this time.
    </x-slot:content>
</x-alert>

{{-- Feature announcement --}}
<x-alert>
    <x-slot:icon>
        @svg('lucide-sparkles')
    </x-slot:icon>

    <x-slot:title>New Feature</x-slot:title>

    <x-slot:content>Try our new dark mode! Toggle it in settings or use the theme switcher.</x-slot:content>
</x-alert>

{{-- Beta feature notice --}}
<x-alert>
    <x-slot:icon>
        @svg('lucide-flask-conical')
    </x-slot:icon>

    <x-slot:title>Beta Feature</x-slot:title>

    <x-slot:content>
        This feature is currently in beta. Your feedback helps us improve!
        <a
            href="/feedback"
            class="font-medium underline">
            Share feedback
        </a>
    </x-slot:content>
</x-alert>
```

### Payment and Transaction Alerts

```blade
{{-- Payment success --}}
<x-alert>
    <x-slot:icon>
        @svg('lucide-check-circle-2')
    </x-slot:icon>

    <x-slot:title>Payment Successful</x-slot:title>

    <x-slot:content>Your payment of $99.00 has been processed successfully. A receipt has been sent to your email.</x-slot:content>
</x-alert>

{{-- Payment failed --}}
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-credit-card')
    </x-slot:icon>

    <x-slot:title>Payment Failed</x-slot:title>

    <x-slot:content>Your card was declined. Please check your card details and try again.</x-slot:content>
</x-alert>
```

### File Upload Alerts

```blade
{{-- Upload success --}}
<x-alert>
    <x-slot:icon>
        @svg('lucide-upload-cloud')
    </x-slot:icon>

    <x-slot:title>Upload Complete</x-slot:title>

    <x-slot:content>5 files were successfully uploaded to your project.</x-slot:content>
</x-alert>

{{-- Upload error --}}
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-file-warning')
    </x-slot:icon>

    <x-slot:title>Upload Failed</x-slot:title>

    <x-slot:content>
        <p>2 files could not be uploaded:</p>
        <ul class="ml-4 mt-2 list-disc">
            <li>document.pdf - File too large (max 10MB)</li>
            <li>image.png - Invalid file type</li>
        </ul>
    </x-slot:content>
</x-alert>
```

### Permission and Access Alerts

```blade
{{-- Insufficient permissions --}}
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-lock')
    </x-slot:icon>

    <x-slot:title>Access Denied</x-slot:title>

    <x-slot:content>You don't have permission to perform this action. Contact your administrator for access.</x-slot:content>
</x-alert>

{{-- Trial expiration --}}
<x-alert variant="destructive">
    <x-slot:icon>
        @svg('lucide-clock')
    </x-slot:icon>

    <x-slot:title>Trial Ending Soon</x-slot:title>

    <x-slot:content>
        Your trial expires in 3 days.
        <a
            href="/upgrade"
            class="font-medium underline">
            Upgrade now
        </a>
        to continue using all features.
    </x-slot:content>
</x-alert>
```

### Custom Styled Alerts

```blade
{{-- Alert with custom classes --}}
<x-alert class="border-primary/20 bg-primary/5">
    <x-slot:icon>
        @svg('lucide-gift', 'text-primary')
    </x-slot:icon>

    <x-slot:title class="text-primary">Special Offer</x-slot:title>

    <x-slot:content class="text-primary/90">Get 20% off your first purchase! Use code WELCOME20 at checkout.</x-slot:content>
</x-alert>
```

## Accessibility

### ARIA Attributes

The alert automatically includes `role="alert"` for screen readers:

```blade
{{-- Automatically includes role="alert" --}}
<x-alert>
    <x-slot:title>Message</x-slot:title>
    <x-slot:content>Content</x-slot:content>
</x-alert>
```

### Screen Reader Announcements

```blade
{{-- Alert is announced to screen readers --}}
<x-alert>
    <x-slot:icon>
        @svg('lucide-info')
    </x-slot:icon>

    <x-slot:title>Important Update</x-slot:title>

    <x-slot:content>Your profile has been updated successfully.</x-slot:content>
</x-alert>
```

### Link Accessibility

```blade
{{-- Links in alerts should be descriptive --}}
<x-alert>
    <x-slot:title>Account Updated</x-slot:title>

    <x-slot:content>
        {{-- Good: Descriptive link text --}}
        Your email has been changed.
        <a
            href="/settings"
            class="font-medium underline">
            Review your account settings
        </a>
        for more details.

        {{-- Avoid: Non-descriptive link text --}}
        Your email has been changed.
        <a href="/settings">Click here</a>
        .
    </x-slot:content>
</x-alert>
```

## Best Practices

### When to Use Each Variant

- **`default`**: General information, success messages, tips, announcements
- **`destructive`**: Errors, warnings, critical alerts, dangerous actions

### Alert Messaging

```blade
{{-- Good: Clear, actionable message --}}
<x-alert variant="destructive">
    <x-slot:title>Payment Failed</x-slot:title>
    <x-slot:content>Your card was declined. Please check your card details and try again, or use a different payment method.</x-slot:content>
</x-alert>

{{-- Avoid: Vague message --}}
<x-alert variant="destructive">
    <x-slot:title>Error</x-slot:title>
    <x-slot:content>Something went wrong.</x-slot:content>
</x-alert>
```

### Icon Selection

Common icon choices:

- **Information**: `lucide-info`, `lucide-lightbulb`
- **Success**: `lucide-check-circle-2`, `lucide-check`
- **Warning**: `lucide-alert-triangle`, `lucide-triangle-alert`
- **Error**: `lucide-x-circle`, `lucide-alert-circle`
- **Security**: `lucide-shield-alert`, `lucide-lock`

### Alert Placement

```blade
{{-- Good: Place at top of form --}}
<form>
    @if ($errors->any())
        <x-alert
            variant="destructive"
            class="mb-6">
            {{-- Error alert --}}
        </x-alert>
    @endif

    {{-- Form fields --}}
</form>

{{-- Good: Place above affected content --}}
<div>
    <x-alert class="mb-4">
        {{-- Contextual alert --}}
    </x-alert>

    {{-- Related content --}}
</div>
```

## Technical Details

### Grid Layout

Alerts use CSS Grid for flexible layout:

```blade
{{-- With icon: 2-column grid --}}
<x-alert>
    <x-slot:icon>@svg('icon')</x-slot:icon>
    {{-- Icon column: calc(var(--spacing)*4), Content column: 1fr --}}
</x-alert>

{{-- Without icon: 1-column grid --}}
<x-alert>
    {{-- Icon column: 0, Content column: 1fr --}}
</x-alert>
```

### Color System

The destructive variant uses custom color targeting:

- Text color: `text-destructive`
- Description color: `text-destructive/90`
- Icon color: Inherits from parent (`text-current`)

### Dark Mode

Alerts automatically adapt to dark mode:

```blade
{{-- Automatically adjusts colors for dark mode --}}
<x-alert variant="destructive">
    {{-- Colors adapt to dark theme --}}
</x-alert>
```

## Related Components

- [Toaster](./toaster.md) - Temporary toast notifications
- [Error](./error.md) - Form validation error display
- [Card](./card.md) - Container component for grouped content

## Common Patterns

### Stacked Alerts

```blade
<div class="space-y-4">
    <x-alert>
        <x-slot:icon>@svg('lucide-check-circle-2')</x-slot:icon>
        <x-slot:title>Profile Updated</x-slot:title>
        <x-slot:content>Your changes have been saved.</x-slot:content>
    </x-alert>

    <x-alert variant="destructive">
        <x-slot:icon>@svg('lucide-alert-triangle')</x-slot:icon>
        <x-slot:title>Email Not Verified</x-slot:title>
        <x-slot:content>Please check your inbox and verify your email address.</x-slot:content>
    </x-alert>
</div>
```

### Conditional Alerts

```blade
@if (session('status') === 'password-updated')
    <x-alert>
        <x-slot:icon>@svg('lucide-check-circle-2')</x-slot:icon>
        <x-slot:title>Password Updated</x-slot:title>
        <x-slot:content>Your password has been changed successfully.</x-slot:content>
    </x-alert>
@endif

@if ($user->email_verified_at === null)
    <x-alert variant="destructive">
        <x-slot:icon>@svg('lucide-mail')</x-slot:icon>
        <x-slot:title>Verify Your Email</x-slot:title>
        <x-slot:content>
            Please verify your email address to access all features.
            <button
                wire:click="resendVerification"
                class="font-medium underline">
                Resend verification email
            </button>
        </x-slot:content>
    </x-alert>
@endif
```
