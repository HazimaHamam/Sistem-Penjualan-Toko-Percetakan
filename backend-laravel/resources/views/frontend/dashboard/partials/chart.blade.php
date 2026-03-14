{{-- ═══ CHART ═══ --}}
@php
    $cTotal  = array_sum($chartData ?? []);
    $cAvg    = $cTotal > 0 ? number_format($cTotal / 30, 1) : '0';
    $cMax    = !empty($chartData) ? max($chartData) : 0;
    $cMaxIdx = $cMax > 0 ? array_search($cMax, $chartData) : null;
    $cBest   = $cMaxIdx !== null ? ($chartLabels[$cMaxIdx] ?? '—') : '—';
@endphp

<div class="panel u-rise d3">

    <div class="panel-hd">
        <div>
            <p class="panel-eyebrow">Analitik</p>
            <h3 class="panel-title">Tren Pesanan</h3>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1.5">
                <span style="width:8px;height:8px;border-radius:50%;background:var(--accent);display:inline-block;box-shadow:0 0 8px var(--accent)"></span>
                <span style="font-size:.7rem;color:var(--text-3)">Pesanan masuk</span>
            </div>
            <span style="font-size:.68rem;color:var(--text-3);background:var(--bg-3);border:1px solid var(--line);padding:.25rem .75rem;border-radius:99px">
                30 hari
            </span>
        </div>
    </div>

    {{-- Summary chips --}}
    <div class="chip-row">
        <div class="chip">
            <span class="chip-lbl">Total periode</span>
            <span class="chip-val">{{ $cTotal }} pesanan</span>
        </div>
        <div class="chip-divider"></div>
        <div class="chip">
            <span class="chip-lbl">Rata-rata / hari</span>
            <span class="chip-val">{{ $cAvg }}</span>
        </div>
        <div class="chip-divider"></div>
        <div class="chip">
            <span class="chip-lbl">Hari terbaik</span>
            <span class="chip-val">
                {{ $cBest }}
                @if($cMax > 0)
                    <span style="color:var(--accent);font-weight:400">({{ $cMax }})</span>
                @endif
            </span>
        </div>
    </div>

    {{-- Chart area --}}
    <div style="padding:1.25rem 1.25rem 1rem">
        @if($cTotal > 0)
            <div id="chartSkel" style="display:flex;flex-direction:column;gap:.625rem">
                <div class="skel" style="height:10px;width:20%"></div>
                <div class="skel" style="height:176px;width:100%;border-radius:10px"></div>
                <div style="display:flex;gap:8px">
                    @for($i=0;$i<7;$i++) <div class="skel" style="height:7px;flex:1"></div> @endfor
                </div>
            </div>
            <canvas id="ordersChart" style="display:none" height="85"></canvas>
        @else
            <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:4rem 0;text-align:center">
                <div style="width:52px;height:52px;border-radius:14px;background:var(--bg-3);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    {{-- Heroicons: presentation-chart-line --}}
                    <svg style="width:26px;height:26px;color:var(--text-3)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                    </svg>
                </div>
                <p style="font-size:.875rem;font-weight:600;color:var(--text-2)">Belum ada data grafik</p>
                <p style="font-size:.75rem;color:var(--text-3);margin-top:.25rem">Akan muncul setelah ada pesanan masuk</p>
            </div>
        @endif
    </div>

</div>