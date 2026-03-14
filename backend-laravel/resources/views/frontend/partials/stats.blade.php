{{-- ════════════════════════════
     STATS BAR
     resources/views/frontend/partials/home/_stats.blade.php
════════════════════════════ --}}
<div class="stats-bar">
    <div class="stats-bar-inner">
        <div class="container">
            <div class="stats-grid">
                @php
                    $stats = [
                        ['num' => '5.000+', 'lbl' => 'Pelanggan'],
                        ['num' => '99%',    'lbl' => 'Kepuasan'],
                        ['num' => '24 Jam', 'lbl' => 'Proses Cepat'],
                        ['num' => '5 Thn',  'lbl' => 'Pengalaman'],
                    ];
                @endphp
                @foreach($stats as $i => $s)
                    <div class="stat-item anim-up" style="animation-delay:{{ $i * 0.1 }}s">
                        <span class="stat-num">{{ $s['num'] }}</span>
                        <span class="stat-lbl">{{ $s['lbl'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>