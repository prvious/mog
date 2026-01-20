# Corner

The Corner component adds decorative corner brackets to elements, creating a framed effect that enhances visual hierarchy and draws attention. It uses absolutely positioned corner elements that animate on hover, providing subtle interactive feedback.

## Overview

Corners are decorative elements that frame content with bracket-like borders at each corner. They're particularly effective for highlighting special content, creating visual focus, or adding a modern design accent to cards and containers.

### When to Use

- **Featured content**: Highlight special cards or sections
- **Call-to-action blocks**: Draw attention to important actions
- **Testimonials**: Frame customer quotes and feedback
- **Product showcases**: Emphasize featured products
- **Achievement badges**: Highlight awards or certifications
- **Interactive elements**: Add visual interest to hoverable items
- **Premium content**: Indicate premium or exclusive sections

## Props

The Corner component accepts standard HTML attributes:

- **`class`**: Additional CSS classes for the container
- All other attributes are passed to the wrapper `<div>`

## Features

### Decorative Corners

Four absolute-positioned corner brackets:

- Top-left corner
- Top-right corner
- Bottom-left corner
- Bottom-right corner

### Hover Animation

Interactive feedback on hover:

- Corners expand from `size-1.5` to `size-3`
- Smooth transition with `transition-[height,width]`
- Border opacity changes to `border-current/50`
- Requires parent element to have `group` class

### Current Color

Uses `border-current`:

- Inherits text color from parent
- Easy color customization via text color classes
- Adapts to theme automatically

### Relative Positioning

Container uses `relative` positioning:

- Enables absolute positioning of corners
- Maintains document flow for content
- Properly contains corner elements

## Usage Examples

### Basic Corner Frame

```blade
<div class="group">
    <x-corner>
        <div class="p-8 text-center">
            <h3 class="text-xl font-bold">Featured Content</h3>
            <p class="text-muted-foreground mt-2">This content is highlighted with decorative corners</p>
        </div>
    </x-corner>
</div>
```

### Featured Card

```blade
<div class="group">
    <x-corner>
        <x-card>
            <x-slot:header>
                <x-slot:title>Premium Plan</x-slot:title>
                <x-slot:description>Our most popular option</x-slot:description>
            </x-slot:header>

            <x-slot:content>
                <div class="text-center">
                    <div class="text-4xl font-bold">$99</div>
                    <p class="text-muted-foreground text-sm">per month</p>
                </div>

                <ul class="mt-6 space-y-2">
                    <li class="flex items-center gap-2">
                        @svg('lucide-check', 'text-primary size-4')
                        <span>Unlimited projects</span>
                    </li>
                    <li class="flex items-center gap-2">
                        @svg('lucide-check', 'text-primary size-4')
                        <span>Priority support</span>
                    </li>
                    <li class="flex items-center gap-2">
                        @svg('lucide-check', 'text-primary size-4')
                        <span>Advanced analytics</span>
                    </li>
                </ul>
            </x-slot:content>

            <x-slot:footer>
                <x-button class="w-full">Get Started</x-button>
            </x-slot:footer>
        </x-card>
    </x-corner>
</div>
```

### Testimonial Block

```blade
<div class="group">
    <x-corner class="text-primary">
        <div class="bg-muted rounded-lg p-8">
            <div class="flex items-start gap-4">
                <x-avatar class="size-12">
                    <x-slot:img
                        src="{{ $testimonial->avatar }}"
                        alt="{{ $testimonial->name }}" />
                    <x-slot:initials>{{ $testimonial->initials }}</x-slot:initials>
                </x-avatar>

                <div class="flex-1">
                    <p class="italic">"{{ $testimonial->quote }}"</p>
                    <div class="mt-4">
                        <p class="font-semibold">{{ $testimonial->name }}</p>
                        <p class="text-muted-foreground text-sm">{{ $testimonial->title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-corner>
</div>
```

### Call to Action

```blade
<div class="group">
    <x-corner class="text-primary">
        <div class="from-primary/10 to-primary/5 rounded-xl bg-gradient-to-br p-12 text-center">
            <h2 class="text-3xl font-bold">Ready to Get Started?</h2>
            <p class="text-muted-foreground mt-4 text-lg">Join thousands of satisfied customers today</p>
            <div class="mt-8 flex justify-center gap-4">
                <x-button size="lg">Start Free Trial</x-button>
                <x-button
                    size="lg"
                    variant="outline">
                    Learn More
                </x-button>
            </div>
        </div>
    </x-corner>
</div>
```

### Product Showcase

```blade
<div class="group">
    <x-corner>
        <x-card class="overflow-hidden">
            <x-slot:content class="p-0">
                <div class="relative">
                    <x-badge class="absolute left-4 top-4">Featured</x-badge>
                    <x-aspect-ratio ratio="16/9">
                        <img
                            src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="size-full object-cover" />
                    </x-aspect-ratio>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                    <p class="text-muted-foreground mt-2">{{ $product->description }}</p>

                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-2xl font-bold">${{ $product->price }}</span>
                        <x-button>Add to Cart</x-button>
                    </div>
                </div>
            </x-slot:content>
        </x-card>
    </x-corner>
</div>
```

### Achievement Badge

```blade
<div class="group inline-block">
    <x-corner class="text-yellow-500">
        <div class="rounded-lg bg-gradient-to-br from-yellow-500/20 to-amber-500/10 p-6 text-center">
            @svg('lucide-trophy', 'mx-auto size-12 text-yellow-500')
            <h4 class="mt-3 font-bold">Top Contributor</h4>
            <p class="text-muted-foreground text-sm">Earned {{ $date }}</p>
        </div>
    </x-corner>
</div>
```

### Image Gallery Item

```blade
<div class="group cursor-pointer">
    <x-corner>
        <x-aspect-ratio ratio="1/1">
            <img
                src="{{ $image->url }}"
                alt="{{ $image->title }}"
                class="size-full object-cover transition-transform group-hover:scale-110" />
            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/60 to-transparent p-4 opacity-0 transition-opacity group-hover:opacity-100">
                <div class="text-white">
                    <h4 class="font-semibold">{{ $image->title }}</h4>
                    <p class="text-sm">{{ $image->description }}</p>
                </div>
            </div>
        </x-aspect-ratio>
    </x-corner>
</div>
```

### Pricing Comparison

```blade
<div class="grid gap-6 md:grid-cols-3">
    @foreach ($plans as $plan)
        <div class="group">
            <x-corner class="{{ $plan->featured ? 'text-primary' : '' }}">
                <x-card class="{{ $plan->featured ? 'border-primary shadow-lg' : '' }}">
                    @if ($plan->featured)
                        <x-badge class="absolute -top-3 left-1/2 -translate-x-1/2">Most Popular</x-badge>
                    @endif

                    <x-slot:header>
                        <x-slot:title>{{ $plan->name }}</x-slot:title>
                        <x-slot:description>{{ $plan->description }}</x-slot:description>
                    </x-slot:header>

                    <x-slot:content>
                        <div class="text-center">
                            <div class="text-4xl font-bold">${{ $plan->price }}</div>
                            <p class="text-muted-foreground text-sm">per month</p>
                        </div>

                        <ul class="mt-6 space-y-3">
                            @foreach ($plan->features as $feature)
                                <li class="flex items-center gap-2">
                                    @svg('lucide-check', 'text-primary size-4')
                                    <span class="text-sm">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </x-slot:content>

                    <x-slot:footer>
                        <x-button
                            class="w-full"
                            variant="{{ $plan->featured ? 'default' : 'outline' }}">
                            Choose Plan
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </x-corner>
        </div>
    @endforeach
</div>
```

### Feature Highlight

```blade
<div class="group">
    <x-corner class="text-blue-500">
        <div class="rounded-lg bg-blue-500/5 p-6">
            <div class="flex items-start gap-4">
                <div class="flex size-12 shrink-0 items-center justify-center rounded-lg bg-blue-500/10">
                    @svg('lucide-zap', 'size-6 text-blue-500')
                </div>
                <div>
                    <h3 class="font-semibold">Lightning Fast</h3>
                    <p class="text-muted-foreground mt-1 text-sm">Our platform is optimized for speed, delivering results in milliseconds.</p>
                </div>
            </div>
        </div>
    </x-corner>
</div>
```

### Quote Block

```blade
<div class="group">
    <x-corner>
        <blockquote class="border-primary bg-muted/50 border-l-4 p-6">
            <p class="text-lg italic">"{{ $quote->text }}"</p>
            <footer class="text-muted-foreground mt-4 text-sm">— {{ $quote->author }}</footer>
        </blockquote>
    </x-corner>
</div>
```

### Stats Card

