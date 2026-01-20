---
name: input-textarea-browser-tests
description: Browser tests for input and textarea components following button test pattern
depends_on: null
---

## Feature Description

Create comprehensive browser tests for the input and textarea components following the exact pattern established in `tests/views/button.blade.php` and `tests/Browser/ButtonComponentTest.php`. Tests will verify all input types, sizes, states, and take screenshots organized in `tests/Browser/screenshots/input/` and `tests/Browser/screenshots/textarea/`.

## Implementation Plan

### Test View

**Create:** `tests/views/input.blade.php`

Structure following button pattern:
```blade
@extends('mog-test::layout')

@section('title', 'Input Component Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Input Component Tests</h1>

        {{-- Input Types --}}
        <section dusk="section-types" class="space-y-4">
            <h2 class="text-2xl font-semibold">Input Types</h2>
            <div class="flex flex-wrap gap-4">
                <x-mog::input type="text" dusk="type-text" placeholder="Text input" />
                <x-mog::input type="email" dusk="type-email" placeholder="Email input" />
                <x-mog::input type="password" dusk="type-password" placeholder="Password" />
                <x-mog::input type="number" dusk="type-number" placeholder="Number" />
                {{-- etc --}}
            </div>
        </section>

        {{-- Input Sizes --}}
        <section dusk="section-sizes" class="space-y-4">
            <h2 class="text-2xl font-semibold">Sizes</h2>
            <div class="flex flex-col gap-4">
                <x-mog::input size="xs" dusk="size-xs" placeholder="Extra Small" />
                <x-mog::input size="sm" dusk="size-sm" placeholder="Small" />
                <x-mog::input size="md" dusk="size-md" placeholder="Medium (default)" />
                <x-mog::input size="xl" dusk="size-xl" placeholder="Extra Large" />
            </div>
        </section>

        {{-- Input States --}}
        <section dusk="section-states" class="space-y-4">
            <h2 class="text-2xl font-semibold">States</h2>
            <div class="flex flex-col gap-4">
                <x-mog::input dusk="state-default" placeholder="Default" />
                <x-mog::input disabled dusk="state-disabled" placeholder="Disabled" value="Disabled" />
                <x-mog::input readonly dusk="state-readonly" placeholder="Readonly" value="Readonly" />
                <x-mog::input invalid dusk="state-invalid" placeholder="Invalid/Error" />
            </div>
        </section>

        {{-- Textarea --}}
        <section dusk="section-textarea" class="space-y-4">
            <h2 class="text-2xl font-semibold">Textarea</h2>
            <div class="flex flex-col gap-4">
                <x-mog::textarea dusk="textarea-default" placeholder="Default textarea" rows="3" />
                <x-mog::textarea dusk="textarea-disabled" disabled placeholder="Disabled" rows="3" />
            </div>
        </section>
    </div>
@endsection
```

### Browser Tests

**Create:** `tests/Browser/InputComponentTest.php`

Following button test pattern:
```php
<?php

describe('Input Types', function (): void {
    test('text input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-text"]');

        $page->screenshotElement('[dusk="type-text"]', filename: 'input/input-type-text');
    });

    test('email input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-email"]');

        $page->screenshotElement('[dusk="type-email"]', filename: 'input/input-type-email');
    });

    // More type tests...
})->group('input', 'browser', 'types');

describe('Input Sizes', function (): void {
    test('extra small input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="size-xs"]');

        $page->screenshotElement('[dusk="size-xs"]', filename: 'input/input-size-xs');
    });

    // More size tests...
})->group('input', 'browser', 'sizes');

describe('Input States', function (): void {
    test('disabled input cannot be edited', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="state-disabled"]');
        $page->assertScript('document.querySelector("[dusk=state-disabled]").hasAttribute("disabled")', true);

        $page->screenshotElement('[dusk="state-disabled"]', filename: 'input/input-state-disabled');
    });

    // More state tests...
})->group('input', 'browser', 'states');

describe('Textarea Component', function (): void {
    test('textarea renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="textarea-default"]');

        $page->screenshotElement('[dusk="textarea-default"]', filename: 'textarea/textarea-default');
    });

    // More textarea tests...
})->group('textarea', 'browser');
```

### Routes

**Update:** `tests/TestCase.php`

Add route:
```php
$router->get('/test/input', function () {
    return view('mog-test::input');
});
```

### Screenshot Organization

Screenshots will be stored in:
- `tests/Browser/screenshots/input/` - All input component screenshots
- `tests/Browser/screenshots/textarea/` - All textarea screenshots

Filenames follow pattern: `{component}/{component}-{variant}-{value}.png`

## Acceptance Criteria

- [ ] Test view created following button.blade.php pattern
- [ ] All input types tested (text, email, password, number, tel, url, date, file)
- [ ] All input sizes tested (xs, sm, md, xl)
- [ ] All input states tested (default, disabled, readonly, invalid)
- [ ] Textarea component tested
- [ ] Screenshots saved to `tests/Browser/screenshots/input/`
- [ ] Screenshots saved to `tests/Browser/screenshots/textarea/`
- [ ] All tests pass with `vendor/bin/pest --group=input`
- [ ] Code formatted with Laravel Pint and Prettier

## Testing Strategy

**Pattern:** Exactly match button test structure
- One test per variant/size/state
- Each test visits page, asserts visibility, takes screenshot
- Use `describe()` blocks to organize tests
- Use `dusk` attributes for selectors
- Screenshots use filename pattern: `{component}/{descriptive-name}`

**Groups:**
- `input` - All input tests
- `textarea` - All textarea tests
- `browser` - Browser test marker

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

**Input Types to Test:**
- text, email, password
- number, tel, url
- date, time, datetime-local
- file
- search

**Key Differences from Button:**
- Inputs have value binding (test typing)
- File inputs have special handling
- Readonly vs disabled states

**Screenshot Strategy:**
- Organize by component subdirectory
- One screenshot per test variant
- Full sections for comparison shots
