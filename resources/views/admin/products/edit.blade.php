@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between venom-card p-6 rounded-2xl">
        <div>
            <h1 class="text-2xl font-black text-white uppercase tracking-wider">Edit Product</h1>
            <p class="text-xs text-slate-400">Update specifications, Tokopedia link, image, or pricing</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-xl bg-[#121a15] border border-[#1f2e24] text-slate-300 text-xs font-bold uppercase">
            &larr; Back to Catalog
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="venom-card p-8 rounded-2xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Category</label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name_en }} ({{ $cat->name_id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Price in IDR (Rp)</label>
                <input type="number" step="1000" name="price_idr" value="{{ old('price_idr', $product->price_idr) }}" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">English Product Name</label>
                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Indonesian Product Name</label>
                <input type="text" name="name_id" value="{{ old('name_id', $product->name_id) }}" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Tokopedia Product Link</label>
            <input type="url" name="tokopedia_url" value="{{ old('tokopedia_url', $product->tokopedia_url) }}" class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Upload Replacement Image</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#00e676] file:text-black">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Or Direct Image URL</label>
                <input type="text" name="image_url_input" value="{{ old('image_url_input', $product->image_path) }}" class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">
            </div>
        </div>

        <!-- Cue & Accessory Specs Matrix -->
        <div class="border-t border-[#1f2e24] pt-6 space-y-4">
            <h3 class="text-xs font-black text-[#00e676] uppercase tracking-wider">Specifications Sheet</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Tip Size</label>
                    <input type="text" name="tip_size" value="{{ old('tip_size', $product->tip_size) }}" class="w-full px-3 py-2 rounded-lg bg-[#0a0f0d] border border-[#1f2e24] text-white text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Joint Pin</label>
                    <input type="text" name="joint_type" value="{{ old('joint_type', $product->joint_type) }}" class="w-full px-3 py-2 rounded-lg bg-[#0a0f0d] border border-[#1f2e24] text-white text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Weight</label>
                    <input type="text" name="weight_oz" value="{{ old('weight_oz', $product->weight_oz) }}" class="w-full px-3 py-2 rounded-lg bg-[#0a0f0d] border border-[#1f2e24] text-white text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Deflection Grade</label>
                    <input type="text" name="deflection_grade" value="{{ old('deflection_grade', $product->deflection_grade) }}" class="w-full px-3 py-2 rounded-lg bg-[#0a0f0d] border border-[#1f2e24] text-white text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Chalk Friction Matrix</label>
                    <input type="text" name="chalk_friction" value="{{ old('chalk_friction', $product->chalk_friction) }}" class="w-full px-3 py-2 rounded-lg bg-[#0a0f0d] border border-[#1f2e24] text-white text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Available Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-3 py-2 rounded-lg bg-[#0a0f0d] border border-[#1f2e24] text-white text-xs">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">English Description</label>
                <textarea name="description_en" rows="3" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">{{ old('description_en', $product->description_en) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Indonesian Description</label>
                <textarea name="description_id" rows="3" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm">{{ old('description_id', $product->description_id) }}</textarea>
            </div>
        </div>

        <div class="flex items-center space-x-6">
            <label class="flex items-center space-x-2 text-xs text-white font-bold">
                <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }} class="rounded bg-[#0a0f0d] border-[#1f2e24] text-[#00e676]">
                <span>Featured Product</span>
            </label>

            <label class="flex items-center space-x-2 text-xs text-white font-bold">
                <input type="checkbox" name="is_active" {{ $product->is_active ? 'checked' : '' }} class="rounded bg-[#0a0f0d] border-[#1f2e24] text-[#00e676]">
                <span>Active</span>
            </label>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_25px_rgba(0,230,118,0.4)]">
            Update Product Changes
        </button>
    </form>
</div>
@endsection
