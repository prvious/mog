---
name: field-components-browser-tests
description: Browser tests for field, fieldset, and all field-* sub-components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for the field component system including field, fieldset, field-content, field-description, field-error, field-group, field-label, field-legend, field-separator, and field-title. These components provide form field structure and validation feedback.

## Implementation Plan

### Test View

**Create:** `tests/views/field.blade.php`

Test page structure with sections for:
- Basic field with label and input
- Field with description
- Field with error state
- Field with all sub-components (label, description, error, etc.)
- Fieldset with legend and multiple fields
- Field group for related fields
- Field with separator
- Field with custom title

### Browser Tests

**Create:** `tests/Browser/FieldComponentTest.php`

**Test Coverage:**
- Field component with label renders correctly
- Field with description text
- Field with error message (invalid state)
- Field with all sub-components together
- Fieldset with legend and multiple fields
- Field group composition
- Field separator visual rendering
- Field title styling
- Field content slot
- Required field indicator
- Disabled field state

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/field`

## Acceptance Criteria

- [ ] Basic field with label tested
- [ ] Field description renders correctly
- [ ] Field error state displays properly
- [ ] Fieldset with legend and fields tested
- [ ] Field group composition tested
- [ ] All field sub-components render correctly
- [ ] Required and disabled states tested
- [ ] Screenshots saved to field subdirectory
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/field/`

**Test Groups:**
- `field`, `fieldset`
- `browser`, `forms`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Field components are form composition utilities
- Test with actual input components for realistic rendering
- Error states should be visually distinct
- Fieldset provides semantic grouping
