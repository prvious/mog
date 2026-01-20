# Link

The Link component creates styled navigation links by wrapping the Button component with the `asLink` prop. It renders as an anchor (`<a>`) element while maintaining all button styling variants and features, providing consistent visual design across your application's navigation.

## Overview

Links are fundamental navigation elements. The Link component bridges the gap between semantic anchor elements and the rich styling system of the Button component, enabling consistent design patterns whether you're using buttons or links.

### When to Use

- **Navigation links**: Primary and secondary navigation
- **In-page links**: Jump to sections within a page
- **External links**: Link to external resources
- **Card links**: Make entire cards clickable
- **Breadcrumbs**: Navigation breadcrumb trails
- **Footer links**: Footer navigation and legal links
- **Call-to-action links**: Link-based CTAs with button styling

## Props

The Link component inherits all props from the Button component since it's a wrapper that sets `asLink="true"`:

### Inherited from Button

- **`variant`** - Visual style variant
    - Options: `default`, `destructive`, `outline`, `secondary`, `ghost`, `link`
    - Default: `default`

- **`size`** - Size variant
    - Options: `default`, `sm`, `lg`, `icon`, `icon-sm`, `icon-lg`
    - Default: `default`

### Standard Anchor Attributes

All standard anchor attributes are supported:

- **`href`**: Destination URL (required for functional links)
- **`target`**: `_blank`, `_self`, `_parent`, `_top`
- **`rel`**: Relationship attribute (e.g., `noopener noreferrer`)
- **`download`**: Prompt file download
- **`hreflang`**: Language of linked resource

## Features

### Button Component Integration

Inherits all button features:

- All visual variants (default, outline, ghost, etc.)
- All size variants
- Icon support and positioning
- Loading states with Livewire
- Focus and hover states
- Dark mode support

### Semantic HTML

Renders as proper anchor element:

- Uses `<a>` tag instead of `<button>`
- Supports `href` attribute for navigation
- Works with browser navigation features
- Compatible with screen readers

### Livewire Integration

Supports Livewire wire:click for SPAs:

- No page reload required
- Maintains Livewire state
- Shows loading indicators
- Works with wire:navigate

### Flexible Styling

Full Tailwind CSS customization:

- Override any variant styles
- Add custom classes
- Responsive design support
- Theme-aware colors

## Usage Examples

### Basic Link

```blade
{{-- Simple navigation link --}}
<x-link href="/about">About Us</x-link>

{{-- Link with custom variant --}}
<x-link
    href="/contact"
    variant="outline">
    Contact
</x-link>

{{-- Ghost variant link --}}
<x-link
    href="/blog"
    variant="ghost">
    Blog
</x-link>
```

### Link Variants

```blade
<div class="flex flex-wrap gap-4">
    {{-- Default (primary) --}}
    <x-link href="/dashboard">Dashboard</x-link>

    {{-- Outline --}}
    <x-link
        href="/settings"
        variant="outline">
        Settings
    </x-link>

    {{-- Secondary --}}
    <x-link
        href="/profile"
        variant="secondary">
        Profile
    </x-link>

    {{-- Ghost --}}
    <x-link
        href="/help"
        variant="ghost">
        Help
    </x-link>

    {{-- Link variant (underlined) --}}
    <x-link
        href="/terms"
        variant="link">
        Terms of Service
    </x-link>

    {{-- Destructive --}}
    <x-link
        href="/delete-account"
        variant="destructive">
        Delete Account
    </x-link>
</div>
```

### Links with Icons

```blade
{{-- Icon before text --}}
<x-link href="/download">
    @svg('lucide-download', 'size-4')
    Download
</x-link>

{{-- Icon after text --}}
<x-link
    href="/external"
    target="_blank"
    rel="noopener noreferrer">
    Visit Site
    @svg('lucide-external-link', 'size-4')
</x-link>

{{-- Icon-only link --}}
<x-link
    href="/settings"
    size="icon"
    variant="ghost"
    aria-label="Settings">
    @svg('lucide-settings', 'size-4')
</x-link>

{{-- Multiple icons --}}
<x-link href="/share">
    @svg('lucide-share-2', 'size-4')
    Share
    @svg('lucide-arrow-up-right', 'size-3')
</x-link>
```

### External Links

