# Avatar

The Avatar component displays user profile images with automatic fallback to initials when images fail to load or are unavailable. It uses Alpine.js for smart error handling and provides a consistent circular design for user representation across your application.

## Overview

Avatars are visual representations of users or entities. The component provides robust image loading with graceful fallbacks, ensuring a polished user experience even when images are unavailable or fail to load.

### When to Use

- **User profiles**: Display user profile pictures
- **Comment sections**: Show commenter avatars
- **Team members**: Display team member photos
- **Chat interfaces**: Show participant avatars in conversations
- **Activity feeds**: Visual indicators for user actions
- **User lists**: Enhance user directories with avatars
- **Navigation**: User menu with profile picture

## Props

### `img`

**Type:** `slot`
**Default:** `null`

Image slot for the avatar picture. Accepts an `<img>` element with standard attributes. The component automatically handles:

- Load errors with Alpine.js `x-on:error` handler
- Success loading with `x-on:load` handler
- Visibility toggling based on error state

### `initials`

**Type:** `slot`
**Default:** `null`

Fallback slot for displaying user initials when image is unavailable or fails to load. Accepts text content that renders in a centered layout with muted background.

## Features

### Automatic Fallback

Smart error handling:

- Shows image when successfully loaded
- Automatically switches to initials on image load failure
- Resets to image if source changes and loads successfully
- No manual state management required

### Alpine.js Integration

Uses Alpine.js for reactive behavior:

- `x-data="{ error: false }"` for error state tracking
- `x-on:error` to catch image load failures
- `x-on:load` to reset error state
- `x-show` for conditional rendering

### Consistent Sizing

Fixed aspect ratio:

- Circular shape via `rounded-full`
- Square dimensions with `size-8` default
- Easy size customization with Tailwind classes
- Prevents layout shift during loading

### Overflow Control

Proper image containment:

- `overflow-hidden` clips images to circle
- Prevents distortion with proper sizing
- Maintains visual consistency

## Usage Examples

### Basic Avatar with Image

```blade
<x-avatar>
    <x-slot:img
        src="/avatars/john-doe.jpg"
        alt="John Doe" />
</x-avatar>
```

### Avatar with Initials Fallback

```blade
<x-avatar>
    <x-slot:img
        src="/avatars/jane-smith.jpg"
        alt="Jane Smith" />
    <x-slot:initials>JS</x-slot:initials>
</x-avatar>
```

### Initials Only (No Image)

```blade
<x-avatar>
    <x-slot:initials>AB</x-slot:initials>
</x-avatar>
```

### Different Sizes

```blade
{{-- Small avatar (32px) --}}
<x-avatar class="size-8">
    <x-slot:img
        src="/avatar.jpg"
        alt="User" />
    <x-slot:initials>JD</x-slot:initials>
</x-avatar>

{{-- Medium avatar (40px) --}}
<x-avatar class="size-10">
    <x-slot:img
        src="/avatar.jpg"
        alt="User" />
    <x-slot:initials>JD</x-slot:initials>
</x-avatar>

{{-- Large avatar (64px) --}}
<x-avatar class="size-16">
    <x-slot:img
        src="/avatar.jpg"
        alt="User" />
    <x-slot:initials>JD</x-slot:initials>
</x-avatar>

{{-- Extra large avatar (96px) --}}
<x-avatar class="size-24">
    <x-slot:img
        src="/avatar.jpg"
        alt="User" />
    <x-slot:initials>JD</x-slot:initials>
</x-avatar>
```

### User Profile Header

```blade
<div class="flex items-center gap-4">
    <x-avatar class="size-16">
        <x-slot:img
            src="{{ $user->avatar_url }}"
            alt="{{ $user->name }}" />
        <x-slot:initials>{{ $user->initials }}</x-slot:initials>
    </x-avatar>

    <div>
        <h2 class="text-xl font-bold">{{ $user->name }}</h2>
        <p class="text-muted-foreground text-sm">{{ $user->email }}</p>
    </div>
</div>
```

