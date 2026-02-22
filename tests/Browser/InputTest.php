<?php

use Livewire\Livewire;

describe('Input', function () {
    test('renders all input types', function () {
        Livewire::visit('pages::tests.input')
            ->assertVisible('[dusk="input-text"]')
            ->assertVisible('[dusk="input-email"]')
            ->assertVisible('[dusk="input-password"]')
            ->assertVisible('[dusk="input-number"]')
            ->assertVisible('[dusk="input-tel"]')
            ->assertVisible('[dusk="input-url"]')
            ->assertVisible('[dusk="input-date"]')
            ->assertVisible('[dusk="input-search"]');
    });

    test('inputs have correct type attributes', function () {
        Livewire::visit('pages::tests.input')
            ->assertAttribute('[dusk="input-email"]', 'type', 'email')
            ->assertAttribute('[dusk="input-password"]', 'type', 'password')
            ->assertAttribute('[dusk="input-number"]', 'type', 'number');
    });

    test('can type into text input', function () {
        Livewire::visit('pages::tests.input')
            ->type('[dusk="input-text"]', 'Hello World')
            ->assertValue('[dusk="input-text"]', 'Hello World');
    });

    test('renders all sizes', function () {
        Livewire::visit('pages::tests.input')
            ->assertVisible('[dusk="input-sm"]')
            ->assertVisible('[dusk="input-md"]')
            ->assertVisible('[dusk="input-xl"]');
    });

    test('disabled input has disabled attribute', function () {
        Livewire::visit('pages::tests.input')
            ->assertDisabled('[dusk="input-disabled"]');
    });

    test('readonly input has readonly attribute', function () {
        Livewire::visit('pages::tests.input')
            ->assertAttribute('[dusk="input-readonly"]', 'readonly', 'readonly');
    });

    test('invalid input has aria-invalid attribute', function () {
        Livewire::visit('pages::tests.input')
            ->assertAriaAttribute('[dusk="input-invalid"]', 'invalid', 'true');
    });

    test('textarea renders', function () {
        Livewire::visit('pages::tests.input')
            ->assertVisible('[dusk="textarea-default"]')
            ->assertVisible('[dusk="textarea-disabled"]');
    });

    test('disabled textarea has disabled attribute', function () {
        Livewire::visit('pages::tests.input')
            ->assertDisabled('[dusk="textarea-disabled"]');
    });

    test('label renders and associates with input', function () {
        Livewire::visit('pages::tests.input')
            ->assertVisible('[dusk="label-default"]')
            ->assertAttribute('[dusk="label-default"]', 'for', 'labeled-input');
    });
})->group('browser', 'input');
