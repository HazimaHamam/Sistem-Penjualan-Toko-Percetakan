{{-- ════════════════════════════
     PRODUK TERLARIS
     resources/views/frontend/partials/home/_produk.blade.php

     Menerima variabel $produk dari HomeController
     Contoh: view('frontend.home', compact('produk'))
════════════════════════════ --}}
<section class="section" style="background:var(--ivory)">
    <div class="container">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:3rem;flex-wrap:wrap;gap:1rem"
             class="anim-up d1">
            <div>
                <span class="eyebrow">Terlaris</span>
                <h2 class="section-heading">Produk <em>Paling Diminati</em></h2>
                <p style="color:var(--ink-soft);font-size:.9rem;margin-top:.5rem">
                    Pilihan terpopuler dari ribuan pelanggan kami
                </p>
            </div>
            <a href="{{ route('produk.index') }}"
               style="display:inline-flex;align-items:center;gap:.375rem;font-size:.8rem;font-weight:600;color:var(--gold);text-decoration:none;border-bottom:1.5px solid rgba(201,130,10,.3);padding-bottom:2px;transition:border-color .15s"
               onmouseover="this.style.borderColor='var(--gold)'"
               onmouseout="this.style.borderColor='rgba(201,130,10,.3)'">
                Lihat semua produk
                <svg style="width:13px;height:13px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

        <div class="prod-grid">
            @forelse($produk ?? [] as $i => $item)
                <div class="prod-card anim-up" style="animation-delay:{{ ($i * 0.08) + 0.1 }}s">
                    <div class="prod-img-wrap">
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : '' }}"
                             alt="{{ $item->nama }}"
                             loading="lazy"
                             width="400" height="200"
                             {{ !$item->gambar ? 'style=display:none' : '' }}>
                        @if($loop->first)
                            <span class="prod-badge">Terlaris</span>
                        @endif
                    </div>
                    <div class="prod-body">
                        <p class="prod-name">{{ $item->nama }}</p>
                        <p class="prod-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        <div class="prod-actions">
                            <a href="{{ route('produk.show', $item->id) }}" class="btn-detail">Lihat Detail</a>
                            <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit"
                                        class="btn-add"
                                        title="Tambah ke keranjang"
                                        aria-label="Tambah {{ $item->nama }} ke keranjang">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column:1/-1;text-align:center;padding:4rem 0">
                    <p style="color:var(--ink-muted);font-size:.9rem">Produk belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>