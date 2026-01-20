---
name: media-display-browser-tests
description: Browser tests for avatar, aspect-ratio, and badge components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for media and display utility components including avatar, aspect-ratio, and badge. These components enhance visual presentation of content.

## Implementation Plan

### Test View

**Create:** `tests/views/media-display.blade.php`

Test page structure with sections for:
- Avatar component with image
- Avatar with initials fallback
- Avatar sizes (xs, sm, md, lg, xl)
- Avatar shapes (circle, square)
- Aspect-ratio container (16:9, 4:3, 1:1, etc.)
- Aspect-ratio with image content
- Aspect-ratio with video or iframe
- Badge component variants
- Badge sizes
- Badge with dot indicator
- Badge colors/variants

### Browser Tests

**Create:** `tests/Browser/MediaDisplayTest.php`

**Test Coverage:**
- Avatar with image renders correctly
- Avatar with initials fallback
- Avatar size variants (xs, sm, md, lg, xl)
- Avatar shape variants (circle, square)
- Aspect-ratio maintains ratio
- Aspect-ratio with different ratios (16:9, 4:3, 1:1)
- Aspect-ratio with image content
- Badge component renders
- Badge variants (default, primary, secondary, etc.)
- Badge sizes
- Badge with dot indicator
- Badge positioning (when used with other components)

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/media-display`

## Acceptance Criteria

- [ ] Avatar with image tested
- [ ] Avatar initials fallback tested
- [ ] Avatar sizes tested
- [ ] Avatar shapes tested
- [ ] Aspect-ratio containers maintain ratios
- [ ] Aspect-ratio with various ratios tested
- [ ] Badge variants tested
- [ ] Badge sizes tested
- [ ] Badge with dot indicator tested
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/avatar/`
- `tests/Browser/screenshots/aspect-ratio/`
- `tests/Browser/screenshots/badge/`

**Test Groups:**
- `avatar`, `aspect-ratio`, `badge`
- `browser`, `media`, `display`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Avatar should handle missing images gracefully
- Aspect-ratio uses CSS to maintain proportions
- Badge is typically used for counts or status indicators
- Test badge positioning when used with avatars or buttons
