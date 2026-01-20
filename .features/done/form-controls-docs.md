---
name: form-controls-documentation
description: Document form input components (input, textarea, checkbox, select, etc.)
depends_on: null
---

## Feature Description

Create comprehensive documentation for all form control components in the Mog library: `input`, `textarea`, `checkbox`, `switch`, `toggle`, `select`, `select-group`, `radio-group`, `radio-group-item`, and `slider`.

These components provide the interactive form elements that users interact with to input data. Documentation should cover styling variants, states (disabled, error, focus), Livewire integration, and accessibility features.

## Implementation Plan

### Documentation Structure

**Files to create:**
- `docs/input.md` - Text input and textarea
- `docs/checkbox.md` - Checkbox, switch, and toggle
- `docs/select.md` - Select and select-group
- `docs/radio-group.md` - Radio button groups
- `docs/slider.md` - Range slider input

### Each Documentation File Should Include

1. **Overview**
   - Component purpose and use cases
   - Visual examples (screenshots or descriptions)

2. **Component API**
   - Props with types and defaults
   - Slots (if applicable)
   - Attributes support
   - Styling classes

3. **Usage Examples**
   - Basic usage
   - With field wrapper
   - Error states
   - Disabled states
   - Livewire wire:model binding
   - Custom styling

4. **Accessibility**
   - ARIA attributes
   - Keyboard navigation
   - Screen reader support

5. **Related Components**
   - Cross-references to field components
   - Links to input-group components

## Acceptance Criteria

- [ ] `docs/input.md` is created with input and textarea documentation
- [ ] `docs/checkbox.md` is created covering checkbox, switch, and toggle
- [ ] `docs/select.md` is created with select and select-group usage
- [ ] `docs/radio-group.md` is created with radio group examples
- [ ] `docs/slider.md` is created with slider configuration options
- [ ] All props and attributes are documented for each component
- [ ] At least 3 usage examples per component type
- [ ] Livewire integration examples are included
- [ ] Accessibility features are documented
- [ ] Code examples are tested and formatted
- [ ] Cross-references between related components are included

## Testing Strategy

**Manual Testing**
- Review locations: All `docs/*.md` files created
- Validation steps:
  - Copy each code example into a test Laravel view
  - Verify examples render correctly
  - Test Livewire wire:model bindings work as expected
  - Validate error state styling appears correctly
  - Check accessibility with screen reader (if possible)
  - Ensure prop documentation matches implementation

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

- Components use Tailwind CSS utility classes extensively
- Form controls integrate with Livewire for reactive updates
- Error states are triggered via `aria-invalid` attribute
- Focus states use `focus-visible:ring-ring/50` pattern
- Dark mode variants are included with `dark:` prefix
- Select and radio components may use Alpine.js for interactivity
- Slider component uses floating-ui for positioning
