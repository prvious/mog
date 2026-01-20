# Aspect Ratio

The Aspect Ratio component creates containers that maintain a specific width-to-height ratio, perfect for responsive images, videos, and embedded content. It uses Alpine.js to dynamically calculate the proper padding-bottom percentage.

## Overview

Aspect ratios ensure content maintains consistent proportions across different screen sizes. The component creates a responsive container that scales proportionally, preventing layout shifts and maintaining visual consistency.

### When to Use

- **Video embeds**: YouTube, Vimeo, or other embedded videos
- **Image containers**: Maintain consistent image dimensions
- **Responsive media**: Ensure media scales proportionally
- **Thumbnails**: Create uniform thumbnail grids
- **Placeholder content**: Loading states with proper dimensions
- **Card images**: Consistent image sizes in card layouts

## Props

### `ratio`

**Type:** `string | float | int`
**Default:** `1` (1:1 square)

Controls the aspect ratio of the container. Accepts multiple formats:

- **String format**: `"16/9"`, `"4/3"`, `"21/9"`, `"1/1"`
- **Decimal format**: `1.777` (16/9), `1.333` (4/3), `2.333` (21/9)
- **Integer format**: `1` (square), `2` (2:1)

Common ratios:

- `"16/9"` or `1.777` - Widescreen video (YouTube, modern displays)
- `"4/3"` or `1.333` - Standard video, iPad
- `"21/9"` or `2.333` - Ultra-wide
- `"1/1"` or `1` - Square (Instagram)
- `"3/2"` or `1.5` - Classic photography
- `"9/16"` or `0.5625` - Vertical video (Stories, TikTok)

## Features

### Dynamic Calculation

Uses Alpine.js to calculate padding-bottom:

- Parses ratio string (e.g., "16/9")
- Calculates percentage dynamically
- Sets inline style for precise control

### Responsive Scaling

Container scales proportionally:

- Full width by default
- Height calculated automatically
- Maintains ratio across breakpoints

### Absolute Positioning

Content inside uses absolute positioning:

- Fills entire container
- Positioned at top-left (0, 0)
- Stretches to bottom-right
- Works with any content type

### Flexible Content

Supports any child content:

- Images (img, picture)
- Videos (video, iframe)
- Canvas elements
- Custom components

## Usage Examples

### Basic 16:9 Container

```blade
<x-aspect-ratio ratio="16/9">
    <img
        src="/landscape.jpg"
        alt="Landscape"
        class="size-full object-cover" />
</x-aspect-ratio>
```

### YouTube Embed

```blade
<x-aspect-ratio ratio="16/9">
    <iframe
        src="https://www.youtube.com/embed/dQw4w9WgXcQ"
        title="YouTube video"
        class="size-full"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
</x-aspect-ratio>
```

### Square Image (1:1)

```blade
<x-aspect-ratio ratio="1/1">
    <img
        src="/profile.jpg"
        alt="Profile"
        class="size-full rounded-lg object-cover" />
</x-aspect-ratio>
```

### Product Thumbnails

```blade
<div class="grid grid-cols-2 gap-4 md:grid-cols-4">
    @foreach ($products as $product)
        <div>
            <x-aspect-ratio ratio="4/3">
                <img
                    src="{{ $product->image }}"
                    alt="{{ $product->name }}"
                    class="size-full rounded-lg object-cover" />
            </x-aspect-ratio>

            <h3 class="mt-2 font-medium">{{ $product->name }}</h3>
            <p class="text-muted-foreground text-sm">${{ $product->price }}</p>
        </div>
    @endforeach
</div>
```

### Video Background

```blade
<x-aspect-ratio
    ratio="21/9"
    class="overflow-hidden rounded-xl">
    <video
        autoplay
        loop
        muted
        playsinline
        class="size-full object-cover">
        <source
            src="/hero-video.mp4"
            type="video/mp4" />
    </video>

    <div class="absolute inset-0 flex items-center justify-center bg-black/40">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold">Welcome</h1>
            <p class="mt-2">Discover amazing content</p>
        </div>
    </div>
</x-aspect-ratio>
```

### Loading Placeholder

```blade
<x-aspect-ratio
    ratio="16/9"
    class="bg-muted animate-pulse rounded-lg">
    <div class="flex size-full items-center justify-center">
        <x-spinner />
    </div>
</x-aspect-ratio>
```

### Card with Image

```blade
<x-card class="overflow-hidden">
    <x-slot:content class="p-0">
        <x-aspect-ratio ratio="16/9">
            <img
                src="/article-cover.jpg"
                alt="Article cover"
                class="size-full object-cover" />
        </x-aspect-ratio>

        <div class="p-6">
            <h3 class="text-lg font-semibold">Article Title</h3>
            <p class="text-muted-foreground mt-2 text-sm">Article description goes here with a brief summary of the content.</p>

            <div class="mt-4 flex items-center justify-between">
                <span class="text-muted-foreground text-xs">5 min read</span>
                <x-button size="sm">Read More</x-button>
            </div>
        </div>
    </x-slot:content>
</x-card>
```

