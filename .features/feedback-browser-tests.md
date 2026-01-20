---
name: feedback-browser-tests
description: Browser tests for alert, error, empty, toaster, spinner, and skeleton components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for feedback and loading state components including alert, error, empty, toaster, spinner, and skeleton. These components provide user feedback and loading indicators.

## Implementation Plan

### Test View

**Create:** `tests/views/feedback.blade.php`

Test page structure with sections for:
- Alert variants (info, success, warning, error)
- Alert with title and description
- Alert with dismiss button
- Error component for error messages
- Empty state component with icon and message
- Empty state with action button
- Toaster/toast notifications
- Toast types (default, success, error, info, warning)
- Spinner component (loading indicator)
- Spinner sizes
- Skeleton loading placeholders
- Skeleton variants (text, circle, rectangle)

### Browser Tests

**Create:** `tests/Browser/FeedbackComponentTest.php`

**Test Coverage:**
- Alert variants render correctly
- Alert with title and description
- Alert dismiss button functionality
- Error component displays error messages
- Empty state renders with icon
- Empty state action button
- Toast notifications appear
- Toast auto-dismiss behavior
- Toast types visual differences
- Spinner renders and animates
- Spinner size variants
- Skeleton placeholders render
- Skeleton shape variants

### Routes

**Update:** `tests/TestCase.php`

Add route: `/test/feedback`

## Acceptance Criteria

- [ ] Alert variants (info, success, warning, error) tested
- [ ] Alert dismiss functionality tested
- [ ] Error component tested
- [ ] Empty state with icon and message tested
- [ ] Empty state action button tested
- [ ] Toast notifications display correctly
- [ ] Toast auto-dismiss tested
- [ ] Spinner renders correctly
- [ ] Spinner size variants tested
- [ ] Skeleton placeholders tested
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/alert/`
- `tests/Browser/screenshots/error/`
- `tests/Browser/screenshots/empty/`
- `tests/Browser/screenshots/toaster/`
- `tests/Browser/screenshots/spinner/`
- `tests/Browser/screenshots/skeleton/`

**Test Groups:**
- `alert`, `error`, `empty`, `toaster`, `spinner`, `skeleton`
- `browser`, `feedback`, `loading`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Toaster uses the global Mog toast system
- Test toast auto-dismiss with usleep() timing
- Spinner may be animated (CSS animations)
- Skeleton is typically used during data loading
- Empty states should be visually distinct
