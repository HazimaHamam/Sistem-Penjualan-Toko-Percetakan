{{-- ════════════════════════════
     TESTIMONIALS
     resources/views/frontend/partials/home/_testimonials.blade.php
════════════════════════════ --}}
<section class="section" style="background:var(--ivory)">
    <div class="container">

        <div style="text-align:center;margin-bottom:3rem" class="anim-up d1">
            <span class="eyebrow">Testimoni</span>
            <h2 class="section-heading">Kata <em>Pelanggan Kami</em></h2>
        </div>

        @php
            $testimonials = [
                [
                    'text' => 'Hasil cetak stampel sangat tajam dan cepat. Pesan hari ini, besok sudah sampai. Luar biasa!',
                    'name' => 'Budi Santoso',
                    'role' => 'Pemilik Toko',
                ],
                [
                    'text' => 'Kartu nama saya terlihat sangat profesional. Kualitas kertas dan cetaknya premium banget.',
                    'name' => 'Siti Rahayu',
                    'role' => 'Freelancer',
                ],
                [
                    'text' => 'Buku Yasin pesanan acara keluarga besar kualitasnya memuaskan. Harga juga sangat terjangkau.',
                    'name' => 'Ahmad Fauzi',
                    'role' => 'Pelanggan Setia',
                ],
            ];
        @endphp

        <div class="testi-grid">
            @foreach($testimonials as $i => $t)
                <div class="testi-card anim-up" style="animation-delay:{{ ($i * 0.12) + 0.1 }}s">
                    <div class="testi-quote" aria-hidden="true">"</div>
                    <div class="testi-stars" aria-label="5 bintang">★★★★★</div>
                    <p class="testi-text">{{ $t['text'] }}</p>
                    <div class="testi-author">
                        <div class="testi-avatar" aria-hidden="true">
                            {{ strtoupper(substr($t['name'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="testi-name">{{ $t['name'] }}</p>
                            <p class="testi-role">{{ $t['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>