### Vertical Video (9:16)

```blade
<div class="mx-auto max-w-sm">
    <x-aspect-ratio ratio="9/16">
        <iframe
            src="https://www.tiktok.com/embed/..."
            class="size-full"
            frameborder="0"
            allowfullscreen></iframe>
    </x-aspect-ratio>
</div>
```

### Image Gallery

```blade
<div class="grid grid-cols-3 gap-2">
    @foreach ($images as $image)
        <x-aspect-ratio
            ratio="1/1"
            class="group cursor-pointer overflow-hidden rounded">
            <img
                src="{{ $image->url }}"
                alt="{{ $image->alt }}"
                class="size-full object-cover transition-transform group-hover:scale-110" />
        </x-aspect-ratio>
    @endforeach
</div>
```

### Different Ratios

```blade
<div class="space-y-4">
    {{-- Widescreen (16:9) --}}
    <x-aspect-ratio
        ratio="16/9"
        class="bg-primary/10 rounded">
        <div class="flex size-full items-center justify-center">
            <span>16:9 Widescreen</span>
        </div>
    </x-aspect-ratio>

    {{-- Standard (4:3) --}}
    <x-aspect-ratio
        ratio="4/3"
        class="bg-secondary/10 rounded">
        <div class="flex size-full items-center justify-center">
            <span>4:3 Standard</span>
        </div>
    </x-aspect-ratio>

    {{-- Square (1:1) --}}
    <x-aspect-ratio
        ratio="1/1"
        class="bg-accent/10 rounded">
        <div class="flex size-full items-center justify-center">
            <span>1:1 Square</span>
        </div>
    </x-aspect-ratio>

    {{-- Ultra-wide (21:9) --}}
    <x-aspect-ratio
        ratio="21/9"
        class="bg-muted rounded">
        <div class="flex size-full items-center justify-center">
            <span>21:9 Ultra-wide</span>
        </div>
    </x-aspect-ratio>
</div>
```

### With Overlay

```blade
<x-aspect-ratio
    ratio="16/9"
    class="group overflow-hidden rounded-lg">
    <img
        src="/thumbnail.jpg"
        alt="Video thumbnail"
        class="size-full object-cover" />

    <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity group-hover:opacity-100">
        <x-button size="lg">
            @svg('lucide-play', 'size-6')
            Play Video
        </x-button>
    </div>
</x-aspect-ratio>
```

### Blog Post Preview

```blade
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($posts as $post)
        <article class="group cursor-pointer">
            <x-aspect-ratio
                ratio="3/2"
                class="overflow-hidden rounded-lg">
                <img
                    src="{{ $post->featured_image }}"
                    alt="{{ $post->title }}"
                    class="size-full object-cover transition-transform group-hover:scale-105" />
            </x-aspect-ratio>

            <div class="mt-3">
                <x-badge size="sm">{{ $post->category }}</x-badge>
                <h3 class="group-hover:text-primary mt-2 font-semibold">{{ $post->title }}</h3>
                <p class="text-muted-foreground mt-1 text-sm">{{ $post->excerpt }}</p>

                <div class="text-muted-foreground mt-3 flex items-center gap-2 text-xs">
                    <time>{{ $post->published_at->format('M d, Y') }}</time>
                    <span>•</span>
                    <span>{{ $post->read_time }} min read</span>
                </div>
            </div>
        </article>
    @endforeach
</div>
```

### Avatar with Aspect Ratio

```blade
<x-aspect-ratio
    ratio="1/1"
    class="w-24 overflow-hidden rounded-full">
    <img
        src="/avatar.jpg"
        alt="User avatar"
        class="size-full object-cover" />
</x-aspect-ratio>
```

## Accessibility

### Image Alt Text

Always provide descriptive alt text:

```blade
{{-- Good: Descriptive alt text --}}
<x-aspect-ratio ratio="16/9">
    <img
        src="/sunset.jpg"
        alt="Beautiful sunset over the ocean with orange and pink clouds"
        class="size-full object-cover" />
</x-aspect-ratio>

{{-- Avoid: Generic or missing alt text --}}
<x-aspect-ratio ratio="16/9">
    <img
        src="/image.jpg"
        alt="image"
        class="size-full object-cover" />
</x-aspect-ratio>
```

### Video Accessibility

Provide proper video accessibility:

```blade
<x-aspect-ratio ratio="16/9">
    <video
        controls
        class="size-full">
        <source
            src="/video.mp4"
            type="video/mp4" />
        <track
            kind="captions"
            src="/captions.vtt"
            srclang="en"
            label="English" />
        Your browser does not support the video tag.
    </video>
</x-aspect-ratio>
```

### Iframe Titles

Include descriptive titles for iframes:

```blade
{{-- Good: Descriptive title --}}
<x-aspect-ratio ratio="16/9">
    <iframe
        src="https://www.youtube.com/embed/..."
        title="Tutorial: Getting started with Mog components"
        class="size-full"></iframe>
</x-aspect-ratio>
```

## Best Practices

