---
name: table-browser-tests
description: Browser tests for table, tr, th, and cell components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for table components including table, tr (table row), th (table header), and cell. These components provide structured data table layouts.

## Implementation Plan

### Test View

**Create:** `tests/views/table.blade.php`

Test page structure with sections for:
- Basic table with headers and rows
- Table with different column alignments
- Table with sortable headers
- Table with hoverable rows
- Table with striped rows
- Table with bordered cells
- Responsive table (scrollable on mobile)
- Table with empty state

### Browser Tests

**Create:** `tests/Browser/TableComponentTest.php`

**Test Coverage:**
- Table structure renders correctly
- Table headers (th) render
- Table rows (tr) render
- Table cells render with content
- Table with multiple columns
- Table row hover states
- Table with striped styling
- Table with borders
- Empty table state
- Responsive table scrolling

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/table`

## Acceptance Criteria

- [ ] Table with headers and rows renders correctly
- [ ] Table headers (th) tested
- [ ] Table cells with various content tested
- [ ] Table row hover states tested
- [ ] Striped and bordered table variants tested
- [ ] Empty table state tested
- [ ] Responsive table behavior tested
- [ ] Screenshots saved to table subdirectory
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/table/`

**Test Groups:**
- `table`
- `browser`, `data-display`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Table components should render semantic HTML tables
- Test with realistic data (multiple rows and columns)
- Consider responsive behavior for small screens
- Empty state should be visually distinct
