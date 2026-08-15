@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto space-y-8">
    <a href="{{ route('landing') }}#cues" class="inline-flex items-center text-xs font-bold text-[#00e676] uppercase tracking-wider hover:underline">
        &larr; Back to Products Collection
    </a>

    <div class="venom-card p-8 rounded-3xl grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
        <div class="md:col-span-6 bg-[#050806] rounded-2xl p-6 border border-[#1f2e24] flex items-center justify-center">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-96 w-auto object-contain rounded-xl filter drop-shadow-[0_0_15px_rgba(0,230,118,0.3)]">
        </div>

        <div class="md:col-span-6 space-y-6">
            <div>
                <span class="px-3 py-1 rounded-full bg-[#00e676]/10 border border-[#00e676]/30 text-[#00e676] text-xs font-bold uppercase">
                    {{ $product->category->name }}
                </span>
                <h1 class="text-3xl font-black text-white mt-3 leading-tight">{{ $product->name }}</h1>
            </div>

            <div>
                <span class="text-xs text-slate-400 block font-bold uppercase">{{ __('app.products.price_idr') }}</span>
                <div class="text-4xl font-black text-[#00e676] mt-1">{{ $product->formatted_price_idr }}</div>
            </div>

            <p class="text-sm text-slate-300 leading-relaxed">{{ $product->description }}</p>

            <div class="bg-[#0a0f0d] p-5 rounded-2xl border border-[#1f2e24] space-y-3">
                <h3 class="text-xs font-black text-[#00e676] uppercase tracking-wider">{{ __('app.products.specifications') }}</h3>
                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-500 block text-[10px] uppercase font-bold">{{ __('app.products.tip_size') }}</span>
                        <span class="text-white font-bold">{{ $product->tip_size ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[10px] uppercase font-bold">{{ __('app.products.joint_type') }}</span>
                        <span class="text-white font-bold">{{ $product->joint_type ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[10px] uppercase font-bold">{{ __('app.products.weight') }}</span>
                        <span class="text-white font-bold">{{ $product->weight_oz ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[10px] uppercase font-bold">{{ __('app.products.deflection') }}</span>
                        <span class="text-white font-bold">{{ $product->deflection_grade ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ $product->tokopedia_url ?: 'https://www.tokopedia.com/severus' }}" target="_blank" class="w-full py-4 rounded-xl bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-xs uppercase tracking-wider flex items-center justify-center shadow-[0_0_20px_rgba(66,181,73,0.4)] transition-all">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                {{ __('app.products.buy_now') }}
            </a>
        </div>
    </div>
</div>
@endsection
