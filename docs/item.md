# Item

The Item component family provides a flexible system for building list items, card content, and other composite UI elements with consistent structure for headers, content, media, and actions.

## Overview

Items are reusable composition primitives for creating structured content blocks. They're perfect for lists, cards, feeds, settings panels, and any UI that requires consistent arrangement of titles, descriptions, media, and actions.

The Item family includes 10 components that work together:

- **`<x-item>`**: Main wrapper container
- **`<x-item-header>`**: Header section for top content
- **`<x-item-footer>`**: Footer section for bottom content
- **`<x-item-title>`**: Title text with medium font weight
- **`<x-item-description>`**: Muted description text with line clamping
- **`<x-item-content>`**: Flexible content area that grows to fill space
- **`<x-item-media>`**: Media section for images, icons, or avatars
- **`<x-item-actions>`**: Container for action buttons
- **`<x-item-group>`**: Wrapper for grouping multiple items with role="list"
- **`<x-item-separator>`**: Horizontal separator between items

## Component Specifications

### `<x-item>`

The main container that holds all item sub-components.

#### Props

##### `variant`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'outline'`, `'muted'`

Controls the visual style of the item.

- **`default`**: Transparent background, border transparent
- **`outline`**: Shows border with `border-border` color
- **`muted`**: Adds subtle muted background (`bg-muted/50`)

##### `size`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'sm'`

Controls the padding and spacing.

- **`default`**: 16px padding, 16px gap between children
- **`sm`**: 12px horizontal padding, 12px vertical padding, 10px gap

##### `tag`

**Type:** `string`
**Default:** `'div'`

The HTML element to render. Can be `'div'`, `'a'`, `'button'`, `'li'`, etc.

#### Features

- Flexbox layout with `items-center` and wrapping support
- Group context (`group/item`) for styling child elements
- Hover states for link items (`[a]:hover:bg-accent/50`)
- Focus states with visible ring
- Smooth transitions for interactions

---

### `<x-item-header>`

Header section that spans the full width and contains top content like titles or status indicators.

#### Features

- Full width (`basis-full`)
- Flexbox with `items-center` and `justify-between`
- 8px gap between children
- Uses `data-slot="item-header"` for styling hooks

---

### `<x-item-footer>`

Footer section that spans the full width for bottom content like timestamps or metadata.

#### Features

- Full width (`basis-full`)
- Flexbox with `items-center` and `justify-between`
- 8px gap between children
- Uses `data-slot="item-footer"` for styling hooks

---

### `<x-item-title>`

Title text component with medium font weight.

#### Features

- Medium font weight (`font-medium`)
- Small text size (`text-sm`)
- Snug line height (`leading-snug`)
- Flexbox with `items-center` and 8px gap for icons
- Width fits content (`w-fit`)
- Uses `data-slot="item-title"` for styling hooks

---

### `<x-item-description>`

Description text component with muted styling and automatic line clamping.

#### Features

- Muted foreground color
- Line clamp 2 lines by default (`line-clamp-2`)
- Small text size (`text-sm`)
- Normal font weight
- Balanced text wrapping
- Link styles: underline on hover, primary color
- Uses `data-slot="item-description"` for styling hooks

---

### `<x-item-content>`

Flexible content area that grows to fill available space.

#### Features

- Flexbox column layout
- Flex-1 to grow and fill space
- 4px gap between children
- Adjacent content slots use `flex-none`
- Uses `data-slot="item-content"` for styling hooks

---

### `<x-item-media>`

Media section for images, icons, avatars, or other visual elements.

#### Props

##### `variant`

**Type:** `string`
**Default:** `'default'`
**Options:** `'default'`, `'image'`, `'icon'`

Controls the media styling.

- **`default`**: Transparent background, no sizing
- **`image`**: 40px square, rounded corners, image covers container
- **`icon`**: 32px square, border, muted background, contains 16px icon

#### Features

- Flexbox centering for content
- Shrink 0 to maintain size
- Icons are pointer-events-none
- Self-aligns to start when description is present
- Slight vertical offset when description exists
- Uses `data-slot="item-media"` for styling hooks

---

### `<x-item-actions>`

Container for action buttons or interactive elements.

#### Features

- Flexbox row layout
- 8px gap between action buttons
- Uses `data-slot="item-actions"` for styling hooks

