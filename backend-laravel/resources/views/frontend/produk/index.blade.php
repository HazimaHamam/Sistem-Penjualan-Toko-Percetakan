@extends('frontend.layouts.app')

@section('title', 'Produk')

@section('content')

<div class="min-h-screen bg-gray-100">

    {{-- Top Bar --}}
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    Daftar Produk
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Menampilkan {{ $produk->total() }} produk tersedia
                </p>
            </div>

            {{-- Sort --}}
            <form method="GET" class="flex items-center gap-2">
                <label class="text-sm text-gray-600">Urutkan:</label>
                <select name="sort"
                        onchange="this.form.submit()"
                        class="border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">

                    <option value="">Terbaru</option>
                    <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>
                        Harga Terendah
                    </option>
                    <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>
                        Harga Tertinggi
                    </option>

                </select>
            </form>

        </div>
    </div>


    {{-- Produk Grid --}}
    <div class="container mx-auto px-6 py-10">

        @if($produk->count())

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($produk as $item)

                <div class="bg-white border rounded-xl hover:shadow-lg transition duration-200">

                    {{-- Gambar --}}
                    <a href="{{ route('produk.show', $item->id) }}" class="block overflow-hidden rounded-t-xl">

                        <img src="{{ $item->gambar ? asset($item->gambar) : 'https://picsum.photos/500/400' }}"
                             alt="{{ $item->nama }}"
                             class="w-full h-48 object-cover hover:scale-105 transition duration-300"
                             loading="lazy">

                    </a>

                    {{-- Info --}}
                    <div class="p-4">

                        <h2 class="text-sm md:text-base font-semibold text-gray-800 line-clamp-2 min-h-[40px]">
                            {{ $item->nama }}
                        </h2>

                        <div class="mt-3 flex items-center justify-between">

                            <span class="text-blue-600 font-bold text-sm md:text-base">
                                Rp {{ number_format($item->harga,0,',','.') }}
                            </span>

                            <a href="{{ route('produk.show', $item->id) }}"
                               class="text-xs text-white bg-blue-600 px-3 py-1.5 rounded-md hover:bg-blue-700 transition">
                                Detail
                            </a>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $produk->withQueryString()->links() }}
            </div>

        @else

            <div class="bg-white rounded-xl p-12 text-center shadow-sm">

                <h2 class="text-xl font-semibold text-gray-700">
                    Belum Ada Produk
                </h2>

                <p class="text-gray-500 mt-2">
                    Produk akan segera tersedia. Silakan cek kembali nanti.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection