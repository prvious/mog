---
name: select-input-group-browser-tests
description: Browser tests for select, input-group, and label components
depends_on: null
---

## Feature Description

Create browser tests for select dropdowns, input group compositions, and label components following the button test pattern. Each component gets its own screenshot subdirectory.

## Implementation Plan

### Test View

**Create:** `tests/views/select-input-group.blade.php`

```blade
@extends('mog-test::layout')

@section('title', 'Select and Input Group Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Select & Input Group Tests</h1>

        {{-- Select Basic --}}
        <section dusk="section-select" class="space-y-4">
            <h2 class="text-2xl font-semibold">Select</h2>
            <div class="flex flex-col gap-4">
                <x-mog::select dusk="select-default">
                    <option value="">Choose an option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </x-mog::select>

                <x-mog::select dusk="select-disabled" disabled>
                    <option value="">Disabled select</option>
                </x-mog::select>
            </div>
        </section>

        {{-- Select with Groups --}}
        <section dusk="section-select-groups" class="space-y-4">
            <h2 class="text-2xl font-semibold">Select with Optgroups</h2>
            <x-mog::select dusk="select-groups">
                <x-mog::select-group label="Group 1">
                    <option value="1-1">Group 1 - Option 1</option>
                    <option value="1-2">Group 1 - Option 2</option>
                </x-mog::select-group>
                <x-mog::select-group label="Group 2">
                    <option value="2-1">Group 2 - Option 1</option>
                    <option value="2-2">Group 2 - Option 2</option>
                </x-mog::select-group>
            </x-mog::select>
        </section>

        {{-- Input Group with Addons --}}
        <section dusk="section-input-group" class="space-y-4">
            <h2 class="text-2xl font-semibold">Input Group</h2>

            {{-- With text addon --}}
            <x-mog::input-group dusk="input-group-text">
                <x-mog::input-group-addon>
                    <x-mog::input-group-text>$</x-mog::input-group-text>
                </x-mog::input-group-addon>
                <x-mog::input-group-input placeholder="Amount" />
                <x-mog::input-group-addon>
                    <x-mog::input-group-text>.00</x-mog::input-group-text>
                </x-mog::input-group-addon>
            </x-mog::input-group>

            {{-- With button addon --}}
            <x-mog::input-group dusk="input-group-button">
                <x-mog::input-group-input placeholder="Search..." />
                <x-mog::input-group-addon>
                    <x-mog::input-group-button>
                        <x-mog::button>Search</x-mog::button>
                    </x-mog::input-group-button>
                </x-mog::input-group-addon>
            </x-mog::input-group>

            {{-- Multiple inputs --}}
            <x-mog::input-group dusk="input-group-multiple">
                <x-mog::input-group-input placeholder="First name" />
                <x-mog::input-group-input placeholder="Last name" />
            </x-mog::input-group>

            {{-- With textarea --}}
            <x-mog::input-group dusk="input-group-textarea">
                <x-mog::input-group-addon>
                    <x-mog::input-group-text>@</x-mog::input-group-text>
                </x-mog::input-group-addon>
                <x-mog::input-group-textarea placeholder="Comment..." rows="3" />
            </x-mog::input-group>
        </section>

        {{-- Label Variants --}}
        <section dusk="section-label" class="space-y-4">
            <h2 class="text-2xl font-semibold">Label</h2>
            <div class="flex flex-col gap-4">
                <div>
                    <x-mog::label dusk="label-default" for="input-1">Default Label</x-mog::label>
                    <x-mog::input id="input-1" placeholder="Input" />
                </div>
                <div>
                    <x-mog::label dusk="label-required" for="input-2" required>Required Label *</x-mog::label>
                    <x-mog::input id="input-2" placeholder="Required input" />
                </div>
            </div>
        </section>
    </div>
@endsection
```

### Browser Tests

**Create:** `tests/Browser/SelectInputGroupTest.php`

```php
<?php

describe('Select Component', function (): void {
    test('select default renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="select-default"]')
            ->assertSee('Choose an option');

        $page->screenshotElement('[dusk="select-default"]', filename: 'select/select-default');
    });

    test('select disabled state renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="select-disabled"]');
        $page->assertScript('document.querySelector("[dusk=select-disabled]").hasAttribute("disabled")', true);

        $page->screenshotElement('[dusk="select-disabled"]', filename: 'select/select-disabled');
    });

    test('select with optgroups renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="select-groups"]')
            ->assertSee('Group 1')
            ->assertSee('Group 2');

        $page->screenshotElement('[dusk="select-groups"]', filename: 'select/select-groups');
    });

    test('select option can be selected', function (): void {
        $page = visit('/test/select-input-group');

        $page->select('[dusk="select-default"]', '2');

        $page->assertScript('document.querySelector("[dusk=select-default]").value', '2');
    });
})->group('select', 'browser');

describe('Input Group Component', function (): void {
    test('input group with text addons renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="input-group-text"]')
            ->assertSee('$')
            ->assertSee('.00');

        $page->screenshotElement('[dusk="input-group-text"]', filename: 'input-group/input-group-text');
    });

    test('input group with button addon renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="input-group-button"]')
            ->assertSee('Search');

        $page->screenshotElement('[dusk="input-group-button"]', filename: 'input-group/input-group-button');
    });

    test('input group with multiple inputs renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="input-group-multiple"]');

        $page->screenshotElement('[dusk="input-group-multiple"]', filename: 'input-group/input-group-multiple');
    });

    test('input group with textarea renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="input-group-textarea"]')
            ->assertSee('@');

        $page->screenshotElement('[dusk="input-group-textarea"]', filename: 'input-group/input-group-textarea');
    });

    test('all input group variants display correctly together', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="section-input-group"]');

        $page->screenshotElement('[dusk="section-input-group"]', filename: 'input-group/input-group-all-variants');
    });
})->group('input-group', 'browser');

describe('Label Component', function (): void {
    test('default label renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="label-default"]')
            ->assertSee('Default Label');

        $page->screenshotElement('[dusk="label-default"]', filename: 'label/label-default');
    });

    test('required label renders correctly', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="label-required"]')
            ->assertSee('Required Label');

        $page->screenshotElement('[dusk="label-required"]', filename: 'label/label-required');
    });
})->group('label', 'browser');
```

### Routes

**Update:** `tests/TestCase.php`

```php
$router->get('/test/select-input-group', function () {
    return view('mog-test::select-input-group');
});
```

## Acceptance Criteria

- [ ] Select with options renders and options can be selected
- [ ] Select with optgroups renders correctly
- [ ] Select disabled state tested
- [ ] Input group with text addons tested
- [ ] Input group with button addon tested
- [ ] Input group with multiple inputs tested
- [ ] Input group with textarea tested
- [ ] Label with for attribute tested
- [ ] Label required variant tested
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/select/`
- `tests/Browser/screenshots/input-group/`
- `tests/Browser/screenshots/label/`

**Test Groups:**
- `select`, `input-group`, `label`
- `browser`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Select uses `select()` method to choose options
- Input group tests composition of multiple sub-components
- Label tests association with inputs via `for` attribute
- Test both individual components and full sections
