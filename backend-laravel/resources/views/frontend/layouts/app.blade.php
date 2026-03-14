<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Percetakan Online') — Cetak Premium</title>

    {{-- SEO dasar --}}
    <meta name="description" content="@yield('meta_description', 'Percetakan premium online — stampel, kartu nama, buku yasin, flyer, banner. Kualitas terbaik, pengiriman ke seluruh Indonesia.')">

    {{-- Vite: app.css & app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    @include('frontend.partials.navbar')
    @if (session('success') || session('error') || session('info') || $errors->any())
        <div class="flash-wrapper" id="flashWrapper">

            @if (session('success'))
                <div class="flash flash--success" role="alert">
                    <span class="flash-icon">
                        <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <p class="flash-text">{{ session('success') }}</p>
                    <button class="flash-close" onclick="this.closest('.flash').remove()" aria-label="Tutup notifikasi">×</button>
                </div>
            @endif

            @if (session('error'))
                <div class="flash flash--error" role="alert">
                    <span class="flash-icon">
                        <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <p class="flash-text">{{ session('error') }}</p>
                    <button class="flash-close" onclick="this.closest('.flash').remove()" aria-label="Tutup notifikasi">×</button>
                </div>
            @endif

            @if (session('info'))
                <div class="flash flash--info" role="alert">
                    <span class="flash-icon">
                        <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <p class="flash-text">{{ session('info') }}</p>
                    <button class="flash-close" onclick="this.closest('.flash').remove()" aria-label="Tutup notifikasi">×</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="flash flash--error" role="alert">
                    <span class="flash-icon">
                        <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <div class="flash-text">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    <button class="flash-close" onclick="this.closest('.flash').remove()" aria-label="Tutup notifikasi">×</button>
                </div>
            @endif

        </div>
    @endif


    {{-- ══════════════════════════════
         MAIN CONTENT
         FIX: <main> tidak lagi dibungkus container/padding global.
         Tiap child view (home, produk, dll) mengatur layout-nya sendiri.
         Halaman full-width seperti home bisa bebas stretch ke tepi layar.
    ══════════════════════════════ --}}
    <main id="main-content">
        @yield('content')
    </main>


    {{-- ══════════════════════════════
         FOOTER
    ══════════════════════════════ --}}
    @include('frontend.partials.footer')
    @stack('scripts')

    {{-- Auto-hide flash messages setelah 5 detik --}}
    @if (session('success') || session('error') || session('info') || $errors->any())
    <script>
        (function () {
            var flashes = document.querySelectorAll('.flash');
            flashes.forEach(function (el) {
                setTimeout(function () {
                    el.style.transition = 'opacity .4s ease, transform .4s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateX(20px)';
                    setTimeout(function () { el.remove(); }, 400);
                }, 5000);
            });
        })();
    </script>
    @endif

</body>
</html>