```blade
{{-- External link with proper attributes --}}
<x-link
    href="https://github.com/example/repo"
    target="_blank"
    rel="noopener noreferrer">
    View on GitHub
    @svg('lucide-external-link', 'size-4')
</x-link>

{{-- Social media link --}}
<x-link
    href="https://twitter.com/example"
    target="_blank"
    rel="noopener noreferrer"
    size="icon"
    variant="outline"
    aria-label="Follow on Twitter">
    @svg('lucide-twitter', 'size-4')
</x-link>

{{-- Documentation link --}}
<x-link
    href="https://docs.example.com"
    target="_blank"
    rel="noopener noreferrer"
    variant="outline">
    @svg('lucide-book-open', 'size-4')
    Read Documentation
    @svg('lucide-arrow-up-right', 'size-3')
</x-link>
```

### Navigation Menu

```blade
<nav class="flex items-center gap-2">
    <x-link
        href="/"
        variant="ghost">
        Home
    </x-link>

    <x-link
        href="/products"
        variant="ghost">
        Products
    </x-link>

    <x-link
        href="/about"
        variant="ghost">
        About
    </x-link>

    <x-link
        href="/contact"
        variant="ghost">
        Contact
    </x-link>

    <x-separator
        orientation="vertical"
        class="mx-2 h-6" />

    <x-link
        href="/login"
        variant="outline">
        Login
    </x-link>

    <x-link href="/signup">Sign Up</x-link>
</nav>
```

### Active/Current Page Styling

```blade
{{-- Using Laravel's request helper --}}
<nav class="flex flex-col gap-2">
    <x-link
        href="/dashboard"
        variant="{{ request()->is('dashboard') ? 'outline' : 'ghost' }}">
        @svg('lucide-layout-dashboard', 'size-4')
        Dashboard
    </x-link>

    <x-link
        href="/projects"
        variant="{{ request()->is('projects*') ? 'outline' : 'ghost' }}">
        @svg('lucide-folder', 'size-4')
        Projects
    </x-link>

    <x-link
        href="/tasks"
        variant="{{ request()->is('tasks*') ? 'outline' : 'ghost' }}">
        @svg('lucide-check-square', 'size-4')
        Tasks
    </x-link>

    <x-link
        href="/settings"
        variant="{{ request()->is('settings*') ? 'outline' : 'ghost' }}">
        @svg('lucide-settings', 'size-4')
        Settings
    </x-link>
</nav>

{{-- Using Route::is() --}}
<nav class="flex gap-4">
    <x-link
        href="{{ route('home') }}"
        variant="{{ Route::is('home') ? 'default' : 'ghost' }}">
        Home
    </x-link>

    <x-link
        href="{{ route('blog.index') }}"
        variant="{{ Route::is('blog.*') ? 'default' : 'ghost' }}">
        Blog
    </x-link>

    <x-link
        href="{{ route('contact') }}"
        variant="{{ Route::is('contact') ? 'default' : 'ghost' }}">
        Contact
    </x-link>
</nav>
```

### Breadcrumb Navigation

```blade
<nav class="flex items-center gap-2 text-sm">
    <x-link
        href="/"
        variant="ghost"
        size="sm">
        Home
    </x-link>

    @svg('lucide-chevron-right', 'text-muted-foreground size-4')

    <x-link
        href="/products"
        variant="ghost"
        size="sm">
        Products
    </x-link>

    @svg('lucide-chevron-right', 'text-muted-foreground size-4')

    <x-link
        href="/products/{{ $category->slug }}"
        variant="ghost"
        size="sm">
        {{ $category->name }}
    </x-link>

    @svg('lucide-chevron-right', 'text-muted-foreground size-4')

    <span class="text-muted-foreground">{{ $product->name }}</span>
</nav>
```

### Card with Link

```blade
{{-- Entire card as clickable link --}}
<x-link
    href="{{ route('posts.show', $post) }}"
    variant="ghost"
    class="h-auto flex-col items-start p-0 text-left">
    <x-card class="w-full transition-shadow hover:shadow-lg">
        <x-slot:content class="p-0">
            <x-aspect-ratio ratio="16/9">
                <img
                    src="{{ $post->image }}"
                    alt="{{ $post->title }}"
                    class="size-full object-cover" />
            </x-aspect-ratio>

            <div class="p-6">
                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                <p class="text-muted-foreground mt-2 text-sm">{{ $post->excerpt }}</p>

                <div class="mt-4 flex items-center gap-2">
                    <x-badge size="sm">{{ $post->category }}</x-badge>
                    <span class="text-muted-foreground text-xs">
                        {{ $post->published_at->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </x-slot:content>
    </x-card>
</x-link>

{{-- Card with link in footer --}}
<x-card>
    <x-slot:header>
        <x-slot:title>{{ $article->title }}</x-slot:title>
        <x-slot:description>{{ $article->excerpt }}</x-slot:description>
    </x-slot:header>

    <x-slot:footer>
        <x-link
            href="{{ route('articles.show', $article) }}"
            variant="link">
            Read more →
        </x-link>
    </x-slot:footer>
</x-card>
```

