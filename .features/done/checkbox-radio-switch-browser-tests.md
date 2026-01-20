---
name: checkbox-radio-switch-browser-tests
description: Browser tests for checkbox, radio, switch, toggle, and slider components
depends_on: null
---

## Feature Description

Create comprehensive browser tests for boolean/selection input components (checkbox, radio group, switch, toggle, slider) following the pattern from button tests. Screenshots organized by component in subdirectories.

## Implementation Plan

### Test View

**Create:** `tests/views/checkbox-radio-switch.blade.php`

```blade
@extends('mog-test::layout')

@section('title', 'Checkbox Radio Switch Test')

@section('content')
    <div class="space-y-8 p-4">
        <h1 class="text-3xl font-bold mb-8">Checkbox, Radio, Switch Tests</h1>

        {{-- Checkbox States --}}
        <section dusk="section-checkbox" class="space-y-4">
            <h2 class="text-2xl font-semibold">Checkbox</h2>
            <div class="flex flex-col gap-4">
                <label class="flex items-center gap-2">
                    <x-mog::checkbox dusk="checkbox-unchecked" />
                    <span>Unchecked</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::checkbox dusk="checkbox-checked" checked />
                    <span>Checked</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::checkbox dusk="checkbox-disabled" disabled />
                    <span>Disabled</span>
                </label>
            </div>
        </section>

        {{-- Radio Group --}}
        <section dusk="section-radio" class="space-y-4">
            <h2 class="text-2xl font-semibold">Radio Group</h2>
            <x-mog::radio-group dusk="radio-group" name="test-radio">
                <label class="flex items-center gap-2">
                    <x-mog::radio-group-item dusk="radio-option-1" value="option1" checked />
                    <span>Option 1</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::radio-group-item dusk="radio-option-2" value="option2" />
                    <span>Option 2</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::radio-group-item dusk="radio-option-3" value="option3" />
                    <span>Option 3</span>
                </label>
            </x-mog::radio-group>
        </section>

        {{-- Switch --}}
        <section dusk="section-switch" class="space-y-4">
            <h2 class="text-2xl font-semibold">Switch</h2>
            <div class="flex flex-col gap-4">
                <label class="flex items-center gap-2">
                    <x-mog::switch dusk="switch-off" />
                    <span>Off</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::switch dusk="switch-on" checked />
                    <span>On</span>
                </label>
                <label class="flex items-center gap-2">
                    <x-mog::switch dusk="switch-disabled" disabled />
                    <span>Disabled</span>
                </label>
            </div>
        </section>

        {{-- Toggle --}}
        <section dusk="section-toggle" class="space-y-4">
            <h2 class="text-2xl font-semibold">Toggle</h2>
            <div class="flex gap-4">
                <x-mog::toggle dusk="toggle-default">Toggle</x-mog::toggle>
                <x-mog::toggle dusk="toggle-pressed" pressed>Pressed</x-mog::toggle>
                <x-mog::toggle dusk="toggle-disabled" disabled>Disabled</x-mog::toggle>
            </div>
        </section>

        {{-- Slider --}}
        <section dusk="section-slider" class="space-y-4">
            <h2 class="text-2xl font-semibold">Slider</h2>
            <div class="flex flex-col gap-4">
                <x-mog::slider dusk="slider-default" min="0" max="100" value="50" />
                <x-mog::slider dusk="slider-disabled" min="0" max="100" value="50" disabled />
            </div>
        </section>
    </div>
@endsection
```

### Browser Tests

**Create:** `tests/Browser/CheckboxRadioSwitchTest.php`