### Use Object-Fit

Always set `object-fit` for images:

```blade
{{-- Good: object-cover maintains aspect ratio --}}
<x-aspect-ratio ratio="16/9">
    <img
        src="/image.jpg"
        alt="..."
        class="size-full object-cover" />
</x-aspect-ratio>

{{-- Alternative: object-contain shows full image --}}
<x-aspect-ratio ratio="16/9">
    <img
        src="/image.jpg"
        alt="..."
        class="size-full object-contain" />
</x-aspect-ratio>

{{-- Avoid: No object-fit may distort image --}}
<x-aspect-ratio ratio="16/9">
    <img
        src="/image.jpg"
        alt="..."
        class="size-full" />
</x-aspect-ratio>
```

### Choose Appropriate Ratios

```blade
{{-- Good: 16:9 for video content --}}
<x-aspect-ratio ratio="16/9">
    <iframe
        src="..."
        title="Video"></iframe>
</x-aspect-ratio>

{{-- Good: 1:1 for profile pictures --}}
<x-aspect-ratio ratio="1/1">
    <img
        src="/profile.jpg"
        alt="Profile"
        class="size-full object-cover" />
</x-aspect-ratio>

{{-- Good: 4:3 for classic photography --}}
<x-aspect-ratio ratio="4/3">
    <img
        src="/photo.jpg"
        alt="Photo"
        class="size-full object-cover" />
</x-aspect-ratio>
```

### Set Container Width

```blade
{{-- Good: Control width with classes --}}
<div class="w-full max-w-2xl">
    <x-aspect-ratio ratio="16/9">
        <img
            src="/image.jpg"
            alt="..."
            class="size-full object-cover" />
    </x-aspect-ratio>
</div>

{{-- Good: Responsive grid widths --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    <x-aspect-ratio ratio="1/1">...</x-aspect-ratio>
    <x-aspect-ratio ratio="1/1">...</x-aspect-ratio>
    <x-aspect-ratio ratio="1/1">...</x-aspect-ratio>
</div>
```

### Lazy Loading

Use lazy loading for images:

```blade
<x-aspect-ratio ratio="16/9">
    <img
        src="/image.jpg"
        alt="..."
        loading="lazy"
        class="size-full object-cover" />
</x-aspect-ratio>
```

## Technical Details

### Component Structure

```blade
<div
    class="relative w-full"
    :style="{'padding-bottom': `${100 / ratio}%`}">
    <div class="absolute bottom-0 left-0 right-0 top-0">
        {{ $slot }}
    </div>
</div>
```

### Ratio Calculation

The `parseAspectRatio` method handles multiple formats:

```php
// String format: "16/9" → 1.777
// Decimal format: 1.777 → 1.777
// Integer format: 1 → 1.0

// Padding-bottom = (100 / ratio)%
// For 16:9 = 100 / 1.777 = 56.25%
```

### CSS Classes

```css
/* Container */
relative w-full

/* Absolute positioned content */
absolute bottom-0 left-0 right-0 top-0

/* Dynamic padding-bottom via :style */
padding-bottom: calc(100 / ratio)%
```

### How It Works

1. Container has `position: relative` and full width
2. Padding-bottom creates vertical space based on ratio
3. Content is absolutely positioned to fill container
4. Alpine.js calculates padding dynamically

## Related Components

- [Card](./card.md) - Use aspect ratio for card images
- [Scrollable](./scrollable.md) - Combine with scrollable content
- [Empty](./empty.md) - Show placeholder in aspect ratio containers

## Common Patterns

### Hero Section

```blade
<x-aspect-ratio
    ratio="21/9"
    class="overflow-hidden">
    <img
        src="/hero.jpg"
        alt="Hero background"
        class="size-full object-cover" />

    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent">
        <div class="container flex h-full items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold">Welcome to Mog</h1>
                <p class="mt-4 text-xl">Build beautiful UIs with ease</p>
                <div class="mt-8 flex gap-4">
                    <x-button size="lg">Get Started</x-button>
                    <x-button
                        size="lg"
                        variant="outline">
                        Learn More
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</x-aspect-ratio>
```

### Social Media Preview

```blade
<div class="max-w-md">
    <x-aspect-ratio
        ratio="1.91/1"
        class="overflow-hidden rounded-lg border">
        <img
            src="/og-image.jpg"
            alt="Open Graph preview"
            class="size-full object-cover" />
    </x-aspect-ratio>

    <div class="mt-2 text-sm">
        <div class="font-semibold">Preview: Facebook/LinkedIn Share</div>
        <div class="text-muted-foreground">Optimal ratio: 1.91:1 (1200x630)</div>
    </div>
</div>
```

### Responsive Iframe

```blade
<div class="w-full max-w-4xl">
    <x-aspect-ratio
        ratio="16/9"
        class="overflow-hidden rounded-lg shadow-lg">
        <iframe
            src="https://maps.google.com/..."
            class="size-full"
            title="Location map"
            loading="lazy"></iframe>
    </x-aspect-ratio>
</div>
```