### Comment Section

```blade
<div class="space-y-4">
    @foreach ($comments as $comment)
        <div class="flex gap-3">
            <x-avatar>
                <x-slot:img
                    src="{{ $comment->user->avatar }}"
                    alt="{{ $comment->user->name }}" />
                <x-slot:initials>{{ $comment->user->initials }}</x-slot:initials>
            </x-avatar>

            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <span class="font-medium">{{ $comment->user->name }}</span>
                    <span class="text-muted-foreground text-xs">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="text-muted-foreground mt-1 text-sm">
                    {{ $comment->body }}
                </p>
            </div>
        </div>
    @endforeach
</div>
```

### Team Members Grid

```blade
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @foreach ($team as $member)
        <x-card>
            <x-slot:content>
                <div class="flex flex-col items-center text-center">
                    <x-avatar class="size-20">
                        <x-slot:img
                            src="{{ $member->photo }}"
                            alt="{{ $member->name }}" />
                        <x-slot:initials>{{ $member->initials }}</x-slot:initials>
                    </x-avatar>

                    <h3 class="mt-4 font-semibold">{{ $member->name }}</h3>
                    <p class="text-muted-foreground text-sm">{{ $member->role }}</p>

                    <div class="mt-4 flex gap-2">
                        <x-button
                            size="icon-sm"
                            variant="ghost">
                            @svg('lucide-mail', 'size-4')
                        </x-button>
                        <x-button
                            size="icon-sm"
                            variant="ghost">
                            @svg('lucide-linkedin', 'size-4')
                        </x-button>
                    </div>
                </div>
            </x-slot:content>
        </x-card>
    @endforeach
</div>
```

### User List with Avatars

```blade
<x-card>
    <x-slot:content class="p-0">
        <div class="divide-y">
            @foreach ($users as $user)
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center gap-3">
                        <x-avatar>
                            <x-slot:img
                                src="{{ $user->avatar }}"
                                alt="{{ $user->name }}" />
                            <x-slot:initials>{{ $user->initials }}</x-slot:initials>
                        </x-avatar>

                        <div>
                            <p class="font-medium">{{ $user->name }}</p>
                            <p class="text-muted-foreground text-sm">{{ $user->email }}</p>
                        </div>
                    </div>

                    <x-badge>{{ $user->role }}</x-badge>
                </div>
            @endforeach
        </div>
    </x-slot:content>
</x-card>
```

### Avatar Group (Stacked)

```blade
{{-- Stacked avatars showing multiple users --}}
<div class="flex -space-x-2">
    @foreach ($participants->take(3) as $participant)
        <x-avatar class="ring-background border-background size-10 border-2">
            <x-slot:img
                src="{{ $participant->avatar }}"
                alt="{{ $participant->name }}" />
            <x-slot:initials>{{ $participant->initials }}</x-slot:initials>
        </x-avatar>
    @endforeach

    @if ($participants->count() > 3)
        <x-avatar class="bg-muted ring-background border-background size-10 border-2">
            <x-slot:initials class="text-xs">+{{ $participants->count() - 3 }}</x-slot:initials>
        </x-avatar>
    @endif
</div>
```

### Chat Interface

```blade
<div class="space-y-4">
    @foreach ($messages as $message)
        <div class="{{ $message->isCurrentUser() ? 'flex-row-reverse' : '' }} flex gap-3">
            <x-avatar>
                <x-slot:img
                    src="{{ $message->user->avatar }}"
                    alt="{{ $message->user->name }}" />
                <x-slot:initials>{{ $message->user->initials }}</x-slot:initials>
            </x-avatar>

            <div class="{{ $message->isCurrentUser() ? 'items-end' : 'items-start' }} flex flex-col">
                <div class="{{ $message->isCurrentUser() ? 'bg-primary text-primary-foreground' : 'bg-muted' }} max-w-xs rounded-lg px-4 py-2">
                    <p class="text-sm">{{ $message->text }}</p>
                </div>
                <span class="text-muted-foreground mt-1 text-xs">
                    {{ $message->created_at->format('g:i A') }}
                </span>
            </div>
        </div>
    @endforeach
</div>
```