```php
<?php

describe('Checkbox States', function (): void {
    test('unchecked checkbox renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="checkbox-unchecked"]');

        $page->screenshotElement('[dusk="checkbox-unchecked"]', filename: 'checkbox/checkbox-unchecked');
    });

    test('checked checkbox renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="checkbox-checked"]');
        $page->assertScript('document.querySelector("[dusk=checkbox-checked]").checked', true);

        $page->screenshotElement('[dusk="checkbox-checked"]', filename: 'checkbox/checkbox-checked');
    });

    test('checkbox can be clicked', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('[dusk="checkbox-unchecked"]');
        usleep(100000);

        $page->assertScript('document.querySelector("[dusk=checkbox-unchecked]").checked', true);
    });
})->group('checkbox', 'browser');

describe('Radio Group', function (): void {
    test('radio group renders with first option checked', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="radio-group"]');
        $page->assertScript('document.querySelector("[dusk=radio-option-1]").checked', true);

        $page->screenshotElement('[dusk="section-radio"]', filename: 'radio/radio-group-default');
    });

    test('radio option can be selected', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('[dusk="radio-option-2"]');
        usleep(100000);

        $page->assertScript('document.querySelector("[dusk=radio-option-2]").checked', true);
        $page->assertScript('document.querySelector("[dusk=radio-option-1]").checked', false);
    });
})->group('radio', 'browser');

describe('Switch Component', function (): void {
    test('switch off state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="switch-off"]');

        $page->screenshotElement('[dusk="switch-off"]', filename: 'switch/switch-off');
    });

    test('switch on state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="switch-on"]');
        $page->assertScript('document.querySelector("[dusk=switch-on]").checked', true);

        $page->screenshotElement('[dusk="switch-on"]', filename: 'switch/switch-on');
    });

    test('switch can be toggled', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('[dusk="switch-off"]');
        usleep(100000);

        $page->assertScript('document.querySelector("[dusk=switch-off]").checked', true);
    });
})->group('switch', 'browser');

describe('Toggle Component', function (): void {
    test('toggle default state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="toggle-default"]')
            ->assertSee('Toggle');

        $page->screenshotElement('[dusk="toggle-default"]', filename: 'toggle/toggle-default');
    });

    test('toggle pressed state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="toggle-pressed"]');
        $page->assertScript('document.querySelector("[dusk=toggle-pressed]").getAttribute("aria-pressed")', 'true');

        $page->screenshotElement('[dusk="toggle-pressed"]', filename: 'toggle/toggle-pressed');
    });

    test('toggle can be clicked', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('[dusk="toggle-default"]');
        usleep(100000);

        $page->assertScript('document.querySelector("[dusk=toggle-default]").getAttribute("aria-pressed")', 'true');
    });
})->group('toggle', 'browser');

describe('Slider Component', function (): void {
    test('slider renders with default value', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="slider-default"]');

        $page->screenshotElement('[dusk="slider-default"]', filename: 'slider/slider-default');
    });

    test('slider disabled state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="slider-disabled"]');
        $page->assertScript('document.querySelector("[dusk=slider-disabled]").hasAttribute("disabled")', true);

        $page->screenshotElement('[dusk="slider-disabled"]', filename: 'slider/slider-disabled');
    });
})->group('slider', 'browser');
```

### Routes

**Update:** `tests/TestCase.php`

```php
$router->get('/test/checkbox-radio-switch', function () {
    return view('mog-test::checkbox-radio-switch');
});
```

## Acceptance Criteria

- [ ] Test view created with all component states
- [ ] Checkbox unchecked, checked, disabled states tested
- [ ] Radio group with multiple options tested
- [ ] Switch on/off states tested
- [ ] Toggle default/pressed states tested
- [ ] Slider with different values tested
- [ ] Click interactions verified for each component
- [ ] Screenshots saved to respective subdirectories
- [ ] All tests pass with appropriate groups
- [ ] Code formatted

## Testing Strategy

**Screenshot Directories:**
- `tests/Browser/screenshots/checkbox/`
- `tests/Browser/screenshots/radio/`
- `tests/Browser/screenshots/switch/`
- `tests/Browser/screenshots/toggle/`
- `tests/Browser/screenshots/slider/`

**Test Groups:**
- `checkbox`, `radio`, `switch`, `toggle`, `slider`
- `browser`

## Code Formatting

```bash
composer lint
pnpm format
```

## Additional Notes

- Use `checked` attribute for default states
- Test click interactions with `usleep(100000)` wait
- Verify state with `assertScript()` checking DOM properties
- Radio groups ensure mutual exclusivity
- Toggle uses `aria-pressed` attribute
