<?php

namespace Mog\Assets;

class ScriptAssetManager
{
    /**
     * Generate a script tag for the Mog JavaScript file.
     *
     * Returns an HTML script tag that loads the Mog JavaScript file
     * with cache-busting via version query string from manifest.json.
     */
    public function scriptTag(): string
    {
        $version = $this->getManifestVersion('/mog.js');

        return '<script src="/mog/mog.js?id='.$version.'" data-navigate-once defer></script>';
    }

    /**
     * Get the version hash from manifest.json for a given file.
     */
    public function getManifestVersion(string $file): string
    {
        $manifestPath = __DIR__.'/../../dist/manifest.json';

        if (! file_exists($manifestPath)) {
            return '';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        return $manifest[$file] ?? '';
    }

    /**
     * Get the file path for the appropriate Mog JavaScript bundle.
     *
     * Returns minified version in production, development version otherwise.
     */
    public function getScriptFilePath(): string
    {
        $file = config('app.debug') ? 'mog.js' : 'mog.min.js';

        return __DIR__.'/../../dist/'.$file;
    }
}
