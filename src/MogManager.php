<?php

namespace Mog;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;

class MogManager
{
    /**
     * Parse aspect ratio string into a float value.
     *
     * Accepts formats like "16/9", "4/3", or numeric strings.
     * Returns a float representing the aspect ratio.
     *
     * @param  string|float|int  $ratio  The ratio to parse
     * @return float The parsed ratio as a float
     */
    public function parseAspectRatio(int|string|float $ratio): float
    {
        if (is_string($ratio)) {
            $parts = explode('/', trim($ratio));
            if (count($parts) === 2 && is_numeric($parts[0]) && is_numeric($parts[1]) && (float) $parts[1] != 0) {
                return floatval($parts[0]) / floatval($parts[1]);
            }

            if (is_numeric($ratio)) {
                return floatval($ratio);
            }

            return 1.0; // fallback to 1:1 if invalid
        }

        return (float) $ratio;
    }

    public function registerBladeDirectives(): void
    {
        Blade::directive('mog', function (string $expression) {
            return <<<'HTML'
                <style>
                    :root.dark {
                        color-scheme: dark;
                    }
                </style>

                <script>
                    window.Mog = {
                        get theme() {
                            return window.localStorage.getItem('mog::paint') || 'system'
                        },

                        get coat() {
                            return this.theme;
                        },

                        paint(theme) {
                            let applyDark = () => document.documentElement.classList.add('dark');
                            let applyLight = () => document.documentElement.classList.remove('dark');
                            let setTheme = (theme) => window.localStorage.setItem('mog::paint', theme);

                            if (theme === 'system') {
                                let scheme = window.matchMedia('(prefers-color-scheme: dark)');
                                window.localStorage.removeItem('mog::paint');
                                scheme.matches ? applyDark() : applyLight();
                            } else if (theme === 'dark') {
                                setTheme('dark');
                                applyDark();
                            } else if (theme === 'light') {
                                setTheme('light');
                                applyLight();
                            }
                        }
                    }

                    window.Mog.paint(window.localStorage.getItem('mog::paint') || 'system')
                </script>

                <?php app('livewire')->forceAssetInjection(); ?>

                {!! app('mog')->script() !!}
            HTML;
        });
    }

    public function bootScriptRoute(): void
    {
        if (config('app.debug')) {
            $file = 'mog.js';
        } else {
            $file = 'mog.min.js';
        }

        Route::get('mog/mog.js', fn () => Utils::pretendResponseIsFile(__DIR__.'/../dist/'.$file));
    }

    /**
     * Generate a script tag for the Mog JavaScript file.
     *
     * Returns an HTML script tag that loads the Mog JavaScript file
     * with cache-busting via version query string from manifest.json.
     *
     * @return string The complete script tag with attributes
     */
    public function script(): string
    {
        $manifest = json_decode(file_get_contents(__DIR__.'/../dist/manifest.json'), true);
        $version = $manifest['/mog.js'] ?? '';

        return '<script src="/mog/mog.js?id='.$version.'" data-navigate-once defer></script>';
    }
}
