@extends('frontend.layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="min-h-screen bg-slate-50 py-20">

    <div class="max-w-5xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-14">
            <h1 class="text-3xl font-semibold text-slate-800">
                Profile Settings
            </h1>
            <p class="text-slate-500 mt-2 text-sm">
                Kelola informasi akun dan keamanan Anda.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-12">

            {{-- LEFT PANEL --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8 sticky top-10">

                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br 
                                    from-blue-600 to-indigo-600 
                                    flex items-center justify-center 
                                    text-white text-2xl font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <h2 class="mt-5 text-base font-medium text-slate-800">
                            {{ auth()->user()->name }}
                        </h2>

                        <p class="text-xs text-slate-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-200 space-y-3 text-xs text-slate-600">
                        <div class="flex justify-between">
                            <span>Status</span>
                            <span class="text-green-600 font-medium">Active</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Member Since</span>
                            <span>{{ auth()->user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                </div>
            </div>


            {{-- RIGHT CONTENT --}}
            <div class="lg:col-span-2 space-y-10">

                {{-- UPDATE PROFILE --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-10">

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-slate-800">
                            Informasi Akun
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Perbarui nama dan email Anda.
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-600 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- NAME --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-600">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   class="w-full px-4 py-2.5 text-sm rounded-lg border border-slate-300
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          outline-none transition">

                            @error('name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-600">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   class="w-full px-4 py-2.5 text-sm rounded-lg border border-slate-300
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          outline-none transition">

                            @error('email')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="pt-4 flex gap-3">
                            <button type="submit"
                                    class="px-5 py-2.5 text-sm font-medium
                                           bg-blue-600 text-white rounded-lg
                                           hover:bg-blue-700 transition">
                                Simpan
                            </button>

                            <a href="{{ route('profile') }}"
                               class="px-5 py-2.5 text-sm font-medium
                                      bg-slate-100 text-slate-700 rounded-lg
                                      hover:bg-slate-200 transition">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>


                {{-- CHANGE PASSWORD --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-10">

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-slate-800">
                            Keamanan Akun
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Ubah password untuk menjaga keamanan akun Anda.
                        </p>
                    </div>

                    @if(session('success_password'))
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-600 text-sm">
                            {{ session('success_password') }}
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('profile.password.update') }}"
                          class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- CURRENT PASSWORD --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-600">
                                Password Saat Ini
                            </label>

                            <input type="password"
                                   name="current_password"
                                   class="w-full px-4 py-2.5 text-sm rounded-lg border border-slate-300
                                          focus:ring-2 focus:ring-red-500 focus:border-red-500
                                          outline-none transition">

                            @error('current_password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NEW PASSWORD --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-600">
                                Password Baru
                            </label>

                            <input type="password"
                                   name="password"
                                   class="w-full px-4 py-2.5 text-sm rounded-lg border border-slate-300
                                          focus:ring-2 focus:ring-red-500 focus:border-red-500
                                          outline-none transition">

                            @error('password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-600">
                                Konfirmasi Password Baru
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="w-full px-4 py-2.5 text-sm rounded-lg border border-slate-300
                                          focus:ring-2 focus:ring-red-500 focus:border-red-500
                                          outline-none transition">
                        </div>

                        {{-- BUTTON --}}
                        <div class="pt-4">
                            <button type="submit"
                                    class="px-5 py-2.5 text-sm font-medium
                                           bg-red-600 text-white rounded-lg
                                           hover:bg-red-700 transition">
                                Update Password
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection