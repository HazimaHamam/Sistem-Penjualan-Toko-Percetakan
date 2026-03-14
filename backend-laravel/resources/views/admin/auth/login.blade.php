@extends('admin.layouts.auth')

@section('content')

<form method="POST" action="{{ route('admin.login.process') }}" class="space-y-6">
    @csrf

    <div>
        <label class="block text-sm mb-2 text-slate-300">
            Email
        </label>
        <input type="email"
               name="email"
               value="{{ old('email') }}"
               class="w-full rounded-xl bg-white/20 border border-white/30 px-4 py-3 placeholder-slate-300 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
               placeholder="admin@email.com"
               required>
    </div>

    <div>
        <label class="block text-sm mb-2 text-slate-300">
            Password
        </label>
        <input type="password"
               name="password"
               class="w-full rounded-xl bg-white/20 border border-white/30 px-4 py-3 placeholder-slate-300 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
               placeholder="••••••••"
               required>
    </div>

    <button type="submit"
        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-3 rounded-xl transition shadow-lg hover:shadow-indigo-500/40">
        Login
    </button>
</form>

@endsection