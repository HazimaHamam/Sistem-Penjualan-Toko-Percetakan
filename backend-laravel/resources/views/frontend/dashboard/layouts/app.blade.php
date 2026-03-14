<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Percetakan Online</title>

    {{-- Google Fonts: DM Sans + DM Serif Display --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=DM+Serif+Display&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')

    <style>
        :root {
            --font-sans:   'DM Sans', sans-serif;
            --font-serif:  'DM Serif Display', serif;
            --bg:          #0f0e0c;
            --bg-2:        #161512;
            --bg-3:        #1e1c18;
            --surface:     #161512;
            --border:      rgba(255,255,255,0.07);
            --text:        #f5f3ef;
            --text-muted:  #a8a098;
            --accent:      #7c6dfa;
            --accent-soft: rgba(124,109,250,0.12);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: var(--font-sans);
            background: var(--bg);
            color: var(--text);
        }

        [x-cloak] { display: none !important; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar       { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #2e2c28; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #3e3c38; }
    </style>
</head>

<body x-data="{ sidebarOpen: false, sidebarCollapsed: false }">

<div class="min-h-screen flex">

    {{-- ═══════════════════ SIDEBAR ═══════════════════ --}}
    <aside
        :class="sidebarCollapsed ? 'w-[72px]' : 'w-64'"
        class="fixed lg:static inset-y-0 left-0 z-40
               -translate-x-full lg:translate-x-0
               transition-all duration-300 ease-in-out
               flex flex-col
               bg-[#1a1917] text-white
               shadow-2xl lg:shadow-none"
        :style="sidebarOpen ? 'transform:translateX(0)' : ''"
        aria-label="Sidebar navigasi"
    >

        {{-- Logo --}}
        <div class="h-16 flex items-center justify-between px-5 border-b border-white/10">
            <span
                x-show="!sidebarCollapsed"
                x-transition.opacity
                class="font-serif text-lg tracking-wide text-white/90 truncate"
                style="font-family: var(--font-serif)"
            >
                Percetakan
            </span>
            <button
                type="button"
                @click="sidebarCollapsed = !sidebarCollapsed"
                :aria-label="sidebarCollapsed ? 'Perluas sidebar' : 'Perkecil sidebar'"
                class="hidden lg:flex w-8 h-8 rounded-lg items-center justify-center
                       text-white/50 hover:text-white hover:bg-white/10 transition shrink-0"
            >
                <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-6 overflow-y-auto space-y-1" aria-label="Menu utama">
            @include('frontend.dashboard.partials.sidebar')
        </nav>

        {{-- Profile --}}
        <div class="border-t border-white/10 p-4">
            <div class="flex items-center gap-3" :class="sidebarCollapsed ? 'justify-center' : ''">
                <div class="w-8 h-8 rounded-full bg-indigo-500 text-white
                            flex items-center justify-center text-xs font-semibold shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0" x-show="!sidebarCollapsed" x-transition.opacity>
                    <p class="text-sm font-medium text-white/90 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-white/40">Member</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" x-show="!sidebarCollapsed" x-transition.opacity class="mt-3">
                @csrf
                <button type="submit"
                        onclick="return confirm('Yakin ingin logout?')"
                        class="w-full text-xs text-white/40 hover:text-red-400
                               py-2 rounded-lg hover:bg-white/5
                               transition-all duration-200 active:scale-[0.98]">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- Mobile Overlay --}}
    <div
        x-cloak x-show="sidebarOpen" x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        aria-hidden="true"
    ></div>

    {{-- ═══════════════════ MAIN ═══════════════════ --}}
    <div class="flex-1 flex flex-col min-h-screen overflow-hidden">

        {{-- Topbar --}}
        <header class="h-16 sticky top-0 z-30 px-6 lg:px-8 flex items-center justify-between"
                style="background:rgba(15,14,12,0.8);backdrop-filter:blur(16px);border-bottom:1px solid rgba(255,255,255,0.06)">

            <div class="flex items-center gap-4">
                <button type="button" @click="sidebarOpen = true"
                        aria-label="Buka menu"
                        class="lg:hidden w-9 h-9 flex items-center justify-center
                               rounded-lg transition"
                        style="color:rgba(255,255,255,0.4)"
                        onmouseover="this.style.background='rgba(255,255,255,0.07)'"
                        onmouseout="this.style.background='transparent'">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>

                {{-- Breadcrumb-style title --}}
                <div class="flex items-center gap-2 text-sm">
                    <span style="color:rgba(255,255,255,0.25)">Customer Portal</span>
                    <span style="color:rgba(255,255,255,0.15)">/</span>
                    <span style="font-weight:600;color:rgba(255,255,255,0.85)">@yield('page_title', 'Dashboard')</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @auth
                {{-- Notification bell --}}
                <button type="button" aria-label="Notifikasi"
                        class="w-9 h-9 flex items-center justify-center rounded-lg transition relative"
                        style="color:rgba(255,255,255,0.4);background:transparent"
                        onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.8)'"
                        onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.4)'">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                </button>

                {{-- Divider --}}
                <div class="w-px h-6" style="background:rgba(255,255,255,0.08)"></div>

                {{-- User chip --}}
                <div class="flex items-center gap-2.5 pl-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold shrink-0"
                         style="background:linear-gradient(135deg,#4338ca,#6d28d9);color:#fff">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-medium leading-tight" style="color:rgba(255,255,255,0.85)">{{ auth()->user()->name }}</p>
                        <p class="text-xs leading-tight" style="color:rgba(255,255,255,0.3)">Member</p>
                    </div>
                </div>
                @endauth
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-6 lg:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="px-8 py-4 text-xs text-center"
                style="color:rgba(255,255,255,0.2);border-top:1px solid rgba(255,255,255,0.05);background:var(--bg-2)">
            © {{ date('Y') }} Percetakan Online
        </footer>

    </div>
</div>

@stack('scripts')
</body>
</html>