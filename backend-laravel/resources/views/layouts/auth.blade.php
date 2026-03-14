<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Authentication')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')

    {{-- Optional: Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full antialiased text-slate-100">

    {{-- Main Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>