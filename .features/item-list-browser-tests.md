---
name: item-list-browser-tests
description: Browser tests for item component and all item-* sub-components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for the item/list component system including item, item-actions, item-content, item-description, item-footer, item-group, item-header, item-media, item-separator, and item-title. These components provide structured list item layouts.

## Implementation Plan

### Test View

**Create:** `tests/views/item.blade.php`

Test page structure with sections for:
- Basic item with title and description
- Item with media (avatar/image)
- Item with header and footer
- Item with actions (buttons, links)
- Item with all sub-components
- Item group (multiple items)
- Item with separators between elements
- Interactive item (clickable)

### Browser Tests

**Create:** `tests/Browser/ItemComponentTest.php`

**Test Coverage:**
- Item with title renders correctly
- Item with title and description
- Item with media slot (avatar, icon)
- Item with header section
- Item with footer section
- Item with action buttons
- Item content slot
- Item group with multiple items
- Item separator visual rendering
- All item sub-components together
- Interactive item click behavior

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/item`

## Acceptance Criteria

- [ ] Basic item renders with title
- [ ] Item description displays correctly
- [ ] Item media slot renders (avatar/icon)
- [ ] Item header and footer tested
- [ ] Item actions (buttons) render
- [ ] Item group with multiple items tested
- [ ] Item separator visual tested
- [ ] All sub-components render correctly together
- [ ] Interactive item behavior tested
- [ ] Screenshots saved to item subdirectory
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/item/`

**Test Groups:**
- `item`
- `browser`, `lists`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Item components are designed for list layouts (contacts, messages, etc.)
- Test with realistic content (avatars, multi-line descriptions)
- Item actions should be interactive
- Item group provides list structure
