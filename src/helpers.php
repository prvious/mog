<?php

namespace Mog;

use Illuminate\Support\Str;

/**
 * Strip any quotes from the given string.
 *
 * @return string
 */
function stripQuotes(string $value)
{
    return Str::startsWith($value, ['"', '\''])
        ? substr($value, 1, -1)
        : $value;
}

/**
 * Strip any square brackets from the given string.
 *
 * @return string
 */
function stripSquareBrackets(string $value)
{
    return Str::startsWith($value, ['[']) && Str::endsWith($value, [']'])
        ? substr($value, 1, -1)
        : $value;
}
