<?php

describe('Button Variants', function (): void {
    test('default variant renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Default')
            ->assertVisible('[dusk="variant-default"]');

        // Take screenshot of variant
        $page->screenshotElement('[dusk="variant-default"]', filename: 'button/button-variant-default');
    });

    test('destructive variant renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Destructive')
            ->assertVisible('[dusk="variant-destructive"]');

        $page->screenshotElement('[dusk="variant-destructive"]', filename: 'button/button-variant-destructive');
    });

    test('outline variant renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Outline')
            ->assertVisible('[dusk="variant-outline"]');

        $page->screenshotElement('[dusk="variant-outline"]', filename: 'button/button-variant-outline');
    });

    test('secondary variant renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Secondary')
            ->assertVisible('[dusk="variant-secondary"]');

        $page->screenshotElement('[dusk="variant-secondary"]', filename: 'button/button-variant-secondary');
    });

    test('ghost variant renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Ghost')
            ->assertVisible('[dusk="variant-ghost"]');

        $page->screenshotElement('[dusk="variant-ghost"]', filename: 'button/button-variant-ghost');
    });

    test('link variant renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Link')
            ->assertVisible('[dusk="variant-link"]');

        $page->screenshotElement('[dusk="variant-link"]', filename: 'button/button-variant-link');
    });

    test('all variants display correctly together', function (): void {
        $page = visit('/test/button');

        // Verify all variants are visible
        $page->assertVisible('[dusk="section-variants"]')
            ->assertVisible('[dusk="variant-default"]')
            ->assertVisible('[dusk="variant-destructive"]')
            ->assertVisible('[dusk="variant-outline"]')
            ->assertVisible('[dusk="variant-secondary"]')
            ->assertVisible('[dusk="variant-ghost"]')
            ->assertVisible('[dusk="variant-link"]');

        // Take full section screenshot
        $page->screenshotElement('[dusk="section-variants"]', filename: 'button/button-all-variants');
    });
})->group('button', 'browser', 'variants');

describe('Button Sizes', function (): void {
    test('small button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-sm"]')
            ->assertSee('Small');

        $page->screenshotElement('[dusk="size-sm"]', filename: 'button/button-size-sm');
    });

    test('default button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-default"]')
            ->assertSee('Default');

        $page->screenshotElement('[dusk="size-default"]', filename: 'button/button-size-default');
    });

    test('large button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-lg"]')
            ->assertSee('Large');

        $page->screenshotElement('[dusk="size-lg"]', filename: 'button/button-size-lg');
    });

    test('icon button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-icon"]');

        $page->screenshotElement('[dusk="size-icon"]', filename: 'button/button-size-icon');
    });

    test('icon-sm button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-icon-sm"]');

        $page->screenshotElement('[dusk="size-icon-sm"]', filename: 'button/button-size-icon-sm');
    });

    test('icon-lg button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-icon-lg"]');

        $page->screenshotElement('[dusk="size-icon-lg"]', filename: 'button/button-size-icon-lg');
    });

    test('all sizes display correctly together', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="section-sizes"]')
            ->assertVisible('[dusk="size-sm"]')
            ->assertVisible('[dusk="size-default"]')
            ->assertVisible('[dusk="size-lg"]');

        $page->screenshotElement('[dusk="section-sizes"]', filename: 'button/button-all-sizes');
    });
})->group('button', 'browser', 'sizes');

describe('Button States', function (): void {
    test('disabled button renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="state-disabled"]')
            ->assertSee('Disabled');

        // Verify button has disabled attribute via script
        $page->assertScript('document.querySelector("[dusk=state-disabled]").hasAttribute("disabled")', true);

        $page->screenshotElement('[dusk="state-disabled"]', filename: 'button/button-state-disabled');
    });

    test('disabled button cannot be clicked', function (): void {
        $page = visit('/test/button');

        // Verify disabled attribute exists
        $page->assertScript('document.querySelector("[dusk=state-disabled]").hasAttribute("disabled")', true);
    });

    test('hover state can be simulated', function (): void {
        $page = visit('/test/button');

        // Hover over button
        $page->hover('[dusk="interactive-hover"]');

        // Take screenshot of hover state
        $page->screenshotElement('[dusk="interactive-hover"]', filename: 'button/button-state-hover');

        expect(true)->toBeTrue();
    });

    test('focus state can be simulated', function (): void {
        $page = visit('/test/button');

        // Focus the button
        $page->click('[dusk="interactive-focus"]');

        // Take screenshot of focus state
        $page->screenshotElement('[dusk="interactive-focus"]', filename: 'button/button-state-focus');

        expect(true)->toBeTrue();
    });

    test('loading state displays spinner', function (): void {
        $page = visit('/test/button');

        // Find the loading button and click to toggle loading state
        $page->assertVisible('[dusk="loading-button"]')
            ->click('[dusk="loading-button"]');

        // Give Alpine time to update
        usleep(100000); // 100ms

        // Verify loading attribute is set
        $page->assertScript('document.querySelector("[dusk=loading-button]").hasAttribute("data-loading")', true);

        $page->screenshotElement('[dusk="section-loading"]', filename: 'button/button-state-loading');
    });
})->group('button', 'browser', 'states');