---

### `<x-item-group>`

Wrapper component for grouping multiple items with proper list semantics.

#### Features

- Semantic `role="list"` attribute
- Flexbox column layout
- Group context (`group/item-group`) for advanced styling
- Uses `data-slot="item-group"` for styling hooks

---

### `<x-item-separator>`

Horizontal separator between items, wraps the `<x-separator>` component.

#### Features

- Horizontal orientation
- No vertical margin (`my-0`)
- Uses `data-slot="item-separator"` for styling hooks

## Usage Examples

### Simple List Item

```blade
<x-item-group>
    <x-item>
        <x-item-content>
            <x-item-title>Inbox</x-item-title>
            <x-item-description>3 new messages</x-item-description>
        </x-item-content>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>Archive</x-item-title>
            <x-item-description>128 archived items</x-item-description>
        </x-item-content>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>Trash</x-item-title>
            <x-item-description>12 items in trash</x-item-description>
        </x-item-content>
    </x-item>
</x-item-group>
```

### Card with Header and Footer

```blade
<x-item variant="outline">
    <x-item-header>
        <x-item-title>Project Update</x-item-title>
        <x-badge variant="success">Active</x-badge>
    </x-item-header>

    <x-item-content>
        <x-item-description>The new feature has been successfully deployed to production. All systems are operational and performing well.</x-item-description>
    </x-item-content>

    <x-item-footer>
        <span class="text-muted-foreground text-xs">2 hours ago</span>
        <x-item-actions>
            <x-button
                variant="ghost"
                size="sm">
                View
            </x-button>
            <x-button
                variant="ghost"
                size="sm">
                Share
            </x-button>
        </x-item-actions>
    </x-item-footer>
</x-item>
```

### Item with Media (Avatar/Image)

```blade
<x-item-group>
    <x-item>
        <x-item-media variant="image">
            <img
                src="/avatars/john.jpg"
                alt="John Doe" />
        </x-item-media>

        <x-item-content>
            <x-item-title>John Doe</x-item-title>
            <x-item-description>Senior Developer at Acme Corp</x-item-description>
        </x-item-content>

        <x-item-actions>
            <x-button
                variant="outline"
                size="sm">
                Follow
            </x-button>
        </x-item-actions>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-media variant="image">
            <img
                src="/avatars/jane.jpg"
                alt="Jane Smith" />
        </x-item-media>

        <x-item-content>
            <x-item-title>Jane Smith</x-item-title>
            <x-item-description>Product Manager at Tech Inc</x-item-description>
        </x-item-content>

        <x-item-actions>
            <x-button
                variant="outline"
                size="sm">
                Follow
            </x-button>
        </x-item-actions>
    </x-item>
</x-item-group>
```

### Item with Icon Media

```blade
<x-item-group>
    <x-item>
        <x-item-media variant="icon">
            @svg('mog-bell')
        </x-item-media>

        <x-item-content>
            <x-item-title>Notifications</x-item-title>
            <x-item-description>Manage your notification preferences</x-item-description>
        </x-item-content>

        @svg('mog-chevron-right', 'text-muted-foreground size-4')
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-media variant="icon">
            @svg('mog-shield')
        </x-item-media>

        <x-item-content>
            <x-item-title>Privacy & Security</x-item-title>
            <x-item-description>Control your privacy settings</x-item-description>
        </x-item-content>

        @svg('mog-chevron-right', 'text-muted-foreground size-4')
    </x-item>
</x-item-group>
```

### Item with Actions

```blade
<x-item-group>
    <x-item>
        <x-item-content>
            <x-item-title>Delete Account</x-item-title>
            <x-item-description>Permanently delete your account and all associated data</x-item-description>
        </x-item-content>

        <x-item-actions>
            <x-button
                variant="destructive"
                size="sm">
                Delete
            </x-button>
        </x-item-actions>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>Export Data</x-item-title>
            <x-item-description>Download a copy of your personal data</x-item-description>
        </x-item-content>

        <x-item-actions>
            <x-button
                variant="outline"
                size="sm">
                @svg('mog-download')
                Export
            </x-button>
        </x-item-actions>
    </x-item>
</x-item-group>
```

### Grouped Items with Variants

