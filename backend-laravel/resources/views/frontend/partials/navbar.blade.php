{{-- ════════════════════════════════════════════════════════
     NAVBAR — Hybrid Tailwind v4 + Custom CSS
     resources/views/frontend/partials/navbar.blade.php

     Pendekatan:
     - Tailwind  : layout, spacing, flex, sizing, responsive
     - Custom CSS : animasi dropdown, hamburger transform,
                    mobile slide, scroll behavior, active dot
════════════════════════════════════════════════════════ --}}

@php
    $active    = fn(string $route) => request()->routeIs($route);
    $cartCount = session('cart') ? count(session('cart')) : 0;
@endphp

<style>
/* ── Komponen yang tidak bisa diekspresikan dengan Tailwind utility ── */

/* Scroll state */
#navbar.is-scrolled {
    background: rgba(250,247,242,.98) !important;
    box-shadow: 0 4px 24px rgba(42,40,37,.08);
}

/* Logo mark hover */
.nav-logo:hover .nav-logo-mark {
    transform: rotate(-4deg) scale(1.05);
}

/* Active link — dot indicator bawah */
.nav-link-active::after {
    content: '';
    position: absolute;
    bottom: 4px; left: 50%;
    transform: translateX(-50%);
    width: 16px; height: 2px;
    background: var(--gold);
    border-radius: 99px;
}

/* Dropdown animasi */
.nav-dropdown {
    opacity: 0;
    pointer-events: none;
    transform: translateY(8px) scale(.97);
    transform-origin: top right;
    transition: opacity .2s ease, transform .2s cubic-bezier(.16,1,.3,1);
}
.nav-dropdown.is-open {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0) scale(1);
}

/* Chevron rotate saat dropdown terbuka */
.nav-chevron { transition: transform .25s ease; }
#navUserBtn[aria-expanded="true"] .nav-chevron {
    transform: rotate(180deg);
}

/* Hamburger → ✕ */
.nav-hamburger span {
    transition: transform .3s ease, opacity .3s ease;
    transform-origin: center;
}
.nav-hamburger.is-open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.nav-hamburger.is-open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger.is-open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

/* Mobile menu smooth slide */
#navMobile {
    overflow: hidden;
    max-height: 0;
    transition: max-height .35s cubic-bezier(.16,1,.3,1);
    border-top: 1px solid transparent;
}
#navMobile.is-open {
    max-height: 600px;
    border-top-color: var(--border);
}
</style>

