# Installation

Get started with Mog in your Laravel application. This guide covers installation, setup, and theme configuration.

## Prerequisites

Before installing Mog, ensure your environment meets these requirements:

- **Laravel**: 11.x or 12.x
- **PHP**: 8.1 or higher
- **Node.js**: 18.x or higher
- **Package Manager**: npm, pnpm, or yarn
- **TailwindCSS**: v4.x (installed automatically)
- **Livewire**: v3.x (will be installed as a dependency)

## Installation Steps

### Step 1: Install via Composer

Install Mog using Composer:

```bash
composer require prvious/mog
```

This will install Mog along with its dependencies including:

- Laravel Livewire v3
- Alpine.js (via CDN or bundled)
- Blade Icons for SVG icons

### Step 2: Add the @mog Directive

Add the `@mog` directive to your layout's `<head>` section. This directive injects the necessary JavaScript, styles, and theme system.

```blade
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0" />
        <title>My App</title>

        {{-- Mog: Injects theme system, scripts, and styles --}}
        @mog

        {{-- Your app's compiled CSS --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
```

The `@mog` directive provides:

- Theme management system (light/dark/system modes)
- Livewire assets
- Mog JavaScript bundle (`mog.js` or `mog.min.js` based on `app.debug`)
- Global `$mog` magic helper for Alpine.js

### Step 3: Add the Overlay Component

Add `<x-mog::overlay />` before the closing `</body>` tag. This component is essential for modals, slide-overs, and toast notifications.

```blade
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0" />
        <title>My App</title>

        @mog
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        {{ $slot }}

        {{-- Mog: Modal backdrop, dialog container, and toaster --}}
        <x-mog::overlay />
    </body>
</html>
```

The overlay component provides three critical pieces of infrastructure:

1. **Modal Backdrop**: Semi-transparent overlay for dialogs and slide-overs
2. **Dialog Container**: Global mounting point (`#mog-dialog-container`) for modals
3. **Toaster System**: Persistent toast notifications across Livewire navigations

## Tailwind CSS Configuration

Mog uses Tailwind CSS v4 for styling. You need to configure your CSS entry point to import Mog's styles and scan component files.

### Option 1: Single CSS File (Recommended)

Create or update `resources/css/app.css`:

```css
/* Import Tailwind CSS v4 */
@import 'tailwindcss';

/* Import tw-animate-css for animations */
@import 'tw-animate-css';

/* Import Mog's base styles and component utilities */
@import '../../vendor/your-vendor/mog/resources/css/tailwind.css';

/* Scan Mog components for Tailwind classes */
@source '../../vendor/your-vendor/mog/resources/components/**/*.blade.php';

/* Scan Livewire attribute views */
@source '../../vendor/livewire/livewire/src/Features/SupportAttributes/views/**/*.blade.php';

/* Scan your application's Blade files */
@source '../views/**/*.blade.php';

/* Custom variants for dark mode and layout variations */
@custom-variant dark (&:is(.dark *));
@custom-variant fixed (&:is(.layout-fixed *));

/* Theme configuration */
@theme inline {
    --text-2xs: 0.625rem;
    --blur-2xs: 2px;
    --breakpoint-3xl: 1600px;
    --breakpoint-4xl: 2000px;
    --radius-sm: calc(var(--radius) - 4px);
    --radius-md: calc(var(--radius) - 2px);
    --radius-lg: var(--radius);
    --radius-xl: calc(var(--radius) + 4px);
    --radius-2xl: calc(var(--radius) + 8px);
    --radius-3xl: calc(var(--radius) + 12px);
    --radius-4xl: calc(var(--radius) + 16px);
    --color-background: var(--background);
    --color-foreground: var(--foreground);
    --color-card: var(--card);
    --color-card-foreground: var(--card-foreground);
    --color-popover: var(--popover);
    --color-popover-foreground: var(--popover-foreground);
    --color-primary: var(--primary);
    --color-primary-foreground: var(--primary-foreground);
    --color-secondary: var(--secondary);
    --color-secondary-foreground: var(--secondary-foreground);
    --color-muted: var(--muted);
    --color-muted-foreground: var(--muted-foreground);
    --color-accent: var(--accent);
    --color-accent-foreground: var(--accent-foreground);
    --color-destructive: var(--destructive);
    --color-destructive-foreground: var(--destructive-foreground);
    --color-border: var(--border);
    --color-input: var(--input);
    --color-ring: var(--ring);
}

/* Light mode colors */
:root {
    --radius: 0.625rem;
    --background: oklch(1 0 0);
    --foreground: oklch(0.145 0 0);
    --card: oklch(1 0 0);
    --card-foreground: oklch(0.145 0 0);
    --popover: oklch(1 0 0);
    --popover-foreground: oklch(0.145 0 0);
    --primary: oklch(0.205 0 0);
    --primary-foreground: oklch(0.985 0 0);
    --secondary: oklch(0.97 0 0);
    --secondary-foreground: oklch(0.205 0 0);
    --muted: oklch(0.97 0 0);
    --muted-foreground: oklch(0.556 0 0);
    --accent: oklch(0.97 0 0);
    --accent-foreground: oklch(0.205 0 0);
    --destructive: oklch(0.577 0.245 27.325);
    --destructive-foreground: oklch(0.97 0.01 17);
    --border: oklch(0.922 0 0);
    --input: oklch(0.922 0 0);
    --ring: oklch(0.708 0 0);
}

/* Dark mode colors */
.dark {
    --background: oklch(0.145 0 0);
    --foreground: oklch(0.985 0 0);
    --card: oklch(0.205 0 0);
    --card-foreground: oklch(0.985 0 0);
    --popover: oklch(0.269 0 0);
    --popover-foreground: oklch(0.985 0 0);
    --primary: oklch(0.922 0 0);
    --primary-foreground: oklch(0.205 0 0);
    --secondary: oklch(0.269 0 0);
    --secondary-foreground: oklch(0.985 0 0);
    --muted: oklch(0.269 0 0);
    --muted-foreground: oklch(0.708 0 0);
    --accent: oklch(0.371 0 0);
    --accent-foreground: oklch(0.985 0 0);
    --destructive: oklch(0.704 0.191 22.216);
    --destructive-foreground: oklch(0.58 0.22 27);
    --border: oklch(1 0 0 / 10%);
    --input: oklch(1 0 0 / 15%);
    --ring: oklch(0.556 0 0);
}
```

