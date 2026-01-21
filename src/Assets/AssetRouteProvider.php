<?php

namespace Mog\Assets;

use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;

class AssetRouteProvider
{
    public function __construct(
        private ScriptAssetManager $scriptAssetManager
    ) {}

    /**
     * Register the Mog script route.
     *
     * Registers a GET route at /mog/mog.js that serves the appropriate
     * JavaScript bundle (minified in production, development otherwise).
     */
    public function registerRoute(): void
    {
        Route::get('mog/mog.js', function () {
            $filePath = $this->scriptAssetManager->getScriptFilePath();

            return Utils::pretendResponseIsFile($filePath);
        });
    }
}
