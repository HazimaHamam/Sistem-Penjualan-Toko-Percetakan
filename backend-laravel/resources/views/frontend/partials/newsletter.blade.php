{{-- ════════════════════════════
     NEWSLETTER
     resources/views/frontend/partials/home/_newsletter.blade.php
════════════════════════════ --}}

<style>
.newsletter-form:focus-within {
    border-color: rgba(201,130,10,.5);
    box-shadow: 0 0 0 3px rgba(201,130,10,.1);
}
.newsletter-input::placeholder {
    color: var(--ink-muted);
}
</style>

<section class="bg-ivory-2 border-t border-ivory-3 py-20">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="max-w-[560px] mx-auto text-center">

            {{-- Eyebrow --}}
            <span class="eyebrow justify-center">Newsletter</span>

            {{-- Heading --}}
            <h2 class="font-display text-[clamp(1.75rem,3.5vw,2.5rem)] font-bold leading-tight text-navy tracking-tight mb-3 anim-up d1">
                Dapatkan <em style="font-style:italic" class="text-gold">Promo Eksklusif</em>
            </h2>

            {{-- Subtext --}}
            <p class="text-ink-soft text-[0.9rem] leading-[1.7] anim-up d2">
                Update promo, diskon eksklusif, dan info terbaru langsung ke email Anda.
            </p>

            {{--
                FIX: Pakai session('newsletter_success') bukan session('success').
                session('success') bersifat global — bisa terisi dari form checkout,
                kontak, atau form lain di halaman yang sama, sehingga form newsletter
                bisa hilang padahal bukan karena subscribe berhasil.
            --}}
            @if(session('newsletter_success'))
                <div class="mt-5 flex items-center gap-2.5 px-4 py-3 bg-white border border-green-200 rounded-xl text-sm text-green-700 anim-up d3">
                    <svg class="w-4 h-4 shrink-0 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('newsletter_success') }}
                </div>
            @endif

            {{-- Form: tetap tampil kecuali newsletter_success terset --}}
            @if(!session('newsletter_success'))
                <form action="{{ route('newsletter.subscribe') }}"
                      method="POST"
                      class="newsletter-form flex gap-2 mt-7 bg-white border border-ivory-3 rounded-xl px-3.5 py-1.5 transition-all duration-200 anim-up d3">
                    @csrf

                    <input type="email"
                           name="email"
                           class="newsletter-input flex-1 min-w-0 border-none bg-transparent text-[0.9rem] text-ink outline-none py-1.5"
                           placeholder="email@anda.com"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           aria-label="Alamat email untuk newsletter">

                    <button type="submit"
                            class="shrink-0 px-5 py-2.5 bg-gold text-white text-[0.85rem] font-semibold rounded-[9px] border-none cursor-pointer font-[inherit] transition-all duration-200 hover:bg-[#b8720a] hover:-translate-y-px">
                        Subscribe
                    </button>
                </form>

                @error('email')
                    <p class="mt-2 text-[0.75rem] text-red-500 text-left">{{ $message }}</p>
                @enderror
            @endif

            {{-- Note --}}
            <p class="mt-3 text-[0.72rem] text-ink-muted anim-in d4">
                Tidak ada spam. Berhenti langganan kapan saja.
            </p>

        </div>
    </div>
</section>