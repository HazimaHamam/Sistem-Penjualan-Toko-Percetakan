@extends('frontend.layouts.app')

@section('title', 'Profile')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-14">

    <div class="max-w-5xl mx-auto px-6">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- HEADER CARD --}}
        <div class="relative overflow-hidden rounded-3xl bg-white shadow-xl">

            {{-- Top Gradient Banner --}}
            <div class="h-32 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600"></div>

            <div class="relative px-8 pb-8">

                {{-- Avatar --}}
                <div class="absolute -top-14">
                    <div class="w-28 h-28 rounded-2xl bg-white p-2 shadow-lg">
                        <div class="w-full h-full rounded-xl bg-blue-600 text-white
                                    flex items-center justify-center text-4xl font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                {{-- User Info --}}
                <div class="pt-20 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            {{ auth()->user()->name }}
                        </h1>
                        <p class="text-gray-500 mt-1">
                            {{ auth()->user()->email }}
                        </p>
                        <p class="text-sm text-gray-400 mt-1">
                            Member sejak {{ auth()->user()->created_at->format('d F Y') }}
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('profile.edit') }}"
                           class="px-5 py-2.5 bg-gray-900 text-white rounded-xl
                                  hover:bg-black transition shadow-md">
                            Edit Profile
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="px-5 py-2.5 bg-blue-600 text-white rounded-xl
                                  hover:bg-blue-700 transition shadow-md">
                            Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="px-5 py-2.5 bg-red-500 text-white rounded-xl
                                           hover:bg-red-600 transition shadow-md">
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        {{-- DETAIL SECTION --}}
        <div class="grid md:grid-cols-2 gap-8 mt-10">

            {{-- Account Info --}}
            <div class="bg-white rounded-2xl shadow p-8 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    Informasi Akun
                </h2>

                <div class="space-y-6">

                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Registrasi</p>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ auth()->user()->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>
            </div>


            {{-- Account Stats --}}
            <div class="bg-white rounded-2xl shadow p-8 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    Aktivitas
                </h2>

                <div class="grid grid-cols-2 gap-6">

                    <div class="bg-slate-50 rounded-xl p-5 text-center">
                        <p class="text-3xl font-bold text-blue-600">
                            0
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Total Pesanan
                        </p>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-5 text-center">
                        <p class="text-3xl font-bold text-green-600">
                            0
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Pesanan Selesai
                        </p>
                    </div>

                </div>

                <div class="mt-8">
                    <a href="{{ route('dashboard') }}"
                       class="block w-full text-center py-3 rounded-xl
                              bg-gray-900 text-white hover:bg-black transition">
                        Lihat Riwayat Pesanan
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection