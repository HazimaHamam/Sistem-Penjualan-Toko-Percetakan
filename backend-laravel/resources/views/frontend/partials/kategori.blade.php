<section class="section-sm" style="background:var(--white)">
    <div class="container">

        <div style="text-align:center;margin-bottom:2.5rem" class="anim-up d1">
            <span class="eyebrow">Kategori Produk</span>
            <h2 class="section-heading">Apa yang Anda <em>Butuhkan?</em></h2>
        </div>

        @php
            $kategori = [
                [
                    'name' => 'Stampel',
                    'svg'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="14" width="18" height="5" rx="1"/><path d="M7 14V9a5 5 0 0110 0v5"/><line x1="3" y1="19" x2="21" y2="19"/></svg>',
                ],
                [
                    'name' => 'Kartu Nama',
                    'svg'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><line x1="6" y1="11" x2="12" y2="11"/><line x1="6" y1="14" x2="10" y2="14"/></svg>',
                ],
                [
                    'name' => 'Buku Yasin',
                    'svg'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>',
                ],
                [
                    'name' => 'Printing',
                    'svg'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>',
                ],
            ];
        @endphp

        <div class="cat-grid">
            @foreach($kategori as $i => $k)
                <a href="{{ route('produk.index') }}"
                   class="cat-card anim-up"
                   style="animation-delay:{{ ($i * 0.08) + 0.1 }}s">
                    <div class="cat-icon-wrap">
                        {!! $k['svg'] !!}
                    </div>
                    <p class="cat-name">{{ $k['name'] }}</p>
                </a>
            @endforeach
        </div>

    </div>
</section>