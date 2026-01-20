---
name: installation-documentation
description: Create comprehensive installation guide for Mog UI component library
depends_on: null
---

## Feature Description

Create an `installation.md` documentation file that provides clear, step-by-step instructions for installing and configuring Mog in a Laravel application. The guide should cover:

1. Composer package installation
2. Layout integration with `@mog` directive and `<x-mog::overlay />` component
3. Tailwind CSS configuration with theme imports
4. Custom theme configuration using CSS variables (similar to shadcn/ui approach)

The documentation should emphasize that users can customize the design system via CSS variables and that the test CSS files (`tests/css/app.css` and `tests/css/theme.css`) are provided as reference examples that can be combined into a single file.

## Implementation Plan

### Documentation Structure

**File to create:**
- `docs/installation.md` - Complete installation and setup guide

### Documentation Sections

1. **Prerequisites**
   - Laravel version requirements
   - Node.js and package manager requirements
   - TailwindCSS v4 requirement

2. **Installation Steps**
   - Step 1: Require the Composer package
   - Step 2: Add `@mog` directive to layout head
   - Step 3: Add `<x-mog::overlay />` before closing body tag
   - Step 4: Configure Tailwind CSS imports
   - Step 5: Configure theme (CSS variables)

3. **Tailwind Configuration**
   - Import structure based on `tests/css/app.css`
   - How to import `resources/css/tailwind.css` from the package
   - Setting up `@source` directives for component scanning
   - Reference to test files as examples

4. **Theme Customization**
   - Explanation of CSS variable-based theming (like shadcn/ui)
   - Reference to `tests/css/theme.css` for theme structure
   - Custom variant examples (`@custom-variant dark`, `@custom-variant fixed`)
   - `@theme inline` token definitions
   - Light and dark mode color schemes with oklch values
   - How to customize colors via CSS variables

5. **Verification**
   - How to test the installation
   - Example component usage to verify setup
   - Troubleshooting common issues

6. **Next Steps**
   - Link to component documentation
   - Link to theming guide
   - Link to examples

### Key Technical Details to Include

From `tests/css/app.css`:
```css
@import 'tailwindcss';
@import 'tw-animate-css';
@import '../../resources/css/tailwind.css';
@source '../../resources/components/**/*.blade.php';
@source '../../vendor/livewire/livewire/src/Features/SupportAttributes/views/**/*.blade.php';
@import './theme.css';
@source '../**/*.blade.php';
```

From `tests/css/theme.css`:
- Custom variants: `@custom-variant dark (&:is(.dark *))`
- `@theme inline` with design tokens (radius, colors)
- CSS variable structure for colors (background, foreground, primary, etc.)
- Light mode (`:root`) and dark mode (`.dark`) color schemes
- oklch color format usage

### Important Emphasize Points

1. **Flexibility**: Users don't need separate files - they can combine app.css and theme.css as long as they import `resources/css/tailwind.css`
2. **Customization**: Colors are fully customizable via CSS variables
3. **Shadcn-like approach**: Same theming system as shadcn/ui for familiarity
4. **Test files are references**: The files in `tests/css/` are examples, not requirements
5. **Package CSS import**: Must import the package's `resources/css/tailwind.css` file
6. **Component scanning**: Use `@source` to scan both Mog components and your own Blade files

## Acceptance Criteria

- [ ] `docs/installation.md` is created with complete installation instructions
- [ ] Composer package installation step is documented
- [ ] Layout integration with `@mog` and `<x-mog::overlay />` is explained clearly
- [ ] Tailwind CSS setup is documented with import structure from `tests/css/app.css`
- [ ] Theme configuration is documented with reference to `tests/css/theme.css`
- [ ] CSS variable customization is explained with examples
- [ ] Documentation emphasizes flexibility (users can combine files)
- [ ] Documentation emphasizes that colors are customizable via CSS variables
- [ ] Comparison to shadcn/ui theming approach is mentioned
- [ ] Code examples are properly formatted with syntax highlighting
- [ ] Troubleshooting section addresses common setup issues
- [ ] Next steps and links to other documentation are provided

## Testing Strategy

**Manual Testing**
- Review location: `docs/installation.md`
- Validation steps:
  - Verify all installation steps are clear and complete
  - Check that code examples match actual test file structure
  - Ensure CSS variable examples are accurate
  - Verify links to other documentation pages work
  - Test that instructions can be followed by a new user
  - Validate that both combined and separated CSS approaches are explained

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

### Reference Files
- `tests/css/app.css` - Main CSS entry point with imports and @source directives
- `tests/css/theme.css` - Theme definition with CSS variables and color schemes

### Key Distinctions to Clarify
1. The test CSS files are **examples** for testing the package, not required structure
2. Users need to import the **package's** `resources/css/tailwind.css`, not create their own
3. Users can structure their CSS however they want, as long as they:
   - Import Tailwind CSS
   - Import the package's CSS file
   - Configure `@source` to scan components
   - Define theme variables

### Theming Philosophy
- Uses oklch color format for consistent perceptual color space
- CSS variables follow shadcn/ui conventions for familiarity
- Custom variants (`dark`, `fixed`) for scoped styling
- Design tokens defined in `@theme inline` for Tailwind integration
- Full customization without touching component source code

### Package Structure Context
- Components: `resources/components/**/*.blade.php`
- Package CSS: `resources/css/tailwind.css`
- JavaScript: `resources/js/mog.js`
- SVG Icons: `resources/svg/**/*.svg`

### Installation Flow Summary
1. Composer require → Package installed
2. Add `@mog` to head → JavaScript and styles loaded
3. Add `<x-mog::overlay />` to body → Modal/toast infrastructure ready
4. Configure CSS → Import package CSS + define theme
5. Use components → Start building with `<x-mog::button>`, etc.
