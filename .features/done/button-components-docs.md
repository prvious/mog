---
name: button-components-documentation
description: Document button, button-group, and related button components
depends_on: null
---

## Feature Description

Create comprehensive documentation for button-related components: `button`, `button-group`, `button-group-text`, and `button-separator`.

These components provide interactive buttons with various styles, sizes, loading states, and the ability to group multiple buttons together with separators and labels.

## Implementation Plan

### Documentation Structure

**Files to create:**
- `docs/button.md` - Button component with variants and states
- `docs/button-group.md` - Button grouping components

### Button Documentation (`docs/button.md`)

1. **Overview**
   - Button component purpose
   - Link vs button element support

2. **Props & Variants**
   - `variant`: default, destructive, outline, secondary, ghost, link
   - `size`: default, sm, lg, icon, icon-sm, icon-lg
   - `asLink`: render as anchor tag

3. **Features**
   - Automatic loading indicators for Livewire actions
   - Icon support
   - Disabled states
   - Focus states
   - Error states (aria-invalid)

4. **Usage Examples**
   - Basic button
   - All variant examples
   - All size examples
   - Icon-only buttons
   - Buttons with icons and text
   - Loading states with Livewire
   - Button as link
   - Submit buttons with auto-loading
   - Disabled buttons

### Button Group Documentation (`docs/button-group.md`)

1. **Overview**
   - Purpose of button groups
   - Visual cohesion for related actions

2. **Components**
   - `<x-button-group>` - Wrapper for grouped buttons
   - `<x-button-separator>` - Visual separator between buttons
   - `<x-button-group-text>` - Text label within group

3. **Usage Examples**
   - Basic button group
   - Button group with separators
   - Button group with text labels
   - Mixed button variants in group

## Acceptance Criteria

- [ ] `docs/button.md` is created with complete button documentation
- [ ] `docs/button-group.md` is created with grouping patterns
- [ ] All variants are visually demonstrated with examples
- [ ] All sizes are documented with examples
- [ ] Loading state behavior is clearly explained
- [ ] Livewire integration examples are included
- [ ] Icon usage is documented with examples
- [ ] At least 8 examples for button component
- [ ] At least 3 examples for button-group
- [ ] Code examples are tested and formatted
- [ ] Accessibility considerations are noted

## Testing Strategy

**Manual Testing**
- Review locations: `docs/button.md`, `docs/button-group.md`
- Validation steps:
  - Test each variant renders with correct styling
  - Verify loading indicators appear on Livewire actions
  - Check icon-only buttons have correct sizing
  - Test button-as-link functionality
  - Validate focus and disabled states
  - Test button groups maintain visual cohesion
  - Check that all prop combinations work as expected

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

- Button loading state is automatically detected from `wire:click` and `wire:target` attributes
- Submit buttons (`type="submit"`) show loading indicator when disabled
- Loading indicator uses `mog-loader-2` icon with rotation animation
- The `$js.` Livewire methods skip automatic loading indicators
- Button content is wrapped in a span for proper loading state transitions
- Uses `data-loading` and `data-loading-indicator` attributes for state management
- Icon sizing is automatically handled via CSS (`[&_svg]:size-4`)
- Dark mode variants adjust background opacity and colors