```blade
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
    @foreach ($stats as $stat)
        <div class="group">
            <x-corner class="text-{{ $stat->color }}-500">
                <x-card>
                    <x-slot:content>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-muted-foreground text-sm">{{ $stat->label }}</p>
                                <p class="mt-2 text-3xl font-bold">{{ $stat->value }}</p>
                                <p class="text-{{ $stat->color }}-500 mt-1 text-sm">{{ $stat->change }} from last month</p>
                            </div>
                            <div class="bg-{{ $stat->color }}-500/10 flex size-12 items-center justify-center rounded-lg">
                                @svg($stat->icon, "text-{{ $stat->color }}-500 size-6")
                            </div>
                        </div>
                    </x-slot:content>
                </x-card>
            </x-corner>
        </div>
    @endforeach
</div>
```

### Different Colors

```blade
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    {{-- Primary color --}}
    <div class="group">
        <x-corner class="text-primary">
            <div class="bg-primary/5 rounded-lg p-6 text-center">
                <h4 class="font-semibold">Primary</h4>
            </div>
        </x-corner>
    </div>

    {{-- Destructive color --}}
    <div class="group">
        <x-corner class="text-destructive">
            <div class="bg-destructive/5 rounded-lg p-6 text-center">
                <h4 class="font-semibold">Destructive</h4>
            </div>
        </x-corner>
    </div>

    {{-- Success/green color --}}
    <div class="group">
        <x-corner class="text-green-500">
            <div class="rounded-lg bg-green-500/5 p-6 text-center">
                <h4 class="font-semibold">Success</h4>
            </div>
        </x-corner>
    </div>

    {{-- Warning/yellow color --}}
    <div class="group">
        <x-corner class="text-yellow-500">
            <div class="rounded-lg bg-yellow-500/5 p-6 text-center">
                <h4 class="font-semibold">Warning</h4>
            </div>
        </x-corner>
    </div>

    {{-- Info/blue color --}}
    <div class="group">
        <x-corner class="text-blue-500">
            <div class="rounded-lg bg-blue-500/5 p-6 text-center">
                <h4 class="font-semibold">Info</h4>
            </div>
        </x-corner>
    </div>

    {{-- Purple color --}}
    <div class="group">
        <x-corner class="text-purple-500">
            <div class="rounded-lg bg-purple-500/5 p-6 text-center">
                <h4 class="font-semibold">Purple</h4>
            </div>
        </x-corner>
    </div>
</div>
```

## Accessibility

### Decorative Element

Corners are purely decorative and don't require accessibility attributes:

```blade
{{-- Good: Decorative corners don't need ARIA --}}
<div class="group">
    <x-corner>
        <div>Content here</div>
    </x-corner>
</div>
```

### Content Accessibility

Ensure wrapped content remains accessible:

```blade
{{-- Good: Content inside maintains proper semantics --}}
<div class="group">
    <x-corner>
        <x-card>
            <x-slot:header>
                <x-slot:title>Accessible Title</x-slot:title>
            </x-slot:header>
            <x-slot:content>Accessible content</x-slot:content>
        </x-card>
    </x-corner>
</div>
```

## Best Practices

### Always Use Group Class

```blade
{{-- Good: Parent has group class for hover effect --}}
<div class="group">
    <x-corner>
        <div>Content</div>
    </x-corner>
</div>

{{-- Avoid: Missing group class means no hover animation --}}
<div>
    <x-corner>
        <div>Content</div>
    </x-corner>
</div>
```

### Use Sparingly

```blade
{{-- Good: Highlight only special content --}}
<div class="grid gap-6 md:grid-cols-3">
    <x-card>Basic Plan</x-card>

    <div class="group">
        <x-corner class="text-primary">
            <x-card>Premium Plan (Featured)</x-card>
        </x-corner>
    </div>

    <x-card>Enterprise Plan</x-card>
</div>

{{-- Avoid: Too many corners reduce impact --}}
<div class="grid gap-6 md:grid-cols-3">
    @foreach ($items as $item)
        <div class="group">
            <x-corner>
                <x-card>{{ $item->name }}</x-card>
            </x-corner>
        </div>
    @endforeach
</div>
```

### Match Colors to Content

```blade
{{-- Good: Corner color matches content theme --}}
<div class="group">
    <x-corner class="text-green-500">
        <x-alert variant="success">Success message</x-alert>
    </x-corner>
</div>

{{-- Avoid: Mismatched colors --}}
<div class="group">
    <x-corner class="text-blue-500">
        <x-alert variant="destructive">Error message</x-alert>
    </x-corner>
</div>
```

### Ensure Adequate Padding

```blade
{{-- Good: Content has padding so corners don't overlap --}}
<div class="group">
    <x-corner>
        <div class="p-8">Content with padding</div>
    </x-corner>
</div>

{{-- Avoid: No padding may cause corner overlap --}}
<div class="group">
    <x-corner>
        <div>Content without padding</div>
    </x-corner>
</div>
```

