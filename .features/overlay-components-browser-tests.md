---
name: overlay-components-browser-tests
description: Browser tests for dialog, slide-over, popover, tooltip, dropdown, and overlay components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for overlay and interactive components including dialog, slide-over, popover, tooltip, dropdown, and overlay. These components provide layered UI elements that appear over content.

## Implementation Plan

### Test View

**Create:** `tests/views/overlay.blade.php`

Test page structure with sections for:
- Dialog component (modal) with trigger
- Dialog with header, content, footer
- Slide-over panel from different sides
- Popover with trigger and content
- Tooltip on hover
- Dropdown menu with items
- Overlay backdrop component

### Browser Tests

**Create:** `tests/Browser/OverlayComponentTest.php`

**Test Coverage:**
- Dialog opens on trigger click
- Dialog displays content correctly
- Dialog closes on backdrop click or close button
- Slide-over opens from side (left/right)
- Slide-over animation and dismissal
- Popover appears on trigger interaction
- Popover positioning relative to trigger
- Tooltip shows on hover
- Tooltip hides on mouse leave
- Dropdown opens on click
- Dropdown items are interactive
- Overlay backdrop renders
- Focus trapping in dialogs
- ESC key closes overlays

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/overlay`

## Acceptance Criteria

- [ ] Dialog opens and closes correctly
- [ ] Dialog content renders properly
- [ ] Slide-over animations tested
- [ ] Popover positioning tested
- [ ] Tooltip hover behavior tested
- [ ] Dropdown menu interactions tested
- [ ] Overlay backdrop tested
- [ ] Focus trapping verified
- [ ] Keyboard navigation (ESC) tested
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/dialog/`
- `tests/Browser/screenshots/slide-over/`
- `tests/Browser/screenshots/popover/`
- `tests/Browser/screenshots/tooltip/`
- `tests/Browser/screenshots/dropdown/`
- `tests/Browser/screenshots/overlay/`

**Test Groups:**
- `dialog`, `slide-over`, `popover`, `tooltip`, `dropdown`, `overlay`
- `browser`, `interactive`, `overlays`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- These components use Alpine.js for interactivity
- Test open/close state transitions
- Verify backdrop click-outside behavior
- Focus management is critical for accessibility
- Use `usleep()` for animation timing when needed
