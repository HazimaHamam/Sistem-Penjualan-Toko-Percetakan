{{-- ════════════════════════════
     CTA SECTION
     resources/views/frontend/partials/home/_cta.blade.php
════════════════════════════ --}}
<section class="cta-section">
    <div class="container" style="position:relative;z-index:1">

        <span class="eyebrow anim-up d1" style="color:var(--gold-2);justify-content:center">
            Mulai Sekarang
        </span>

        <h2 class="cta-title anim-up d2">
            Siap Cetak <em>Hari Ini?</em>
        </h2>

        <p class="cta-sub anim-up d3">
            Ribuan pelanggan sudah mempercayakan kebutuhan cetak mereka kepada kami.
        </p>

        <div class="anim-up d4" style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('produk.index') }}" class="btn-gold">
                Mulai Pesan Sekarang
                <svg style="width:15px;height:15px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
            <a href="{{ route('kontak') }}" class="btn-outline-light">Hubungi Kami</a>
        </div>

    </div>
</section>