{{-- ═══ HEADER ═══ --}}
<div class="flex items-start justify-between u-rise d1">

    <div>
        <div class="flex items-center gap-2 mb-2.5">
            <span class="live-dot"></span>
            <span style="font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text-3)">
                Live Overview
            </span>
        </div>
        <h2 style="font-family:var(--font-serif,'DM Serif Display',serif);font-size:2rem;font-weight:400;color:var(--text-1);line-height:1.15;letter-spacing:-.01em">
            Halo, {{ auth()->user()->name }}
        </h2>
        <p style="font-size:.8125rem;color:var(--text-2);margin-top:.5rem;line-height:1.6">
            Ringkasan akun Anda dalam 30 hari terakhir.
        </p>
    </div>

    {{-- Date badge --}}
    @php $hour = \Carbon\Carbon::now()->hour; @endphp
    <div class="hidden sm:flex flex-col items-end gap-1.5">
        <span style="font-size:.7rem;color:var(--text-2);background:var(--bg-3);border:1px solid var(--line);padding:.35rem .875rem;border-radius:99px;letter-spacing:.02em">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}
        </span>
        <span style="font-size:.7rem;color:var(--text-3);padding-right:.25rem">
            {{ $hour < 12 ? '🌤 Selamat pagi' : ($hour < 17 ? '☀️ Selamat siang' : '🌙 Selamat malam') }}
        </span>
    </div>

</div>