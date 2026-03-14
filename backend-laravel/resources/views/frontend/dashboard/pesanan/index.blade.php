@extends('frontend.dashboard.layouts.app')

@section('title', 'Pesanan Saya')
@section('page_title', 'Pesanan')

@section('content')

    {{-- ── HEADER ── --}}
    <div class="flex items-start justify-between afu d1">
        <div>
            <p class="text-xs font-medium text-stone-400 uppercase tracking-widest mb-1">Manajemen</p>
            <h2 class="text-2xl font-semibold text-stone-900" style="font-family: var(--font-serif)">
                Pesanan Saya
            </h2>
            <p class="text-sm text-stone-500 mt-1">Kelola dan pantau seluruh pesanan Anda.</p>
        </div>

        {{-- Total badge --}}
        <div class="hidden sm:flex items-center gap-2 bg-white border border-stone-100
                    rounded-xl px-4 py-2.5 shadow-sm">
            <span class="text-xs text-stone-400">Total</span>
            <span class="text-sm font-bold text-stone-800">{{ $orders->total() }} pesanan</span>
        </div>
    </div>


    {{-- ── FILTER + SEARCH ── --}}
    <div class="bg-white rounded-2xl border border-stone-100 p-4 afu d2">
        <form method="GET" action="{{ route('orders.index') }}"
              class="flex flex-col sm:flex-row gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-stone-400 pointer-events-none"
                     fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nomor invoice atau catatan..."
                       class="w-full pl-9 pr-4 py-2.5 text-sm rounded-xl
                              bg-stone-50 border border-stone-100
                              focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400
                              text-stone-800 placeholder:text-stone-400 transition">
            </div>

            {{-- Status Filter --}}
            <div class="flex gap-2 flex-wrap">
                @php
                    $statuses = [
                        ''           => 'Semua',
                        'pending'    => 'Pending',
                        'processing' => 'Diproses',
                        'completed'  => 'Selesai',
                        'cancelled'  => 'Dibatalkan',
                    ];
                    $activeStatus = request('status', '');
                @endphp

                @foreach($statuses as $value => $label)
                    <a href="{{ route('orders.index', array_merge(request()->except('status', 'page'), $value ? ['status' => $value] : [])) }}"
                       class="px-3 py-2 text-xs font-medium rounded-xl transition-all duration-150
                              {{ $activeStatus === $value
                                  ? 'bg-indigo-600 text-white shadow-sm'
                                  : 'bg-stone-50 text-stone-500 hover:bg-stone-100 border border-stone-100' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- Search Submit --}}
            <button type="submit"
                    class="px-4 py-2.5 text-sm font-medium bg-indigo-600 text-white
                           rounded-xl hover:bg-indigo-500 active:scale-[0.98]
                           transition-all duration-150 shrink-0">
                Cari
            </button>

        </form>
    </div>


    {{-- ── TABLE ── --}}
    <div class="bg-white rounded-2xl border border-stone-100 overflow-hidden afu d3">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-stone-50 bg-stone-50/60">
                        <th class="px-6 py-3.5 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                            Invoice
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                            Catatan
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3.5 text-right text-xs font-medium text-stone-400 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-3.5 text-center text-xs font-medium text-stone-400 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-50">
                    @forelse($orders as $order)
                        @php
                            $statusMap = [
                                'completed'  => ['class' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100', 'label' => 'Selesai'],
                                'processing' => ['class' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-100',   'label' => 'Diproses'],
                                'pending'    => ['class' => 'bg-stone-100 text-stone-600 ring-1 ring-stone-200',  'label' => 'Pending'],
                                'cancelled'  => ['class' => 'bg-red-50 text-red-600 ring-1 ring-red-100',        'label' => 'Dibatalkan'],
                            ];
                            $s = $statusMap[$order->status] ?? ['class' => 'bg-stone-100 text-stone-500', 'label' => ucfirst($order->status)];
                        @endphp
                        <tr class="order-row hover:bg-stone-50/70 transition-colors duration-150">

                            {{-- Invoice --}}
                            <td class="px-6 py-4">
                                <span class="font-semibold text-stone-800">
                                    {{ $order->invoice_number }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-4 text-stone-500">
                                <span>{{ $order->created_at->format('d M Y') }}</span>
                                <span class="block text-xs text-stone-400 mt-0.5">
                                    {{ $order->created_at->format('H:i') }} WIB
                                </span>
                            </td>

                            {{-- Catatan --}}
                            <td class="px-6 py-4 text-stone-500 max-w-[200px]">
                                <span class="truncate block text-sm">
                                    {{ $order->notes ?? '—' }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $s['class'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $order->status === 'completed'  ? 'bg-emerald-500' : '' }}
                                        {{ $order->status === 'processing' ? 'bg-amber-500'   : '' }}
                                        {{ $order->status === 'pending'    ? 'bg-stone-400'   : '' }}
                                        {{ $order->status === 'cancelled'  ? 'bg-red-500'     : '' }}
                                    "></span>
                                    {{ $s['label'] }}
                                </span>
                            </td>

                            {{-- Total --}}
                            <td class="px-6 py-4 text-right">
                                <span class="font-semibold text-stone-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Detail --}}
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600
                                              hover:bg-indigo-100 flex items-center justify-center
                                              transition" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </a>

                                    {{-- Batalkan (hanya jika pending) --}}
                                    @if($order->status === 'pending')
                                        <form method="POST"
                                              action="{{ route('orders.cancel', $order->id) }}"
                                              onsubmit="return confirm('Batalkan pesanan {{ $order->invoice_number }}?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-red-50 text-red-500
                                                           hover:bg-red-100 flex items-center justify-center
                                                           transition" title="Batalkan Pesanan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        {{-- Placeholder agar kolom tidak collapse --}}
                                        <div class="w-8 h-8"></div>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-stone-50 flex items-center justify-center">
                                        {{-- Heroicons: inbox --}}
                                        <svg class="w-7 h-7 text-stone-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-stone-600">Belum ada pesanan</p>
                                        <p class="text-xs text-stone-400 mt-1">
                                            @if(request('search') || request('status'))
                                                Tidak ada hasil untuk filter yang dipilih.
                                                <a href="{{ route('orders.index') }}" class="text-indigo-500 hover:underline">Reset filter</a>
                                            @else
                                                Pesanan Anda akan muncul di sini.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── PAGINATION ── --}}
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-stone-50 flex items-center justify-between">
                <p class="text-xs text-stone-400">
                    Menampilkan {{ $orders->firstItem() }}–{{ $orders->lastItem() }}
                    dari {{ $orders->total() }} pesanan
                </p>

                <div class="flex items-center gap-1">
                    {{-- Prev --}}
                    @if($orders->onFirstPage())
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg
                                     text-stone-300 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg
                                  text-stone-500 hover:bg-stone-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Page numbers --}}
                    @foreach($orders->getUrlRange(max(1, $orders->currentPage() - 2), min($orders->lastPage(), $orders->currentPage() + 2)) as $page => $url)
                        <a href="{{ $url }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-medium transition
                                  {{ $page === $orders->currentPage()
                                      ? 'bg-indigo-600 text-white'
                                      : 'text-stone-500 hover:bg-stone-100' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    {{-- Next --}}
                    @if($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg
                                  text-stone-500 hover:bg-stone-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </a>
                    @else
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg
                                     text-stone-300 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        @endif

    </div>

@endsection