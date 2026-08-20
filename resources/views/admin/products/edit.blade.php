@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between bg-white dark:bg-[#121a15] shadow-sm border border-gray-200 dark:border-white/10 dark:shadow-none p-6 rounded-2xl">
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-wider">Edit Product</h1>
            <p class="text-xs text-gray-500 dark:text-slate-400">Update specifications, Tokopedia link, image, or pricing</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-[#121a15] border border-gray-200 dark:border-[#1f2e24] text-gray-600 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-[#1f2e24] text-xs font-bold uppercase transition-colors">
            &larr; Back to Catalog
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-500 dark:text-red-400 p-4 rounded-xl text-xs space-y-1">
            <p class="font-bold uppercase">There were errors with your submission:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-[#121a15] shadow-sm border border-gray-200 dark:border-white/10 dark:shadow-none p-8 rounded-2xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">Category</label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name_en }} ({{ $cat->name_id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">Price in IDR (Rp)</label>
                <input type="number" step="1000" name="price_idr" value="{{ old('price_idr', $product->price_idr) }}" required class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">English Product Name</label>
                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" required class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">Indonesian Product Name</label>
                <input type="text" name="name_id" value="{{ old('name_id', $product->name_id) }}" required class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Tokopedia Product Link</label>
            <input type="url" name="tokopedia_url" value="{{ old('tokopedia_url', $product->tokopedia_url) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase mb-2">Shopee Product Link</label>
            <input type="url" name="shopee_url" value="{{ old('shopee_url', $product->shopee_url) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">Upload Replacement Image</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-gray-700 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#00e676] file:text-black hover:file:bg-[#10b981]">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">Or Direct Image URL</label>
                <input type="text" name="image_url_input" value="{{ old('image_url_input', $product->image_path) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm" placeholder="https://...">
            </div>
        </div>

        @if($product->image_path)
            <div class="flex items-center space-x-4 bg-gray-50 dark:bg-[#0a0f0d] p-4 rounded-xl border border-gray-200 dark:border-[#1f2e24]">
                <img src="{{ $product->image_url }}" alt="Product Image Preview" referrerpolicy="no-referrer" class="w-20 h-20 object-contain rounded-lg border border-gray-300 dark:border-[#1f2e24] bg-black/40">
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-gray-900 dark:text-white block">Current Image Preview</span>
                    <span class="text-[10px] text-gray-500 dark:text-slate-400 truncate block max-w-md">{{ $product->image_path }}</span>
                </div>
            </div>
        @endif

        <!-- Cue & Accessory Specs Matrix -->
        <div class="border-t border-gray-200 dark:border-[#1f2e24] pt-6 space-y-4">
            <h3 class="text-xs font-black text-emerald-600 dark:text-[#00e676] uppercase tracking-wider">Specifications Sheet</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Tip Size</label>
                    <input type="text" name="tip_size" value="{{ old('tip_size', $product->tip_size) }}" class="w-full px-3 py-2 rounded-lg bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Joint Pin</label>
                    <input type="text" name="joint_type" value="{{ old('joint_type', $product->joint_type) }}" class="w-full px-3 py-2 rounded-lg bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Weight</label>
                    <input type="text" name="weight_oz" value="{{ old('weight_oz', $product->weight_oz) }}" class="w-full px-3 py-2 rounded-lg bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Tip</label>
                    <input type="text" name="tip" value="{{ old('tip', $product->tip) }}" class="w-full px-3 py-2 rounded-lg bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs" placeholder="e.g. Kamui Black Soft 11.8mm">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Ferrule</label>
                    <input type="text" name="ferrule" value="{{ old('ferrule', $product->ferrule) }}" class="w-full px-3 py-2 rounded-lg bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs" placeholder="e.g. Ivorine-X Laminated">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">English Description</label>
                <textarea name="description_en" rows="3" required class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">{{ old('description_en', $product->description_en) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 uppercase mb-2">Indonesian Description</label>
                <textarea name="description_id" rows="3" required class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-[#0a0f0d] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-sm">{{ old('description_id', $product->description_id) }}</textarea>
            </div>
        </div>

        <!-- Product Options / Variants -->
        <div class="border-t border-gray-200 dark:border-[#1f2e24] pt-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-wider">Product Options / Variants</h3>
                    <p class="text-[10px] text-gray-500 dark:text-slate-400">Optional choices (e.g. Tip Diameter, Joint Type) — each with its own price & optional description.</p>
                </div>
                <button type="button" onclick="addOptionRow()" class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs font-black uppercase tracking-wider hover:bg-emerald-500 transition-colors">
                    + Add Option
                </button>
            </div>

            <div id="options-container" class="space-y-4">
                @foreach($product->options as $opt)
                    @php
                        $idx = $loop->index;
                    @endphp
                    <div class="option-row bg-gray-50 dark:bg-[#0a0f0d] border border-gray-200 dark:border-[#1f2e24] rounded-xl p-4 space-y-3">
                        <input type="hidden" name="options[{{ $idx }}][id]" value="{{ $opt->id }}">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black text-emerald-600 dark:text-[#00e676] uppercase tracking-wider">Option / Variant</span>
                            <button type="button" onclick="this.closest('.option-row').remove()" class="text-red-400 hover:text-red-500 text-xs font-bold">Remove</button>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Title (EN)</label>
                                <input type="text" name="options[{{ $idx }}][title_en]" value="{{ $opt->title_en }}" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Title (ID)</label>
                                <input type="text" name="options[{{ $idx }}][title_id]" value="{{ $opt->title_id }}" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Choice (EN)</label>
                                <input type="text" name="options[{{ $idx }}][option_en]" value="{{ $opt->option_en }}" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Choice (ID)</label>
                                <input type="text" name="options[{{ $idx }}][option_id]" value="{{ $opt->option_id }}" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Price (Rp) — optional override</label>
                                <input type="number" step="1000" min="0" name="options[{{ $idx }}][price]" value="{{ $opt->price }}" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Description (EN) — optional</label>
                                <textarea name="options[{{ $idx }}][description_en]" rows="2" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">{{ $opt->description_en }}</textarea>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Description (ID) — optional</label>
                                <textarea name="options[{{ $idx }}][description_id]" rows="2" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">{{ $opt->description_id }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <template id="option-template">
                <div class="option-row bg-gray-50 dark:bg-[#0a0f0d] border border-gray-200 dark:border-[#1f2e24] rounded-xl p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black text-emerald-600 dark:text-[#00e676] uppercase tracking-wider">Option / Variant</span>
                        <button type="button" onclick="this.closest('.option-row').remove()" class="text-red-400 hover:text-red-500 text-xs font-bold">Remove</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Title (EN)</label>
                            <input type="text" name="options[__IDX__][title_en]" placeholder="e.g. Tip Diameter" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Title (ID)</label>
                            <input type="text" name="options[__IDX__][title_id]" placeholder="e.g. Diameter Tip" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Choice (EN)</label>
                            <input type="text" name="options[__IDX__][option_en]" placeholder="e.g. 12.5mm Pro Taper" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Choice (ID)</label>
                            <input type="text" name="options[__IDX__][option_id]" placeholder="e.g. 12.5mm Pro Taper" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Price (Rp) — optional override</label>
                            <input type="number" step="1000" min="0" name="options[__IDX__][price]" placeholder="e.g. 2500000" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Description (EN) — optional</label>
                            <textarea name="options[__IDX__][description_en]" rows="2" placeholder="Optional note for this choice..." class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs"></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 uppercase mb-1">Description (ID) — optional</label>
                            <textarea name="options[__IDX__][description_id]" rows="2" placeholder="Catatan opsional untuk pilihan ini..." class="w-full px-3 py-2 rounded-lg bg-white dark:bg-[#121a15] border border-gray-300 dark:border-[#1f2e24] text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-[#00e676] outline-none text-xs"></textarea>
                        </div>
                    </div>
                </div>
            </template>
        </div>


        <div class="flex items-center space-x-6">
            <label class="flex items-center space-x-2 text-xs text-gray-900 dark:text-white font-bold">
                <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }} class="rounded bg-gray-50 dark:bg-[#0a0f0d] border-gray-300 dark:border-[#1f2e24] text-emerald-600 dark:text-[#00e676]">
                <span>Featured Product</span>
            </label>

            <label class="flex items-center space-x-2 text-xs text-gray-900 dark:text-white font-bold">
                <input type="checkbox" name="is_active" {{ $product->is_active ? 'checked' : '' }} class="rounded bg-gray-50 dark:bg-[#0a0f0d] border-gray-300 dark:border-[#1f2e24] text-emerald-600 dark:text-[#00e676]">
                <span>Active</span>
            </label>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_25px_rgba(0,230,118,0.4)]">
            Update Product Changes
        </button>
    </form>
</div>

<script>
    let optionIdx = {{ count($product->options) }};
    function addOptionRow(data) {
        const tpl = document.getElementById('option-template');
        if (!tpl) {
            // Fallback: create an empty row manually
            const container = document.getElementById('options-container');
            if (!container) return;
            const div = document.createElement('div');
            div.className = 'option-row bg-gray-50 dark:bg-[#0a0f0d] border border-gray-200 dark:border-[#1f2e24] rounded-xl p-4 space-y-3';
            div.innerHTML = '<div class="flex items-center justify-between"><span class="text-[10px] font-black text-emerald-600 dark:text-[#00e676] uppercase tracking-wider">Option / Variant</span><button type="button" onclick="this.closest(\'.option-row\').remove()" class="text-red-400 hover:text-red-500 text-xs font-bold">Remove</button></div>';
            container.appendChild(div);
            return;
        }
        const clone = tpl.content.cloneNode(true);
        const row = clone.querySelector('.option-row');
        const idx = optionIdx++;
        row.innerHTML = row.innerHTML.replace(/__IDX__/g, idx);
        if (data) {
            const inputs = row.querySelectorAll('input, textarea');
            inputs.forEach(el => {
                const name = el.getAttribute('name');
                if (!name) return;
                const key = name.match(/\[([^\]]+)\]$/)[1];
                if (data[key] !== undefined) el.value = data[key];
            });
        }
        document.getElementById('options-container').appendChild(clone);
    }
    window.addOptionRow = addOptionRow;
</script>
@endsection
