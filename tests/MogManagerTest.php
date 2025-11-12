<?php

use Mog\MogManager;

describe('parseAspectRatio', function (): void {
    it('parses string ratio formats correctly', function ($input, $expected): void {
        $ratio = app(MogManager::class)->parseAspectRatio($input);

        expect($ratio)->toBe($expected);
    })->with([
        ['16/9', 16 / 9],
        ['4/3', 4 / 3],
        ['21/9', 21 / 9],
        ['1/1', 1.0],
        ['2/1', 2.0],
        ['3/2', 1.5],
    ]);

    it('parses numeric string values correctly', function ($input, $expected): void {
        $ratio = app(MogManager::class)->parseAspectRatio($input);

        expect($ratio)->toBe($expected);
    })->with([
        ['1.5', 1.5],
        ['0.75', 0.75],
        ['2', 2.0],
        ['1', 1.0],
        ['0.5', 0.5],
    ]);

    it('handles numeric values correctly', function ($input, $expected): void {
        $ratio = app(MogManager::class)->parseAspectRatio($input);

        expect($ratio)->toBe($expected);
    })->with([
        [1.5, 1.5],
        [0.75, 0.75],
        [2, 2.0],
        [1, 1.0],
        [0.5, 0.5],
        [16 / 9, 16 / 9],
    ]);

    it('returns fallback for invalid string formats', function ($input): void {
        $ratio = app(MogManager::class)->parseAspectRatio($input);

        expect($ratio)->toBe(1.0);
    })->with([
        ['invalid'],
        ['16/'],
        ['/9'],
        ['16/0'], // division by zero
        ['a/b'],
        [''],
        ['16/9/2'], // too many parts
    ]);

    it('handles edge cases', function ($input, $expected): void {
        $ratio = app(MogManager::class)->parseAspectRatio($input);

        expect($ratio)->toBe($expected);
    })->with([
        ['16.5/9.2', 16.5 / 9.2],
        ['1.0/1.0', 1.0],
        [' 16/9 ', 16 / 9], // handles leading and trailing spaces
        ['16 / 9', 16 / 9], // handles spaces in between
    ]);

    it('handles zero and negative values appropriately', function ($input, $expected): void {
        $ratio = app(MogManager::class)->parseAspectRatio($input);

        expect($ratio)->toBe($expected);
    })->with([
        [0, 0.0],
        [-1, -1.0],
        ['-1', -1.0],
        ['0', 0.0],
        ['-16/9', -16 / 9],
    ]);
});

describe('script', function (): void {
    it('returns a script tag with correct attributes', function (): void {
        $script = app(MogManager::class)->script();

        expect($script)->toContain('<script');
        expect($script)->toContain('src="/mog/mog.js?id=');
        expect($script)->toContain('data-navigate-once');
        expect($script)->toContain('defer');
        expect($script)->toContain('</script>');
    });

    it('includes version from manifest.json', function (): void {
        $script = app(MogManager::class)->script();

        // The manifest.json should have a version/hash
        expect($script)->toMatch('/src="\/mog\/mog\.js\?id=[^"]+"/');
    });

    it('generates valid HTML script tag', function (): void {
        $script = app(MogManager::class)->script();

        // Should be a complete script tag with all required parts
        expect($script)->toStartWith('<script');
        expect($script)->toEndWith('</script>');
    });
});
