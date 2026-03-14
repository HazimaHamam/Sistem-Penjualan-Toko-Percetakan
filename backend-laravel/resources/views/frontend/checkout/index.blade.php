@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="container mx-auto py-10 px-4">

    {{-- TITLE --}}
    <h1 class="text-3xl font-bold mb-6">
        Checkout
    </h1>


    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- FORM CHECKOUT --}}
    <form action="{{ route('checkout.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">

        @csrf


        {{-- NAMA --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                Nama
            </label>

            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                placeholder="Masukkan nama"
                class="border p-2 w-full rounded focus:ring focus:ring-green-200"
                required
            >
        </div>


        {{-- ALAMAT --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                Alamat
            </label>

            <textarea
                name="alamat"
                placeholder="Masukkan alamat lengkap"
                class="border p-2 w-full rounded focus:ring focus:ring-green-200"
                required
            >{{ old('alamat') }}</textarea>
        </div>


        {{-- NO HP --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                No HP / WhatsApp
            </label>

            <input
                type="text"
                name="hp"
                value="{{ old('hp') }}"
                placeholder="08xxxxxxxxxx"
                class="border p-2 w-full rounded focus:ring focus:ring-green-200"
                required
            >
        </div>


        {{-- BUTTON --}}
        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded transition"
        >
            Pesan Sekarang
        </button>


    </form>

</div>

@endsection