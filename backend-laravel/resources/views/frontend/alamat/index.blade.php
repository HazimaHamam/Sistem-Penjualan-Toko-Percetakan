@extends('frontend.layouts.app')

@section('title', 'Alamat')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">
                Alamat Kami
            </h1>
            <p class="mt-3 text-gray-500">
                Temukan lokasi usaha kami melalui peta digital
            </p>
        </div>

        {{-- CONTENT --}}
        <div class="grid md:grid-cols-2 gap-8">

            {{-- ADDRESS CARD --}}
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    MIRZA STAMP (Stempel)
                </h2>

                <p class="text-gray-600 leading-relaxed">
                    Karangawen, Kabupaten Demak<br>
                    Jawa Tengah, Indonesia
                </p>

                <a href="https://maps.app.goo.gl/7SBmzy6tiwuCdJGr9"
                   target="_blank"
                   class="inline-flex items-center gap-2 mt-5
                          bg-indigo-600 text-white px-4 py-2 rounded-lg
                          hover:bg-indigo-700 transition">
                    Buka di Google Maps
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 3h7v7m0-7L10 14" />
                    </svg>
                </a>
            </div>

            {{-- MAP --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <iframe
                    src="https://www.google.com/maps?q=Karangawen+Demak+Jawa+Tengah&output=embed"
                    class="w-full h-[350px] border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

        </div>

    </div>
</section>
@endsection