---
name: button-browser-tests
description: Comprehensive browser tests for button component with visual snapshot testing
depends_on: null
---

## Feature Description

Create comprehensive browser tests for the Mog button component using Pest Browser Testing with Playwright. This will test all button variants, sizes, states, and interactive behaviors (like Livewire loading states) in a real browser environment. Additionally, implement visual regression testing using screenshot snapshots to ensure the button component maintains its visual appearance across changes.

The button component has:
- **Variants**: default, destructive, outline, secondary, ghost, link
- **Sizes**: default, sm, lg, icon, icon-sm, icon-lg
- **States**: default, hover, focus, disabled, loading (Livewire)
- **Rendering modes**: button element, link element (asLink)

## Implementation Plan

### Browser Test Files

**Test file location:** `tests/Browser/ButtonComponentTest.php`

**Test organization:**
- Group tests by functionality using Pest's `describe()` blocks
- Use data providers for testing multiple variants/sizes
- Implement visual snapshot testing for appearance verification

### Test Page Enhancements

**Update:** `tests/views/button.blade.php`

Add comprehensive test cases covering:
- All button variants (default, destructive, outline, secondary, ghost, link)
- All button sizes (default, sm, lg, icon, icon-sm, icon-lg)
- Disabled states
- Loading states (with Livewire wire:click simulation)
- Buttons with icons
- Button groups
- As-link rendering mode

### Visual Snapshot Testing Setup

**Implementation approach:**
- Use Playwright's built-in screenshot comparison
- Store baseline screenshots in `tests/Browser/snapshots/`
- Compare screenshots pixel-by-pixel on test runs
- Allow small threshold for anti-aliasing differences
- Generate diff images when tests fail

**Snapshot organization:**
```
tests/Browser/snapshots/
├── button-variant-default.png
├── button-variant-destructive.png
├── button-variant-outline.png
├── button-size-sm.png
├── button-size-lg.png
├── button-state-disabled.png
├── button-state-hover.png
├── button-state-focus.png
├── button-state-loading.png
└── button-group.png
```

## Acceptance Criteria

- [ ] All button variants render correctly and are visually tested
- [ ] All button sizes render correctly and are visually tested
- [ ] Button states (hover, focus, disabled) are tested interactively
- [ ] Loading indicator appears when Livewire actions are triggered
- [ ] Buttons can be clicked and trigger expected behaviors
- [ ] As-link rendering mode works correctly
- [ ] Visual snapshots capture all button appearances
- [ ] Snapshot comparison detects visual regressions
- [ ] Tests can be run in both headed and headless modes
- [ ] Tests pass on multiple viewport sizes (desktop, mobile)
- [ ] All tests pass with `composer test`
- [ ] Code is formatted according to project standards

## Testing Strategy

### Browser Tests

**Test file location:** `tests/Browser/ButtonComponentTest.php`

**Test structure:**

```php
describe('Button Variants', function () {
    test('default variant renders correctly', function () { ... });
    test('destructive variant renders correctly', function () { ... });
    test('outline variant renders correctly', function () { ... });
    test('secondary variant renders correctly', function () { ... });
    test('ghost variant renders correctly', function () { ... });
    test('link variant renders correctly', function () { ... });
})->group('button', 'browser', 'variants');

describe('Button Sizes', function () {
    test('small button renders correctly', function () { ... });
    test('default button renders correctly', function () { ... });
    test('large button renders correctly', function () { ... });
    test('icon button renders correctly', function () { ... });
    test('icon-sm button renders correctly', function () { ... });
    test('icon-lg button renders correctly', function () { ... });
})->group('button', 'browser', 'sizes');

describe('Button States', function () {
    test('disabled button cannot be clicked', function () { ... });
    test('hover state applies correct styles', function () { ... });
    test('focus state shows focus ring', function () { ... });
    test('loading state shows spinner', function () { ... });
})->group('button', 'browser', 'states');

describe('Button Interactions', function () {
    test('button click triggers action', function () { ... });
    test('button with href navigates correctly', function () { ... });
    test('button with wire:click shows loading indicator', function () { ... });
})->group('button', 'browser', 'interactions');

describe('Visual Regression', function () {
    test('button variants match visual snapshots', function () { ... });
    test('button sizes match visual snapshots', function () { ... });
    test('button states match visual snapshots', function () { ... });
    test('button in dark mode matches snapshot', function () { ... });
})->group('button', 'browser', 'snapshots');
```