### Navigation User Menu

```blade
<x-dropdown>
    <x-slot:trigger>
        <x-button
            variant="ghost"
            class="gap-2 px-2">
            <x-avatar class="size-8">
                <x-slot:img
                    src="{{ auth()->user()->avatar }}"
                    alt="{{ auth()->user()->name }}" />
                <x-slot:initials>{{ auth()->user()->initials }}</x-slot:initials>
            </x-avatar>
            <span class="hidden md:inline">{{ auth()->user()->name }}</span>
        </x-button>
    </x-slot:trigger>

    <x-slot:content>
        <x-dropdown-item href="/profile">
            @svg('lucide-user', 'size-4')
            Profile
        </x-dropdown-item>
        <x-dropdown-item href="/settings">
            @svg('lucide-settings', 'size-4')
            Settings
        </x-dropdown-item>
        <x-separator class="my-1" />
        <x-dropdown-item href="/logout">
            @svg('lucide-log-out', 'size-4')
            Logout
        </x-dropdown-item>
    </x-slot:content>
</x-dropdown>
```

### Activity Feed

```blade
<div class="space-y-4">
    @foreach ($activities as $activity)
        <div class="flex gap-3">
            <x-avatar>
                <x-slot:img
                    src="{{ $activity->user->avatar }}"
                    alt="{{ $activity->user->name }}" />
                <x-slot:initials>{{ $activity->user->initials }}</x-slot:initials>
            </x-avatar>

            <div class="flex-1">
                <p class="text-sm">
                    <span class="font-medium">{{ $activity->user->name }}</span>
                    {{ $activity->description }}
                </p>
                <p class="text-muted-foreground text-xs">
                    {{ $activity->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    @endforeach
</div>
```

### Custom Background Colors

```blade
{{-- Primary color background --}}
<x-avatar>
    <x-slot:initials class="bg-primary text-primary-foreground">JD</x-slot:initials>
</x-avatar>

{{-- Destructive color background --}}
<x-avatar>
    <x-slot:initials class="bg-destructive text-destructive-foreground">AB</x-slot:initials>
</x-avatar>

{{-- Secondary color background --}}
<x-avatar>
    <x-slot:initials class="bg-secondary text-secondary-foreground">CD</x-slot:initials>
</x-avatar>

{{-- Accent color background --}}
<x-avatar>
    <x-slot:initials class="bg-accent text-accent-foreground">EF</x-slot:initials>
</x-avatar>
```

### With Status Indicator

```blade
<div class="relative inline-block">
    <x-avatar class="size-12">
        <x-slot:img
            src="{{ $user->avatar }}"
            alt="{{ $user->name }}" />
        <x-slot:initials>{{ $user->initials }}</x-slot:initials>
    </x-avatar>

    {{-- Online status indicator --}}
    <span class="ring-background absolute bottom-0 right-0 size-3 rounded-full bg-green-500 ring-2"></span>
</div>

{{-- Different status colors --}}
<div class="flex gap-4">
    {{-- Online --}}
    <div class="relative">
        <x-avatar>
            <x-slot:initials>ON</x-slot:initials>
        </x-avatar>
        <span class="ring-background absolute bottom-0 right-0 size-2.5 rounded-full bg-green-500 ring-2"></span>
    </div>

    {{-- Away --}}
    <div class="relative">
        <x-avatar>
            <x-slot:initials>AW</x-slot:initials>
        </x-avatar>
        <span class="ring-background absolute bottom-0 right-0 size-2.5 rounded-full bg-yellow-500 ring-2"></span>
    </div>

    {{-- Busy --}}
    <div class="relative">
        <x-avatar>
            <x-slot:initials>BS</x-slot:initials>
        </x-avatar>
        <span class="ring-background absolute bottom-0 right-0 size-2.5 rounded-full bg-red-500 ring-2"></span>
    </div>

    {{-- Offline --}}
    <div class="relative">
        <x-avatar>
            <x-slot:initials>OF</x-slot:initials>
        </x-avatar>
        <span class="ring-background bg-muted-foreground absolute bottom-0 right-0 size-2.5 rounded-full ring-2"></span>
    </div>
</div>
```

