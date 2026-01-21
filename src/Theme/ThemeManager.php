<?php

namespace Mog\Theme;

class ThemeManager
{
    /**
     * Get the theme initialization script content.
     *
     * Returns the JavaScript code for theme system initialization.
     * This handles dark/light/system theme modes with localStorage persistence.
     */
    public function getInitializationScript(): string
    {
        return <<<'JAVASCRIPT'
            window.Mog = window.Mog || {};

            Object.assign(window.Mog, {
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
            });

            document.addEventListener('livewire:navigated', () => {
                window.Mog.paint(window.localStorage.getItem('mog::paint') || 'system')
            })

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                window.Mog.paint(window.localStorage.getItem('mog::paint') || 'system')
            })

            window.Mog.paint(window.localStorage.getItem('mog::paint') || 'system')
        JAVASCRIPT;
    }

    /**
     * Get the color-scheme CSS for dark mode.
     */
    public function getColorSchemeStyle(): string
    {
        return <<<'CSS'
            :root.dark {
                color-scheme: dark;
            }
        CSS;
    }
}