```blade
<x-item-group>
    <x-item variant="muted">
        <x-item-content>
            <x-item-title>Today</x-item-title>
        </x-item-content>
    </x-item>

    <x-item>
        <x-item-content>
            <x-item-title>Morning standup meeting</x-item-title>
            <x-item-description>9:00 AM - 9:30 AM</x-item-description>
        </x-item-content>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>Client presentation</x-item-title>
            <x-item-description>2:00 PM - 3:00 PM</x-item-description>
        </x-item-content>
    </x-item>

    <x-item
        variant="muted"
        class="mt-4">
        <x-item-content>
            <x-item-title>Tomorrow</x-item-title>
        </x-item-content>
    </x-item>

    <x-item>
        <x-item-content>
            <x-item-title>Code review session</x-item-title>
            <x-item-description>10:00 AM - 11:00 AM</x-item-description>
        </x-item-content>
    </x-item>
</x-item-group>
```

### Feed/Timeline Items

```blade
<x-item-group>
    <x-item>
        <x-item-media variant="image">
            <img
                src="/avatars/sarah.jpg"
                alt="Sarah Wilson" />
        </x-item-media>

        <x-item-content>
            <x-item-header>
                <x-item-title>Sarah Wilson</x-item-title>
                <span class="text-muted-foreground text-xs">5m ago</span>
            </x-item-header>

            <x-item-description>Just deployed the new authentication system! 🚀 Everything is working smoothly in production.</x-item-description>

            <x-item-footer>
                <x-item-actions>
                    <x-button
                        variant="ghost"
                        size="sm">
                        @svg('mog-heart')
                        12
                    </x-button>
                    <x-button
                        variant="ghost"
                        size="sm">
                        @svg('mog-message-circle')
                        3
                    </x-button>
                    <x-button
                        variant="ghost"
                        size="sm">
                        @svg('mog-share')
                    </x-button>
                </x-item-actions>
            </x-item-footer>
        </x-item-content>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-media variant="image">
            <img
                src="/avatars/mike.jpg"
                alt="Mike Chen" />
        </x-item-media>

        <x-item-content>
            <x-item-header>
                <x-item-title>Mike Chen</x-item-title>
                <span class="text-muted-foreground text-xs">1h ago</span>
            </x-item-header>

            <x-item-description>Working on the new dashboard design. Would love to get some feedback from the team!</x-item-description>

            <x-item-footer>
                <x-item-actions>
                    <x-button
                        variant="ghost"
                        size="sm">
                        @svg('mog-heart')
                        24
                    </x-button>
                    <x-button
                        variant="ghost"
                        size="sm">
                        @svg('mog-message-circle')
                        8
                    </x-button>
                    <x-button
                        variant="ghost"
                        size="sm">
                        @svg('mog-share')
                    </x-button>
                </x-item-actions>
            </x-item-footer>
        </x-item-content>
    </x-item>
</x-item-group>
```

### Settings List Items

```blade
<x-item-group>
    <x-item>
        <x-item-media variant="icon">
            @svg('mog-palette')
        </x-item-media>

        <x-item-content>
            <x-item-title>Theme</x-item-title>
            <x-item-description>Choose your preferred color scheme</x-item-description>
        </x-item-content>

        <x-select>
            <option value="light">Light</option>
            <option value="dark">Dark</option>
            <option value="system">System</option>
        </x-select>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-media variant="icon">
            @svg('mog-globe')
        </x-item-media>

        <x-item-content>
            <x-item-title>Language</x-item-title>
            <x-item-description>Select your display language</x-item-description>
        </x-item-content>

        <x-select>
            <option value="en">English</option>
            <option value="es">Español</option>
            <option value="fr">Français</option>
        </x-select>
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-media variant="icon">
            @svg('mog-bell')
        </x-item-media>

        <x-item-content>
            <x-item-title>Push Notifications</x-item-title>
            <x-item-description>Receive notifications on this device</x-item-description>
        </x-item-content>

        <x-checkbox />
    </x-item>
</x-item-group>
```

### Product List Items

