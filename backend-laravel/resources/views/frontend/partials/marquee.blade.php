{{-- ════════════════════════════
     MARQUEE STRIP
     resources/views/frontend/partials/home/_marquee.blade.php
════════════════════════════ --}}
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-inner">
        @php
            $marqueeItems = ['Stampel Flash', 'Kartu Nama', 'Buku Yasin', 'Flyer', 'Banner', 'Undangan', 'Nota', 'Kalender'];
            $repeated     = array_merge($marqueeItems, $marqueeItems, $marqueeItems, $marqueeItems);
        @endphp
        @foreach($repeated as $item)
            <span class="marquee-item">
                {{ $item }}
                <span class="marquee-dot"></span>
            </span>
        @endforeach
    </div>
</div>