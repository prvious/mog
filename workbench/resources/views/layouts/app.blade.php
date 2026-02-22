<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0" />
        <meta
            name="csrf-token"
            content="{{ csrf_token() }}" />

        <title>{{ $title ?? 'Mog UI' }}</title>

        <!-- Fonts -->
        <link
            rel="preconnect"
            href="https://fonts.bunny.net" />

        <link
            href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,600"
            rel="stylesheet" />

        @mog

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            if (localStorage.layout) {
                document.documentElement.classList.add('layout-' + localStorage.layout)
            }
        </script>
    </head>
    <body
        class="group/body overscroll-none antialiased [--footer-height:calc(var(--spacing)*14)] [--header-height:calc(var(--spacing)*14)] xl:[--footer-height:calc(var(--spacing)*24)]">
        <div
            data-slot="layout"
            class="bg-background relative z-10 flex min-h-svh flex-col">
            <x-header />

            <main class="flex flex-1 flex-col">{{ $slot }}</main>

            <x-footer />
        </div>

        <x-mog::overlay />
    </body>
</html>