### Call-to-Action Links

```blade
{{-- Hero CTA --}}
<div class="text-center">
    <h1 class="text-4xl font-bold">Welcome to Our Platform</h1>
    <p class="text-muted-foreground mt-4 text-xl">Get started with the best tools for your business</p>

    <div class="mt-8 flex justify-center gap-4">
        <x-link
            href="/signup"
            size="lg">
            Get Started
            @svg('lucide-arrow-right', 'size-4')
        </x-link>

        <x-link
            href="/demo"
            size="lg"
            variant="outline">
            Watch Demo
            @svg('lucide-play', 'size-4')
        </x-link>
    </div>
</div>

{{-- Inline CTA --}}
<div class="bg-accent rounded-lg p-6">
    <h3 class="font-semibold">Ready to upgrade?</h3>
    <p class="text-muted-foreground mt-1 text-sm">Get access to premium features and priority support.</p>
    <x-link
        href="/pricing"
        class="mt-4"
        size="sm">
        View Plans
    </x-link>
</div>
```

### Footer Navigation

```blade
<footer class="bg-muted border-border border-t py-12">
    <div class="container">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <h4 class="mb-4 font-semibold">Product</h4>
                <nav class="flex flex-col gap-2">
                    <x-link
                        href="/features"
                        variant="link"
                        class="justify-start">
                        Features
                    </x-link>
                    <x-link
                        href="/pricing"
                        variant="link"
                        class="justify-start">
                        Pricing
                    </x-link>
                    <x-link
                        href="/roadmap"
                        variant="link"
                        class="justify-start">
                        Roadmap
                    </x-link>
                </nav>
            </div>

            <div>
                <h4 class="mb-4 font-semibold">Company</h4>
                <nav class="flex flex-col gap-2">
                    <x-link
                        href="/about"
                        variant="link"
                        class="justify-start">
                        About Us
                    </x-link>
                    <x-link
                        href="/blog"
                        variant="link"
                        class="justify-start">
                        Blog
                    </x-link>
                    <x-link
                        href="/careers"
                        variant="link"
                        class="justify-start">
                        Careers
                    </x-link>
                </nav>
            </div>

            <div>
                <h4 class="mb-4 font-semibold">Resources</h4>
                <nav class="flex flex-col gap-2">
                    <x-link
                        href="/docs"
                        variant="link"
                        class="justify-start">
                        Documentation
                    </x-link>
                    <x-link
                        href="/help"
                        variant="link"
                        class="justify-start">
                        Help Center
                    </x-link>
                    <x-link
                        href="/community"
                        variant="link"
                        class="justify-start">
                        Community
                    </x-link>
                </nav>
            </div>

            <div>
                <h4 class="mb-4 font-semibold">Legal</h4>
                <nav class="flex flex-col gap-2">
                    <x-link
                        href="/privacy"
                        variant="link"
                        class="justify-start">
                        Privacy Policy
                    </x-link>
                    <x-link
                        href="/terms"
                        variant="link"
                        class="justify-start">
                        Terms of Service
                    </x-link>
                    <x-link
                        href="/cookies"
                        variant="link"
                        class="justify-start">
                        Cookie Policy
                    </x-link>
                </nav>
            </div>
        </div>

        <x-separator class="my-8" />

        <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
            <p class="text-muted-foreground text-sm">© 2026 Your Company. All rights reserved.</p>

            <div class="flex gap-2">
                <x-link
                    href="https://twitter.com/example"
                    target="_blank"
                    rel="noopener noreferrer"
                    size="icon-sm"
                    variant="ghost"
                    aria-label="Twitter">
                    @svg('lucide-twitter', 'size-4')
                </x-link>

                <x-link
                    href="https://github.com/example"
                    target="_blank"
                    rel="noopener noreferrer"
                    size="icon-sm"
                    variant="ghost"
                    aria-label="GitHub">
                    @svg('lucide-github', 'size-4')
                </x-link>

                <x-link
                    href="https://linkedin.com/company/example"
                    target="_blank"
                    rel="noopener noreferrer"
                    size="icon-sm"
                    variant="ghost"
                    aria-label="LinkedIn">
                    @svg('lucide-linkedin', 'size-4')
                </x-link>
            </div>
        </div>
    </div>
</footer>
```

