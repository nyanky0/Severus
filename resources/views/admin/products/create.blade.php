@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between venom-card p-6 rounded-2xl">
        <div>
            <h1 class="text-2xl font-black text-white uppercase tracking-wider">Add New Product</h1>
            <p class="text-xs text-slate-400">Upload image, set price, Tokopedia link, and cue specifications</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-xl bg-[#121a15] border border-[#2a1a1d] text-slate-300 text-xs font-bold uppercase">
            &larr; Back to Catalog
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="venom-card p-8 rounded-2xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Category</label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name_en }} ({{ $cat->name_id }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Price in IDR (Rp)</label>
                <input type="number" step="1000" name="price_idr" value="{{ old('price_idr', 1500000) }}" required class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">English Product Name</label>
                <input type="text" name="name_en" required class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm" placeholder="e.g. Severus Carbon Viper Cue">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Indonesian Product Name</label>
                <input type="text" name="name_id" required class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm" placeholder="e.g. Stik Karbon Severus Viper">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Tokopedia Product Link</label>
            <input type="url" name="tokopedia_url" value="https://www.tokopedia.com/severus" class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Upload Product Image File</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#E23B3B] file:text-black hover:file:bg-[#7a1522]">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Or Direct Image URL</label>
                <input type="text" name="image_url_input" class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm" placeholder="https://images.unsplash.com/...">
            </div>
        </div>

        <!-- Cue & Accessory Specs Matrix -->
        <div class="border-t border-[#2a1a1d] pt-6 space-y-4">
            <h3 class="text-xs font-black text-[#E23B3B] uppercase tracking-wider">Specifications Sheet (Optional for Cues & Chalk)</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Tip Size</label>
                    <input type="text" name="tip_size" class="w-full px-3 py-2 rounded-lg bg-[#120c0e] border border-[#2a1a1d] text-white text-xs" placeholder="e.g. 12.5mm Pro Taper">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Joint Pin</label>
                    <input type="text" name="joint_type" class="w-full px-3 py-2 rounded-lg bg-[#120c0e] border border-[#2a1a1d] text-white text-xs" placeholder="e.g. Radial Joint">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Weight</label>
                    <input type="text" name="weight_oz" class="w-full px-3 py-2 rounded-lg bg-[#120c0e] border border-[#2a1a1d] text-white text-xs" placeholder="e.g. 19.0 oz">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Deflection Grade</label>
                    <input type="text" name="deflection_grade" class="w-full px-3 py-2 rounded-lg bg-[#120c0e] border border-[#2a1a1d] text-white text-xs" placeholder="e.g. Ultra Low Deflection">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Chalk Friction Matrix</label>
                    <input type="text" name="chalk_friction" class="w-full px-3 py-2 rounded-lg bg-[#120c0e] border border-[#2a1a1d] text-white text-xs" placeholder="e.g. Grade 9.9 Nano-Grip">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Available Stock</label>
                    <input type="number" name="stock" value="10" class="w-full px-3 py-2 rounded-lg bg-[#120c0e] border border-[#2a1a1d] text-white text-xs">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">English Description</label>
                <textarea name="description_en" rows="3" required class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Indonesian Description</label>
                <textarea name="description_id" rows="3" required class="w-full px-4 py-3 rounded-xl bg-[#120c0e] border border-[#2a1a1d] text-white text-sm"></textarea>
            </div>
        </div>

        <div class="flex items-center space-x-6">
            <label class="flex items-center space-x-2 text-xs text-white font-bold">
                <input type="checkbox" name="is_featured" checked class="rounded bg-[#120c0e] border-[#2a1a1d] text-[#E23B3B]">
                <span>Featured Product (Homepage Showcase)</span>
            </label>

            <label class="flex items-center space-x-2 text-xs text-white font-bold">
                <input type="checkbox" name="is_active" checked class="rounded bg-[#120c0e] border-[#2a1a1d] text-[#E23B3B]">
                <span>Active (Visible on Website)</span>
            </label>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#E23B3B] to-[#7a1522] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_25px_rgba(226,59,59,0.4)]">
            Save Product to Catalog
        </button>
    </form>
</div>
@endsection
