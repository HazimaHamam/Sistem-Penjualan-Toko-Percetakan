{{-- ════════════════════════════
     HERO
     resources/views/frontend/partials/home/_hero.blade.php
════════════════════════════ --}}
<section class="hero">

    {{-- Shape dekoratif mobile --}}
    <svg class="hero-mobile-deco" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="100" cy="100" r="80" fill="none" stroke="white" stroke-width="1"/>
        <circle cx="100" cy="100" r="55" fill="none" stroke="white" stroke-width="1"/>
        <circle cx="100" cy="100" r="30" fill="none" stroke="white" stroke-width="1"/>
        <line x1="20" y1="100" x2="180" y2="100" stroke="white" stroke-width=".5"/>
        <line x1="100" y1="20" x2="100" y2="180" stroke="white" stroke-width=".5"/>
    </svg>

    {{-- Content --}}
    <div class="hero-content">

        <div class="hero-eyebrow anim-r d1">
            <span class="hero-eyebrow-line"></span>
            Percetakan Premium Online
        </div>

        <h1 class="hero-title anim-up d2">
            Cetak <em>Berkualitas,</em><br>
            Proses Kilat
        </h1>

        <p class="hero-sub anim-up d3">
            Stampel, kartu nama, buku yasin, dan kebutuhan cetak bisnis Anda —
            kualitas premium, pengiriman ke seluruh Indonesia.
        </p>

        <div class="anim-up d4" style="display:flex;gap:.875rem;flex-wrap:wrap;align-items:center">
            <a href="{{ route('produk.index') }}" class="btn-gold">
                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
                Cek Harga & Pesan
            </a>
            <a href="{{ route('produk.index') }}#upload-desain" class="btn-outline-light">
                Upload Desain
            </a>
        </div>

        <div class="hero-badges anim-in d5">
            <span class="hero-badge">🚚 Kirim Seluruh Indonesia</span>
            <span class="hero-badge">🖨️ Cetak Premium</span>
            <span class="hero-badge">🔒 Pembayaran Aman</span>
        </div>

    </div>

    {{-- Image --}}
    <div class="hero-img-col anim-in d3">
        <div class="hero-img-wrap">
            <img src="{{ asset('img/hero-printing.png') }}"
                 alt="Percetakan Premium — produk cetak berkualitas"
                 fetchpriority="high"
                 width="500" height="375">
            <div class="hero-float-badge">
                ✓ 5.000+ Pelanggan Puas
            </div>
        </div>
    </div>

</section>