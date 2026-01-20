# Skeleton

The Skeleton component provides animated loading placeholders that mimic the shape of content being loaded. It creates a better user experience by showing the structure of content before it's ready, reducing perceived loading time.

## Overview

Skeletons are visual placeholders that show where content will appear. They provide better UX than spinners alone by:

- Showing the structure and layout of content before it loads
- Reducing perceived loading time
- Preventing layout shifts when content appears
- Providing visual continuity during loading states

### When to Use

- **Content loading**: Show structure while fetching data
- **Image loading**: Placeholder while images download
- **List loading**: Indicate list items are being fetched
- **Card loading**: Show card structure during async operations
- **Lazy loading**: Placeholder for content loaded on scroll

### Skeleton vs Spinner

- **Skeleton**: Better for content with predictable structure (lists, cards, profiles)
- **Spinner**: Better for actions with unknown duration (button clicks, form submissions)

## Features

### Animated Pulse

The skeleton uses a subtle pulse animation:

- Smooth fade in/out effect
- Indicates active loading state
- Gentle animation that doesn't distract

### Flexible Sizing

Skeletons adapt to any size:

- Width and height controlled by Tailwind classes
- Can mimic text, images, buttons, or entire layouts
- Responsive sizing support

## Usage Examples

### Basic Skeleton

```blade
{{-- Rectangle placeholder --}}
<x-skeleton class="h-4 w-full" />

{{-- Square placeholder --}}
<x-skeleton class="size-12" />

{{-- Circle placeholder (for avatars) --}}
<x-skeleton class="size-12 rounded-full" />
```

### Text Placeholders

```blade
{{-- Single line of text --}}
<x-skeleton class="h-4 w-full" />

{{-- Shorter line --}}
<x-skeleton class="h-4 w-3/4" />

{{-- Heading placeholder --}}
<x-skeleton class="h-8 w-1/2" />

{{-- Paragraph placeholder --}}
<div class="space-y-2">
    <x-skeleton class="h-4 w-full" />
    <x-skeleton class="h-4 w-full" />
    <x-skeleton class="h-4 w-4/5" />
</div>
```

### Avatar Placeholders

```blade
{{-- Small avatar --}}
<x-skeleton class="size-8 rounded-full" />

{{-- Default avatar --}}
<x-skeleton class="size-10 rounded-full" />

{{-- Large avatar --}}
<x-skeleton class="size-16 rounded-full" />

{{-- Avatar with text --}}
<div class="flex items-center gap-3">
    <x-skeleton class="size-10 rounded-full" />
    <div class="space-y-2">
        <x-skeleton class="h-4 w-32" />
        <x-skeleton class="h-3 w-24" />
    </div>
</div>
```

### Card Skeleton

```blade
<x-card>
    <x-card-header>
        <x-skeleton class="h-6 w-1/3" />
        <x-skeleton class="mt-2 h-4 w-2/3" />
    </x-card-header>
    <x-card-content>
        <x-skeleton class="h-48 w-full" />
        <div class="mt-4 space-y-2">
            <x-skeleton class="h-4 w-full" />
            <x-skeleton class="h-4 w-full" />
            <x-skeleton class="h-4 w-3/4" />
        </div>
    </x-card-content>
    <x-card-footer>
        <x-skeleton class="h-10 w-24" />
    </x-card-footer>
</x-card>
```

### List Skeleton

```blade
<div class="space-y-4">
    @for ($i = 0; $i < 5; $i++)
        <div class="flex items-center gap-4">
            <x-skeleton class="size-12 rounded-full" />
            <div class="flex-1 space-y-2">
                <x-skeleton class="h-4 w-1/4" />
                <x-skeleton class="h-3 w-1/2" />
            </div>
        </div>
    @endfor
</div>
```

### Item Group Skeleton

```blade
<x-item-group>
    @for ($i = 0; $i < 3; $i++)
        <x-item>
            <x-item-media>
                <x-skeleton class="size-10 rounded-full" />
            </x-item-media>

            <x-item-content>
                <x-skeleton class="h-4 w-32" />
                <x-skeleton class="mt-1 h-3 w-48" />
            </x-item-content>
        </x-item>

        @if (! $loop->last)
            <x-item-separator />
        @endif
    @endfor
</x-item-group>
```

### Table Skeleton

```blade
<x-table>
    <thead>
        <tr>
            <x-th>Name</x-th>
            <x-th>Email</x-th>
            <x-th>Status</x-th>
            <x-th>Actions</x-th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 5; $i++)
            <x-tr>
                <x-td>
                    <div class="flex items-center gap-3">
                        <x-skeleton class="size-8 rounded-full" />
                        <x-skeleton class="h-4 w-32" />
                    </div>
                </x-td>
                <x-td>
                    <x-skeleton class="h-4 w-48" />
                </x-td>
                <x-td>
                    <x-skeleton class="h-6 w-16 rounded-full" />
                </x-td>
                <x-td>
                    <x-skeleton class="h-8 w-20" />
                </x-td>
            </x-tr>
        @endfor
    </tbody>
</x-table>
```

