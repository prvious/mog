---
name: tailwind-css-build-setup
description: Set up Tailwind CSS v4 CLI for building test CSS with custom theme
depends_on: null
---

## Feature Description

Set up Tailwind CSS v4 CLI to properly build CSS for browser tests. Tests previously used the Tailwind CDN which doesn't include the custom theme, color variables, and proper styling that the Mog components expect.

This setup will:
- Install Tailwind CSS v4 CLI and tw-animate-css
- Create test CSS fixtures in `tests/css/`
- Create `theme.css` with custom variants and design tokens
- Create `app.css` test fixture with proper imports
- Update test layout to use built CSS
- Add build step to test workflow

## Implementation Plan

### 1. Install Dependencies

```bash
pnpm add -D @tailwindcss/cli tailwindcss@next tw-animate-css
```

### 2. Create CSS Test Fixtures

**File: `tests/css/theme.css`** (test fixture)
- Custom variants for dark mode and fixed layout
- Tailwind theme tokens for custom values
- Color design tokens using CSS variables
- Light and dark theme definitions

**File: `tests/css/app.css`** (test fixture)
- Import Tailwind CSS v4
- Import tw-animate-css
- Import Mog's tailwind.css from resources/css/
- Import theme.css
- Source all Blade components from the package
- Source Livewire views
- Source test views

### 3. Update Package Scripts

**File: `package.json`**
- Add `build:test` script to build CSS with Tailwind CLI
- Add `watch:test` script for development
- Input: `tests/css/app.css`
- Output: `tests/assets/app.css`

### 4. Update Test Layout

**File: `tests/views/layout.blade.php`**
- Remove Tailwind CDN script
- Add link to built CSS file
- Keep Alpine.js and Mog script

### 5. Update Build Scripts

**File: `package.json`**
- Add `build:test` script to build test CSS
- Add `watch:test` script for development
- Update test command to build CSS first

### 6. Update Composer Scripts

**File: `composer.json`**
- Update `test` script to run `pnpm build:test` before tests
- Ensure CSS is always built before browser tests run

## Acceptance Criteria

- [ ] Vite and Tailwind CSS v4 installed
- [ ] theme.css created with custom variants and tokens
- [ ] app.css created with all imports
- [ ] vite.config.js configured for test CSS builds
- [ ] Test layout updated to use built CSS
- [ ] CSS builds successfully with `pnpm build:test`
- [ ] Browser tests use properly styled components
- [ ] Dark mode styling works in tests
- [ ] All browser tests still pass
- [ ] Code formatted with project standards

## Testing Strategy

1. Build CSS: `pnpm build:test`
2. Verify CSS file created in `tests/assets/`
3. Run browser tests: `vendor/bin/pest --group=button`
4. Verify components have proper styling in screenshots
5. Test dark mode if applicable
6. Verify custom theme colors are applied

## File Structure

```
resources/css/
├── theme.css          # Custom theme with design tokens
└── app.css           # Main test CSS with imports

tests/assets/
└── app.css           # Built CSS output

tests/views/
└── layout.blade.php  # Updated to use built CSS

vite.config.js        # Vite configuration
package.json          # Updated scripts
```

## Notes

- Tailwind CSS v4 uses `@import` instead of PostCSS config
- The `@source` directive tells Tailwind where to scan for classes
- tw-animate-css provides animation utilities
- Built CSS should be gitignored but assets directory tracked
- Consider adding watch mode for development