## Accessibility

### Alt Text

Always provide descriptive alt text for images:

```blade
{{-- Good: Descriptive alt text --}}
<x-avatar>
    <x-slot:img
        src="/avatar.jpg"
        alt="John Doe profile picture" />
</x-avatar>

{{-- Avoid: Missing or generic alt text --}}
<x-avatar>
    <x-slot:img
        src="/avatar.jpg"
        alt="avatar" />
</x-avatar>
```

### Meaningful Initials

Use proper user initials:

```blade
{{-- Good: Actual user initials --}}
<x-avatar>
    <x-slot:initials>{{ $user->first_name[0] }}{{ $user->last_name[0] }}</x-slot:initials>
</x-avatar>

{{-- Avoid: Generic or placeholder text --}}
<x-avatar>
    <x-slot:initials>??</x-slot:initials>
</x-avatar>
```

### Status Indicators

Add ARIA labels for status indicators:

```blade
<div class="relative">
    <x-avatar>
        <x-slot:img
            src="{{ $user->avatar }}"
            alt="{{ $user->name }}" />
        <x-slot:initials>{{ $user->initials }}</x-slot:initials>
    </x-avatar>
    <span
        class="ring-background absolute bottom-0 right-0 size-3 rounded-full bg-green-500 ring-2"
        aria-label="Online"
        role="status"></span>
</div>
```

## Best Practices

### Always Provide Fallback

```blade
{{-- Good: Image with fallback initials --}}
<x-avatar>
    <x-slot:img
        src="{{ $user->avatar }}"
        alt="{{ $user->name }}" />
    <x-slot:initials>{{ $user->initials }}</x-slot:initials>
</x-avatar>

{{-- Avoid: Image without fallback --}}
<x-avatar>
    <x-slot:img
        src="{{ $user->avatar }}"
        alt="{{ $user->name }}" />
</x-avatar>
```

### Use Consistent Sizes

```blade
{{-- Good: Consistent avatar sizes in lists --}}
<div class="space-y-2">
    @foreach ($users as $user)
        <div class="flex items-center gap-3">
            <x-avatar class="size-10">
                <x-slot:img
                    src="{{ $user->avatar }}"
                    alt="{{ $user->name }}" />
                <x-slot:initials>{{ $user->initials }}</x-slot:initials>
            </x-avatar>
            <span>{{ $user->name }}</span>
        </div>
    @endforeach
</div>
```

### Optimize Images

```blade
{{-- Good: Use optimized, appropriately sized images --}}
<x-avatar class="size-12">
    <x-slot:img
        src="{{ $user->avatar_thumb }}"
        {{-- Use thumbnail version, not full size --}}
        alt="{{ $user->name }}" />
    <x-slot:initials>{{ $user->initials }}</x-slot:initials>
</x-avatar>
```

### Handle Missing Data

```blade
{{-- Good: Graceful handling of missing data --}}
<x-avatar>
    @if ($user->avatar)
        <x-slot:img
            src="{{ $user->avatar }}"
            alt="{{ $user->name }}" />
    @endif

    <x-slot:initials>{{ $user->initials ?? 'U' }}</x-slot:initials>
</x-avatar>
```

## Technical Details

### Component Structure

