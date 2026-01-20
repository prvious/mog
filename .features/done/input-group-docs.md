---
name: input-group-documentation
description: Document input-group components for composite input layouts
depends_on: form-controls-documentation
---

## Feature Description

Create comprehensive documentation for the Input Group component family: `input-group`, `input-group-addon`, `input-group-button`, `input-group-input`, `input-group-text`, and `input-group-textarea`.

Input groups allow combining text inputs with buttons, icons, or text labels to create composite form controls like search boxes with buttons, currency inputs with symbols, or URL inputs with protocol prefixes.

## Implementation Plan

### Documentation Structure

**File to create:** `docs/input-group.md`

The documentation should cover:

1. **Overview**
   - Purpose of input groups
   - Common use cases (search, currency, URLs, etc.)
   - Component composition pattern

2. **Component Specifications**
   - `<x-input-group>` - Main wrapper component
   - `<x-input-group-input>` - Input element within group
   - `<x-input-group-textarea>` - Textarea within group
   - `<x-input-group-addon>` - Icon or text addon
   - `<x-input-group-button>` - Button within group
   - `<x-input-group-text>` - Static text label

3. **Props/Attributes**
   - Alignment options (inline-start, inline-end, block-start, block-end)
   - Focus state handling
   - Error state propagation
   - Height variations

4. **Usage Examples**
   - Search input with button
   - Currency input with symbol
   - URL input with protocol prefix
   - Email input with domain suffix
   - Text input with icon addon
   - Textarea with character counter
   - Multiple addons (prefix and suffix)
   - Block-aligned addons (top/bottom)

5. **Styling & States**
   - Focus behavior (unified border and ring)
   - Error states
   - Disabled states
   - Dark mode support

6. **Integration**
   - Using with Livewire
   - Combining with field components

## Acceptance Criteria

- [ ] Documentation file `docs/input-group.md` is created
- [ ] All input-group sub-components are documented
- [ ] Alignment options are clearly explained with examples
- [ ] At least 6 practical examples covering different use cases
- [ ] Focus and error state behavior is documented
- [ ] Code examples are tested and work correctly
- [ ] Integration with field components is shown
- [ ] Dark mode variants are documented
- [ ] Code is formatted according to project standards

## Testing Strategy

**Manual Testing**
- Review location: `docs/input-group.md`
- Validation steps:
  - Test each alignment option example
  - Verify focus states work as expected (unified border)
  - Check error state propagation to parent container
  - Test with Livewire wire:model binding
  - Validate examples render in both light and dark mode
  - Ensure nested structure matches implementation

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

- Input groups use `data-align` attribute for positioning addons
- Focus state is managed at the group level using `has-[[data-slot=input-group-control]:focus-visible]` selector
- Error states propagate from child inputs to the group wrapper
- The component supports both inline (left/right) and block (top/bottom) addon alignment
- Height is automatically adjusted for textarea elements
- Uses `data-ignore` pattern for nested component scanning
- Tailwind container queries are used for responsive behavior
