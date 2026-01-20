<?php

use Tests\TestCase;

/**
 * Configure browser tests to extend the base TestCase
 */
pest()->extend(TestCase::class)->in(__DIR__);

/**
 * Browser Configuration
 */
pest()->browser()
    ->timeout(30000); // 30 seconds timeout for browser operations

// Configure headless mode based on environment variable
if (env('BROWSER_HEADLESS', true)) {
    // Headless mode (default)
} else {
    pest()->browser()->headed();
}
