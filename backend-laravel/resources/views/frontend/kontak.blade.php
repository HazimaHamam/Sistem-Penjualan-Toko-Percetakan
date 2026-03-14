@extends('frontend.layouts.app')

@section('title', 'Kontak')

@section('content')

{{-- HERO SECTION --}}
<section class="bg-gradient-to-r from-blue-700 to-indigo-700 text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-bold mb-4">
            Hubungi Kami
        </h1>
        <p class="text-blue-100 max-w-2xl mx-auto">
            Kami siap membantu kebutuhan cetak bisnis Anda.
            Silakan hubungi kami melalui kontak di bawah ini
            atau kirim pesan langsung melalui form.
        </p>
    </div>
</section>


{{-- CONTENT --}}
<section class="container mx-auto py-16 px-6">

    <div class="grid md:grid-cols-2 gap-10">

        {{-- LEFT: INFO KONTAK --}}
        <div class="space-y-6">

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg mb-2 text-gray-700">
                    <i class="fab fa-whatsapp text-green-500 mr-2"></i> WhatsApp
                </h2>
                <a href="https://wa.me/628123456789"
                   class="text-green-600 font-medium hover:underline">
                    0812-3456-789
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg mb-2 text-gray-700">
                    ✉️ Email
                </h2>
                <a href="mailto:mirza Stamp@gmail.com"
                   class="text-blue-600 font-medium hover:underline">
                    mirza@gmail.com
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg mb-2 text-gray-700">
                    📍 Alamat
                </h2>
                <p class="text-gray-600">
                    Bandung, Jawa Barat, Indonesia
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg mb-2 text-gray-700">
                    🕒 Jam Operasional
                </h2>
                <p class="text-gray-600">
                    Senin - Sabtu : 08:00 - 17:00
                </p>
            </div>

        </div>


        {{-- RIGHT: FORM --}}
        <div class="bg-white p-8 rounded-xl shadow-lg">

            <h2 class="text-2xl font-bold mb-6">
                Kirim Pesan
            </h2>

            <form action="#" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-600 mb-2">
                        Nama
                    </label>
                    <input type="text"
                           name="nama"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                           placeholder="Nama lengkap Anda">
                </div>

                <div>
                    <label class="block text-gray-600 mb-2">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                           placeholder="Email aktif Anda">
                </div>

                <div>
                    <label class="block text-gray-600 mb-2">
                        Pesan
                    </label>
                    <textarea name="pesan"
                              rows="4"
                              class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                              placeholder="Tulis pesan Anda..."></textarea>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow">
                    Kirim Pesan
                </button>

            </form>

        </div>

    </div>

</section>

@endsection