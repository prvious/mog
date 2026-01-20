---
name: pest-browser-testing-setup
description: Install and configure Pest Browser plugin with Playwright for end-to-end component testing
depends_on: orchestra-testbench-setup
---

## Feature Description

Pest Browser plugin provides browser automation testing capabilities using Playwright under the hood. This enables end-to-end testing of Mog's Blade components with real browser interactions, including Alpine.js behaviors, Livewire updates, and the JavaScript-powered theme system.

This feature will install `pestphp/pest-plugin-browser` and configure Playwright for testing component rendering, Alpine.js interactions (click handlers, x-data reactivity), Livewire component state changes, theme system (dark/light/system mode switching), and the global dialog and toast notification systems.

The setup will provide the foundation for comprehensive browser-based testing without creating specific component tests (infrastructure only).

## Implementation Plan

### Backend Components

**Composer Dependencies:**
- Add `pestphp/pest-plugin-browser: ^3.0` to `require-dev` (compatible with Pest 4.x)
- This plugin includes Playwright PHP bindings automatically

**Browser Driver Installation:**
- Run `php artisan pest:install-browser-driver` to install Playwright binaries
- Configure for headless Chrome by default (can switch to headed for debugging)

**Pest Configuration:**
- Create `tests/Browser/Pest.php` for browser test configuration
- Configure browser options (headless mode, viewport size, etc.)
- Set up base URL for testing (e.g., `http://localhost:8080`)

**Test Infrastructure:**
- Create `tests/Browser/` directory for browser tests
- Add browser test helper methods to TestCase:
  - `serveMogApp()` - Start test server with Mog components
  - `waitForAlpine()` - Wait for Alpine.js to initialize
  - `waitForLivewire()` - Wait for Livewire to finish updates

**Server Configuration:**
- Use Testbench's built-in server for serving test application
- Configure routes for test pages with Mog components
- Create test layouts with `@mog` directive for theme/scripts

### Configuration/Infrastructure

**Environment Variables:**
- `BROWSER_HEADLESS=true` - Run tests in headless mode by default
- `BROWSER_DEBUG=false` - Enable screenshots/videos on failure
- `TEST_SERVER_PORT=8080` - Port for test server

**Asset Compilation:**
- Ensure `dist/mog.js` is built before browser tests
- Configure test environment to serve static assets
- Set `APP_DEBUG=true` for non-minified JavaScript in tests

**Playwright Setup:**
- Configure browser contexts (localStorage for theme testing)
- Set up screenshot directory for failed tests
- Configure timeout settings (default 30s)

**Test Routes:**
- Create `tests/routes/web.php` for test-only routes
- Define routes that render test pages with components
- Example: `/test/button`, `/test/dialog`, `/test/theme`

## Acceptance Criteria

- [ ] Pest Browser plugin is installed and configured
- [ ] Playwright browser binaries are installed via `pest:install-browser-driver`
- [ ] Browser test directory structure is created (`tests/Browser/`)
- [ ] Test server can serve Mog components with Alpine.js and Livewire
- [ ] Can navigate to test pages in browser tests
- [ ] Can interact with Alpine.js-powered components (click, type, etc.)
- [ ] Can access browser console logs and network requests
- [ ] Can wait for Alpine.js and Livewire to initialize
- [ ] Can test localStorage for theme persistence
- [ ] Failed tests generate screenshots for debugging
- [ ] All tests pass with `composer test`
- [ ] Code is formatted according to project standards

## Testing Strategy

### Browser Infrastructure Test

**Test file location:** `tests/Browser/BrowserTestInfrastructureTest.php`

**Key test cases:**
- Verify browser can navigate to test pages
- Verify Alpine.js loads and initializes
- Verify `window.Mog` object is available
- Verify Livewire assets are loaded
- Verify can access browser console logs
- Verify can take screenshots

### Example Workflow (Documentation Only)

