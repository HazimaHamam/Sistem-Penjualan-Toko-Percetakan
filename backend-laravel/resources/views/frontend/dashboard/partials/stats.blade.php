{{-- ═══ STAT CARDS ═══ --}}
@php
    $pctProc = $totalOrders > 0 ? round(($processingOrders / $totalOrders) * 100) : 0;
    $pctDone = $totalOrders > 0 ? round(($completedOrders  / $totalOrders) * 100) : 0;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    {{-- ① Total Pesanan --}}
    <div class="stat-card u-rise d2">
        <div class="glow" style="background:var(--accent)"></div>
        <div class="flex items-start justify-between mb-5">
            <div class="stat-icon" style="background:rgba(124,109,250,.12);color:var(--accent)">
                {{-- Heroicons: inbox-stack --}}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.875 14.25l1.214 1.942a2.25 2.25 0 001.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 011.872 1.002l.164.246a2.25 2.25 0 001.872 1.002h2.092a2.25 2.25 0 001.872-1.002l.164-.246A2.25 2.25 0 0116.954 9h4.636M2.41 9A2.25 2.25 0 002.25 9.75v.75m0 0v6.75A2.25 2.25 0 004.5 19.5h15a2.25 2.25 0 002.25-2.25V10.5m-19.5 0V9.75A2.25 2.25 0 014.5 7.5h15a2.25 2.25 0 012.25 2.25V9.75m-19.5 0h19.5"/>
                </svg>
            </div>
            <span style="font-size:.62rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--text-3)">Semua waktu</span>
        </div>
        <span class="stat-num">{{ $totalOrders ?? 0 }}</span>
        <p class="stat-label">Total Pesanan</p>
        <div class="prog">
            <div class="prog-fill" style="width:{{ $totalOrders > 0 ? 100 : 0 }}%;background:var(--accent)"></div>
        </div>
    </div>

    {{-- ② Diproses --}}
    <div class="stat-card u-rise d3">
        <div class="glow" style="background:var(--amber)"></div>
        <div class="flex items-start justify-between mb-5">
            <div class="stat-icon" style="background:rgba(251,191,36,.1);color:var(--amber)">
                {{-- Heroicons: arrow-path --}}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
            </div>
            <span class="bdg bdg-proc">Aktif</span>
        </div>
        <span class="stat-num">{{ $processingOrders ?? 0 }}</span>
        <p class="stat-label">Sedang Diproses</p>
        <div class="prog">
            <div class="prog-fill" style="width:{{ $pctProc }}%;background:var(--amber)"></div>
        </div>
    </div>

    {{-- ③ Selesai --}}
    <div class="stat-card u-rise d4">
        <div class="glow" style="background:var(--emerald)"></div>
        <div class="flex items-start justify-between mb-5">
            <div class="stat-icon" style="background:rgba(52,211,153,.1);color:var(--emerald)">
                {{-- Heroicons: check-badge --}}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                </svg>
            </div>
            <span class="bdg bdg-done">Tuntas</span>
        </div>
        <span class="stat-num">{{ $completedOrders ?? 0 }}</span>
        <p class="stat-label">Pesanan Selesai</p>
        <div class="prog">
            <div class="prog-fill" style="width:{{ $pctDone }}%;background:var(--emerald)"></div>
        </div>
    </div>

    {{-- ④ Total Pengeluaran --}}
    <div class="stat-card stat-card-accent u-rise d5">
        <div class="flex items-start justify-between mb-5">
            <div class="stat-icon" style="background:rgba(255,255,255,.12);color:#e0e7ff;border:1px solid rgba(255,255,255,.15)">
                {{-- Heroicons: banknotes --}}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                </svg>
            </div>
            <span style="font-size:.62rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:rgba(199,210,254,.6)">30 hari</span>
        </div>
        <span class="stat-num" style="font-size:1.6rem;letter-spacing:-.03em">
            Rp&nbsp;{{ number_format($totalSpending ?? 0, 0, ',', '.') }}
        </span>
        <p class="stat-label">Total Pengeluaran</p>
        <div class="prog">
            <div class="prog-fill" style="width:100%;background:rgba(255,255,255,.4)"></div>
        </div>
    </div>

</div>