### Image Placeholder

```blade
{{-- Card image --}}
<x-skeleton class="h-48 w-full" />

{{-- Square image --}}
<x-skeleton class="aspect-square w-full" />

{{-- Landscape image --}}
<x-skeleton class="aspect-video w-full" />

{{-- Portrait image --}}
<x-skeleton class="aspect-[3/4] w-full" />
```

### Form Skeleton

```blade
<div class="space-y-4">
    <div>
        <x-skeleton class="mb-2 h-4 w-20" />
        <x-skeleton class="h-10 w-full" />
    </div>

    <div>
        <x-skeleton class="mb-2 h-4 w-24" />
        <x-skeleton class="h-10 w-full" />
    </div>

    <div>
        <x-skeleton class="mb-2 h-4 w-28" />
        <x-skeleton class="h-24 w-full" />
    </div>

    <x-skeleton class="h-10 w-32" />
</div>
```

### Profile Skeleton

```blade
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center gap-4">
        <x-skeleton class="size-20 rounded-full" />
        <div class="flex-1 space-y-2">
            <x-skeleton class="h-6 w-48" />
            <x-skeleton class="h-4 w-64" />
        </div>
        <x-skeleton class="h-10 w-24" />
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4">
        @for ($i = 0; $i < 3; $i++)
            <div class="space-y-2 text-center">
                <x-skeleton class="mx-auto h-8 w-16" />
                <x-skeleton class="mx-auto h-4 w-20" />
            </div>
        @endfor
    </div>

    {{-- Bio --}}
    <div class="space-y-2">
        <x-skeleton class="h-4 w-full" />
        <x-skeleton class="h-4 w-full" />
        <x-skeleton class="h-4 w-2/3" />
    </div>
</div>
```

### Dashboard Skeleton

```blade
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <x-skeleton class="h-8 w-64" />
        <x-skeleton class="h-10 w-32" />
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        @for ($i = 0; $i < 4; $i++)
            <x-card>
                <x-card-content class="space-y-2">
                    <x-skeleton class="h-4 w-24" />
                    <x-skeleton class="h-8 w-20" />
                    <x-skeleton class="h-3 w-32" />
                </x-card-content>
            </x-card>
        @endfor
    </div>

    {{-- Chart --}}
    <x-card>
        <x-card-header>
            <x-skeleton class="h-6 w-48" />
        </x-card-header>
        <x-card-content>
            <x-skeleton class="h-64 w-full" />
        </x-card-content>
    </x-card>
</div>
```

### Conditional Loading

```blade
@if ($loading)
    {{-- Skeleton state --}}
    <div class="space-y-4">
        @for ($i = 0; $i < 3; $i++)
            <div class="flex items-center gap-4">
                <x-skeleton class="size-12 rounded-full" />
                <div class="flex-1 space-y-2">
                    <x-skeleton class="h-4 w-1/3" />
                    <x-skeleton class="h-3 w-1/2" />
                </div>
            </div>
        @endfor
    </div>
@else
    {{-- Actual content --}}
    @foreach ($items as $item)
        <div class="flex items-center gap-4">
            <img
                src="{{ $item->avatar }}"
                class="size-12 rounded-full" />
            <div>
                <div class="font-medium">{{ $item->name }}</div>
                <div class="text-muted-foreground text-sm">{{ $item->email }}</div>
            </div>
        </div>
    @endforeach
@endif
```

### Livewire Loading States

```blade
<div>
    {{-- Show skeleton while loading --}}
    <div
        wire:loading
        class="space-y-4">
        @for ($i = 0; $i < 3; $i++)
            <x-skeleton class="h-20 w-full" />
        @endfor
    </div>

    {{-- Content hidden during loading --}}
    <div wire:loading.remove>
        @foreach ($posts as $post)
            <x-card>
                <x-card-content>
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </x-card-content>
            </x-card>
        @endforeach
    </div>
</div>
```

### Grid Skeleton

```blade
<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    @for ($i = 0; $i < 6; $i++)
        <div class="space-y-3">
            <x-skeleton class="aspect-video w-full" />
            <x-skeleton class="h-5 w-3/4" />
            <x-skeleton class="h-4 w-full" />
            <x-skeleton class="h-4 w-2/3" />
        </div>
    @endfor
</div>
```

### Product Card Skeleton