**Not implemented in this feature, but demonstrates capabilities:**

```php
// Example: Testing button component with Alpine.js
test('button component renders and handles clicks', function () {
    $this->browse(function ($browser) {
        $browser->visit('/test/button')
            ->waitForAlpine()
            ->assertSee('Click me')
            ->click('@test-button')
            ->waitForText('Clicked!')
            ->assertVisible('@click-result');
    });
});

// Example: Testing theme system
test('theme system persists in localStorage', function () {
    $this->browse(function ($browser) {
        $browser->visit('/test/theme')
            ->waitForAlpine()
            ->click('@dark-mode-toggle')
            ->assertLocalStorage('mog::paint', 'dark')
            ->refresh()
            ->waitForAlpine()
            ->assertLocalStorage('mog::paint', 'dark');
    });
});

// Example: Testing Livewire component interaction
test('livewire component updates state', function () {
    $this->browse(function ($browser) {
        $browser->visit('/test/livewire-form')
            ->waitForLivewire()
            ->type('@name-input', 'John Doe')
            ->click('@submit-button')
            ->waitForLivewireRefresh()
            ->assertSee('Hello, John Doe');
    });
});

// Example: Testing dialog system
test('dialog opens and closes via global Mog API', function () {
    $this->browse(function ($browser) {
        $browser->visit('/test/dialog')
            ->waitForAlpine()
            ->click('@open-dialog-button')
            ->waitForDialog()
            ->assertDialogVisible('test-dialog')
            ->click('@close-button')
            ->assertDialogHidden('test-dialog');
    });
});
```

## Code Formatting

Format all code using: Laravel Pint

Command to run: `composer lint`

## Additional Notes

**Browser Driver Management:**
- Playwright supports Chrome, Firefox, and WebKit
- Default to Chromium for consistency
- Drivers are installed per-project, not globally
- First run will download ~170MB of browser binaries

**Test Server Considerations:**
- Testbench provides `artisan serve` equivalent for tests
- Server starts automatically when browser tests run
- Assets must be compiled before running browser tests
- Use `pnpm build` before running browser tests

**Performance:**
- Browser tests are slower than unit tests (~1-2s per test)
- Run browser tests in separate suite: `vendor/bin/pest tests/Browser`
- CI should run unit tests first, browser tests after
- Consider parallel execution for large browser test suites

**Debugging:**
- Set `BROWSER_HEADLESS=false` to watch tests run
- Use `$browser->pause()` to stop execution and inspect
- Screenshots saved to `tests/Browser/screenshots/` on failure
- Console logs available via `$browser->logs()`

**Alpine.js and Livewire Integration:**
- Must wait for Alpine initialization: `waitForAlpine()`
- Must wait for Livewire updates: `waitForLivewire()`
- Test JavaScript-driven behaviors: dialogs, toasts, theme switching
- Access browser APIs: localStorage, sessionStorage, console

**Test Isolation:**
- Each test gets a fresh browser context
- localStorage/sessionStorage cleared between tests
- Cookies cleared between tests
- Database transactions for data isolation

**Component Testing Strategy:**
- Component rendering: verify HTML structure and classes
- Alpine.js interactions: click, type, visibility toggles
- Livewire updates: form submissions, state changes
- Theme system: localStorage persistence, CSS class changes
- Dialogs/Toasts: open/close, stacking, positioning

**CI/CD Considerations:**
- GitHub Actions: Use `shivammathur/setup-php` with extensions
- Install Node.js for asset compilation: `actions/setup-node@v4`
- Cache Playwright browsers: `~/.cache/ms-playwright`
- Run with `--headless` in CI environments
- Increase timeout for slow CI runners

**Future Enhancements:**
- Visual regression testing with screenshot comparison
- Accessibility testing with aXe integration
- Mobile viewport testing
- Cross-browser testing (Firefox, Safari/WebKit)
- Performance profiling in tests
