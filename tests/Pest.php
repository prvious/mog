<?php

use Pest\Browser\Playwright\Playwright;

pest()->extend(Tests\TestCase::class);

Playwright::setTimeout(2000);
