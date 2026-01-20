---
name: card-layout-browser-tests
description: Browser tests for card, corner, group, separator, and scrollable layout components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for layout and structural components including card, corner, group, separator, and scrollable. These components provide the foundational layout structure for the UI library.

## Implementation Plan

### Test View

**Create:** `tests/views/card-layout.blade.php`

Test page structure with sections for:
- Card component with header, content, footer slots
- Corner component for rounded corner indicators
- Group component for grouping related elements
- Separator component (horizontal and vertical)
- Scrollable component for overflow content

### Browser Tests

**Create:** `tests/Browser/CardLayoutTest.php`

**Test Coverage:**
- Card component renders with all slots (header, content, footer)
- Card with only content
- Corner component positioning (top-left, top-right, bottom-left, bottom-right)
- Group component with multiple children
- Separator orientation (horizontal, vertical)
- Separator with label/text
- Scrollable component with overflow content
- Scrollable component scroll behavior

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/card-layout`

## Acceptance Criteria

- [ ] Card component with all slots renders correctly
- [ ] Card with partial slots tested
- [ ] Corner component positioning tested
- [ ] Group component renders children correctly
- [ ] Separator horizontal and vertical orientations tested
- [ ] Separator with label tested
- [ ] Scrollable component renders with overflow
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/card/`
- `tests/Browser/screenshots/corner/`
- `tests/Browser/screenshots/group/`
- `tests/Browser/screenshots/separator/`
- `tests/Browser/screenshots/scrollable/`

**Test Groups:**
- `card`, `corner`, `group`, `separator`, `scrollable`
- `browser`, `layout`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Card is a composite component with multiple slots
- Corner may have positioning attributes
- Separator can be decorative or semantic
- Scrollable needs content larger than container to test scrolling
