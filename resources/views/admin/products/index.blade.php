@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">
    <div class="mb-2">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-[#00e676] inline-flex items-center text-xs font-bold uppercase transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Dashboard
        </a>
    </div>
    <div class="flex items-center justify-between bg-white dark:bg-[#121a15] shadow-sm border border-gray-200 dark:border-white/10 dark:shadow-none p-6 rounded-2xl">
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-wider">Product Management</h1>
            <p class="text-xs text-gray-500 dark:text-slate-400">Add, edit, or remove billiard cues, chalk, and accessories</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_20px_rgba(0,230,118,0.4)]">
            + Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-[#00e676]/10 border border-emerald-200 dark:border-[#00e676]/40 text-emerald-600 dark:text-[#00e676] text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-[#121a15] shadow-sm border border-gray-200 dark:border-white/10 dark:shadow-none p-4 rounded-2xl">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row items-center gap-4" x-data x-on:change="$el.submit()">
            <div class="w-full sm:w-1/3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full px-4 py-2 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm placeholder-gray-400 dark:placeholder-slate-500" @keydown.enter="$el.closest('form').submit()">
            </div>
            
            <div class="w-full sm:w-1/4">
                <select name="category_id" class="w-full px-4 py-2 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm cursor-pointer appearance-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_en }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-1/4">
                <select name="sort" class="w-full px-4 py-2 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm cursor-pointer appearance-none">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                </select>
            </div>

            <div class="w-full sm:w-auto shrink-0 flex items-center gap-2">
                <select name="per_page" class="px-4 py-2 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm cursor-pointer appearance-none">
                    <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20 per page</option>
                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 per page</option>
                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100 per page</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>All data</option>
                </select>
            </div>
            
            <noscript>
                <button type="submit" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-xs uppercase shadow-[0_0_15px_rgba(0,230,118,0.4)]">Apply</button>
            </noscript>

        </form>
    </div>

    <div class="bg-white dark:bg-[#121a15] shadow-sm border border-gray-200 dark:border-white/10 dark:shadow-none rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-700 dark:text-slate-300">
                <thead class="bg-gray-100 dark:bg-[#0a0f0d] text-gray-600 dark:text-slate-400 uppercase font-bold border-b border-gray-200 dark:border-[#1f2e24]">
                    <tr>
                        <th class="p-4">Image</th>
                        <th class="p-4">Product Name</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Price (IDR)</th>
                        <th class="p-4">Marketplace Links</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-[#1f2e24]">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-[#121a15]/50 transition-colors">
                            <td class="p-4">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" referrerpolicy="no-referrer" class="w-12 h-12 object-cover rounded-lg border border-gray-200 dark:border-[#1f2e24]">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-900 dark:text-white text-sm">{{ $product->name_en }}</div>
                                <div class="text-[10px] text-gray-500 dark:text-slate-400">{{ $product->name_id }}</div>
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-0.5 rounded bg-gray-100 dark:bg-[#0a0f0d] border border-gray-200 dark:border-[#1f2e24] text-emerald-600 dark:text-[#00e676] font-bold">
                                    {{ $product->category->name_en }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-900 dark:text-white font-bold text-sm">
                                Rp {{ number_format($product->price_idr, 0, ',', '.') }}
                            </td>
                            <td class="p-4 space-y-1">
                                @if($product->tokopedia_url)
                                <a href="{{ $product->tokopedia_url }}" target="_blank" class="text-[#42b549] hover:underline flex items-center text-xs font-bold">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                    Tokopedia
                                </a>
                                @endif
                                @if($product->shopee_url)
                                <a href="{{ $product->shopee_url }}" target="_blank" class="text-gray-900 dark:text-white hover:text-gray-600 dark:hover:text-gray-300 hover:underline flex items-center text-xs font-bold">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                    Shopee
                                </a>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1.5 rounded bg-gray-100 dark:bg-[#121a15] hover:bg-gray-200 dark:hover:bg-[#1f2e24] border border-gray-300 dark:border-[#1f2e24] text-gray-700 dark:text-slate-200 font-bold transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-400 font-bold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200 dark:border-[#1f2e24]">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