### Sidebar Navigation

```blade
<aside class="w-64 space-y-1 p-4">
    <x-link
        href="/dashboard"
        variant="{{ request()->is('dashboard') ? 'secondary' : 'ghost' }}"
        class="w-full justify-start">
        @svg('lucide-layout-dashboard', 'size-4')
        Dashboard
    </x-link>

    <x-link
        href="/inbox"
        variant="{{ request()->is('inbox*') ? 'secondary' : 'ghost' }}"
        class="w-full justify-start">
        @svg('lucide-inbox', 'size-4')
        Inbox
        @if ($unreadCount > 0)
            <x-badge
                size="sm"
                class="ml-auto">
                {{ $unreadCount }}
            </x-badge>
        @endif
    </x-link>

    <x-link
        href="/projects"
        variant="{{ request()->is('projects*') ? 'secondary' : 'ghost' }}"
        class="w-full justify-start">
        @svg('lucide-folder', 'size-4')
        Projects
    </x-link>

    <x-link
        href="/team"
        variant="{{ request()->is('team*') ? 'secondary' : 'ghost' }}"
        class="w-full justify-start">
        @svg('lucide-users', 'size-4')
        Team
    </x-link>

    <x-separator class="my-4" />

    <x-link
        href="/settings"
        variant="{{ request()->is('settings*') ? 'secondary' : 'ghost' }}"
        class="w-full justify-start">
        @svg('lucide-settings', 'size-4')
        Settings
    </x-link>

    <x-link
        href="/logout"
        variant="ghost"
        class="text-destructive w-full justify-start">
        @svg('lucide-log-out', 'size-4')
        Logout
    </x-link>
</aside>
```

### Download Links

```blade
{{-- File download link --}}
<x-link
    href="/downloads/report.pdf"
    download
    variant="outline">
    @svg('lucide-download', 'size-4')
    Download Report
</x-link>

{{-- Multiple download options --}}
<div class="flex flex-wrap gap-2">
    <x-link
        href="/downloads/guide.pdf"
        download
        size="sm"
        variant="outline">
        @svg('lucide-file-text', 'size-4')
        PDF
    </x-link>

    <x-link
        href="/downloads/guide.docx"
        download
        size="sm"
        variant="outline">
        @svg('lucide-file-text', 'size-4')
        DOCX
    </x-link>

    <x-link
        href="/downloads/guide.epub"
        download
        size="sm"
        variant="outline">
        @svg('lucide-book', 'size-4')
        EPUB
    </x-link>
</div>
```

### With Livewire

```blade
{{-- Livewire SPA navigation --}}
<x-link
    href="/profile"
    wire:navigate
    variant="ghost">
    View Profile
</x-link>

{{-- Livewire action with loading state --}}
<x-link
    wire:click="exportData"
    variant="outline">
    @svg('lucide-download', 'size-4')
    Export Data
</x-link>
{{-- Loading spinner shows automatically during wire:click --}}
```

## Accessibility

### Descriptive Link Text

```blade
{{-- Good: Descriptive link text --}}
<x-link href="/pricing">View pricing plans</x-link>

{{-- Avoid: Generic link text --}}
<x-link href="/pricing">Click here</x-link>

{{-- Good: Additional context for screen readers --}}
<x-link
    href="/delete"
    variant="destructive"
    aria-label="Delete user account permanently">
    Delete Account
</x-link>
```

### External Link Indication

```blade
{{-- Good: Visual and semantic indication --}}
<x-link
    href="https://example.com"
    target="_blank"
    rel="noopener noreferrer">
    External Resource
    @svg('lucide-external-link', 'size-4')
    <span class="sr-only">(opens in new tab)</span>
</x-link>
```

### Icon-Only Links

```blade
{{-- Good: aria-label for icon-only links --}}
<x-link
    href="/settings"
    size="icon"
    variant="ghost"
    aria-label="Open settings">
    @svg('lucide-settings', 'size-4')
</x-link>

{{-- Avoid: Icon without label --}}
<x-link
    href="/settings"
    size="icon"
    variant="ghost">
    @svg('lucide-settings', 'size-4')
</x-link>
```

### Keyboard Navigation

All links are keyboard accessible:

- **Tab**: Focus the link
- **Enter**: Activate the link
- **Shift + Tab**: Focus previous element

## Best Practices

### Use Semantic Links

```blade
{{-- Good: Use link for navigation --}}
<x-link href="/contact">Contact Us</x-link>

{{-- Good: Use button for actions --}}
<x-button wire:click="submit">Submit Form</x-button>
```

