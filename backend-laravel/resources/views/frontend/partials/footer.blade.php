{{-- ════════════════════════════════════════════════════════
     FOOTER
     resources/views/frontend/partials/footer.blade.php

     PERBAIKAN:
     1. Desain konsisten dengan sistem --gold / --navy / --ivory
     2. Tidak lagi Tailwind hardcode gray-900, gray-800, blue-600, dll
     3. Social media hover pakai warna brand masing-masing via CSS var
     4. Kolom Layanan sekarang punya ikon SVG inline
     5. Kolom Kontak pakai ikon SVG, bukan emoji
     6. Copyright bar dipisah dengan border atas
     7. Footer tidak lagi dibungkus wrapper di app.blade —
        footer mengatur padding-nya sendiri
     8. Animasi hover link underline slide
════════════════════════════════════════════════════════ --}}

<style>
/* ─── FOOTER ────────────────────────────────────────────── */
.site-footer {
    background: var(--navy);
    color: rgba(255,255,255,.5);
    font-family: 'DM Sans', sans-serif;
    margin-top: 0;
}

/* ─── MAIN GRID ─────────────────────────────────────────── */
.footer-main {
    max-width: 1200px; margin: 0 auto;
    padding: 5rem 1.5rem 3.5rem;
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1.4fr;
    gap: 3rem;
}
@media (max-width: 960px) {
    .footer-main { grid-template-columns: 1fr 1fr; gap: 2.5rem; }
}
@media (max-width: 560px) {
    .footer-main { grid-template-columns: 1fr; gap: 2rem; padding: 3rem 1.5rem 2rem; }
}

/* ─── BRAND COL ─────────────────────────────────────────── */
.footer-brand-logo {
    display: flex; align-items: center; gap: .625rem;
    text-decoration: none; margin-bottom: 1.25rem;
}
.footer-brand-mark {
    width: 38px; height: 38px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background .2s, border-color .2s;
}
.footer-brand-logo:hover .footer-brand-mark {
    background: rgba(201,130,10,.15);
    border-color: rgba(201,130,10,.3);
}
.footer-brand-mark svg { width: 20px; height: 20px; color: var(--gold-2); }

.footer-brand-name {
    font-family: 'Playfair Display', serif;
    font-size: .9375rem; font-weight: 700;
    color: #fff; letter-spacing: -.01em;
    display: block;
}
.footer-brand-tagline {
    font-size: .65rem; color: rgba(255,255,255,.35);
    letter-spacing: .05em; text-transform: uppercase;
    display: block; margin-top: 1px;
}

.footer-brand-desc {
    font-size: .875rem; line-height: 1.75;
    color: rgba(255,255,255,.4);
    margin-bottom: 1.75rem; max-width: 280px;
}