### Option 2: Separate Theme File

You can separate theme configuration into its own file for better organization:

**resources/css/app.css:**

```css
@import 'tailwindcss';
@import 'tw-animate-css';
@import '../../vendor/your-vendor/mog/resources/css/tailwind.css';

@source '../../vendor/your-vendor/mog/resources/components/**/*.blade.php';
@source '../../vendor/livewire/livewire/src/Features/SupportAttributes/views/**/*.blade.php';

/* Import your theme file */
@import './theme.css';

@source '../views/**/*.blade.php';
```

**resources/css/theme.css:**

```css
@custom-variant dark (&:is(.dark *));
@custom-variant fixed (&:is(.layout-fixed *));

@theme inline {
    /* Design tokens... */
}

:root {
    /* Light mode colors... */
}

.dark {
    /* Dark mode colors... */
}
```

### Important Notes

1. **Package CSS Import**: You must import Mog's `resources/css/tailwind.css` file - this is required and cannot be omitted.

2. **Component Scanning**: Use `@source` directives to scan both Mog's components and your application's Blade files so Tailwind can detect which classes are being used.

3. **Flexible Structure**: The example above shows the full configuration, but you can structure your CSS files however you prefer. The key requirements are:
    - Import Tailwind CSS
    - Import Mog's CSS file
    - Configure `@source` to scan components
    - Define theme CSS variables

4. **Vendor Path**: Adjust the vendor path based on your package name:

    ```css
    /* Replace 'your-vendor/mog' with actual package name */
    @import '../../vendor/your-vendor/mog/resources/css/tailwind.css';
    ```

5. **Reference Files**: See `tests/css/app.css` and `tests/css/theme.css` in the Mog repository for complete working examples.

## Theme Customization