### Set rel Attributes for External Links

```blade
{{-- Good: Proper security attributes --}}
<x-link
    href="https://external.com"
    target="_blank"
    rel="noopener noreferrer">
    External Link
</x-link>

{{-- Avoid: Missing security attributes --}}
<x-link
    href="https://external.com"
    target="_blank">
    External Link
</x-link>
```

### Indicate Active State

```blade
{{-- Good: Visual indication of current page --}}
<nav class="flex gap-2">
    @foreach ($navItems as $item)
        <x-link
            href="{{ $item->url }}"
            variant="{{ request()->is($item->pattern) ? 'secondary' : 'ghost' }}">
            {{ $item->label }}
        </x-link>
    @endforeach
</nav>
```

### Use Appropriate Variants

```blade
{{-- Good: Primary actions use default variant --}}
<x-link href="/get-started">Get Started</x-link>

{{-- Good: Secondary navigation uses ghost variant --}}
<x-link
    href="/about"
    variant="ghost">
    About
</x-link>

{{-- Good: Destructive actions use destructive variant --}}
<x-link
    href="/delete-account"
    variant="destructive">
    Delete Account
</x-link>
```

## Technical Details

### Component Structure

```blade
{{-- Link component wraps button with asLink prop --}}
<x-button :attributes="$attributes->merge(['asLink' => true])">
    {{ $slot }}
</x-button>

{{-- Which renders as: --}}
<a
    href="..."
    class="...button classes...">
    <span data-slot="button-content">
        {{ $slot }}
    </span>
</a>
```

### Button Integration

The component leverages the button component:

- Sets `asLink="true"` to render `<a>` instead of `<button>`
- Inherits all button variants and sizes
- Maintains loading state functionality
- Preserves all button accessibility features

### Tag Selection

```php
// In button component
$tag = $asLink ? 'a' : 'button';
```

### CSS Classes

Inherits all button classes:

```css
/* Base button classes */
inline-flex items-center justify-center
whitespace-nowrap rounded-md font-medium
focus-visible:ring-ring/50 focus-visible:ring-[3px]

/* Variant-specific classes */
/* Same as button component variants */
```

## Related Components

- [Button](./button.md) - Base component that Link wraps
- [Pagination](./pagination.md) - Uses links for page navigation
- [Dropdown](./dropdown.md) - Can contain link items
- [Card](./card.md) - Often used with links in footers

## Common Patterns

### Navigation Bar

```blade
<header class="border-border border-b">
    <div class="container flex h-16 items-center justify-between">
        <div class="flex items-center gap-6">
            <a
                href="/"
                class="text-xl font-bold">
                Logo
            </a>

            <nav class="hidden items-center gap-2 md:flex">
                <x-link
                    href="/products"
                    variant="ghost">
                    Products
                </x-link>
                <x-link
                    href="/solutions"
                    variant="ghost">
                    Solutions
                </x-link>
                <x-link
                    href="/pricing"
                    variant="ghost">
                    Pricing
                </x-link>
                <x-link
                    href="/docs"
                    variant="ghost">
                    Docs
                </x-link>
            </nav>
        </div>

        <div class="flex items-center gap-2">
            <x-link
                href="/login"
                variant="ghost">
                Login
            </x-link>
            <x-link href="/signup">Sign Up</x-link>
        </div>
    </div>
</header>
```

### Tab Navigation

```blade
<div>
    <nav class="border-border flex gap-2 border-b">
        <x-link
            href="/profile/overview"
            variant="ghost"
            class="{{ request()->is('profile/overview') ? 'border-primary border-b-2' : '' }} rounded-none">
            Overview
        </x-link>

        <x-link
            href="/profile/activity"
            variant="ghost"
            class="{{ request()->is('profile/activity') ? 'border-primary border-b-2' : '' }} rounded-none">
            Activity
        </x-link>

        <x-link
            href="/profile/settings"
            variant="ghost"
            class="{{ request()->is('profile/settings') ? 'border-primary border-b-2' : '' }} rounded-none">
            Settings
        </x-link>
    </nav>

    <div class="mt-6">
        {{-- Tab content --}}
    </div>
</div>
```

### Social Links

```blade
<div class="flex gap-2">
    @foreach ($socialLinks as $social)
        <x-link
            href="{{ $social->url }}"
            target="_blank"
            rel="noopener noreferrer"
            size="icon"
            variant="outline"
            aria-label="{{ $social->name }}">
            @svg($social->icon, 'size-4')
        </x-link>
    @endforeach
</div>
```
