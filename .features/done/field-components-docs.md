---
name: field-components-documentation
description: Document field and fieldset components for form layouts
depends_on: null
---

## Feature Description

Create comprehensive documentation for the Field component family, which provides flexible form layout containers in the Mog component library. This includes the base `field` component and all related sub-components (`field-label`, `field-error`, `field-description`, `field-legend`, `field-group`, `field-content`, `field-separator`, `field-title`) and the `fieldset` component.

These components are essential for building accessible and well-structured forms with proper label-input associations, error messaging, help text, and flexible orientations (vertical, horizontal, responsive).

## Implementation Plan

### Documentation Structure

**File to create:** `docs/field.md`

The documentation should include:

1. **Overview Section**
   - Purpose of field components
   - When to use field vs fieldset
   - Accessibility features

2. **Component Specifications**
   - `<x-field>` - Main wrapper with orientation support
   - `<x-field-label>` - Accessible label element
   - `<x-field-error>` - Error message display
   - `<x-field-description>` - Help text/description
   - `<x-field-legend>` - Legend for fieldsets
   - `<x-field-group>` - Grouping multiple fields
   - `<x-field-content>` - Content wrapper
   - `<x-field-separator>` - Visual separator
   - `<x-field-title>` - Title for field groups
   - `<x-fieldset>` - Fieldset wrapper

3. **Props/Attributes Documentation**
   - For each component, document:
     - Available props with types and defaults
     - Accepted attribute values
     - Slot usage

4. **Usage Examples**
   - Basic field with label and input
   - Field with error state
   - Field with description
   - Horizontal orientation
   - Responsive orientation
   - Fieldset with multiple inputs
   - Complex nested field groups

5. **Best Practices**
   - Accessibility guidelines
   - Error handling patterns
   - Layout recommendations

6. **Related Components**
   - Link to input, textarea, checkbox, etc.

## Acceptance Criteria

- [ ] Documentation file `docs/field.md` is created
- [ ] All field-related components are documented with descriptions
- [ ] All props and attributes are documented with types and defaults
- [ ] At least 5 practical usage examples are provided
- [ ] Code examples are tested and work correctly
- [ ] Accessibility features are clearly explained
- [ ] Navigation between related components is included
- [ ] Code is formatted according to project standards

## Testing Strategy

**Manual Testing**
- Review location: `docs/field.md`
- Validation steps:
  - Verify all code examples are valid Blade syntax
  - Test each example in a Laravel view to ensure it renders correctly
  - Check that prop values match actual component implementation
  - Validate accessibility claims (aria attributes, role values)
  - Ensure examples cover common use cases

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

- Field components use `data-slot` attributes for styling hooks
- Orientation prop supports: `vertical`, `horizontal`, `responsive`
- The `responsive` orientation uses Tailwind's container query modifiers (`@md/field-group`)
- Error states are controlled via `data-invalid` attribute
- Components integrate with Livewire for reactive error display
- The `cn()` helper is used for class merging (from tailwind-merge-php)