{{-- ════ MARKUP ════ --}}
<nav id="navbar"
     class="sticky top-0 z-50 bg-ivory/90 backdrop-blur-md border-b border-black/10 transition-all duration-300"
     style="font-family: var(--font-sans, 'DM Sans', sans-serif)"
     aria-label="Navigasi utama">

    {{-- ── INNER ── --}}
    <div class="max-w-[1200px] mx-auto px-6 h-[68px] flex items-center justify-between gap-8">

        {{-- ── LOGO ── --}}
        <a href="{{ route('home') }}"
           class="nav-logo flex items-center gap-2.5 no-underline shrink-0"
           aria-label="{{ config('app.name', 'Mirza Stamp') }} — Beranda">

            <div class="nav-logo-mark w-[38px] h-[38px] bg-navy rounded-[10px] flex items-center justify-center shrink-0 relative overflow-hidden transition-transform duration-200 ease-[cubic-bezier(.16,1,.3,1)]">
                <div class="absolute inset-0 bg-gradient-to-br from-gold/30 to-transparent"></div>
                <svg class="w-5 h-5 text-gold-2 relative z-10"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="6 9 6 2 18 2 18 9"/>
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8"/>
                </svg>
            </div>

            <div class="leading-none">
                <span class="block font-display text-[0.9375rem] font-bold text-navy tracking-tight">
                    {{ config('app.name', 'Mirza Stamp') }}
                </span>
                <span class="block text-[0.65rem] text-ink-muted font-medium tracking-[0.04em] uppercase mt-px">
                    Percetakan Online
                </span>
            </div>
        </a>

        {{-- ── DESKTOP NAV LINKS ── --}}
        <ul class="hidden md:flex items-center gap-1 list-none m-0 p-0" role="list">
            @php
                $navItems = [
                    ['href' => route('home'),        'route' => 'home',     'label' => 'Home'],
                    ['href' => route('produk.index'), 'route' => 'produk.*', 'label' => 'Produk'],
                    ['href' => route('alamat'),       'route' => 'alamat',   'label' => 'Alamat'],
                    ['href' => route('kontak'),       'route' => 'kontak',   'label' => 'Kontak'],
                ];
            @endphp
            @foreach($navItems as $item)
            <li>
                <a href="{{ $item['href'] }}"
                   class="relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg no-underline transition-colors duration-150
                          {{ $active($item['route'])
                              ? 'nav-link-active text-gold font-semibold'
                              : 'text-ink-soft hover:text-ink hover:bg-ivory-2' }}">
                    {{ $item['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        {{-- ── RIGHT SECTION ── --}}
        <div class="flex items-center gap-3 shrink-0">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}"
               class="relative flex items-center justify-center w-10 h-10 rounded-[10px] text-ink-soft no-underline transition-colors duration-150 hover:text-gold hover:bg-gold-pale"
               aria-label="Keranjang belanja{{ $cartCount > 0 ? ', '.$cartCount.' item' : '' }}">
                <svg class="w-[22px] h-[22px]"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                @if($cartCount > 0)
                    <span class="absolute top-1 right-1 min-w-[16px] h-4 px-1 bg-gold text-white text-[0.6rem] font-bold rounded-full flex items-center justify-center border-[1.5px] border-ivory leading-none"
                          aria-hidden="true">
                        {{ $cartCount > 99 ? '99+' : $cartCount }}
                    </span>
                @endif
            </a>

            {{-- Auth: User dropdown --}}
            @auth
            <div class="relative hidden md:block" id="navUserWrapper">

                <button id="navUserBtn"
                        class="flex items-center gap-2 px-2.5 py-1.5 pl-1.5 bg-transparent border border-black/10 rounded-full cursor-pointer font-[inherit] transition-colors duration-200 hover:border-gold/40 hover:bg-gold-pale"
                        aria-expanded="false"
                        aria-controls="navDropdown"
                        aria-haspopup="true">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-navy to-navy-soft text-white text-xs font-bold flex items-center justify-center shrink-0"
                         aria-hidden="true">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-[0.8rem] font-semibold text-ink max-w-[100px] truncate">
                        {{ auth()->user()->name }}
                    </span>
                    <svg class="nav-chevron w-3.5 h-3.5 text-ink-muted shrink-0"
                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                    </svg>
                </button>

                {{-- Dropdown Panel --}}
                <div id="navDropdown"
                     class="nav-dropdown absolute top-[calc(100%+0.625rem)] right-0 w-56 bg-white border border-black/10 rounded-2xl shadow-xl overflow-hidden"
                     role="menu"
                     aria-labelledby="navUserBtn">

                    <div class="px-4 py-3 border-b border-black/8">
                        <span class="block font-semibold text-[0.85rem] text-ink">{{ auth()->user()->name }}</span>
                        <span class="block text-[0.72rem] text-ink-muted mt-px truncate">{{ auth()->user()->email }}</span>
                    </div>

                    <div class="py-1.5">
                        <a href="{{ route('profile') }}"
                           class="flex items-center gap-2.5 px-4 py-2.5 text-[0.8rem] font-medium text-ink-soft no-underline transition-colors hover:bg-ivory hover:text-ink"
                           role="menuitem">
                            <svg class="w-[15px] h-[15px] shrink-0" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="10" cy="7" r="3"/><path d="M4 17a6 6 0 0112 0"/>
                            </svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-2.5 px-4 py-2.5 text-[0.8rem] font-medium text-ink-soft no-underline transition-colors hover:bg-ivory hover:text-ink"
                           role="menuitem">
                            <svg class="w-[15px] h-[15px] shrink-0" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="6" height="6" rx="1"/>
                                <rect x="11" y="3" width="6" height="6" rx="1"/>
                                <rect x="3" y="11" width="6" height="6" rx="1"/>
                                <rect x="11" y="11" width="6" height="6" rx="1"/>
                            </svg>
                            Dashboard
                        </a>
                        <div class="h-px bg-black/8 my-1.5" role="separator"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-2.5 w-full px-4 py-2.5 text-[0.8rem] font-medium text-red-600 bg-transparent border-none cursor-pointer font-[inherit] text-left transition-colors hover:bg-red-50"
                                    role="menuitem">
                                <svg class="w-[15px] h-[15px] shrink-0" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M13 7l3 3m0 0l-3 3m3-3H8m4-7H5a2 2 0 00-2 2v12a2 2 0 002 2h7"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            @endauth

            {{-- Auth: Guest --}}
            @guest
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('login') }}"
                   class="px-[1.125rem] py-2 text-[0.8rem] font-semibold text-ink no-underline border border-black/10 rounded-[9px] transition-colors hover:border-black/25 hover:bg-ivory-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="px-[1.125rem] py-2 text-[0.8rem] font-semibold text-white no-underline bg-navy rounded-[9px] border border-transparent transition-all hover:bg-navy-2 hover:-translate-y-px">
                    Daftar
                </a>
            </div>
            @endguest

            {{-- Hamburger --}}
            <button id="navHamburger"
                    class="nav-hamburger md:hidden flex flex-col items-center justify-center gap-[5px] w-10 h-10 bg-transparent border border-black/10 rounded-[9px] cursor-pointer p-0 transition-colors hover:border-black/25"
                    aria-expanded="false"
                    aria-controls="navMobile"
                    aria-label="Buka menu navigasi">
                <span class="block w-[18px] h-[1.5px] bg-ink rounded-full"></span>
                <span class="block w-[18px] h-[1.5px] bg-ink rounded-full"></span>
                <span class="block w-[18px] h-[1.5px] bg-ink rounded-full"></span>
            </button>

        </div>
    </div>

    {{-- ── MOBILE MENU ── --}}
    <div id="navMobile" aria-hidden="true">
        <div class="px-6 pt-4 pb-6 flex flex-col gap-1">

            @foreach($navItems as $item)
            <a href="{{ $item['href'] }}"
               class="flex items-center px-3.5 py-3 text-[0.9rem] font-medium rounded-[10px] no-underline transition-colors
                      {{ $active($item['route'])
                          ? 'text-gold bg-gold-pale'
                          : 'text-ink-soft hover:text-gold hover:bg-gold-pale' }}">
                {{ $item['label'] }}
            </a>
            @endforeach

            <a href="{{ route('cart.index') }}"
               class="flex items-center justify-between px-3.5 py-3 text-[0.9rem] font-medium text-ink-soft rounded-[10px] no-underline transition-colors hover:text-gold hover:bg-gold-pale">
                <span>Keranjang</span>
                @if($cartCount > 0)
                    <span class="inline-flex items-center justify-center min-w-5 h-5 px-1.5 bg-gold text-white text-[0.65rem] font-bold rounded-full">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <div class="h-px bg-black/8 my-2"></div>

            @auth
                <a href="{{ route('profile') }}"
                   class="flex items-center px-3.5 py-3 text-[0.9rem] font-medium text-ink-soft rounded-[10px] no-underline transition-colors hover:text-ink hover:bg-ivory-2">
                    Profil Saya
                </a>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-3.5 py-3 text-[0.9rem] font-medium text-ink-soft rounded-[10px] no-underline transition-colors hover:text-ink hover:bg-ivory-2">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-2 w-full px-3.5 py-3 text-[0.9rem] font-medium text-red-600 bg-transparent border-none cursor-pointer rounded-[10px] text-left transition-colors hover:bg-red-50">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M13 7l3 3m0 0l-3 3m3-3H8m4-7H5a2 2 0 00-2 2v12a2 2 0 002 2h7"/>
                        </svg>
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="flex items-center px-3.5 py-3 text-[0.9rem] font-medium text-ink-soft rounded-[10px] no-underline transition-colors hover:text-ink hover:bg-ivory-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="flex items-center px-3.5 py-3 text-[0.9rem] font-medium text-ink-soft rounded-[10px] no-underline transition-colors hover:text-ink hover:bg-ivory-2">
                    Daftar
                </a>
            @endguest

            <a href="{{ route('produk.index') }}"
               class="block text-center px-4 py-3 mt-2 bg-navy text-white text-[0.875rem] font-semibold rounded-[10px] no-underline transition-colors hover:bg-navy-2">
                Pesan Sekarang →
            </a>

        </div>
    </div>

