---
name: orchestra-testbench-setup
description: Install and configure Orchestra Testbench for comprehensive Laravel package testing
depends_on: null
---

## Feature Description

Orchestra Testbench provides a full Laravel application environment for testing Laravel packages. Currently, Mog's test suite uses basic PHPUnit with mocked components, which limits the ability to test real Laravel functionality like service providers, Blade compilation, view rendering, and Livewire integration.

This feature will install Orchestra Testbench v10.x (supporting Laravel 11-12) and update the test infrastructure to provide a complete Laravel testing environment, enabling full integration testing of Blade components, custom compilers, directives, and the Mog service provider.

## Implementation Plan

### Backend Components

**Composer Dependencies:**
- Add `orchestra/testbench: ^10.0` to `require-dev`
- Verify compatibility with existing Pest 4.x setup

**Test Infrastructure Updates:**
- Refactor `tests/TestCase.php` to extend `Orchestra\Testbench\TestCase`
- Add `getPackageProviders()` method to register `Mog\MogServiceProvider`
- Add `getPackageAliases()` method to register Mog facade
- Configure package path and environment setup
- Remove manual mocking code (container, view factory) that Testbench handles

**PHPUnit Configuration:**
- Update `phpunit.xml` to include environment variables for testing
- Add `CACHE_STORE=array` to avoid cache conflicts
- Add `VIEW_COMPILED_PATH` for Blade compilation

**New Test Utilities:**
- Create helper methods in TestCase for common scenarios:
  - `assertBladeRenders($component, $expected)` - Assert component output
  - `registerTestView($name, $contents)` - Register temporary Blade views
  - `mockLivewire()` - Helper for Livewire component testing

### Configuration/Infrastructure

**Environment Setup:**
- Testbench will provide in-memory SQLite database
- Configure views path to include package resources/components
- Set up asset publishing paths for testing

**Service Provider Registration:**
- Ensure `MogServiceProvider` is loaded in test environment
- Verify custom Blade compilers are registered
- Verify custom directives (`@mog`, `@cn`) are available
- Verify icon paths are registered

## Acceptance Criteria

- [ ] Orchestra Testbench v10.x is installed and configured
- [ ] `TestCase.php` extends Orchestra's TestCase with proper package registration
- [ ] Existing test `MogManagerTest.php` passes with new setup
- [ ] Can render Blade components in tests (e.g., `view('mog::button')`)
- [ ] Custom Blade directives (`@mog`, `@cn`) work in test views
- [ ] TailwindMerge integration is available via `app('mog')->cn()`
- [ ] Array slots and self-closing slots compile correctly in tests
- [ ] All tests pass with `composer test`
- [ ] Code is formatted according to project standards

## Testing Strategy

### Unit Tests

**Test file location:** `tests/TestCase.php` (base class)

**Key test cases:**
- Verify service provider is registered
- Verify Blade directives are available
- Verify component namespace is registered
- Verify Mog singleton is bound to container

### Integration Tests

**Test file location:** `tests/OrchestraTestbenchTest.php` (new file)

**Key test cases:**
- Test rendering a simple Blade component (e.g., `<x-mog::button>`)
- Test `@mog` directive injects scripts
- Test `@cn()` directive merges classes correctly
- Test array slot compilation in accordion/dropdown components
- Test Livewire asset injection via `@mog` directive

## Code Formatting

Format all code using: Laravel Pint

Command to run: `composer lint`

## Additional Notes

**Breaking Changes:**
- Existing `TestCase::mockViewFactory()` and `TestCase::compiler()` methods will be removed as Orchestra Testbench provides real implementations
- Tests that relied on mocking container instances will need minor updates

**Benefits:**
- Real Blade compilation instead of mocked compilers
- Full service provider lifecycle (register, boot)
- Access to Laravel facades and helpers
- Database testing with migrations
- Actual view rendering with component resolution
- Foundation for browser testing with Pest Browser

**Migration Strategy:**
1. Install Orchestra Testbench
2. Update TestCase base class
3. Remove manual mocking code
4. Run existing tests to verify compatibility
5. Add integration tests for new capabilities

**Dependencies for Next Feature:**
This setup is a prerequisite for `pest-browser-testing-setup` which requires a full Laravel application environment.
