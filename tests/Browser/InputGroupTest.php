<?php

use Livewire\Livewire;

describe('Input Group', function () {
    test('renders text prefix addon', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertVisible('[dusk="ig-text-prefix"]')
            ->assertSeeIn('[dusk="ig-text-prefix-text"]', 'https://');
    });

    test('renders text suffix addon', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertVisible('[dusk="ig-text-suffix"]')
            ->assertSeeIn('[dusk="ig-text-suffix-text"]', '@example.com');
    });

    test('can type into input group input', function () {
        Livewire::visit('pages::tests.input-group')
            ->type('[dusk="ig-text-prefix-input"]', 'example.com')
            ->assertValue('[dusk="ig-text-prefix-input"]', 'example.com');
    });

    test('renders button addon', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertVisible('[dusk="ig-button"]')
            ->assertVisible('[dusk="ig-button-btn"]');
    });

    test('renders icon addon', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertVisible('[dusk="ig-icon"]')
            ->assertVisible('[dusk="ig-icon-input"]');
    });

    test('renders combined addons', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertVisible('[dusk="ig-combined"]')
            ->assertSeeIn('[dusk="ig-combined-suffix"]', 'USD');
    });

    test('renders textarea input group', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertVisible('[dusk="ig-textarea"]')
            ->assertSeeIn('[dusk="ig-textarea-label"]', 'Description');
    });

    test('input groups have group role', function () {
        Livewire::visit('pages::tests.input-group')
            ->assertAttribute('[dusk="ig-text-prefix"]', 'role', 'group');
    });
})->group('browser', 'input-group');
