<?php

use Mog\MogManager;

it('parses string ratio formats correctly', function ($input, $expected) {
    $manager = new MogManager;
    expect($manager->parseAspectRatio($input))->toBe($expected);
})->with([
    ['16/9', 16 / 9],
    ['4/3', 4 / 3],
    ['21/9', 21 / 9],
    ['1/1', 1.0],
    ['2/1', 2.0],
    ['3/2', 1.5],
]);

it('parses numeric string values correctly', function ($input, $expected) {
    $manager = new MogManager;
    expect($manager->parseAspectRatio($input))->toBe($expected);
})->with([
    ['1.5', 1.5],
    ['0.75', 0.75],
    ['2', 2.0],
    ['1', 1.0],
    ['0.5', 0.5],
]);

it('handles numeric values correctly', function ($input, $expected) {
    $manager = new MogManager;
    expect($manager->parseAspectRatio($input))->toBe($expected);
})->with([
    [1.5, 1.5],
    [0.75, 0.75],
    [2, 2.0],
    [1, 1.0],
    [0.5, 0.5],
    [16 / 9, 16 / 9],
]);

it('returns fallback for invalid string formats', function ($input) {
    $manager = new MogManager;
    expect($manager->parseAspectRatio($input))->toBe(1.0);
})->with([
    ['invalid'],
    ['16/'],
    ['/9'],
    ['16/0'], // division by zero
    ['a/b'],
    [''],
    ['16/9/2'], // too many parts
]);

it('handles edge cases', function ($input, $expected) {
    $manager = new MogManager;
    expect($manager->parseAspectRatio($input))->toBe($expected);
})->with([
    ['16.5/9.2', 16.5 / 9.2],
    ['1.0/1.0', 1.0],
    [' 16/9 ', 16 / 9], // trimmed spaces are handled
    ['16 / 9', 16 / 9], // PHP is_numeric handles spaces in parts
]);

it('handles zero and negative values appropriately', function ($input, $expected) {
    $manager = new MogManager;
    expect($manager->parseAspectRatio($input))->toBe($expected);
})->with([
    [0, 0.0],
    [-1, -1.0],
    ['-1', -1.0],
    ['0', 0.0],
    ['-16/9', -16 / 9],
]);
