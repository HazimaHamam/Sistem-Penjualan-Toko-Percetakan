<ul class="space-y-0.5" role="list">

    {{-- DASHBOARD --}}
    @php $isDashboard = request()->routeIs('dashboard') @endphp
    <li role="listitem">
        <a href="{{ route('dashboard') }}"
           @if($isDashboard) aria-current="page" @endif
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
                  {{ $isDashboard
                      ? 'bg-white/10 text-white'
                      : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}"
           :class="sidebarCollapsed ? 'justify-center' : ''">

            {{-- Heroicons: squares-2x2 (tetap, sudah benar) --}}
            <svg class="w-[18px] h-[18px] shrink-0 transition-transform duration-200 group-hover:scale-110"
                 aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
            </svg>

            <span class="text-sm font-medium truncate"
                  x-show="!sidebarCollapsed" x-transition.opacity>
                Dashboard
            </span>

            @if($isDashboard)
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"
                      x-show="!sidebarCollapsed"></span>
            @endif
        </a>
    </li>

    {{-- ORDERS --}}
    @php $isOrders = request()->routeIs('orders.*') @endphp
    <li role="listitem">
        <a href="{{ route('orders.index') }}"
           @if($isOrders) aria-current="page" @endif
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
                  {{ $isOrders
                      ? 'bg-white/10 text-white'
                      : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}"
           :class="sidebarCollapsed ? 'justify-center' : ''">

            {{-- Heroicons: queue-list --}}
            <svg class="w-[18px] h-[18px] shrink-0 transition-transform duration-200 group-hover:scale-110"
                 aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/>
            </svg>

            <span class="text-sm font-medium truncate"
                  x-show="!sidebarCollapsed" x-transition.opacity>
                Pesanan
            </span>

            @if($isOrders)
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"
                      x-show="!sidebarCollapsed"></span>
            @endif
        </a>
    </li>

    {{-- PROFILE --}}
    @php $isProfile = request()->routeIs('profile') @endphp
    <li role="listitem">
        <a href="{{ route('profile') }}"
           @if($isProfile) aria-current="page" @endif
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
                  {{ $isProfile
                      ? 'bg-white/10 text-white'
                      : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}"
           :class="sidebarCollapsed ? 'justify-center' : ''">

            {{-- Heroicons: cog-6-tooth --}}
            <svg class="w-[18px] h-[18px] shrink-0 transition-transform duration-200 group-hover:scale-110"
                 aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>

            <span class="text-sm font-medium truncate"
                  x-show="!sidebarCollapsed" x-transition.opacity>
                Pengaturan Akun
            </span>

            @if($isProfile)
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"
                      x-show="!sidebarCollapsed"></span>
            @endif
        </a>
    </li>

    {{-- CART --}}
    @php $isCart = request()->routeIs('cart.*') @endphp
    <li role="listitem">
        <a href="{{ route('cart.index') }}"
           @if($isCart) aria-current="page" @endif
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
                  {{ $isCart
                      ? 'bg-white/10 text-white'
                      : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}"
           :class="sidebarCollapsed ? 'justify-center' : ''">

            <svg class="w-[18px] h-[18px] shrink-0 transition-transform duration-200 group-hover:scale-110"
                 aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
            </svg>

            <span class="text-sm font-medium truncate"
                  x-show="!sidebarCollapsed" x-transition.opacity>
                Keranjang
            </span>

            @if($isCart)
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"
                      x-show="!sidebarCollapsed"></span>
            @endif
        </a>
    </li>

</ul>