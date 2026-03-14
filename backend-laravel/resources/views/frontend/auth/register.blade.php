@extends('layouts.auth')

@section('title', 'Register Akun')

@section('content')
<div class="min-h-screen flex items-center justify-center 
            bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-900 px-4">

    <div class="w-full max-w-md">

        <!-- Card -->
        <div class="backdrop-blur-2xl 
                    bg-white/5 
                    border border-white/10 
                    shadow-2xl 
                    rounded-3xl 
                    p-8 
                    text-white">

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-semibold tracking-tight">
                    Buat Akun Baru
                </h2>
                <p class="text-sm text-white/60 mt-1">
                    Daftar untuk mengakses sistem
                </p>
            </div>

            <!-- Error -->
            @if ($errors->any())
                <div class="mb-5 
                            bg-red-500/10 
                            border border-red-400/30 
                            text-red-200 
                            text-sm 
                            rounded-xl 
                            p-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register.process') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium mb-1 text-white/80">
                        Nama Lengkap
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autocomplete="name"
                           class="w-full rounded-xl 
                                  bg-white/5 
                                  border border-white/10
                                  focus:border-indigo-500 
                                  focus:ring-2 
                                  focus:ring-indigo-500/40 
                                  transition
                                  outline-none 
                                  px-4 py-2.5 
                                  text-sm
                                  text-white
                                  placeholder:text-white/40">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-white/80">
                        Email
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           class="w-full rounded-xl 
                                  bg-white/5 
                                  border border-white/10
                                  focus:border-indigo-500 
                                  focus:ring-2 
                                  focus:ring-indigo-500/40 
                                  transition
                                  outline-none 
                                  px-4 py-2.5 
                                  text-sm
                                  text-white
                                  placeholder:text-white/40">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium mb-1 text-white/80">
                        Password
                    </label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           minlength="8"
                           autocomplete="new-password"
                           class="w-full rounded-xl 
                                  bg-white/5 
                                  border border-white/10
                                  focus:border-indigo-500 
                                  focus:ring-2 
                                  focus:ring-indigo-500/40 
                                  transition
                                  outline-none 
                                  px-4 py-2.5
                                  text-sm
                                  text-white
                                  placeholder:text-white/40">
                    <p class="text-xs text-white/40 mt-1">Minimal 8 karakter</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium mb-1 text-white/80">
                        Konfirmasi Password
                    </label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           required
                           minlength="8"
                           autocomplete="new-password"
                           class="w-full rounded-xl 
                                  bg-white/5 
                                  border border-white/10
                                  focus:border-indigo-500 
                                  focus:ring-2 
                                  focus:ring-indigo-500/40 
                                  transition
                                  outline-none 
                                  px-4 py-2.5
                                  text-sm
                                  text-white
                                  placeholder:text-white/40">
                </div>

                <!-- Single Toggle Button -->
                <div class="-mt-2">
                    <button type="button"
                            id="toggle-btn"
                            onclick="togglePasswords()"
                            aria-label="Tampilkan password"
                            class="flex items-center gap-2 text-sm text-white/50 hover:text-indigo-400 transition">

                        <!-- Eye open -->
                        <svg id="eye-on"
                             xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4 shrink-0"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                     c4.477 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.065 7-9.542 7
                                     -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <!-- Eye off -->
                        <svg id="eye-off"
                             xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4 shrink-0 hidden"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19
                                     c-4.477 0-8.268-2.943-9.542-7
                                     a9.956 9.956 0 012.293-3.95
                                     M6.53 6.53A9.956 9.956 0 0112 5
                                     c4.477 0 8.268 2.943 9.542 7
                                     a9.956 9.956 0 01-4.423 5.337
                                     M15 12a3 3 0 11-4.243-4.243
                                     M3 3l18 18"/>
                        </svg>

                        <span id="toggle-label">Tampilkan Password</span>
                    </button>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full 
                               bg-indigo-600 
                               hover:bg-indigo-500 
                               active:scale-[0.98] 
                               transition-all duration-200 
                               rounded-xl 
                               py-2.5 
                               font-semibold 
                               text-sm 
                               shadow-lg 
                               shadow-indigo-900/40">
                    Daftar
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center text-sm text-white/60">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-indigo-400 font-semibold hover:text-indigo-300 transition">
                    Login sekarang
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function togglePasswords() {
    const password     = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');
    const eyeOn        = document.getElementById('eye-on');
    const eyeOff       = document.getElementById('eye-off');
    const label        = document.getElementById('toggle-label');

    const isHidden = password.type === 'password';

    password.type     = isHidden ? 'text' : 'password';
    confirmation.type = isHidden ? 'text' : 'password';

    eyeOn.classList.toggle('hidden', isHidden);
    eyeOff.classList.toggle('hidden', !isHidden);

    label.textContent = isHidden ? 'Sembunyikan Password' : 'Tampilkan Password';
    document.getElementById('toggle-btn').setAttribute('aria-label', label.textContent);
}
</script>
@endsection