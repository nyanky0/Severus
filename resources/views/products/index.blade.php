@extends('layouts.app')

@section('title', 'Products | Severus Cues')

@section('header')
<header x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 20)" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" :class="currentTheme === 'venom' ? 'navbar-gradient-blur--venom' : 'navbar-gradient-blur--reaper'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between" :class="scrolled ? 'py-3' : 'py-5'">
            <a href="{{ route('landing') }}" class="flex items-center group">
                <div class="relative">
                    <img src="{{ asset('images/logo.png') }}" alt="Severus Logo" class="h-10 sm:h-12 w-auto transform group-hover:scale-105 transition-transform duration-300">
                </div>
            </a>
            <nav class="hidden lg:flex items-center space-x-8 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="{{ route('landing') }}" class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">{{ __('app.nav.home') }}<span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span></a>
                <a href="{{ route('products.index') }}" class="transition-colors py-1 relative group cursor-pointer text-white" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">{{ __('app.nav.collection') }}<span class="absolute bottom-0 left-0 w-full h-0.5 transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span></a>
            </nav>
            <div class="flex items-center space-x-3">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-11 h-11 rounded-2xl glass flex items-center justify-center text-white cursor-pointer" aria-label="Toggle menu">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="pt-32 pb-24" x-data="{ activeCategory: 'all', activeModalProduct: null }">
    <section id="cues" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 scroll-mt-28">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 reveal-on-scroll">
            <div>
                <h2 class="text-3xl sm:text-5xl font-black text-white uppercase font-outfit tracking-tight">
                    {{ __('app.catalog.title_prefix') }}
                    <span :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">{{ __('app.catalog.title_highlight') }}</span>
                </h2>
                <p class="text-sm text-slate-400 mt-1 font-medium">{{ __('app.catalog.subtitle') }}</p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 bg-[#060506]/80 p-1.5 rounded-2xl border"
                 :class="currentTheme === 'venom' ? 'border-[#00E676]/20' : 'border-[#E23B3B]/20'">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? (currentTheme === 'venom' ? 'bg-[#00E676] text-black font-extrabold shadow-[0_0_15px_rgba(0,230,118,0.5)]' : 'bg-[#E23B3B] text-white font-extrabold shadow-[0_0_15px_rgba(226,59,59,0.5)]') : 'text-slate-400 hover:text-white font-bold'"
                        class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition-all cursor-pointer min-h-[40px]">
                    {{ __('app.catalog.all_categories') }}
                </button>
                @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->slug }}'"
                            :class="activeCategory === '{{ $category->slug }}' ? (currentTheme === 'venom' ? 'bg-[#00E676] text-black font-extrabold shadow-[0_0_15px_rgba(0,230,118,0.5)]' : 'bg-[#E23B3B] text-white font-extrabold shadow-[0_0_15px_rgba(226,59,59,0.5)]') : 'text-slate-400 hover:text-white font-bold'"
                            class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition-all cursor-pointer min-h-[40px]">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>


        <!-- Dynamic Product Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $index => $product)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug }}'"
                     x-transition:enter="transition ease-out duration-400"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'"
                     class="p-6 rounded-3xl space-y-4 reveal-on-scroll group" style="transition-delay: {{ $index * 60 }}ms">
                    <div class="relative overflow-hidden rounded-2xl bg-[#060506] p-4 flex items-center justify-center aspect-square">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name_en }}" loading="lazy" referrerpolicy="no-referrer"
                             class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover:scale-105">
                        @if($product->is_featured)
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider"
                                  :class="currentTheme === 'venom' ? 'bg-[#00E676] text-black' : 'bg-[#E23B3B] text-white'">
                                {{ __('app.products.featured') }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">{{ $product->category->name }}</span>
                        <h3 class="text-lg font-black text-white uppercase font-outfit leading-tight group-hover:text-transparent group-hover:bg-clip-text transition-all"
                            :class="currentTheme === 'venom' ? 'group-hover:bg-gradient-to-r group-hover:from-[#00E676] group-hover:to-[#10b981]' : 'group-hover:bg-gradient-to-r group-hover:from-[#E23B3B] group-hover:to-[#FF4D5E]'">
                            {{ $product->name_en }}
                        </h3>
                        <p class="text-sm font-black font-outfit"
                           :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                            {{ $product->formatted_price_idr }}
                        </p>
                    </div>


                    <div class="flex items-center gap-2 pt-1">
                        <button @click="activeModalProduct = {{ \Illuminate\Support\Js::from([
                            'name_en' => $product->name_en,
                            'name_id' => $product->name_id,
                            'description_en' => $product->description_en,
                            'description_id' => $product->description_id,
                            'price_idr' => (float) $product->price_idr,
                            'tip_size' => $product->tip_size,
                            'joint_type' => $product->joint_type,
                            'weight_oz' => $product->weight_oz,
                            'tip' => $product->tip,
                            'ferrule' => $product->ferrule,
                            'image_path' => $product->image_url,
                            'tokopedia_url' => $product->tokopedia_url,
                            'shopee_url' => $product->shopee_url,
                            'category' => ['name' => $product->category->name_en ?? 'Severus Product'],
                            'options' => $product->options,
                        ]) }}"
                                class="flex-1 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all cursor-pointer min-h-[48px]"
                                :class="currentTheme === 'venom' ? 'btn-venom' : 'btn-reaper'">
                            {{ __('app.catalog.view_specs') }}
                        </button>

                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div x-show="activeModalProduct !== null"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         x-cloak>

        <div @click.away="activeModalProduct = null"
             :class="currentTheme === 'venom' ? 'venom-glass-card border-[#00E676]/40' : 'reaper-glass-card border-[#E23B3B]/40'"
             class="w-full max-w-2xl p-6 sm:p-8 rounded-3xl space-y-6 relative border shadow-2xl max-h-[90vh] overflow-y-auto">

            <button @click="activeModalProduct = null" class="absolute top-6 right-6 p-2 rounded-xl bg-[#060506] text-slate-400 hover:text-white border border-white/10" aria-label="{{ __('app.products.close') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <template x-if="activeModalProduct">
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                              :class="currentTheme === 'venom' ? 'bg-[#00E676]/20 text-[#00E676]' : 'bg-[#E23B3B]/20 text-[#FF4D5E]'"
                              x-text="activeModalProduct.category ? activeModalProduct.category.name : 'Severus Product'"></span>
                        <span class="text-xs font-semibold text-slate-400">Technical Specifications Sheet</span>
                    </div>

                    <h3 class="text-2xl font-black text-white font-outfit uppercase" x-text="activeModalProduct.name_en"></h3>

                    <div class="h-64 rounded-2xl bg-[#060506] p-4 flex items-center justify-center border border-white/10">
                        <img :src="activeModalProduct.image_path || 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=800&q=80'" :alt="activeModalProduct.name_en" referrerpolicy="no-referrer" class="max-h-full max-w-full object-contain drop-shadow-[0_0_20px_rgba(0,0,0,0.8)]">
                    </div>

                    <!-- Technical Specs Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-[#060506] border border-white/10" x-show="activeModalProduct.tip_size">
                            <span class="text-slate-500 font-bold block uppercase">Tip Size</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.tip_size"></span>
                        </div>
                        <div class="p-3 rounded-xl bg-[#060506] border border-white/10" x-show="activeModalProduct.joint_type">
                            <span class="text-slate-500 font-bold block uppercase">Joint Pin</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.joint_type"></span>
                        </div>
                        <div class="p-3 rounded-xl bg-[#060506] border border-white/10" x-show="activeModalProduct.weight_oz">
                            <span class="text-slate-500 font-bold block uppercase">Weight</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.weight_oz"></span>
                        </div>
                        <div class="p-3 rounded-xl bg-[#060506] border border-white/10" x-show="activeModalProduct.tip">
                            <span class="text-slate-500 font-bold block uppercase">Tip</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.tip"></span>
                        </div>
                        <div class="p-3 rounded-xl bg-[#060506] border border-white/10" x-show="activeModalProduct.ferrule">
                            <span class="text-slate-500 font-bold block uppercase">Ferrule</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.ferrule"></span>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Description</h4>
                        <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-line" x-text="activeModalProduct.description_en"></p>
                    </div>

                    <!-- Available Options / Variants -->
                    <template x-if="activeModalProduct.options && activeModalProduct.options.length > 0">
                        <div class="space-y-2 border-t border-white/10 pt-4">
                            <h4 class="text-xs font-bold text-[#00E676] uppercase tracking-wider">Available Variants & Options</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <template x-for="opt in activeModalProduct.options" :key="opt.id">
                                    <div class="p-2.5 rounded-xl bg-[#060506] border border-white/10 text-xs flex items-center justify-between">
                                        <div>
                                            <span class="text-slate-400 text-[10px] block uppercase" x-text="opt.title_en"></span>
                                            <span class="text-white font-bold" x-text="opt.option_en"></span>
                                        </div>
                                        <span x-show="opt.price > 0" class="text-emerald-400 font-extrabold text-xs" x-text="'Rp ' + Number(opt.price).toLocaleString('id-ID')"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <div class="pt-4 border-t border-white/10 flex items-center justify-between gap-3">
                        <span class="text-2xl font-black font-outfit"
                              :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'"
                              x-text="'Rp ' + Number(activeModalProduct.price_idr).toLocaleString('id-ID')"></span>

                        <div class="flex items-center space-x-2">
                            <a x-show="activeModalProduct.tokopedia_url" :href="activeModalProduct.tokopedia_url" target="_blank" class="px-4 py-2.5 rounded-xl bg-[#42b549] hover:bg-[#369b3d] text-white shadow-[0_0_15px_rgba(66,181,73,0.5)] flex items-center justify-center transition-all text-xs font-extrabold uppercase space-x-2" title="Buy on Tokopedia">
                                <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia" class="h-5 w-5 object-contain">
                                <span>Tokopedia</span>
                            </a>
                            <a x-show="activeModalProduct.shopee_url" :href="activeModalProduct.shopee_url" target="_blank" class="px-4 py-2.5 rounded-xl bg-white hover:bg-gray-200 text-black shadow-[0_0_15px_rgba(255,255,255,0.3)] flex items-center justify-center transition-all text-xs font-extrabold uppercase space-x-2" title="Buy on Shopee">
                                <img src="{{ asset('images/shopee.png') }}" alt="Shopee" class="h-5 w-5 object-contain">
                                <span>Shopee</span>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

</div>
@endsection
