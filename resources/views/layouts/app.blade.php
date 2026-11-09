<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#10251d">
    <title>@yield('title', 'Persela Lamongan') · Persela Lamongan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="page-shell">
        <x-navbar :username="$username ?? null" />

        @include('components.notice', ['message' => session('status')])

        <main class="page-content">
            @yield('content')
        </main>

        <x-footer />
    </div>
</body>
</html>