/* Social icons */
.footer-socials {
    display: flex; gap: .5rem;
    list-style: none; margin: 0; padding: 0;
}
.footer-social-link {
    width: 38px; height: 38px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; color: rgba(255,255,255,.5);
    transition: background .2s, border-color .2s, color .2s, transform .2s;
}
.footer-social-link svg { width: 17px; height: 17px; }
.footer-social-link:hover { transform: translateY(-3px); color: #fff; }
.footer-social-link--fb:hover       { background: #1877f2; border-color: #1877f2; }
.footer-social-link--ig:hover        { background: linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); border-color: transparent; }
.footer-social-link--wa:hover        { background: #25d366; border-color: #25d366; }
.footer-social-link--tiktok:hover    { background: #010101; border-color: #69c9d0; }

/* ─── HEADING ───────────────────────────────────────────── */
.footer-col-heading {
    font-size: .7rem; font-weight: 600;
    letter-spacing: .12em; text-transform: uppercase;
    color: rgba(255,255,255,.35);
    margin-bottom: 1.25rem;
    display: flex; align-items: center; gap: .5rem;
}
.footer-col-heading::before {
    content: '';
    display: block; width: 18px; height: 1.5px;
    background: var(--gold); opacity: .6;
}

/* ─── NAV LINKS ─────────────────────────────────────────── */
.footer-nav-list {
    list-style: none; margin: 0; padding: 0;
    display: flex; flex-direction: column; gap: .25rem;
}
.footer-nav-link {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .3125rem 0;
    font-size: .875rem; color: rgba(255,255,255,.45);
    text-decoration: none;
    position: relative;
    transition: color .15s;
}
.footer-nav-link::after {
    content: '';
    position: absolute; bottom: 0; left: 0;
    width: 0; height: 1px;
    background: var(--gold); opacity: .6;
    transition: width .25s ease;
}
.footer-nav-link:hover { color: rgba(255,255,255,.85); }
.footer-nav-link:hover::after { width: 100%; }

/* ─── LAYANAN LIST ──────────────────────────────────────── */
.footer-service-list {
    list-style: none; margin: 0; padding: 0;
    display: flex; flex-direction: column; gap: .25rem;
}
.footer-service-item {
    display: flex; align-items: center; gap: .625rem;
    padding: .3125rem 0;
    font-size: .875rem; color: rgba(255,255,255,.45);
    transition: color .15s;
}
.footer-service-item:hover { color: rgba(255,255,255,.75); }
.footer-service-dot {
    width: 5px; height: 5px; border-radius: 50%;
    background: var(--gold); opacity: .4;
    flex-shrink: 0;
    transition: opacity .15s;
}
.footer-service-item:hover .footer-service-dot { opacity: .9; }

/* ─── KONTAK LIST ───────────────────────────────────────── */
.footer-contact-list {
    list-style: none; margin: 0; padding: 0;
    display: flex; flex-direction: column; gap: .75rem;
}
.footer-contact-item {
    display: flex; align-items: flex-start; gap: .75rem;
    font-size: .875rem; color: rgba(255,255,255,.45);
    line-height: 1.5;
}
.footer-contact-icon {
    width: 32px; height: 32px; flex-shrink: 0;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    margin-top: -2px;
}
.footer-contact-icon svg { width: 15px; height: 15px; color: var(--gold-2); }
.footer-contact-item a {
    color: inherit; text-decoration: none;
    transition: color .15s;
}
.footer-contact-item a:hover { color: rgba(255,255,255,.85); }

/* ─── BOTTOM BAR ────────────────────────────────────────── */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,.07);
}
.footer-bottom-inner {
    max-width: 1200px; margin: 0 auto;
    padding: 1.375rem 1.5rem;
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap; gap: .75rem;
}
.footer-copy {
    font-size: .75rem; color: rgba(255,255,255,.25);
}
.footer-copy a {
    color: rgba(255,255,255,.4); text-decoration: none;
    transition: color .15s;
}
.footer-copy a:hover { color: var(--gold); }

.footer-bottom-links {
    display: flex; gap: 1.25rem;
    list-style: none; margin: 0; padding: 0;
}
.footer-bottom-link {
    font-size: .72rem; color: rgba(255,255,255,.25);
    text-decoration: none; transition: color .15s;
}
.footer-bottom-link:hover { color: rgba(255,255,255,.55); }
</style>

<footer class="site-footer" aria-label="Footer">

    {{-- ── MAIN GRID ── --}}
    <div class="footer-main">

        {{-- Brand --}}
        <div>
            <a href="{{ route('home') }}" class="footer-brand-logo" aria-label="{{ config('app.name') }} — Beranda">
                <div class="footer-brand-mark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 6 2 18 2 18 9"/>
                        <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                </div>
                <div>
                    <span class="footer-brand-name">{{ config('app.name', 'PercetakanKu') }}</span>
                    <span class="footer-brand-tagline">Percetakan Online</span>
                </div>
            </a>

            <p class="footer-brand-desc">
                Percetakan online profesional dengan kualitas premium,
                harga terjangkau, dan proses cepat. Pengiriman ke
                seluruh Indonesia.
            </p>

            <ul class="footer-socials" aria-label="Media sosial">
                <li>
                    <a href="#" class="footer-social-link footer-social-link--fb" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2.6v-2.9h2.6V9.7c0-2.6 1.5-4 3.9-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6v2h2.9l-.5 2.9h-2.4v7A10 10 0 0022 12z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-social-link footer-social-link--ig" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm5 5.5A4.5 4.5 0 1112 16a4.5 4.5 0 010-9zm6-1a1 1 0 110 2 1 1 0 010-2z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-social-link footer-social-link--wa" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2a10 10 0 00-8.5 15.3L2 22l4.9-1.5A10 10 0 1012 2z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-social-link footer-social-link--tiktok" aria-label="TikTok">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.89a8.2 8.2 0 004.79 1.53V7.01a4.85 4.85 0 01-1.02-.32z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Navigasi --}}
        <div>
            <h3 class="footer-col-heading">Navigasi</h3>
            <ul class="footer-nav-list">
                <li>
                    <a href="{{ route('home') }}" class="footer-nav-link">Home</a>
                </li>
                <li>
                    <a href="{{ route('produk.index') }}" class="footer-nav-link">Produk</a>
                </li>
                <li>
                    <a href="{{ route('alamat') }}" class="footer-nav-link">Alamat</a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}" class="footer-nav-link">Keranjang</a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="footer-nav-link">Kontak</a>
                </li>
            </ul>
        </div>

        {{-- Layanan --}}
        <div>
            <h3 class="footer-col-heading">Layanan</h3>
            <ul class="footer-service-list">
                @php
                    $layanan = [
                        'Stampel Flash',
                        'Kartu Nama',
                        'Buku Yasin',
                        'Flyer & Brosur',
                        'Banner & Spanduk',
                        'Undangan',
                        'Custom Printing',
                    ];
                @endphp
                @foreach($layanan as $item)
                    <li class="footer-service-item">
                        <span class="footer-service-dot" aria-hidden="true"></span>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <h3 class="footer-col-heading">Kontak</h3>
            <ul class="footer-contact-list">

                <li class="footer-contact-item">
                    <div class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:rgba(255,255,255,.25);margin-bottom:1px;letter-spacing:.04em;text-transform:uppercase">WhatsApp</div>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener">0812-3456-7890</a>
                    </div>
                </li>

                <li class="footer-contact-item">
                    <div class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:rgba(255,255,255,.25);margin-bottom:1px;letter-spacing:.04em;text-transform:uppercase">Email</div>
                        <a href="mailto:mirzastamp@gmail.com">mirzastamp@gmail.com</a>
                    </div>
                </li>

                <li class="footer-contact-item">
                    <div class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:rgba(255,255,255,.25);margin-bottom:1px;letter-spacing:.04em;text-transform:uppercase">Lokasi</div>
                        Bandung, Indonesia
                    </div>
                </li>

                <li class="footer-contact-item">
                    <div class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:rgba(255,255,255,.25);margin-bottom:1px;letter-spacing:.04em;text-transform:uppercase">Jam Operasional</div>
                        Senin – Sabtu, 08.00 – 17.00
                    </div>
                </li>

            </ul>
        </div>

    </div>

    {{-- ── BOTTOM BAR ── --}}
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <p class="footer-copy">
                &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ config('app.name', 'PercetakanKu') }}</a>.
                Hak cipta dilindungi.
            </p>
            <ul class="footer-bottom-links" aria-label="Tautan legal">
                <li><a href="#" class="footer-bottom-link">Kebijakan Privasi</a></li>
                <li><a href="#" class="footer-bottom-link">Syarat & Ketentuan</a></li>
            </ul>
        </div>
    </div>

</footer>