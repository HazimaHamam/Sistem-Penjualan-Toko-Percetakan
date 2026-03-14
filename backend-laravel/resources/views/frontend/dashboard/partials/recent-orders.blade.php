{{-- ═══ RECENT ORDERS TABLE ═══ --}}
<div class="panel u-rise d5">

    <div class="panel-hd">
        <div>
            <p class="panel-eyebrow">Riwayat</p>
            <h3 class="panel-title">Pesanan Terbaru</h3>
        </div>
        <a href="{{ route('orders.index') }}" class="pill-link">
            Lihat semua
            <svg style="width:11px;height:11px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
            </svg>
        </a>
    </div>

    <div style="overflow-x:auto">
        <table class="tbl">
            <thead>
                <tr>
                    <th style="width:2.25rem">#</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="text-align:right">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders ?? [] as $order)
                    @php
                        [$bdgCls, $label] = match($order->status) {
                            'completed'  => ['bdg-done',   'Selesai'],
                            'processing' => ['bdg-proc',   'Diproses'],
                            'cancelled'  => ['bdg-cancel', 'Dibatalkan'],
                            default      => ['bdg-pend',   'Pending'],
                        };
                    @endphp
                    <tr class="tbl-row" data-id="{{ $order->id }}">
                        <td style="color:var(--text-3);font-size:.7rem;font-weight:500;font-variant-numeric:tabular-nums">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <span style="font-weight:600;color:var(--text-1);letter-spacing:-.01em">
                                {{ $order->invoice_number }}
                            </span>
                        </td>
                        <td>
                            <span style="color:var(--text-2);font-size:.7875rem">{{ $order->created_at->format('d M Y') }}</span>
                            <span style="display:block;color:var(--text-3);font-size:.68rem;margin-top:2px">{{ $order->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            <span class="bdg {{ $bdgCls }}">
                                <span class="bdg-dot"></span>{{ $label }}
                            </span>
                        </td>
                        <td>
                            <span style="font-weight:700;color:var(--text-1);font-variant-numeric:tabular-nums">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:3.5rem 1.25rem">
                            <div style="display:flex;flex-direction:column;align-items:center;gap:.75rem">
                                <div style="width:48px;height:48px;border-radius:14px;background:var(--bg-3);border:1px solid var(--line);display:flex;align-items:center;justify-content:center">
                                    {{-- Heroicons: document-text --}}
                                    <svg style="width:22px;height:22px;color:var(--text-3)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p style="font-size:.875rem;font-weight:600;color:var(--text-2)">Belum ada pesanan</p>
                                    <p style="font-size:.75rem;color:var(--text-3);margin-top:.2rem">Pesanan Anda akan muncul di sini</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>