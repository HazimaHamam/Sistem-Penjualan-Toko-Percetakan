{{-- ═══ ACTIVITY TIMELINE ═══ --}}
<div class="panel u-rise d4">

    <div class="panel-hd">
        <div>
            <p class="panel-eyebrow">Timeline</p>
            <h3 class="panel-title">Aktivitas Terbaru</h3>
        </div>
        <span style="font-size:.7rem;color:var(--text-3)">
            {{ ($recentOrders ?? collect())->count() }} entri
        </span>
    </div>

    <div style="padding:.75rem 1.25rem">
        @forelse($recentOrders ?? [] as $order)
            @php
                [$dotBg, $bdgCls, $bdgLabel, $amtColor] = match($order->status) {
                    'completed'  => ['var(--emerald)', 'bdg-done',   'Selesai',    '#6ee7b7'],
                    'processing' => ['var(--amber)',   'bdg-proc',   'Diproses',   '#fcd34d'],
                    'cancelled'  => ['var(--red)',     'bdg-cancel', 'Dibatalkan', '#fca5a5'],
                    default      => ['var(--text-3)',  'bdg-pend',   'Pending',    'var(--text-2)'],
                };
            @endphp
            <div class="tl-item flex items-start gap-3 py-2.5">
                {{-- Node --}}
                <div style="width:26px;height:26px;border-radius:50%;background:var(--bg-3);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;z-index:1">
                    <span style="width:7px;height:7px;border-radius:50%;background:{{ $dotBg }};display:block;flex-shrink:0"></span>
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0">
                    <p style="font-size:.8125rem;font-weight:600;color:var(--text-1);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;line-height:1.3">
                        {{ $order->invoice_number }}
                    </p>
                    <div style="display:flex;align-items:center;gap:.5rem;margin-top:.3rem">
                        <span class="bdg {{ $bdgCls }}">
                            <span class="bdg-dot"></span>
                            {{ $bdgLabel }}
                        </span>
                        <span style="font-size:.68rem;color:var(--text-3)">{{ $order->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Amount --}}
                <span style="font-size:.75rem;font-weight:700;color:{{ $amtColor }};flex-shrink:0;font-variant-numeric:tabular-nums">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
        @empty
            <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:3.5rem 0;text-align:center">
                <div style="width:44px;height:44px;border-radius:12px;background:var(--bg-3);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;margin-bottom:.875rem">
                    {{-- Heroicons: clock --}}
                    <svg style="width:20px;height:20px;color:var(--text-3)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p style="font-size:.8125rem;font-weight:600;color:var(--text-2)">Belum ada aktivitas</p>
                <p style="font-size:.7rem;color:var(--text-3);margin-top:.25rem">Pesanan akan muncul di sini</p>
            </div>
        @endforelse
    </div>

</div>