```blade
<div class="grid grid-cols-1 gap-4 md:grid-cols-4">
    @for ($i = 0; $i < 8; $i++)
        <x-card>
            <x-skeleton class="aspect-square w-full" />
            <x-card-content class="space-y-2">
                <x-skeleton class="h-5 w-3/4" />
                <x-skeleton class="h-4 w-1/2" />
                <div class="mt-4 flex items-center justify-between">
                    <x-skeleton class="h-6 w-20" />
                    <x-skeleton class="h-9 w-24" />
                </div>
            </x-card-content>
        </x-card>
    @endfor
</div>
```

## Best Practices

### Match Content Structure

```blade
{{-- Good: Skeleton matches content structure --}}
@if ($loading)
    <div class="flex items-center gap-3">
        <x-skeleton class="size-10 rounded-full" />
        <div class="space-y-2">
            <x-skeleton class="h-4 w-32" />
            <x-skeleton class="h-3 w-24" />
        </div>
    </div>
@else
    <div class="flex items-center gap-3">
        <img
            src="{{ $user->avatar }}"
            class="size-10 rounded-full" />
        <div>
            <div class="font-medium">{{ $user->name }}</div>
            <div class="text-muted-foreground text-sm">{{ $user->email }}</div>
        </div>
    </div>
@endif
```

### Use Appropriate Shapes

```blade
{{-- Text lines --}}
<x-skeleton class="h-4 w-full rounded-md" />

{{-- Buttons --}}
<x-skeleton class="h-10 w-24 rounded-md" />

{{-- Avatars --}}
<x-skeleton class="size-10 rounded-full" />

{{-- Images --}}
<x-skeleton class="aspect-video w-full rounded-lg" />
```

### Vary Line Widths

```blade
{{-- Good: Varied widths look natural --}}
<div class="space-y-2">
    <x-skeleton class="h-4 w-full" />
    <x-skeleton class="h-4 w-11/12" />
    <x-skeleton class="h-4 w-4/5" />
</div>

{{-- Avoid: All same width looks artificial --}}
<div class="space-y-2">
    <x-skeleton class="h-4 w-full" />
    <x-skeleton class="h-4 w-full" />
    <x-skeleton class="h-4 w-full" />
</div>
```

### Limit Number of Skeletons

```blade
{{-- Good: Show 3-5 skeleton items --}}
@for ($i = 0; $i < 5; $i++)
    <x-skeleton class="h-20 w-full" />
@endfor

{{-- Avoid: Too many skeletons can be overwhelming --}}
@for ($i = 0; $i < 50; $i++)
    <x-skeleton class="h-20 w-full" />
@endfor
```

## Accessibility

### Avoid Announcing Skeletons

Skeletons are purely visual and should not be announced to screen readers:

```blade
{{-- Good: No ARIA attributes needed --}}
<x-skeleton class="h-4 w-full" />

{{-- If needed, mark as decorative --}}
<x-skeleton
    class="h-4 w-full"
    aria-hidden="true" />
```

### Provide Loading Context

```blade
<div>
    {{-- Screen reader announcement --}}
    <div
        class="sr-only"
        role="status"
        aria-live="polite">
        @if ($loading)
            Loading content...
        @endif
    </div>

    {{-- Visual skeleton --}}
    @if ($loading)
        <x-skeleton class="h-20 w-full" />
    @endif
</div>
```

## Technical Details

### Animation

The skeleton uses CSS animation for the pulse effect:

```css
@keyframes pulse {
    0%,
    100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
```

### Dark Mode

Skeletons automatically adapt to dark mode using the `bg-accent` color:

```blade
{{-- Automatically adapts to dark mode --}}
<x-skeleton class="h-4 w-full" />
```

## Related Components

- [Spinner](./spinner.md) - Alternative loading indicator for actions
- [Empty](./empty.md) - Empty state component for when no data exists
- [Card](./card.md) - Card component often used with skeletons

## Common Patterns

### Progressive Loading

```blade
<div>
    @if ($users->isEmpty() && $loading)
        {{-- Initial skeleton state --}}
        @for ($i = 0; $i < 5; $i++)
            <x-skeleton class="h-16 w-full" />
        @endfor
    @else
        {{-- Loaded content --}}
        @foreach ($users as $user)
            <div>{{ $user->name }}</div>
        @endforeach
    @endif
</div>
```

### Infinite Scroll Loading

```blade
<div>
    {{-- Loaded items --}}
    @foreach ($items as $item)
        <div>{{ $item->title }}</div>
    @endforeach

    {{-- Loading more indicator --}}
    @if ($hasMore)
        <div class="mt-4 space-y-4">
            @for ($i = 0; $i < 3; $i++)
                <x-skeleton class="h-20 w-full" />
            @endfor
        </div>
    @endif
</div>
```