**Key test cases:**

1. **Variant Testing**
   - Visit `/test/button`
   - For each variant, verify correct background colors
   - Take screenshot of each variant
   - Compare with baseline snapshot

2. **Size Testing**
   - Verify height classes (h-8, h-9, h-10)
   - Verify padding classes
   - Take screenshots at different sizes
   - Compare with baseline snapshots

3. **State Testing**
   - Test disabled attribute prevents clicks
   - Hover over button and verify hover styles
   - Focus button and verify focus ring
   - Simulate loading state and verify spinner appears

4. **Interaction Testing**
   - Click button and verify action triggered
   - Test keyboard navigation (Tab, Enter, Space)
   - Test with Livewire wire:click simulation

5. **Visual Snapshot Testing**
   - Capture full-page screenshot of all button variants
   - Capture individual button screenshots
   - Compare pixel-by-pixel with baseline
   - Generate diff images on mismatch
   - Support updating baselines when intentional changes are made

### Snapshot Update Workflow

**Commands:**
```bash
# Run tests with snapshot comparison
vendor/bin/pest --group=snapshots

# Update baselines (when changes are intentional)
vendor/bin/pest --group=snapshots --update-snapshots

# View diff images (generated on failure)
open tests/Browser/snapshots/diffs/
```

## Code Formatting

Format all code using: Laravel Pint

Command to run: `composer lint`

## Additional Notes

**Browser Test Setup:**
- Tests will use the existing `/test/button` route
- Enhance the test view to include all variants and states
- Use `dusk` attributes for reliable element selection
- Configure viewport sizes for responsive testing

**Visual Regression Testing:**
- Playwright provides built-in `screenshot()` method
- Use `assertScreenshotMatches()` for comparison (if available in Pest Browser)
- Alternative: Use custom snapshot comparison with image diff libraries
- Store snapshots in version control for CI/CD consistency

**Testing in Different Themes:**
- Test buttons in both light and dark modes
- Use `inDarkMode()` Pest Browser method
- Capture separate snapshots for each theme

**Performance Considerations:**
- Screenshot comparison can be slow (~100-500ms per screenshot)
- Run visual tests in separate group: `--group=snapshots`
- Consider parallel execution for faster test runs
- Cache baseline images to avoid repeated comparisons

**CI/CD Integration:**
- Ensure Playwright browsers are installed in CI
- Store baseline snapshots in repository
- Configure CI to fail on visual regressions
- Allow manual approval for intentional visual changes

**Accessibility Testing:**
- Verify buttons have proper ARIA attributes
- Test keyboard navigation (Tab, Enter, Space)
- Verify focus indicators are visible
- Check color contrast ratios (can use browser devtools)

**Cross-Browser Testing:**
- Test in Chromium (default)
- Optionally test in Firefox with `--browser=firefox`
- Optionally test in Safari/WebKit with `--browser=safari`

**Mobile Testing:**
- Test on mobile viewport sizes using `.on()->mobile()`
- Test on specific devices using `.on()->iPhone14Pro()`
- Verify touch interactions work correctly

**Edge Cases to Test:**
- Very long button text (truncation/wrapping)
- Button with only icon (no text)
- Button with icon and text
- Nested buttons in button groups
- Buttons in form contexts

**Documentation:**
- Add examples of visual regression tests to project docs
- Document how to update snapshots when making intentional changes
- Provide guidelines for writing browser tests for other components