```blade
<span
    x-cloak
    x-data="{ error: false }"
    data-slot="avatar"
    class="relative flex size-8 shrink-0 overflow-hidden rounded-full">
    {{-- Initials fallback --}}
    <span
        x-show="error"
        class="bg-muted absolute inset-0 z-10 flex size-full items-center justify-center rounded-full">
        {{ $initials }}
    </span>

    {{-- Image --}}
    <img
        x-on:error="error = true"
        x-on:load="error = false"
        x-show="!error"
        class="absolute inset-0 z-10 aspect-square size-full" />
</span>
```

### Alpine.js State Management

```javascript
// Component tracks error state
x-data="{ error: false }"

// Image load error handler
x-on:error="error = true"

// Image load success handler
x-on:load="error = false"

// Conditional visibility
x-show="!error"  // Show image when no error
x-show="error"   // Show initials when error
```

### CSS Classes

```css
/* Container */
relative flex size-8 shrink-0 overflow-hidden rounded-full

/* Initials */
absolute inset-0 z-10 bg-muted flex size-full items-center justify-center rounded-full

/* Image */
absolute inset-0 z-10 aspect-square size-full
```

### Data Attributes

- `data-slot="avatar"`: Component identifier for styling hooks
- `x-cloak`: Hides element until Alpine.js initializes

## Related Components

- [Badge](./badge.md) - Use with avatars to show user roles
- [Dropdown](./dropdown.md) - Create user menu with avatar trigger
- [Card](./card.md) - Display user profiles with avatars
- [Item](./item.md) - Use avatars in list items

## Common Patterns

### User Profile Card

```blade
<x-card>
    <x-slot:content>
        <div class="flex items-center gap-4">
            <x-avatar class="size-16">
                <x-slot:img
                    src="{{ $user->avatar }}"
                    alt="{{ $user->name }}" />
                <x-slot:initials>{{ $user->initials }}</x-slot:initials>
            </x-avatar>

            <div class="flex-1">
                <h3 class="font-semibold">{{ $user->name }}</h3>
                <p class="text-muted-foreground text-sm">{{ $user->email }}</p>
                <div class="mt-2 flex gap-2">
                    <x-badge size="sm">{{ $user->role }}</x-badge>
                    @if ($user->verified)
                        <x-badge
                            size="sm"
                            variant="success">
                            Verified
                        </x-badge>
                    @endif
                </div>
            </div>

            <x-button
                size="sm"
                variant="outline">
                View Profile
            </x-button>
        </div>
    </x-slot:content>
</x-card>
```

### Notification Item

```blade
<div class="hover:bg-accent flex items-start gap-3 rounded-lg p-3 transition-colors">
    <x-avatar>
        <x-slot:img
            src="{{ $notification->sender->avatar }}"
            alt="{{ $notification->sender->name }}" />
        <x-slot:initials>{{ $notification->sender->initials }}</x-slot:initials>
    </x-avatar>

    <div class="flex-1">
        <p class="text-sm">
            <span class="font-medium">{{ $notification->sender->name }}</span>
            {{ $notification->message }}
        </p>
        <p class="text-muted-foreground text-xs">{{ $notification->created_at->diffForHumans() }}</p>
    </div>

    @if (! $notification->read)
        <span class="bg-primary size-2 rounded-full"></span>
    @endif
</div>
```

### Collaborative Editing Indicator

```blade
<div class="border-border flex items-center gap-2 rounded-lg border p-2">
    <span class="text-muted-foreground text-sm">Currently editing:</span>

    <div class="flex -space-x-2">
        @foreach ($activeUsers as $user)
            <div
                class="relative"
                x-tooltip="{{ $user->name }}">
                <x-avatar class="ring-background size-8 ring-2">
                    <x-slot:img
                        src="{{ $user->avatar }}"
                        alt="{{ $user->name }}" />
                    <x-slot:initials>{{ $user->initials }}</x-slot:initials>
                </x-avatar>
                <span class="ring-background absolute bottom-0 right-0 size-2 animate-pulse rounded-full bg-green-500 ring-2"></span>
            </div>
        @endforeach
    </div>
</div>
```
