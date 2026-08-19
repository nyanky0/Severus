@extends('layouts.app')

@section('title', 'Team Portal â€” Severus Cues')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 reaper-glass-card p-6 rounded-2xl">
        <div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-wider font-outfit">{{ __('app.admin.title') }}</h1>
                <span class="px-2.5 py-1 rounded bg-[#E23B3B]/20 text-[#E23B3B] text-xs font-bold border border-[#E23B3B]/40">Active Team Session</span>
            </div>
            <p class="text-xs text-slate-400 mt-1">{{ __('app.admin.welcome') }} &bull; Reaper Edition &bull; BUILD {{ \App\Support\Version::current() }}</p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 rounded-xl btn-reaper text-xs uppercase tracking-wider flex items-center shadow-[0_0_15px_rgba(226,59,59,0.4)] min-h-[44px]">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Add Product Manually
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-[#121a15] hover:bg-red-500/20 border border-[#2a1a1d] hover:border-red-500/40 text-slate-300 hover:text-red-400 font-bold text-xs uppercase transition-colors min-h-[44px]">
                    {{ __('app.admin.logout') }}
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-[#E23B3B]/10 border border-[#E23B3B]/40 text-[#E23B3B] text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Quick Navigation Links -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="{{ route('admin.products.index') }}" class="reaper-glass-card p-6 rounded-2xl group flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 block uppercase">Product Catalog</span>
                <span class="text-2xl font-black text-white group-hover:text-[#E23B3B] transition-colors">{{ $totalProducts }} Items</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#E23B3B]/10 border border-[#E23B3B]/30 flex items-center justify-center text-[#E23B3B] group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </a>

        <a href="{{ route('admin.products.create') }}" class="reaper-glass-card p-6 rounded-2xl group flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 block uppercase">Manual Upload</span>
                <span class="text-2xl font-black text-white group-hover:text-[#E23B3B] transition-colors">+ Add Product</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#E23B3B]/10 border border-[#E23B3B]/30 flex items-center justify-center text-[#E23B3B] group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
        </a>

        <a href="{{ route('admin.contents.index') }}" class="reaper-glass-card p-6 rounded-2xl group flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 block uppercase">Marketing Banners</span>
                <span class="text-2xl font-black text-white group-hover:text-[#E23B3B] transition-colors">Edit Content</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#E23B3B]/10 border border-[#E23B3B]/30 flex items-center justify-center text-[#E23B3B] group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 012.828 0l2.828 2.828a2 2 0 010 2.828l-8.414 8.414H9v-2.828l8.586-8.586z"></path></svg>
            </div>
        </a>
    </div>


    <!-- Product Catalog List -->
    <div class="reaper-glass-card p-6 rounded-2xl space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-white uppercase tracking-wider flex items-center font-outfit">
                <svg class="w-5 h-5 mr-2 text-[#E23B3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Current Product Catalog (Manual Management)
            </h3>

            <a href="{{ route('admin.products.create') }}" class="text-xs font-bold text-[#E23B3B] hover:underline">+ Add New</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-[#060506] text-slate-400 uppercase font-bold border-b border-white/10">
                    <tr>
                        <th class="p-3">Product Name</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Price (IDR)</th>
                        <th class="p-3">Stock</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($products as $product)
                        <tr>
                            <td class="p-3 font-semibold text-white">{{ $product->name_en }}</td>
                            <td class="p-3"><span class="px-2 py-0.5 rounded bg-[#E23B3B]/10 text-[#E23B3B] text-[10px] font-bold border border-[#E23B3B]/30">{{ $product->category->name }}</span></td>
                            <td class="p-3 text-[#E23B3B] font-bold">Rp {{ number_format($product->price_idr, 0, ',', '.') }}</td>
                            <td class="p-3 font-bold text-slate-300">{{ $product->stock }}</td>
                            <td class="p-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-2.5 py-1 rounded bg-[#241319] hover:bg-[#E23B3B]/20 text-[#E23B3B] border border-[#E23B3B]/30 font-bold text-[10px] mr-1">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-slate-500">No products added yet. Click "+ Add Product Manually" above.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
