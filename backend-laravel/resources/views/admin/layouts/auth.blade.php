<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Login' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen overflow-hidden bg-slate-950 flex items-center justify-center px-6">

    {{-- ================= BACKGROUND DECORATION ================= --}}
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-[-200px] left-[-200px] w-[500px] h-[500px] bg-indigo-600 opacity-30 blur-3xl rounded-full"></div>
        <div class="absolute bottom-[-200px] right-[-200px] w-[500px] h-[500px] bg-blue-500 opacity-30 blur-3xl rounded-full"></div>
    </div>

    {{-- ================= CONTAINER ================= --}}
    <div class="w-full max-w-md">

        {{-- Branding --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-white tracking-tight">
                Admin Panel
            </h1>
            <p class="text-slate-400 mt-3 text-sm">
                Percetakan Online Management System
            </p>
        </div>

        {{-- Glass Card --}}
        <div class="backdrop-blur-xl bg-white/10 border border-white/20 shadow-2xl rounded-3xl p-8 text-white">

            {{-- Flash Success --}}
            @if(session('success'))
                <div class="mb-4 bg-green-500/20 border border-green-400/40 text-green-200 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error --}}
            @if($errors->any())
                <div class="mb-4 bg-red-500/20 border border-red-400/40 text-red-200 px-4 py-3 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @yield('content')

        </div>

        <p class="text-center text-xs text-slate-500 mt-8">
            © {{ date('Y') }} Percetakan Online
        </p>

    </div>

</body>
</html>