## Technical Details

### Component Structure

```blade
<div class="relative">
    {{ $slot }}

    {{-- Top-left corner --}}
    <span
        class="group-hover:border-current/50 absolute left-0 top-0 size-1.5 border-l border-t border-current transition-[height,width] group-hover:size-3"></span>

    {{-- Top-right corner --}}
    <span
        class="group-hover:border-current/50 absolute right-0 top-0 size-1.5 border-r border-t border-current transition-[height,width] group-hover:size-3"></span>

    {{-- Bottom-left corner --}}
    <span
        class="group-hover:border-current/50 absolute bottom-0 left-0 size-1.5 border-b border-l border-current transition-[height,width] group-hover:size-3"></span>

    {{-- Bottom-right corner --}}
    <span
        class="group-hover:border-current/50 absolute bottom-0 right-0 size-1.5 border-b border-r border-current transition-[height,width] group-hover:size-3"></span>
</div>
```

### CSS Classes

```css
/* Container */
relative                              /* Establishes positioning context */

/* Corner elements */
absolute                             /* Position relative to container */
size-1.5                            /* Default size (6px) */
border-current                      /* Use current text color */
transition-[height,width]           /* Smooth size transitions */

/* Hover states (requires parent with 'group' class) */
group-hover:size-3                  /* Expand to 12px on hover */
group-hover:border-current/50       /* Reduce opacity to 50% on hover */
```

### Corner Positioning

```css
/* Top-left */
left-0 top-0 border-l border-t

/* Top-right */
right-0 top-0 border-r border-t

/* Bottom-left */
bottom-0 left-0 border-b border-l

/* Bottom-right */
bottom-0 right-0 border-b border-r
```

## Related Components

- [Card](./card.md) - Commonly wrapped with corner decoration
- [Badge](./badge.md) - Use together for featured indicators
- [Button](./button.md) - Can be highlighted with corners for CTAs

## Common Patterns

### Hero Section with Corner

```blade
<div class="group">
    <x-corner class="text-primary">
        <div class="from-primary/10 via-primary/5 rounded-2xl bg-gradient-to-br to-transparent p-16">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="text-5xl font-bold">Welcome to Our Platform</h1>
                <p class="text-muted-foreground mt-6 text-xl">The ultimate solution for your business needs</p>
                <div class="mt-10 flex justify-center gap-4">
                    <x-button size="lg">Get Started</x-button>
                    <x-button
                        size="lg"
                        variant="outline">
                        Learn More
                    </x-button>
                </div>
            </div>
        </div>
    </x-corner>
</div>
```

### Feature Grid with Selective Corners

```blade
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($features as $feature)
        <div class="{{ $feature->highlighted ? 'group' : '' }}">
            @if ($feature->highlighted)
                <x-corner class="text-primary">
                    <x-card>
                        <x-slot:content>
                            <div class="text-center">
                                @svg($feature->icon, 'text-primary mx-auto size-12')
                                <h3 class="mt-4 font-semibold">{{ $feature->name }}</h3>
                                <p class="text-muted-foreground mt-2 text-sm">{{ $feature->description }}</p>
                            </div>
                        </x-slot:content>
                    </x-card>
                </x-corner>
            @else
                <x-card>
                    <x-slot:content>
                        <div class="text-center">
                            @svg($feature->icon, 'text-muted-foreground mx-auto size-12')
                            <h3 class="mt-4 font-semibold">{{ $feature->name }}</h3>
                            <p class="text-muted-foreground mt-2 text-sm">{{ $feature->description }}</p>
                        </div>
                    </x-slot:content>
                </x-card>
            @endif
        </div>
    @endforeach
</div>
```

### Animated Card Hover

```blade
<div class="group cursor-pointer">
    <x-corner>
        <x-card class="transition-all group-hover:-translate-y-1 group-hover:shadow-xl">
            <x-slot:content>
                <div class="text-center">
                    <div class="bg-primary/10 mx-auto flex size-16 items-center justify-center rounded-full transition-transform group-hover:scale-110">
                        @svg('lucide-star', 'text-primary size-8')
                    </div>
                    <h3 class="mt-4 text-lg font-semibold">Premium Feature</h3>
                    <p class="text-muted-foreground mt-2 text-sm">Unlock advanced capabilities</p>
                </div>
            </x-slot:content>
        </x-card>
    </x-corner>
</div>
```
