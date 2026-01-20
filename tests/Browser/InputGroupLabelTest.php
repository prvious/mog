<?php

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

    test('all label variants display correctly together', function (): void {
        $page = visit('/test/select-input-group');

        $page->assertVisible('[dusk="section-label"]');

        $page->screenshotElement('[dusk="section-label"]', filename: 'label/label-all-variants');
    });
})->group('label', 'browser');