```blade
<x-item-group>
    <x-item variant="outline">
        <x-item-media variant="image">
            <img
                src="/products/laptop.jpg"
                alt="Laptop" />
        </x-item-media>

        <x-item-content>
            <x-item-title>MacBook Pro 14"</x-item-title>
            <x-item-description>Apple M2 Pro chip, 16GB RAM, 512GB SSD</x-item-description>
        </x-item-content>

        <x-item-content>
            <div class="text-lg font-semibold">$1,999</div>
            <x-badge variant="success">In Stock</x-badge>
        </x-item-content>

        <x-item-actions>
            <x-button
                variant="outline"
                size="icon-sm">
                @svg('mog-heart')
            </x-button>
            <x-button size="sm">
                @svg('mog-shopping-cart')
                Add to Cart
            </x-button>
        </x-item-actions>
    </x-item>

    <x-item
        variant="outline"
        class="mt-4">
        <x-item-media variant="image">
            <img
                src="/products/keyboard.jpg"
                alt="Keyboard" />
        </x-item-media>

        <x-item-content>
            <x-item-title>Magic Keyboard</x-item-title>
            <x-item-description>Wireless keyboard with Touch ID</x-item-description>
        </x-item-content>

        <x-item-content>
            <div class="text-lg font-semibold">$149</div>
            <x-badge variant="success">In Stock</x-badge>
        </x-item-content>

        <x-item-actions>
            <x-button
                variant="outline"
                size="icon-sm">
                @svg('mog-heart')
            </x-button>
            <x-button size="sm">
                @svg('mog-shopping-cart')
                Add to Cart
            </x-button>
        </x-item-actions>
    </x-item>
</x-item-group>
```

### Interactive List Items (Links)

```blade
<x-item-group>
    <x-item
        tag="a"
        href="/profile">
        <x-item-media variant="icon">
            @svg('mog-user')
        </x-item-media>

        <x-item-content>
            <x-item-title>Profile</x-item-title>
            <x-item-description>View and edit your profile</x-item-description>
        </x-item-content>

        @svg('mog-chevron-right', 'text-muted-foreground size-4')
    </x-item>

    <x-item-separator />

    <x-item
        tag="a"
        href="/settings">
        <x-item-media variant="icon">
            @svg('mog-settings')
        </x-item-media>

        <x-item-content>
            <x-item-title>Settings</x-item-title>
            <x-item-description>Manage your account settings</x-item-description>
        </x-item-content>

        @svg('mog-chevron-right', 'text-muted-foreground size-4')
    </x-item>

    <x-item-separator />

    <x-item
        tag="a"
        href="/help">
        <x-item-media variant="icon">
            @svg('mog-help-circle')
        </x-item-media>

        <x-item-content>
            <x-item-title>Help & Support</x-item-title>
            <x-item-description>Get help and support</x-item-description>
        </x-item-content>

        @svg('mog-chevron-right', 'text-muted-foreground size-4')
    </x-item>
</x-item-group>
```

## Composition Patterns

### Layout Recommendations

**Horizontal Layout (Default)**

Items use flexbox with `items-center` by default, creating a horizontal layout. This is ideal for:

- List items with media and content side-by-side
- Action items with buttons on the right
- Navigation items with chevron indicators

**Vertical Layout with Header/Footer**

Using `<x-item-header>` and `<x-item-footer>` creates sections that span the full width (`basis-full`), forcing vertical stacking:

```blade
<x-item>
    <x-item-header>
        {{-- Spans full width --}}
    </x-item-header>

    {{-- Content wraps to next row --}}

    <x-item-footer>
        {{-- Spans full width --}}
    </x-item-footer>
</x-item>
```

### Responsive Considerations

**Media Sections**

- Media components use `shrink-0` to maintain size
- Images use `object-cover` for consistent aspect ratios
- Icon variants have fixed sizes (32px for icons, 40px for images)

**Content Flexibility**

- `<x-item-content>` uses `flex-1` to grow and fill available space
- Multiple content sections can be used; the first grows, others use `flex-none`
- Description text uses `line-clamp-2` to prevent overflow

**Small Size Variant**

For compact UIs, use the `sm` size:

```blade
<x-item size="sm">
    {{-- Reduced padding and gaps --}}
</x-item>
```

### Best Practices

1. **Use Semantic HTML**

```blade
{{-- Lists should use item-group --}}
<x-item-group>
    <x-item tag="li">...</x-item>
</x-item-group>

{{-- Links should use tag="a" --}}
<x-item
    tag="a"
    href="/profile">
    ...
</x-item>

{{-- Buttons should use tag="button" --}}
<x-item
    tag="button"
    wire:click="select">
    ...
</x-item>
```

