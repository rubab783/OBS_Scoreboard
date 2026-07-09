<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    {{-- App CSS --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Dashboard CSS --}}
    @stack('styles')

</head>

<body class="font-sans antialiased bg-[#07111d] text-white">

    <main class="min-h-screen">

        @yield('content')

    </main>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

    @stack('scripts')

</body>

</html>