</nav>

<script>
(function () {
    'use strict';

    var navbar     = document.getElementById('navbar');
    var hamburger  = document.getElementById('navHamburger');
    var mobileMenu = document.getElementById('navMobile');
    var userBtn    = document.getElementById('navUserBtn');
    var dropdown   = document.getElementById('navDropdown');

    /* Scroll */
    function onScroll() {
        navbar.classList.toggle('is-scrolled', window.scrollY > 20);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* Hamburger */
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function () {
            var isOpen = mobileMenu.classList.toggle('is-open');
            hamburger.classList.toggle('is-open', isOpen);
            hamburger.setAttribute('aria-expanded', isOpen);
            mobileMenu.setAttribute('aria-hidden', !isOpen);
        });
    }

    /* Dropdown */
    if (userBtn && dropdown) {
        userBtn.addEventListener('click', function () {
            var isOpen = dropdown.classList.toggle('is-open');
            userBtn.setAttribute('aria-expanded', isOpen);
        });
        document.addEventListener('click', function (e) {
            var wrapper = document.getElementById('navUserWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                dropdown.classList.remove('is-open');
                userBtn.setAttribute('aria-expanded', 'false');
            }
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && dropdown.classList.contains('is-open')) {
                dropdown.classList.remove('is-open');
                userBtn.setAttribute('aria-expanded', 'false');
                userBtn.focus();
            }
        });
    }
})();
</script>