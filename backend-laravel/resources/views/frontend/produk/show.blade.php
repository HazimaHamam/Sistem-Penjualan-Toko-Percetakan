@extends('frontend.layouts.app')

@section('title', $produk->nama)

@section('content')

<div class="container mx-auto px-4 py-10">


    <div class="grid md:grid-cols-2 gap-12 items-start">


        {{-- IMAGE SECTION --}}
        <div>

            <div class="bg-white rounded-2xl shadow-lg p-4">

                <img src="{{ $produk->gambar ? asset($produk->gambar) : asset('img/default.jpg') }}"
                     class="w-full h-[450px] object-cover rounded-xl hover:scale-105 transition duration-300">

            </div>


            {{-- BADGES --}}
            <div class="flex gap-2 mt-4">

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    ✔ Ready Stock
                </span>

                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                    ⭐ Best Seller
                </span>

            </div>


        </div>



        {{-- INFO SECTION --}}
        <div>


            {{-- TITLE --}}
            <h1 class="text-3xl md:text-4xl font-bold mb-3">
                {{ $produk->nama }}
            </h1>


            {{-- PRICE --}}
            <div class="text-3xl font-bold text-blue-600 mb-4">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </div>


            {{-- DESCRIPTION --}}
            <p class="text-gray-600 mb-6 leading-relaxed">
                {{ $produk->deskripsi ?? 
                'Produk percetakan berkualitas tinggi dengan hasil tajam, warna akurat, dan bahan premium. Cocok untuk kebutuhan bisnis, promosi, dan personal.' }}
            </p>



            {{-- ADD TO CART CARD --}}
            <div class="bg-white shadow-lg rounded-xl p-6">


                <form action="{{ url('/cart/add') }}" method="POST">

                    @csrf

                    <input type="hidden" name="id" value="{{ $produk->id }}">


                    {{-- QTY --}}
                    <label class="block font-semibold mb-2">
                        Jumlah
                    </label>


                    <div class="flex items-center gap-3 mb-5">


                        <button type="button"
                                onclick="decreaseQty()"
                                class="bg-gray-200 px-3 py-2 rounded hover:bg-gray-300">
                            −
                        </button>


                        <input type="number"
                               id="qty"
                               name="qty"
                               value="1"
                               min="1"
                               class="border rounded-lg px-4 py-2 w-20 text-center">


                        <button type="button"
                                onclick="increaseQty()"
                                class="bg-gray-200 px-3 py-2 rounded hover:bg-gray-300">
                            +
                        </button>


                    </div>



                    {{-- BUTTON --}}
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">

                        🛒 Tambah ke Keranjang

                    </button>


                </form>


            </div>



            {{-- EXTRA INFO --}}
            <div class="mt-6 space-y-2 text-gray-600">

                <div>🚚 Pengiriman cepat</div>

                <div>🎨 Support desain custom</div>

                <div>🏆 Kualitas premium</div>

                <div>💰 Harga terbaik</div>

            </div>


        </div>


    </div>


</div>



{{-- SCRIPT QTY --}}
<script>

function increaseQty() {

    let qty = document.getElementById('qty');
    qty.value = parseInt(qty.value) + 1;

}

function decreaseQty() {

    let qty = document.getElementById('qty');

    if (qty.value > 1) {
        qty.value = parseInt(qty.value) - 1;
    }

}

</script>


@endsection