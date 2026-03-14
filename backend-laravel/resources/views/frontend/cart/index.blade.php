@extends('frontend.layouts.app')

@section('title', 'Keranjang')

@section('content')

<div class="container mx-auto px-4 py-10">


    {{-- TITLE --}}
    <h1 class="text-3xl font-bold mb-8">
        Keranjang Belanja
    </h1>



    @if(session('cart') && count($cart) > 0)

        <div class="grid lg:grid-cols-3 gap-8">


            {{-- LIST PRODUK --}}
            <div class="lg:col-span-2 space-y-4">


                @php $grandTotal = 0; @endphp


                @foreach($cart as $item)

                    @php $grandTotal += $item->total; @endphp


                    <div class="bg-white rounded-xl shadow p-4 flex gap-4 items-center hover:shadow-md transition">


                        {{-- IMAGE --}}
                        <img src="{{ $item->gambar ? asset($item->gambar) : asset('img/default.jpg') }}"
                             class="w-24 h-24 object-cover rounded-lg">


                        {{-- INFO --}}
                        <div class="flex-1">

                            <h2 class="font-semibold text-lg">
                                {{ $item->nama }}
                            </h2>

                            <p class="text-gray-500 text-sm">
                                Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>


                            {{-- QTY --}}
                            <div class="flex items-center gap-3 mt-2">

                                <span class="text-sm bg-gray-100 px-3 py-1 rounded">
                                    Qty: {{ $item->qty }}
                                </span>

                                <span class="text-sm font-semibold text-blue-600">
                                    Total: Rp {{ number_format($item->total, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>



                        {{-- REMOVE BUTTON --}}
                        <a href="{{ url('/cart/remove/'.$item->id) }}"
                           class="text-red-500 hover:text-red-700 text-sm font-medium">

                            Hapus

                        </a>


                    </div>

                @endforeach


            </div>



            {{-- SUMMARY --}}
            <div>

                <div class="bg-white rounded-xl shadow p-6 sticky top-24">


                    <h2 class="font-bold text-xl mb-4">
                        Ringkasan Belanja
                    </h2>


                    <div class="flex justify-between mb-2">
                        <span>Total Item</span>
                        <span>{{ count($cart) }}</span>
                    </div>


                    <div class="flex justify-between font-bold text-lg border-t pt-3 mt-3">
                        <span>Total</span>
                        <span class="text-blue-600">
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </span>
                    </div>



                    {{-- CHECKOUT BUTTON --}}
                    <a href="{{ route('checkout.index') }}"
                       class="block text-center bg-blue-600 hover:bg-blue-700 text-white mt-6 py-3 rounded-lg transition">

                        Checkout Sekarang

                    </a>



                    {{-- CLEAR CART --}}
                    <a href="{{ url('/cart/clear') }}"
                       class="block text-center text-red-500 hover:text-red-700 mt-3 text-sm">

                        Kosongkan Keranjang

                    </a>


                </div>

            </div>


        </div>



    @else


        {{-- EMPTY STATE --}}
        <div class="bg-white rounded-xl shadow p-10 text-center">

            <icon src="{{ asset('frontend/icon/empty-cart.png') }}"
                 class="w-40 mx-auto mb-4">

            <h2 class="text-xl font-semibold mb-2">
                Keranjang masih kosong
            </h2>

            <p class="text-gray-500 mb-4">
                Silakan pilih produk terlebih dahulu
            </p>

            <a href="{{ route('produk.index') }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">

                Lihat Produk

            </a>

        </div>


    @endif


</div>

@endsection