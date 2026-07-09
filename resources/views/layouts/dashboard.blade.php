<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    @stack('styles')

</head>

<body class="dashboard-body">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    @include('components.dashboard.sidebar')

    {{-- Right Content --}}
    <div class="flex flex-col flex-1 overflow-hidden">

        {{-- Dynamic Topbar --}}
        @include('components.dashboard.topbar',[
            'title'=>$title ?? 'Dashboard',
            'subtitle'=>$subtitle ?? 'Manage your broadcasts.'
        ])

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-8">

            @yield('content')

        </main>

    </div>

</div>

<script src="https://unpkg.com/lucide@latest"></script>

<script>
if(typeof lucide!=="undefined"){
    lucide.createIcons();
}
</script>

@stack('scripts')

</body>

</html>