2. **Maintain Visual Hierarchy**

```blade
{{-- Good: Clear hierarchy --}}
<x-item>
    <x-item-media variant="icon">...</x-item-media>
    <x-item-content>
        <x-item-title>Primary Info</x-item-title>
        <x-item-description>Secondary Info</x-item-description>
    </x-item-content>
</x-item>
```

3. **Use Separators Wisely**

```blade
{{-- Separators create visual grouping --}}
<x-item-group>
    <x-item>Item 1</x-item>
    <x-item-separator />
    <x-item>Item 2</x-item>
    <x-item-separator />
    <x-item>Item 3</x-item>
</x-item-group>
```

4. **Leverage Data Slots for Custom Styling**

All components have `data-slot` attributes for advanced styling:

```blade
{{-- Custom styles targeting slots --}}
<x-item class="[&_[data-slot=item-media]]:size-12 [&_[data-slot=item-title]]:text-lg">...</x-item>
```

## Integration with Other Components

### With Avatar Component

```blade
<x-item>
    <x-item-media>
        <x-avatar
            src="/avatars/user.jpg"
            alt="User" />
    </x-item-media>

    <x-item-content>
        <x-item-title>User Name</x-item-title>
        <x-item-description>
            user
            @example.com
        </x-item-description>
    </x-item-content>
</x-item>
```

### With Badge Component

```blade
<x-item>
    <x-item-content>
        <x-item-title>
            Notifications
            <x-badge variant="destructive">12</x-badge>
        </x-item-title>
        <x-item-description>You have unread messages</x-item-description>
    </x-item-content>
</x-item>
```

### With Button Component

```blade
<x-item>
    <x-item-content>
        <x-item-title>Newsletter</x-item-title>
        <x-item-description>Subscribe to our weekly newsletter</x-item-description>
    </x-item-content>

    <x-item-actions>
        <x-button
            variant="outline"
            size="sm">
            Subscribe
        </x-button>
    </x-item-actions>
</x-item>
```

### With Checkbox and Radio Components

```blade
<x-item-group>
    <x-item tag="label">
        <x-checkbox wire:model="notifications" />
        <x-item-content>
            <x-item-title>Email Notifications</x-item-title>
            <x-item-description>Receive updates via email</x-item-description>
        </x-item-content>
    </x-item>

    <x-item-separator />

    <x-item tag="label">
        <x-checkbox wire:model="sms" />
        <x-item-content>
            <x-item-title>SMS Notifications</x-item-title>
            <x-item-description>Receive updates via text message</x-item-description>
        </x-item-content>
    </x-item>
</x-item-group>
```

### With Input Component

```blade
<x-item-group>
    <x-item>
        <x-item-content>
            <x-item-title>Username</x-item-title>
            <x-item-description>Choose a unique username</x-item-description>
        </x-item-content>
        <x-input
            wire:model="username"
            placeholder="johndoe" />
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>Email</x-item-title>
            <x-item-description>Your primary email address</x-item-description>
        </x-item-content>
        <x-input
            type="email"
            wire:model="email" />
    </x-item>
</x-item-group>
```

## Livewire Compatibility

Items work seamlessly with Livewire for dynamic interactions:

### Dynamic Lists

```blade
<x-item-group>
    @foreach ($users as $user)
        <x-item wire:key="user-{{ $user->id }}">
            <x-item-media variant="image">
                <img
                    src="{{ $user->avatar }}"
                    alt="{{ $user->name }}" />
            </x-item-media>

            <x-item-content>
                <x-item-title>{{ $user->name }}</x-item-title>
                <x-item-description>{{ $user->email }}</x-item-description>
            </x-item-content>

            <x-item-actions>
                <x-button
                    variant="outline"
                    size="sm"
                    wire:click="followUser({{ $user->id }})">
                    Follow
                </x-button>
            </x-item-actions>
        </x-item>

        @if (! $loop->last)
            <x-item-separator />
        @endif
    @endforeach
</x-item-group>
```

### Interactive Selection