Mog uses a CSS variable-based theming system, similar to [shadcn/ui](https://ui.shadcn.com). This approach provides maximum flexibility without requiring changes to component source code.

### Color System

Colors are defined using CSS variables with the oklch color format:

```css
:root {
    --background: oklch(1 0 0); /* Pure white */
    --foreground: oklch(0.145 0 0); /* Near black */
    --primary: oklch(0.205 0 0); /* Dark gray */
    --primary-foreground: oklch(0.985 0 0); /* Light text */
    /* ... more colors */
}

.dark {
    --background: oklch(0.145 0 0); /* Dark background */
    --foreground: oklch(0.985 0 0); /* Light text */
    --primary: oklch(0.922 0 0); /* Light gray */
    /* ... more colors */
}
```

### Why oklch?

oklch provides perceptually uniform colors, meaning:

- Colors appear equally bright across hue variations
- Gradients and transitions look smooth and natural
- Better accessibility with consistent contrast ratios
- Modern color space supported by all modern browsers

### Available Color Variables

```css
/* Layout colors */
--background          /* Page background */
--foreground          /* Primary text color */
--card                /* Card backgrounds */
--card-foreground     /* Card text */

/* Interactive colors */
--primary             /* Primary actions, links */
--primary-foreground  /* Text on primary */
--secondary           /* Secondary actions */
--secondary-foreground /* Text on secondary */

/* State colors */
--muted               /* Subtle backgrounds */
--muted-foreground    /* Subtle text */
--accent              /* Highlight/hover states */
--accent-foreground   /* Text on accent */
--destructive         /* Danger/delete actions */
--destructive-foreground /* Text on destructive */

/* Form elements */
--border              /* Border color */
--input               /* Input border/background */
--ring                /* Focus ring color */
```

### Customizing Colors

To customize the theme, simply change the CSS variable values:

**Example: Blue theme**

```css
:root {
    --primary: oklch(0.55 0.22 264); /* Blue primary */
    --primary-foreground: oklch(1 0 0); /* White text */
    --accent: oklch(0.85 0.15 264); /* Light blue accent */
    --accent-foreground: oklch(0.2 0.1 264); /* Dark blue text */
}
```

**Example: Green theme**

```css
:root {
    --primary: oklch(0.5 0.18 145); /* Green primary */
    --primary-foreground: oklch(1 0 0); /* White text */
    --accent: oklch(0.9 0.12 145); /* Light green accent */
    --accent-foreground: oklch(0.25 0.15 145); /* Dark green text */
}
```

**Example: Custom destructive color**

```css
:root {
    --destructive: oklch(0.65 0.28 30); /* Orange-red */
    --destructive-foreground: oklch(1 0 0); /* White text */
}
```

### Border Radius

Customize border radius globally:

```css
:root {
    --radius: 0.5rem; /* Default: 0.625rem (10px) */
}

/* This affects all radius utilities: */
/* radius-sm, radius-md, radius-lg, etc. */
```

### Custom Variants

Define custom variants for scoped styling:

```css
/* Dark mode variant */
@custom-variant dark (&:is(.dark *));

/* Fixed layout variant */
@custom-variant fixed (&:is(.layout-fixed *));

/* Usage in HTML: */
/* <div class="dark:bg-background fixed:sticky"> */
```

### Design Tokens

Define custom design tokens in `@theme inline`:

```css
@theme inline {
    /* Custom text sizes */
    --text-2xs: 0.625rem;

    /* Custom breakpoints */
    --breakpoint-3xl: 1600px;
    --breakpoint-4xl: 2000px;

    /* Radius scale */
    --radius-sm: calc(var(--radius) - 4px);
    --radius-lg: var(--radius);
    --radius-xl: calc(var(--radius) + 4px);
}
```

## Verification

After installation, verify everything is working correctly.

### Test Basic Component

Create a test route and view:

```php
// routes/web.php
Route::get('/test-mog', function () {
    return view('test-mog');
});
```

```blade
{{-- resources/views/test-mog.blade.php --}}
<x-layouts.app>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold">Mog Installation Test</h1>

        <div class="mt-8 space-y-4">
            {{-- Test Button --}}
            <div>
                <x-mog::button>Default Button</x-mog::button>
                <x-mog::button variant="outline">Outline Button</x-mog::button>
                <x-mog::button variant="destructive">Destructive Button</x-mog::button>
            </div>

            {{-- Test Card --}}
            <x-mog::card>
                <x-slot:header>
                    <x-slot:title>Card Title</x-slot:title>
                    <x-slot:description>This is a card description</x-slot:description>
                </x-slot:header>

                <x-slot:content>
                    <p>Card content goes here.</p>
                </x-slot:content>

                <x-slot:footer>
                    <x-mog::button size="sm">Action</x-mog::button>
                </x-slot:footer>
            </x-mog::card>

            {{-- Test Dialog --}}
            <x-mog::dialog>
                <x-slot:trigger>
                    <x-mog::button>Open Dialog</x-mog::button>
                </x-slot:trigger>

                <x-slot:content>
                    <x-slot:title>Dialog Title</x-slot:title>
                    <x-slot:description>This is a dialog description</x-slot:description>

                    <p class="mt-4">Dialog content goes here.</p>
                </x-slot:content>
            </x-mog::dialog>
        </div>
    </div>
</x-layouts.app>
```

Visit `/test-mog` in your browser. You should see:

- Buttons with proper styling and hover states
- A card with header, content, and footer sections
- A dialog that opens and closes smoothly with overlay backdrop

### Test Theme Switching

Test dark mode by adding the `dark` class to the `<html>` element:

```blade
<html
    lang="en"
    class="dark"></html>
```

Or programmatically toggle theme:

```html
<x-mog::button x-on:click="$mog.paint('dark')">Dark Mode</x-mog::button>
<x-mog::button x-on:click="$mog.paint('light')">Light Mode</x-mog::button>
<x-mog::button x-on:click="$mog.paint('system')">System Mode</x-mog::button>
```

### Test Toast Notifications

```html
<x-mog::button x-on:click="$mog.toast.success('Success!', 'Operation completed')"> Show Toast </x-mog::button>
```

## Troubleshooting

### Components Not Rendering

**Problem**: Mog components don't render or show as plain HTML

**Solutions**:

- Verify Composer package is installed: `composer show your-vendor/mog`
- Clear Laravel caches: `php artisan optimize:clear`
- Ensure service provider is registered (happens automatically in Laravel 11+)

### Styles Not Loading

**Problem**: Components render but have no styling

**Solutions**:

- Verify you've imported Mog's CSS: `@import '../../vendor/your-vendor/mog/resources/css/tailwind.css';`
- Check that `@source` directives include Mog's components directory
- Build your CSS: `npm run build` or `pnpm build`
- Clear browser cache and hard reload

### Dark Mode Not Working

**Problem**: Dark mode colors don't apply

**Solutions**:

- Verify `@custom-variant dark (&:is(.dark *));` is defined in your CSS
- Ensure dark mode color variables are defined in `.dark { ... }`
- Check that `dark` class is being added to the `<html>` element
- Test theme switching: `$mog.paint('dark')`

### Dialogs/Overlays Not Working

**Problem**: Dialogs don't open or overlay is missing

**Solutions**:

- Verify `<x-mog::overlay />` is added before closing `</body>` tag
- Ensure Alpine.js is loaded (check browser console)
- Check that `@mog` directive is in the `<head>`
- Verify JavaScript bundle loads: inspect Network tab for `mog.js`

### Tailwind Classes Not Working

**Problem**: Tailwind utility classes don't apply

**Solutions**:

- Ensure `@import 'tailwindcss';` is at the top of your CSS file
- Verify `@source` directives scan all relevant Blade files
- Check that Tailwind CSS v4 is installed: `npm list tailwindcss`
- Rebuild CSS: `npm run build`

### CSS Variables Not Applying

**Problem**: Custom color variables don't work

**Solutions**:

- Verify CSS variables are defined in `:root` and `.dark`
- Check variable names match: `--background`, `--foreground`, etc.
- Ensure variables are mapped in `@theme inline` section
- Clear CSS build cache and rebuild

## Next Steps

Now that Mog is installed, explore the component library:

### Component Documentation

Browse the complete component documentation:

- [Button](./button.md) - Buttons in various styles and sizes
- [Card](./card.md) - Flexible card containers
- [Dialog](./dialog.md) - Modal dialogs and confirmations
- [Table](./table.md) - Data tables with sorting and pagination
- [Form Components](./input.md) - Inputs, selects, checkboxes, and more

### Theming Guide

Learn more about customizing Mog's appearance:

- Understanding the color system
- Creating custom themes
- Using design tokens
- Building custom variants

### Examples

See Mog components in action:

- Dashboard layouts
- Form examples
- Data tables
- Authentication pages
- E-commerce interfaces

## Additional Resources

- **Repository**: [GitHub](https://github.com/your-vendor/mog)
- **Issues**: [Report bugs](https://github.com/your-vendor/mog/issues)
- **Discussions**: [Ask questions](https://github.com/your-vendor/mog/discussions)
- **Changelog**: [View updates](https://github.com/your-vendor/mog/releases)

## About the Theming System

Mog's theming system is inspired by [shadcn/ui](https://ui.shadcn.com), using CSS variables for complete customization without modifying component source code. This approach provides:

- **No Build-Time Configuration**: Change themes by updating CSS variables
- **Runtime Theme Switching**: Switch themes dynamically without rebuilding
- **Framework Agnostic**: Same theming approach works across projects
- **Full Control**: Every color can be customized to match your brand
- **Modern Color Space**: oklch provides perceptually uniform, accessible colors
- **Familiar Conventions**: Compatible with shadcn/ui for easy migration

The test files in `tests/css/app.css` and `tests/css/theme.css` are provided as complete working examples. Use them as reference for your own implementation, but feel free to structure your CSS files however works best for your project.
