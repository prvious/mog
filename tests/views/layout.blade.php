<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mog Test')</title>
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto p-8">
        @yield('content')
    </div>

    @livewireScripts
    <script src="{{ app('mog')->script() }}"></script>
</body>
</html>
