@extends('layouts.app')

@section('title', 'Team Portal Login — Severus Cues')

@section('content')
<div class="min-h-screen pt-28 pb-16 flex items-center justify-center px-4">
    <div class="max-w-md w-full reaper-glass-card p-8 rounded-2xl border border-[#00e676]/30 shadow-[0_0_30px_rgba(0,230,118,0.15)]">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Severus Logo" class="h-16 w-auto mx-auto object-contain filter drop-shadow-[0_0_12px_rgba(0,230,118,0.7)]">
            <h2 class="text-2xl font-black text-white mt-4 uppercase tracking-wider font-outfit">{{ __('app.admin.title') }}</h2>
            <p class="text-xs text-slate-400 mt-1">Authorized Severus Team Access Only</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/40 text-red-400 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Team Email</label>
                <input type="email" name="email" value="{{ old('email', 'admin@severus.com') }}" required class="w-full px-4 py-3 rounded-xl bg-[#060506] border border-white/10 focus:border-[#00e676] text-white text-sm outline-none transition-colors min-h-[48px]">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-[#060506] border border-white/10 focus:border-[#00e676] text-white text-sm outline-none transition-colors min-h-[48px]">
            </div>

            <div class="flex items-center justify-between text-xs text-slate-400">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="rounded bg-[#060506] border-white/20 text-[#00e676]">
                    <span>Remember Me</span>
                </label>
                <span class="text-[10px] text-slate-500">Default: admin@severus.com / severus123</span>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl btn-venom text-xs uppercase tracking-wider min-h-[52px]">
                {{ __('app.admin.login') }}
            </button>
        </form>
    </div>
</div>
@endsection
