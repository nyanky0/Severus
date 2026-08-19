@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between venom-card p-6 rounded-2xl">
        <div>
            <h1 class="text-2xl font-black text-white uppercase tracking-wider">Product Management</h1>
            <p class="text-xs text-slate-400">Add, edit, or remove billiard cues, chalk, and accessories</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#E23B3B] to-[#7a1522] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_20px_rgba(226,59,59,0.4)]">
            + Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-[#E23B3B]/10 border border-[#E23B3B]/40 text-[#E23B3B] text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="venom-card rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-[#120c0e] text-slate-400 uppercase font-bold border-b border-[#2a1a1d]">
                    <tr>
                        <th class="p-4">Image</th>
                        <th class="p-4">Product Name</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Price (IDR)</th>
                        <th class="p-4">Tokopedia Link</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2a1a1d]">
                    @foreach($products as $product)
                        <tr class="hover:bg-[#121a15]/50 transition-colors">
                            <td class="p-4">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg border border-[#2a1a1d]">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-white text-sm">{{ $product->name_en }}</div>
                                <div class="text-[10px] text-slate-400">{{ $product->name_id }}</div>
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-0.5 rounded bg-[#120c0e] border border-[#2a1a1d] text-[#E23B3B] font-bold">
                                    {{ $product->category->name_en }}
                                </span>
                            </td>
                            <td class="p-4 text-white font-bold text-sm">
                                Rp {{ number_format($product->price_idr, 0, ',', '.') }}
                            </td>
                            <td class="p-4">
                                <a href="{{ $product->tokopedia_url }}" target="_blank" class="text-[#42b549] hover:underline flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                    View Shop
                                </a>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1.5 rounded bg-[#121a15] hover:bg-[#1f2e24] border border-[#2a1a1d] text-slate-200 font-bold">
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
        <div class="p-4 border-t border-[#2a1a1d]">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
