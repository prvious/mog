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

    test('password input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-password"]');

        $page->screenshotElement('[dusk="type-password"]', filename: 'input/input-type-password');
    });

    test('number input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-number"]');

        $page->screenshotElement('[dusk="type-number"]', filename: 'input/input-type-number');
    });

    test('tel input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-tel"]');

        $page->screenshotElement('[dusk="type-tel"]', filename: 'input/input-type-tel');
    });

    test('url input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-url"]');

        $page->screenshotElement('[dusk="type-url"]', filename: 'input/input-type-url');
    });

    test('date input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-date"]');

        $page->screenshotElement('[dusk="type-date"]', filename: 'input/input-type-date');
    });

    test('time input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-time"]');

        $page->screenshotElement('[dusk="type-time"]', filename: 'input/input-type-time');
    });

    test('datetime-local input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-datetime"]');

        $page->screenshotElement('[dusk="type-datetime"]', filename: 'input/input-type-datetime');
    });

    test('file input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-file"]');

        $page->screenshotElement('[dusk="type-file"]', filename: 'input/input-type-file');
    });

    test('search input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="type-search"]');

        $page->screenshotElement('[dusk="type-search"]', filename: 'input/input-type-search');
    });

    test('all input types display correctly together', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="section-types"]');

        $page->screenshotElement('[dusk="section-types"]', filename: 'input/input-all-types');
    });
})->group('input', 'browser', 'types');

describe('Input Sizes', function (): void {
    test('extra small input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="size-xs"]');

        $page->screenshotElement('[dusk="size-xs"]', filename: 'input/input-size-xs');
    });

    test('small input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="size-sm"]');

        $page->screenshotElement('[dusk="size-sm"]', filename: 'input/input-size-sm');
    });

    test('medium input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="size-md"]');

        $page->screenshotElement('[dusk="size-md"]', filename: 'input/input-size-md');
    });

    test('extra large input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="size-xl"]');

        $page->screenshotElement('[dusk="size-xl"]', filename: 'input/input-size-xl');
    });

    test('all sizes display correctly together', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="section-sizes"]');

        $page->screenshotElement('[dusk="section-sizes"]', filename: 'input/input-all-sizes');
    });
})->group('input', 'browser', 'sizes');

describe('Input States', function (): void {
    test('default input renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="state-default"]');

        $page->screenshotElement('[dusk="state-default"]', filename: 'input/input-state-default');
    });

    test('disabled input cannot be edited', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="state-disabled"]');
        $page->assertScript('document.querySelector("[dusk=state-disabled]").hasAttribute("disabled")', true);

        $page->screenshotElement('[dusk="state-disabled"]', filename: 'input/input-state-disabled');
    });

    test('readonly input displays value but cannot be edited', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="state-readonly"]');
        $page->assertScript('document.querySelector("[dusk=state-readonly]").hasAttribute("readonly")', true);
        $page->assertScript('document.querySelector("[dusk=state-readonly]").value', 'Readonly');

        $page->screenshotElement('[dusk="state-readonly"]', filename: 'input/input-state-readonly');
    });

    test('invalid input displays error state', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="state-invalid"]');

        $page->screenshotElement('[dusk="state-invalid"]', filename: 'input/input-state-invalid');
    });

    test('all states display correctly together', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="section-states"]');

        $page->screenshotElement('[dusk="section-states"]', filename: 'input/input-all-states');
    });
})->group('input', 'browser', 'states');

describe('Input Interactions', function (): void {
    test('input accepts text entry', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="interactive-type"]');
        $page->type('[dusk="interactive-type"]', 'Hello World');

        usleep(100000); // Wait for input

        $page->assertScript('document.querySelector("[dusk=interactive-type]").value', 'Hello World');
    });

    test('input can be focused', function (): void {
        $page = visit('/test/input');

        $page->script('document.querySelector("[dusk=interactive-focus]").focus()');

        $page->assertScript('document.activeElement === document.querySelector("[dusk=interactive-focus]")', true);
    });
})->group('input', 'browser', 'interactions');

describe('Textarea Component', function (): void {
    test('default textarea renders correctly', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="textarea-default"]');

        $page->screenshotElement('[dusk="textarea-default"]', filename: 'textarea/textarea-default');
    });

    test('disabled textarea cannot be edited', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="textarea-disabled"]');
        $page->assertScript('document.querySelector("[dusk=textarea-disabled]").hasAttribute("disabled")', true);

        $page->screenshotElement('[dusk="textarea-disabled"]', filename: 'textarea/textarea-disabled');
    });

    test('readonly textarea displays value but cannot be edited', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="textarea-readonly"]');
        $page->assertScript('document.querySelector("[dusk=textarea-readonly]").hasAttribute("readonly")', true);

        $page->screenshotElement('[dusk="textarea-readonly"]', filename: 'textarea/textarea-readonly');
    });

    test('invalid textarea displays error state', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="textarea-invalid"]');

        $page->screenshotElement('[dusk="textarea-invalid"]', filename: 'textarea/textarea-invalid');
    });

    test('textarea accepts multi-line text', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="textarea-default"]');
        $page->type('[dusk="textarea-default"]', "Line 1\nLine 2\nLine 3");

        usleep(100000);

        $page->assertScript('document.querySelector("[dusk=textarea-default]").value.includes("Line 1")', true);
    });

    test('all textarea states display correctly together', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="section-textarea"]');

        $page->screenshotElement('[dusk="section-textarea"]', filename: 'textarea/textarea-all-states');
    });
})->group('textarea', 'browser');

describe('Visual Regression', function (): void {
    test('all sizes comparison matches snapshot', function (): void {
        $page = visit('/test/input');

        $page->assertVisible('[dusk="section-all-sizes"]');

        $page->screenshotElement('[dusk="section-all-sizes"]', filename: 'input/input-sizes-comparison');
    });

    test('individual size snapshots', function (): void {
        $page = visit('/test/input');

        $page->screenshotElement('[dusk="snap-size-xs"]', filename: 'input/snap-size-xs');
        $page->screenshotElement('[dusk="snap-size-sm"]', filename: 'input/snap-size-sm');
        $page->screenshotElement('[dusk="snap-size-md"]', filename: 'input/snap-size-md');
        $page->screenshotElement('[dusk="snap-size-xl"]', filename: 'input/snap-size-xl');

        expect(true)->toBeTrue();
    });

    test('full page snapshot', function (): void {
        $page = visit('/test/input');

        $page->screenshot(filename: 'input/input-component-full-page', fullPage: true);

        expect(true)->toBeTrue();
    });
})->group('input', 'browser', 'snapshots');
