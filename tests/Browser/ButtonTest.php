<?php

use Livewire\Livewire;

describe('Button', function () {
    test('renders all variants', function () {
        Livewire::visit('pages::tests.button')
            ->assertVisible('[dusk="btn-default"]')
            ->assertVisible('[dusk="btn-destructive"]')
            ->assertVisible('[dusk="btn-outline"]')
            ->assertVisible('[dusk="btn-secondary"]')
            ->assertVisible('[dusk="btn-ghost"]')
            ->assertVisible('[dusk="btn-link"]');
    });

    test('renders all sizes', function () {
        Livewire::visit('pages::tests.button')
            ->assertVisible('[dusk="btn-sm"]')
            ->assertVisible('[dusk="btn-default-size"]')
            ->assertVisible('[dusk="btn-lg"]')
            ->assertVisible('[dusk="btn-icon"]')
            ->assertVisible('[dusk="btn-icon-sm"]')
            ->assertVisible('[dusk="btn-icon-lg"]');
    });

    test('disabled button has disabled attribute', function () {
        Livewire::visit('pages::tests.button')
            ->assertDisabled('[dusk="btn-disabled"]');
    });

    test('link button renders as anchor tag', function () {
        Livewire::visit('pages::tests.button')
            ->assertScript(
                'document.querySelector("[dusk=btn-as-link]").tagName',
                'A'
            );
    });

    test('link button has correct href', function () {
        Livewire::visit('pages::tests.button')
            ->assertAttribute('[dusk="btn-as-link"]', 'href', '#test-link');
    });

    test('button group renders with children', function () {
        Livewire::visit('pages::tests.button')
            ->assertVisible('[dusk="btn-group"]')
            ->assertVisible('[dusk="btn-group-1"]')
            ->assertVisible('[dusk="btn-group-2"]')
            ->assertVisible('[dusk="btn-group-3"]');
    });

    test('button displays correct text', function () {
        Livewire::visit('pages::tests.button')
            ->assertSeeIn('[dusk="btn-default"]', 'Default')
            ->assertSeeIn('[dusk="btn-destructive"]', 'Destructive')
            ->assertSeeIn('[dusk="btn-outline"]', 'Outline');
    });

    test('button group has group role', function () {
        Livewire::visit('pages::tests.button')
            ->assertAttribute('[dusk="btn-group"]', 'role', 'group');
    });
})->group('browser', 'button');