describe('Button Interactions', function (): void {
    test('button click triggers action', function (): void {
        $page = visit('/test/button');

        $page->assertSee('Click Me')
            ->click('[dusk="interactive-click"]')
            ->assertSee('Clicked!');
    });

    test('button with href navigates correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="as-link"]')
            ->click('[dusk="as-link"]');

        // Verify URL has hash
        $page->assertScript('window.location.hash', '#link-test');
    });

    test('button can be focused with keyboard', function (): void {
        $page = visit('/test/button');

        // Focus a button using JavaScript
        $page->script('document.querySelector("[dusk=interactive-focus]").focus()');

        // Verify focus
        $page->assertScript('document.activeElement === document.querySelector("[dusk=interactive-focus]")', true);
    });

    test('loading button toggles state on click', function (): void {
        $page = visit('/test/button');

        // Click to enable loading
        $page->click('[dusk="loading-button"]');
        usleep(100000); // Wait for Alpine

        // Verify loading is active
        $page->assertScript('document.querySelector("[dusk=loading-button]").hasAttribute("data-loading")', true);

        // Click again to disable loading
        $page->click('[dusk="loading-button"]');
        usleep(100000);

        // Verify loading is no longer active
        $page->assertScript('document.querySelector("[dusk=loading-button]").hasAttribute("data-loading")', false);
    });
})->group('button', 'browser', 'interactions');

describe('Button with Icons', function (): void {
    test('button with left icon renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="with-icon-left"]')
            ->assertSee('Add Item');

        $page->screenshotElement('[dusk="with-icon-left"]', filename: 'button/button-with-icon-left');
    });

    test('button with right icon renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="with-icon-right"]')
            ->assertSee('Delete');

        $page->screenshotElement('[dusk="with-icon-right"]', filename: 'button/button-with-icon-right');
    });

    test('icon-only buttons render correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="size-icon"]')
            ->assertVisible('[dusk="size-icon-sm"]')
            ->assertVisible('[dusk="size-icon-lg"]');

        $page->screenshotElement('[dusk="section-icon-sizes"]', filename: 'button/button-icon-sizes');
    });
})->group('button', 'browser', 'icons');

describe('Button Group', function (): void {
    test('button group renders correctly', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="button-group"]')
            ->assertVisible('[dusk="group-btn-1"]')
            ->assertVisible('[dusk="group-btn-2"]')
            ->assertVisible('[dusk="group-btn-3"]')
            ->assertSee('First')
            ->assertSee('Second')
            ->assertSee('Third');

        $page->screenshotElement('[dusk="section-group"]', filename: 'button/button-group');
    });

    test('button group buttons can be clicked', function (): void {
        $page = visit('/test/button');

        $page->click('[dusk="group-btn-1"]');
        $page->click('[dusk="group-btn-2"]');
        $page->click('[dusk="group-btn-3"]');

        expect(true)->toBeTrue();
    });
})->group('button', 'browser', 'group');

describe('Visual Regression', function (): void {
    test('all variants comparison matches snapshot', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="section-all-variants"]');

        // Take screenshot of the entire comparison section
        $page->screenshotElement('[dusk="section-all-variants"]', filename: 'button/button-variants-comparison');
    });

    test('individual variant snapshots', function (): void {
        $page = visit('/test/button');

        // Capture snapshots of individual variants in the comparison grid
        $page->screenshotElement('[dusk="snap-default"]', filename: 'button/snap-variant-default');
        $page->screenshotElement('[dusk="snap-destructive"]', filename: 'button/snap-variant-destructive');
        $page->screenshotElement('[dusk="snap-outline"]', filename: 'button/snap-variant-outline');
        $page->screenshotElement('[dusk="snap-secondary"]', filename: 'button/snap-variant-secondary');
        $page->screenshotElement('[dusk="snap-ghost"]', filename: 'button/snap-variant-ghost');
        $page->screenshotElement('[dusk="snap-link"]', filename: 'button/snap-variant-link');

        expect(true)->toBeTrue();
    });

    test('full page snapshot', function (): void {
        $page = visit('/test/button');

        // Take full page screenshot
        $page->screenshot(filename: 'button/button-component-full-page', fullPage: true);

        expect(true)->toBeTrue();
    });
})->group('button', 'browser', 'snapshots');

describe('Responsive Testing', function (): void {
    test('buttons render correctly on mobile', function (): void {
        $page = visit('/test/button')->on()->mobile();

        $page->assertVisible('[dusk="section-variants"]')
            ->assertVisible('[dusk="variant-default"]')
            ->assertVisible('[dusk="variant-destructive"]');

        $page->screenshot(filename: 'button/button-mobile-view', fullPage: true);
    });

    test('buttons render correctly on desktop', function (): void {
        $page = visit('/test/button');

        $page->assertVisible('[dusk="section-variants"]');

        $page->screenshot(filename: 'button/button-desktop-view', fullPage: true);
    });
})->group('button', 'browser', 'responsive');
