# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Mog is a Livewire-based UI component library for Laravel applications. It provides 68+ Blade components with Alpine.js interactivity, TailwindCSS styling, and a custom theming system.

## Development Commands

### PHP/Composer
```bash
composer install              # Install PHP dependencies
composer lint                # Format code with Laravel Pint
composer lint:check          # Check code formatting without changes
composer test                # Run Pest tests
vendor/bin/phpstan analyse   # Run static analysis (level max)
```

### JavaScript/Node
```bash
pnpm install                 # Install Node dependencies
pnpm build                   # Build JavaScript bundles (mog.js, mog.min.js, mog.esm.js)
pnpm watch                   # Build in watch mode for development
pnpm format                  # Format Blade templates and workflows with Prettier
pnpm format:check            # Check formatting without changes
```

### Test CSS Build
```bash
pnpm build:test              # Build test CSS with Tailwind CLI (tests/css/app.css → tests/assets/app.css)
pnpm watch:test              # Build test CSS in watch mode
```

**Test CSS Structure:**
- `tests/css/app.css` - Test CSS fixture (imports Tailwind, package CSS, theme)
- `tests/css/theme.css` - Test theme fixture (custom design tokens, dark mode)
- `tests/assets/app.css` - Built CSS output (gitignored)

The test CSS files are **test fixtures**, not part of the package. They import the package's `resources/css/tailwind.css` and add test-specific theme customization.

### Testing
```bash
vendor/bin/pest                    # Run all tests
vendor/bin/pest --filter TestName  # Run specific test
```

#### Browser Testing

Mog uses **Pest Browser Testing** (v4.x) with Playwright for end-to-end component testing. Browser tests can interact with real DOM elements, test Alpine.js behaviors, theme switching, and Livewire updates.

**Playwright MCP Server:**

When making changes to the package that may affect browser tests or require verification that the package is working correctly, use the **Playwright MCP server** to interact with the browser. This ensures that all components render correctly, interactive behaviors work as expected, and the package functions properly in a real browser environment.

**Browser Test Commands:**
```bash
vendor/bin/pest tests/Browser      # Run only browser tests
vendor/bin/pest --group=browser    # Run browser test group
vendor/bin/pest --headed           # Run with visible browser (debugging)
vendor/bin/pest --parallel         # Run tests in parallel
vendor/bin/pest --browser=firefox  # Use specific browser
```

**Test Infrastructure:**
- Test routes: `/test/button`, `/test/alpine`, `/test/theme` (defined in `tests/TestCase.php`)
- Test views: `tests/views/` with `mog-test::` namespace
- Screenshots: Auto-saved to `tests/Browser/screenshots/` on failure
- Configuration: `tests/Browser/Pest.php` (timeout, headless mode, etc.)

**Official Documentation:**

When working with browser tests, **ALWAYS fetch the latest documentation** from the official Pest docs:

```bash
# Fetch latest browser testing docs
curl -s https://raw.githubusercontent.com/pestphp/docs/refs/heads/4.x/browser-testing.md
```

**Documentation URL:** https://raw.githubusercontent.com/pestphp/docs/refs/heads/4.x/browser-testing.md

This ensures you have the most up-to-date API methods, configuration options, and testing patterns. The official docs include:
- Installation and setup steps
- All available interaction methods (`click`, `fill`, `type`, `select`, etc.)
- Assertion methods (`assertSee`, `assertVisible`, `assertUrlIs`, etc.)
- Configuration options (browser selection, timeouts, user agents, etc.)
- Debugging techniques (`debug()`, `screenshot()`, `tinker()`)
- Multi-page testing and parallel execution

**Example Browser Test:**
```php
test('button component renders and handles clicks', function () {
    $page = visit('/test/button');

    $page->assertSee('Default Button')
         ->click('[dusk="test-button-default"]')
         ->assertVisible('[dusk="test-button-default"]');
});
```

## Architecture

### Component System

Mog uses Laravel's anonymous component system with components located in `resources/components/`. Components are registered with the `mog::` prefix (e.g., `<x-mog::button>`).

**Key architectural patterns:**

1. **Array Slots Compiler** (`src/Blade/ArraySlotsCompiler.php`): Custom Blade compiler that transforms array slot syntax `<x-slot:[name]>` into `@arraySlot()` directives, enabling dynamic slot names for components like accordions and dropdowns.

2. **Self-Closing Slots** (`src/Blade/SelfClosingSlotsCompiler.php`): Handles self-closing slot syntax for more concise component definitions.

3. **TailwindMerge Integration**: All components use TailwindMerge PHP for intelligent class merging. Access via:
   - Blade directive: `@cn('class1', 'class2')`
   - Component macro: `$attributes->cn('class1', 'class2')`
   - Direct call: `app('mog')->cn('class1', 'class2')`

### JavaScript Architecture

The JavaScript layer (`resources/js/mog.js`) initializes on Alpine.js's `alpine:init` event and provides:

- **Theme System**: `window.Mog.paint(theme)` manages dark/light/system themes via localStorage (`mog::paint`)
- **Dialog Management**: Global reactive dialog stack (`window.Mog.dialogs`) with open/close/closeAll methods
- **Toast System**: Reactive toast notifications with types (default, success, error, info, warning, loading), positioned notifications, and pub/sub pattern
- **Alpine Magic**: `$mog` magic helper for accessing Mog APIs from Alpine components

### Service Provider Flow

`MogServiceProvider` registers:

1. **Blade directives**: Custom `@mog` directive injects theme system, Livewire assets, and Mog scripts
2. **Custom compilers**: Array slots and self-closing slots preprocessing
3. **Component path**: Anonymous components from `resources/components` with `mog::` namespace
4. **Script route**: `/mog/mog.js` serves built JavaScript with cache-busting via manifest.json
5. **Icons**: Registers `resources/svg` directory for Blade Icons with `mog::` prefix

### Build System

The build script (`scripts/build.js`) uses esbuild to create three bundles:
- `dist/mog.esm.js`: ESM format for Node/bundlers
- `dist/mog.js`: Development bundle for browsers
- `dist/mog.min.js`: Minified production bundle (used when `app.debug = false`)

The `@/` alias resolves to `resources/js/` in imports.

### Component Conventions

Components follow these patterns:

1. **Props destructuring**: Use `@props([...])` with defaults at the top
2. **Slot handling**: Custom slots use array syntax for dynamic names (e.g., dropdown items, accordion panels)
3. **Class merging**: Always use `$attributes->cn()` or `@cn()` for class attributes to enable user overrides
4. **Alpine integration**: Interactive components use `x-data`, `x-on`, and `$mog` magic helper

## Code Formatting

- **PHP**: Laravel Pint (PSR-12 based) - configured in Pint's defaults
- **Blade**: Prettier with blade-plugin - see `.blade.format.json` and `.prettierrc`
  - Uses Laravel Pint for embedded PHP (`useLaravelPint: true`)
  - Block-style echo formatting
  - 4 spaces, no semicolons, single quotes for JS
- **JavaScript**: Prettier with Tailwind plugin - see `.prettierrc`
  - Single quotes, no semicolons

## Important Files

- `src/MogManager.php`: Core manager class with utility methods (theme, overlays, cn, script injection)
- `src/MogServiceProvider.php`: Registers all components, directives, and integrations
- `resources/js/mog.js`: Global JavaScript API and Alpine.js integration
- `scripts/build.js`: esbuild configuration with alias resolution
- `dist/manifest.json`: Cache-busting hashes for JavaScript assets
