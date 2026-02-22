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

**Test CSS Structure:**

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

### Modern Service-Oriented Architecture

Mog follows a clean, modular architecture with clear separation of concerns. All services are organized into logical namespaces:

```
src/
├── Assets/                          # Asset management (scripts, routes)
│   ├── AssetRouteProvider.php      # Registers /mog/mog.js route
│   └── ScriptAssetManager.php      # Script tag generation + manifest handling
│
├── Blade/                           # Blade compiler integrations
│   ├── Compilers/                  # Blade compilers
│   │   ├── BaseSlotCompiler.php    # Shared compiler logic
│   │   ├── ArraySlotsCompiler.php  # Array slot syntax compiler
│   │   └── SelfClosingSlotsCompiler.php # Self-closing slot compiler
│   ├── Directives/                 # Blade directive implementations
│   │   └── ArraySlotDirectives.php # Array slot directive logic
│   └── DirectiveProvider.php       # Central directive registration
│
├── Bootstrap/                       # Service provider bootstrapping
│   ├── CompilerBootstrapper.php    # Blade compiler setup
│   └── TailwindBootstrapper.php    # TailwindMerge macro setup
│
├── Theme/                           # Theme management
│   ├── ThemeManager.php            # Theme initialization scripts
│   └── OverlayManager.php          # Overlay rendering state
│
├── Utilities/                       # Utility functions
│   └── AspectRatioParser.php      # Aspect ratio parsing
│
├── MogManager.php                   # Core facade/coordinator
└── MogServiceProvider.php           # Service provider
```

**Architecture Principles:**

1. **Single Responsibility**: Each class has one clear purpose
2. **Dependency Injection**: All services use constructor injection
3. **Stateless Services**: All singletons are stateless (Octane-safe)
4. **Request-Scoped State**: State stored on Request object, not in services
5. **Testability**: Services can be unit tested in isolation

### Laravel Octane Compatibility

**Mog is fully compatible with Laravel Octane.** All services follow Octane best practices:

#### State Management

- **OverlayManager**: Uses static state that is automatically flushed between requests via Octane `\Laravel\Octane\Events\RequestTerminated::class` event
- **All other services**: Completely stateless - no mutable properties or static variables
- **No memory leaks**: No accumulating state across requests

#### Safe Patterns Used

```php
// ✅ Static state with Octane event listeners (OverlayManager)
class OverlayManager {
    private static bool $overlayRendered = false;

    public static function flushState(): void {
        static::$overlayRendered = false;
    }
}

// In MogServiceProvider:
private function bootOctaneStateFlush(): void {
    // Flush state after each Octane request
    if (class_exists(\Laravel\Octane\Events\RequestTerminated::class)) {
        $this->app['events']->listen(
            \Laravel\Octane\Events\RequestTerminated::class,
            fn () => OverlayManager::flushState()
        );
    }

    // Also flush after regular requests
    $this->app->terminating(fn () => OverlayManager::flushState());
}

// ✅ Stateless utilities (all other services)
public function parse(int|string|float $ratio): float
{
    // Pure function - no state
}
```

This pattern uses static state with automatic flushing via Octane's `RequestTerminated` event and Laravel's `terminating()` callback, ensuring compatibility with both Octane and traditional PHP-FPM deployments.

#### Service Registration

All services are registered as singletons because they are either:

- Stateless utilities (ThemeManager, AspectRatioParser, compilers)
- Use request-scoped storage (OverlayManager)
- Read-only operations (ScriptAssetManager)

This is safe under Octane because:

1. No mutable instance variables persist between requests
2. State that must persist per-request is stored on the Request object
3. All dependencies are resolved once and reused (no stale references)

### Component System

Mog uses Laravel's anonymous component system with components located in `resources/components/`. Components are registered with the `mog::` prefix (e.g., `<x-mog::button>`).

**Key architectural patterns:**

1. **Array Slots Compiler** (`src/Blade/Compilers/ArraySlotsCompiler.php`): Custom Blade compiler that transforms array slot syntax `<x-slot:[name]>` into `@arraySlot()` directives, enabling dynamic slot names for components like accordions and dropdowns.

2. **Self-Closing Slots** (`src/Blade/Compilers/SelfClosingSlotsCompiler.php`): Handles self-closing slot syntax for more concise component definitions.

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

### Core Files

- `src/MogManager.php`: Core facade/coordinator (delegates to specialized services)
- `src/MogServiceProvider.php`: Service provider (registers all services and bootstrappers)
- `resources/js/mog.js`: Global JavaScript API and Alpine.js integration
- `scripts/build.js`: esbuild configuration with alias resolution
- `dist/manifest.json`: Cache-busting hashes for JavaScript assets

### Service Classes

- `src/Theme/OverlayManager.php`: Request-scoped overlay state management (Octane-safe)
- `src/Theme/ThemeManager.php`: Theme initialization JavaScript/CSS generation
- `src/Assets/ScriptAssetManager.php`: Script tag generation with cache-busting
- `src/Assets/AssetRouteProvider.php`: Registers `/mog/mog.js` route
- `src/Utilities/AspectRatioParser.php`: Aspect ratio string parsing utility
- `src/Blade/DirectiveProvider.php`: Central Blade directive registration
- `src/Bootstrap/CompilerBootstrapper.php`: Blade compiler bootstrap
- `src/Bootstrap/TailwindBootstrapper.php`: TailwindMerge macro bootstrap

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4.18

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan

- Use the `list-artisan-commands` tool when you need to call an Artisan command to double-check the available parameters.

## URLs

- Whenever you share a project URL with the user, you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain/IP, and port.

## Tinker / Debugging

- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.
- Use the `database-schema` tool to inspect table structure before writing migrations or models.

## Reading Browser Logs With the `browser-logs` Tool

- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)

- Boost comes with a powerful `search-docs` tool you should use before trying other approaches when working with Laravel or Laravel ecosystem packages. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic-based queries at once. For example: `['rate limiting', 'routing rate limiting', 'routing']`. The most relevant results will be returned first.
- Do not add package names to queries; package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'.
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit".
3. Quoted Phrases (Exact Position) - query="infinite scroll" - words must be adjacent and in that order.
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit".
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms.

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.

## Constructors

- Use PHP 8 constructor property promotion in `__construct()`.
    - `public function __construct(public GitHub $github) { }`
- Do not allow empty `__construct()` methods with zero parameters unless the constructor is private.

## Type Declarations

- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

<!-- Explicit Return Types and Method Params -->

```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
```

## Enums

- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.

## Comments

- Prefer PHPDoc blocks over inline comments. Never use comments within the code itself unless the logic is exceptionally complex.

## PHPDoc Blocks

- Add useful array shape type definitions when appropriate.

</laravel-boost-guidelines>
