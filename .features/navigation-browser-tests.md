---
name: navigation-browser-tests
description: Browser tests for accordion, pagination, and link components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for navigation and content organization components including accordion, pagination, and link. These components help users navigate through content and pages.

## Implementation Plan

### Test View

**Create:** `tests/views/navigation.blade.php`

Test page structure with sections for:
- Accordion with multiple panels
- Accordion expand/collapse behavior
- Accordion with default open panel
- Pagination with multiple pages
- Pagination previous/next buttons
- Pagination page numbers
- Link component with different variants
- Link with icons
- External vs internal links

### Browser Tests

**Create:** `tests/Browser/NavigationComponentTest.php`

**Test Coverage:**
- Accordion renders with multiple panels
- Accordion panel expands on click
- Accordion panel collapses when another opens
- Accordion with default open panel
- Pagination displays page numbers
- Pagination previous/next buttons
- Pagination active page styling
- Pagination disabled states
- Link component renders correctly
- Link with icon renders
- Link hover states
- External link indicators

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/navigation`

## Acceptance Criteria

- [ ] Accordion expands/collapses correctly
- [ ] Accordion single-open behavior tested
- [ ] Pagination page numbers render
- [ ] Pagination navigation tested
- [ ] Pagination active/disabled states tested
- [ ] Link component variants tested
- [ ] Link with icons tested
- [ ] Link hover states tested
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/accordion/`
- `tests/Browser/screenshots/pagination/`
- `tests/Browser/screenshots/link/`

**Test Groups:**
- `accordion`, `pagination`, `link`
- `browser`, `navigation`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Accordion uses Alpine.js for expand/collapse
- Test both single and multiple open panels
- Pagination may be functional or visual only
- Link component should support all HTML link features
