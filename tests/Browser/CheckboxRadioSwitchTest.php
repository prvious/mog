<?php

describe('Checkbox States', function (): void {
    test('unchecked checkbox renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('button[dusk="checkbox-unchecked"]');

        $page->screenshotElement('button[dusk="checkbox-unchecked"]', filename: 'checkbox/checkbox-unchecked');
    });

    test('checked checkbox renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('button[dusk="checkbox-checked"]');
        $page->assertScript('document.querySelector("button[dusk=checkbox-checked]").dataset.state', 'checked');

        $page->screenshotElement('button[dusk="checkbox-checked"]', filename: 'checkbox/checkbox-checked');
    });

    test('checkbox can be clicked', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('button[dusk="checkbox-unchecked"]');

        $page->assertScript('document.querySelector("button[dusk=checkbox-unchecked]").dataset.state', 'checked');
    });
})->group('checkbox', 'browser');

describe('Radio Group', function (): void {
    test('radio group renders with first option checked', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="radio-group"]');
        $page->assertScript('document.querySelector("[dusk=radio-option-1]").dataset.state', 'checked');

        $page->screenshotElement('[dusk="section-radio"]', filename: 'radio/radio-group-default');
    });

    test('radio option can be selected', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('[dusk="radio-option-2"]');

        $page->assertScript('document.querySelector("[dusk=radio-option-2]").dataset.state', 'checked');
        $page->assertScript('document.querySelector("[dusk=radio-option-1]").dataset.state', 'unchecked');
    });
})->group('radio', 'browser');

describe('Switch Component', function (): void {
    test('switch off state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('button[dusk="switch-off"]');

        $page->screenshotElement('button[dusk="switch-off"]', filename: 'switch/switch-off');
    });

    test('switch on state renders correctly', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('button[dusk="switch-on"]');
        $page->assertScript('document.querySelector("button[dusk=switch-on]").dataset.state', 'checked');

        $page->screenshotElement('button[dusk="switch-on"]', filename: 'switch/switch-on');
    });

    test('switch can be toggled', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('button[dusk="switch-off"]');

        $page->assertScript('document.querySelector("button[dusk=switch-off]").dataset.state', 'checked');
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
        $page->assertScript('document.querySelector("[dusk=toggle-pressed]").dataset.state', 'on');

        $page->screenshotElement('[dusk="toggle-pressed"]', filename: 'toggle/toggle-pressed');
    });

    test('toggle can be clicked', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->click('[dusk="toggle-default"]');

        $page->assertScript('document.querySelector("[dusk=toggle-default]").dataset.state', 'on');
    });
})->group('toggle', 'browser');

describe('Slider Component', function (): void {
    test('slider section renders', function (): void {
        $page = visit('/test/checkbox-radio-switch');

        $page->assertVisible('[dusk="section-slider"]')
            ->assertSee('Slider');

        $page->screenshotElement('[dusk="section-slider"]', filename: 'slider/slider-section');
    });
})->group('slider', 'browser');