```blade
<x-item-group>
    @foreach ($options as $option)
        <x-item
            tag="button"
            wire:click="selectOption('{{ $option->id }}')"
            variant="{{ $selectedOption === $option->id ? 'muted' : 'default' }}">
            <x-item-media variant="icon">
                @svg($option->icon)
            </x-item-media>

            <x-item-content>
                <x-item-title>{{ $option->title }}</x-item-title>
                <x-item-description>{{ $option->description }}</x-item-description>
            </x-item-content>

            @if ($selectedOption === $option->id)
                @svg('mog-check', 'text-primary size-5')
            @endif
        </x-item>

        @if (! $loop->last)
            <x-item-separator />
        @endif
    @endforeach
</x-item-group>
```

## Accessibility

### Semantic HTML

Use appropriate semantic HTML for different contexts:

```blade
{{-- List semantics --}}
<x-item-group role="list">
    <x-item role="listitem">...</x-item>
</x-item-group>

{{-- Link semantics --}}
<x-item
    tag="a"
    href="/profile"
    aria-label="View profile">
    ...
</x-item>

{{-- Button semantics --}}
<x-item
    tag="button"
    aria-label="Select option">
    ...
</x-item>
```

### ARIA Labels

Provide descriptive labels for interactive elements:

```blade
<x-item
    tag="button"
    aria-label="Edit profile settings">
    <x-item-media variant="icon">
        @svg('mog-edit')
    </x-item-media>
    <x-item-content>
        <x-item-title>Edit Profile</x-item-title>
    </x-item-content>
</x-item>
```

### Focus States

Items include visible focus states with focus rings:

```blade
<x-item tag="button">
    {{-- Automatically includes focus-visible:border-ring and focus-visible:ring styles --}}
</x-item>
```

## Dark Mode

All item components include dark mode support through Tailwind's dark mode classes. Colors automatically adjust based on the theme:

```blade
{{-- Automatically adapts to dark mode --}}
<x-item variant="outline">
    <x-item-content>
        <x-item-title>Title</x-item-title>
        <x-item-description>Description</x-item-description>
    </x-item-content>
</x-item>
```

## Related Components

- [Avatar](./avatar.md) - User profile images for item media
- [Badge](./badge.md) - Status indicators in items
- [Button](./button.md) - Action buttons in item actions
- [Checkbox](./checkbox.md) - Selection controls in items
- [Separator](./separator.md) - Visual separators between items

## Common Patterns

### Contact List

```blade
<x-item-group>
    @foreach ($contacts as $contact)
        <x-item
            tag="a"
            href="/contacts/{{ $contact->id }}">
            <x-item-media variant="image">
                <img
                    src="{{ $contact->avatar }}"
                    alt="{{ $contact->name }}" />
            </x-item-media>

            <x-item-content>
                <x-item-title>{{ $contact->name }}</x-item-title>
                <x-item-description>{{ $contact->email }}</x-item-description>
            </x-item-content>

            @svg('mog-chevron-right', 'text-muted-foreground size-4')
        </x-item>

        @if (! $loop->last)
            <x-item-separator />
        @endif
    @endforeach
</x-item-group>
```

### Notification Feed

```blade
<x-item-group>
    @foreach ($notifications as $notification)
        <x-item>
            <x-item-media variant="icon">
                @svg($notification->icon)
            </x-item-media>

            <x-item-content>
                <x-item-title>{{ $notification->title }}</x-item-title>
                <x-item-description>{{ $notification->message }}</x-item-description>
            </x-item-content>

            <span class="text-muted-foreground whitespace-nowrap text-xs">
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </x-item>

        @if (! $loop->last)
            <x-item-separator />
        @endif
    @endforeach
</x-item-group>
```

### Settings Panel

```blade
<x-item-group>
    <x-item>
        <x-item-content>
            <x-item-title>Two-Factor Authentication</x-item-title>
            <x-item-description>Add an extra layer of security to your account</x-item-description>
        </x-item-content>

        <x-checkbox wire:model.live="twoFactor" />
    </x-item>

    <x-item-separator />

    <x-item>
        <x-item-content>
            <x-item-title>Session Timeout</x-item-title>
            <x-item-description>Automatically log out after period of inactivity</x-item-description>
        </x-item-content>

        <x-select wire:model.live="sessionTimeout">
            <option value="15">15 minutes</option>
            <option value="30">30 minutes</option>
            <option value="60">1 hour</option>
            <option value="never">Never</option>
        </x-select>
    </x-item>
</x-item-group>
```
