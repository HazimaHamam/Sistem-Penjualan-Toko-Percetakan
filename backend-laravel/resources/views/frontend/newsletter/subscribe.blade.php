@extends('frontend.layouts.app')

@section('title', 'Subscribe Newsletter')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-navy px-6 py-16 relative overflow-hidden">

    {{-- Background glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full"
             style="background: radial-gradient(circle, rgba(201,130,10,.12) 0%, transparent 70%)">
        </div>
    </div>

    <div class="relative z-10 max-w-md w-full">

        {{-- Card --}}
        <div class="bg-navy-2 border border-white/8 rounded-2xl p-10 text-center shadow-2xl">

            {{-- Icon --}}
            <div class="mb-6 flex justify-center">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gold/15 border border-gold/20">
                    <svg class="w-7 h-7 text-gold-2" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.75"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
            </div>

            {{-- Eyebrow --}}
            <span class="inline-flex items-center gap-2 text-[0.7rem] font-semibold tracking-[0.14em] uppercase text-gold-2 mb-4">
                <span class="block w-5 h-px bg-gold-2"></span>
                Newsletter
                <span class="block w-5 h-px bg-gold-2"></span>
            </span>

            {{-- Title --}}
            <h1 class="font-display text-[clamp(1.75rem,4vw,2.25rem)] font-bold text-white leading-tight tracking-tight mb-3">
                Dapatkan <em class="italic text-gold-2">Promo Eksklusif</em>
            </h1>

            {{-- Description --}}
            <p class="text-white/50 text-[0.9rem] leading-relaxed mb-8">
                Promo, diskon eksklusif, dan info terbaru langsung ke email Anda.
                Tanpa spam, berhenti kapan saja.
            </p>

            {{-- Success state --}}
            @if(session('success'))
                <div class="flex items-start gap-3 px-4 py-3.5 mb-6 bg-green-500/10 border border-green-500/20 rounded-xl text-left">
                    <svg class="w-5 h-5 shrink-0 text-green-400 mt-px" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-[0.875rem] text-green-300 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Form --}}
            @if(!session('success'))
                <form action="{{ route('newsletter.subscribe') }}"
                      method="POST"
                      class="text-left space-y-3">
                    @csrf

                    {{-- Email input --}}
                    <div>
                        <label for="email" class="sr-only">Alamat Email</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="email@anda.com"
                               required
                               autocomplete="email"
                               class="w-full px-4 py-3.5 rounded-xl
                                      bg-white/8 border text-white text-[0.9rem]
                                      placeholder:text-white/30
                                      outline-none transition-all duration-200
                                      {{ $errors->has('email')
                                          ? 'border-red-500/60 focus:border-red-500 focus:ring-2 focus:ring-red-500/20'
                                          : 'border-white/10 focus:border-gold/50 focus:ring-2 focus:ring-gold/15' }}">

                        @error('email')
                            <p class="mt-1.5 text-[0.75rem] text-red-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2
                                   py-3.5 bg-gold text-white text-[0.9rem] font-semibold
                                   rounded-xl border-none cursor-pointer font-[inherit]
                                   transition-all duration-200
                                   hover:bg-[#b8720a] hover:-translate-y-px
                                   active:translate-y-0 active:scale-[0.98]"
                            style="box-shadow: 0 6px 24px rgba(201,130,10,.35)">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Subscribe Sekarang
                    </button>
                </form>
            @else
                {{-- Setelah sukses: tombol kembali --}}
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 mt-2 px-6 py-3 bg-white/8 border border-white/10 text-white/70 text-[0.875rem] font-medium rounded-xl no-underline transition-colors hover:bg-white/12 hover:text-white">
                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            @endif

        </div>

        {{-- Back link --}}
        @if(!session('success'))
            <p class="text-center mt-5 text-[0.8rem] text-white/30">
                <a href="{{ route('home') }}"
                   class="text-white/40 no-underline hover:text-white/70 transition-colors">
                    ← Kembali ke Beranda
                </a>
            </p>
        @endif

    </div>
</section>
@endsection