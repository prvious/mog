<?php

use Livewire\Livewire;

describe('Form Controls', function () {
    test('checkbox renders all states', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertVisible('button[dusk="checkbox-default"]')
            ->assertVisible('button[dusk="checkbox-checked"]')
            ->assertVisible('button[dusk="checkbox-disabled"]');
    });

    test('checkbox starts unchecked by default', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('button[dusk="checkbox-default"]', 'state', 'unchecked');
    });

    test('checked checkbox has checked state', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('button[dusk="checkbox-checked"]', 'state', 'checked');
    });

    test('checkbox can be toggled', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('button[dusk="checkbox-default"]', 'state', 'unchecked')
            ->click('button[dusk="checkbox-default"]')
            ->assertDataAttribute('button[dusk="checkbox-default"]', 'state', 'checked');
    });

    test('disabled checkbox has disabled attribute', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDisabled('button[dusk="checkbox-disabled"]');
    });

    test('switch renders all states', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertVisible('button[dusk="switch-default"]')
            ->assertVisible('button[dusk="switch-on"]')
            ->assertVisible('button[dusk="switch-disabled"]');
    });

    test('switch starts unchecked by default', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('button[dusk="switch-default"]', 'state', 'unchecked');
    });

    test('switch can be toggled', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('button[dusk="switch-default"]', 'state', 'unchecked')
            ->click('button[dusk="switch-default"]')
            ->assertDataAttribute('button[dusk="switch-default"]', 'state', 'checked');
    });

    test('disabled switch has disabled attribute', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDisabled('button[dusk="switch-disabled"]');
    });

    test('toggle renders all states', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertVisible('[dusk="toggle-default"]')
            ->assertVisible('[dusk="toggle-pressed"]')
            ->assertVisible('[dusk="toggle-disabled"]');
    });

    test('toggle can be pressed', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('[dusk="toggle-default"]', 'state', 'off')
            ->click('[dusk="toggle-default"]')
            ->assertDataAttribute('[dusk="toggle-default"]', 'state', 'on');
    });

    test('disabled toggle has disabled attribute', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDisabled('[dusk="toggle-disabled"]');
    });

    test('radio group renders with options', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertVisible('[dusk="radio-group"]')
            ->assertVisible('[dusk="radio-option-1"]')
            ->assertVisible('[dusk="radio-option-2"]')
            ->assertVisible('[dusk="radio-option-3"]');
    });

    test('radio group has first option selected by default', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertDataAttribute('[dusk="radio-option-1"]', 'state', 'checked')
            ->assertDataAttribute('[dusk="radio-option-2"]', 'state', 'unchecked');
    });

    test('radio group allows selecting different option', function () {
        Livewire::visit('pages::tests.form-controls')
            ->click('[dusk="radio-option-2"]')
            ->assertDataAttribute('[dusk="radio-option-2"]', 'state', 'checked')
            ->assertDataAttribute('[dusk="radio-option-1"]', 'state', 'unchecked');
    });

    test('slider renders', function () {
        Livewire::visit('pages::tests.form-controls')
            ->assertPresent('[dusk="slider-default"]');
    });
})->group('browser', 'form-controls');
