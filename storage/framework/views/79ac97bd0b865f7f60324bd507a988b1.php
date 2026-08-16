<?php $__env->startSection('header'); ?>
<header x-data="{ scrolled: false, mobileMenuOpen: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)" 
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 navbar-gradient-blur"
        :class="scrolled ? 'border-b border-[#00E676]/30 shadow-[0_10px_30px_rgba(0,0,0,0.8)] py-3' : 'border-b border-white/5 py-5'">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Brand Logo & Title -->
            <a href="#home" @click.prevent="$dispatch('scroll-to', 'home')" class="flex items-center space-x-3 group">
                <div class="relative">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Logo" class="h-10 sm:h-12 w-auto transform group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-[#00E676]/20 rounded-full blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-xl sm:text-2xl text-white tracking-widest uppercase font-outfit">
                        SEVERUS <span class="text-[#00E676] group-hover:text-[#10b981] transition-colors">CUES</span>
                    </span>
                    <span class="text-[9px] uppercase tracking-[0.25em] text-slate-400 font-bold -mt-1">Venom Precision</span>
                </div>
            </a>

            <!-- Streamlined Desktop Nav Links (Home, Collection, Viper Tech) -->
            <nav class="hidden md:flex items-center space-x-8 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="#home" @click.prevent="$dispatch('scroll-to', 'home')" class="hover:text-[#00E676] transition-colors py-1 relative group cursor-pointer">
                    <?php echo e(__('app.nav.home')); ?>

                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#00E676] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#cues" @click.prevent="$dispatch('scroll-to', 'cues')" class="hover:text-[#00E676] transition-colors py-1 relative group cursor-pointer">
                    <?php echo e(__('app.nav.collection')); ?>

                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#00E676] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#technology" @click.prevent="$dispatch('scroll-to', 'technology')" class="hover:text-[#00E676] transition-colors py-1 relative group cursor-pointer">
                    <?php echo e(__('app.nav.technology')); ?>

                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#00E676] group-hover:w-full transition-all duration-300"></span>
                </a>
            </nav>

            <!-- Language Switcher, Shopee, Tokopedia & Instagram Buttons with Official Logos -->
            <div class="hidden md:flex items-center space-x-3">
                <!-- EN / ID i18n Switcher -->
                <div class="flex items-center bg-[#141D17] p-1 rounded-xl border border-[#00E676]/20 mr-1">
                    <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="px-2.5 py-1 rounded-lg text-xs font-bold transition-all <?php echo e(app()->getLocale() === 'en' ? 'bg-[#00E676] text-black shadow-[0_0_10px_rgba(0,230,118,0.5)]' : 'text-slate-400 hover:text-white'); ?>">EN</a>
                    <a href="<?php echo e(route('lang.switch', 'id')); ?>" class="px-2.5 py-1 rounded-lg text-xs font-bold transition-all <?php echo e(app()->getLocale() === 'id' ? 'bg-[#00E676] text-black shadow-[0_0_10px_rgba(0,230,118,0.5)]' : 'text-slate-400 hover:text-white'); ?>">ID</a>
                </div>

                <!-- Tokopedia Official Store CTA -->
                <a href="https://www.tokopedia.com/severus" target="_blank" class="px-3.5 py-2 rounded-xl bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(66,181,73,0.4)] transition-all flex items-center" title="Tokopedia Store">
                    <img src="<?php echo e(asset('images/tokopedia.png')); ?>" alt="Tokopedia" class="h-4 w-4 mr-1.5 object-contain drop-shadow">
                    Tokopedia
                </a>

                <!-- Shopee Official Store CTA -->
                <a href="https://shopee.co.id/severuscues" target="_blank" class="px-3.5 py-2 rounded-xl bg-[#ee4d2d] hover:bg-[#d73f21] text-white font-extrabold text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(238,77,45,0.4)] transition-all flex items-center" title="Shopee Store">
                    <img src="<?php echo e(asset('images/shopee.png')); ?>" alt="Shopee" class="h-4 w-4 mr-1.5 object-contain drop-shadow">
                    Shopee
                </a>

                <!-- Instagram Handle Link -->
                <a href="https://www.instagram.com/severuscues/" target="_blank" class="p-2 rounded-xl bg-[#141D17] hover:bg-[#E1306C]/20 border border-[#E1306C]/30 text-[#E1306C] transition-colors" title="Instagram @severuscues">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>

                <!-- Admin Link -->
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="p-2 rounded-xl bg-[#141D17] hover:bg-[#00E676]/20 border border-[#00E676]/30 text-[#00E676] transition-colors" title="Inside Team Admin Portal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </a>
            </div>

            <!-- Mobile Hamburger Menu Button -->
            <div class="flex items-center space-x-3 md:hidden">
                <div class="flex items-center bg-[#141D17] p-0.5 rounded-lg border border-[#00E676]/20 text-[10px]">
                    <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="px-2 py-0.5 rounded font-bold <?php echo e(app()->getLocale() === 'en' ? 'bg-[#00E676] text-black' : 'text-slate-400'); ?>">EN</a>
                    <a href="<?php echo e(route('lang.switch', 'id')); ?>" class="px-2 py-0.5 rounded font-bold <?php echo e(app()->getLocale() === 'id' ? 'bg-[#00E676] text-black' : 'text-slate-400'); ?>">ID</a>
                </div>

                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2.5 rounded-xl bg-[#141D17] border border-[#00E676]/30 text-[#00E676] hover:bg-[#00E676]/10 transition-colors focus:outline-none" aria-label="Toggle Navigation">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu (Home, Collection, Viper Tech) -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-[#0A0F0D]/95 backdrop-blur-2xl border-b border-[#00E676]/30 px-6 py-6 space-y-4 shadow-2xl"
         x-cloak>
        
        <nav class="flex flex-col space-y-3 font-outfit text-sm font-bold uppercase tracking-wider text-slate-200">
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'home')" href="#home" class="py-2.5 px-4 rounded-xl hover:bg-[#00E676]/10 hover:text-[#00E676] transition-all flex items-center justify-between cursor-pointer">
                <span><?php echo e(__('app.nav.home')); ?></span>
                <svg class="w-4 h-4 text-[#00E676]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'cues')" href="#cues" class="py-2.5 px-4 rounded-xl hover:bg-[#00E676]/10 hover:text-[#00E676] transition-all flex items-center justify-between cursor-pointer">
                <span><?php echo e(__('app.nav.collection')); ?></span>
                <svg class="w-4 h-4 text-[#00E676]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'technology')" href="#technology" class="py-2.5 px-4 rounded-xl hover:bg-[#00E676]/10 hover:text-[#00E676] transition-all flex items-center justify-between cursor-pointer">
                <span><?php echo e(__('app.nav.technology')); ?></span>
                <svg class="w-4 h-4 text-[#00E676]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </nav>

        <div class="pt-4 border-t border-[#1f2e24] flex flex-col space-y-2">
            <a href="https://www.tokopedia.com/severus" target="_blank" class="w-full py-2.5 rounded-xl bg-[#42b549] text-white font-extrabold text-xs uppercase tracking-wider text-center flex items-center justify-center shadow-[0_0_15px_rgba(66,181,73,0.4)]">
                <img src="<?php echo e(asset('images/tokopedia.png')); ?>" alt="Tokopedia" class="h-4 w-4 mr-2 object-contain">
                Tokopedia Official Store
            </a>

            <a href="https://shopee.co.id/severuscues" target="_blank" class="w-full py-2.5 rounded-xl bg-[#ee4d2d] text-white font-extrabold text-xs uppercase tracking-wider text-center flex items-center justify-center shadow-[0_0_15px_rgba(238,77,45,0.4)]">
                <img src="<?php echo e(asset('images/shopee.png')); ?>" alt="Shopee" class="h-4 w-4 mr-2 object-contain">
                Shopee Official Store
            </a>

            <a href="https://www.instagram.com/severuscues/" target="_blank" class="w-full py-2.5 rounded-xl bg-[#141D17] text-[#E1306C] border border-[#E1306C]/30 font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center">
                Instagram @severuscues
            </a>
        </div>
    </div>
</header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div x-data="{ 
    activeCategory: 'all', 
    activeModalProduct: null,
    scrollTo(id) {
        const target = document.getElementById(id);
        if (target) {
            const headerOffset = 90;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }
}" 
@scroll-to.window="scrollTo($event.detail)"
class="space-y-24 pt-28">

    <!-- 1. Hero Section -->
    <section id="home" class="relative overflow-hidden pt-8 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto scroll-mt-28">
        <!-- Venom Ambient Background Glows -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#00E676]/10 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <!-- Left Hero Text -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left reveal-on-scroll">
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full bg-[#00E676]/10 border border-[#00E676]/30 text-[#00E676] text-xs font-extrabold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#00E676] animate-ping"></span>
                    <span><?php echo e($siteContents['hero_title'] ?? __('app.hero.badge')); ?></span>
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight uppercase font-outfit tracking-tight">
                    <?php echo e(__('app.hero.headline_prefix')); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00E676] via-[#10b981] to-emerald-400"><?php echo e(__('app.hero.headline_highlight')); ?></span>
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    <?php echo e($siteContents['hero_subtitle'] ?? __('app.hero.subtitle')); ?>

                </p>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-4">
                    <a href="#cues" @click.prevent="scrollTo('cues')" class="px-6 py-3.5 rounded-2xl btn-venom flex items-center justify-center text-xs font-black uppercase tracking-wider cursor-pointer">
                        <span><?php echo e(__('app.hero.explore_btn')); ?></span>
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </a>

                    <a href="https://www.tokopedia.com/severus" target="_blank" class="px-5 py-3.5 rounded-2xl bg-[#141D17] hover:bg-[#42b549]/20 border border-[#42b549]/40 text-[#42b549] font-bold text-xs uppercase tracking-wider flex items-center transition-all">
                        <img src="<?php echo e(asset('images/tokopedia.png')); ?>" alt="Tokopedia" class="h-4 w-4 mr-1.5 object-contain">
                        <span>Tokopedia</span>
                    </a>

                    <a href="https://shopee.co.id/severuscues" target="_blank" class="px-5 py-3.5 rounded-2xl bg-[#141D17] hover:bg-[#ee4d2d]/20 border border-[#ee4d2d]/40 text-[#ee4d2d] font-bold text-xs uppercase tracking-wider flex items-center transition-all">
                        <img src="<?php echo e(asset('images/shopee.png')); ?>" alt="Shopee" class="h-4 w-4 mr-1.5 object-contain">
                        <span>Shopee</span>
                    </a>
                </div>
            </div>

            <!-- Right Hero Visual Showcase -->
            <div class="lg:col-span-5 relative flex justify-center reveal-on-scroll delay-200">
                <div class="w-full max-w-md venom-card p-6 rounded-3xl relative group overflow-hidden">
                    <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-[#00E676]/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>

                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Cue Stick" class="w-48 h-auto mx-auto drop-shadow-[0_0_35px_rgba(0,230,118,0.5)] transform group-hover:rotate-6 group-hover:scale-110 transition-transform duration-500">

                    <div class="mt-6 text-center space-y-2">
                        <h3 class="text-xl font-black text-white font-outfit uppercase">Reaper V2 Pro Carbon Shaft</h3>
                        <p class="text-xs text-slate-400 font-medium">TrueLock Joint &bull; 12.4mm Tip &bull; Super Low Deflection</p>
                        <div class="pt-2">
                            <span class="inline-block px-4 py-1.5 rounded-full bg-[#00E676]/20 text-[#00E676] font-extrabold text-sm border border-[#00E676]/40">Rp 2.950.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Product Catalog Section (Venom Collection) -->
    <section id="cues" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 scroll-mt-28">
        <!-- Section Header & Category Filters -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 reveal-on-scroll">
            <div>
                <h2 class="text-3xl sm:text-4xl font-black text-white uppercase font-outfit tracking-tight">
                    <?php echo e(__('app.catalog.title_prefix')); ?> <span class="text-[#00E676]"><?php echo e(__('app.catalog.title_highlight')); ?></span>
                </h2>
                <p class="text-sm text-slate-400 mt-1 font-medium"><?php echo e(__('app.catalog.subtitle')); ?></p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 bg-[#141D17] p-1.5 rounded-2xl border border-[#00E676]/20">
                <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-[#00E676] text-black font-extrabold shadow-[0_0_15px_rgba(0,230,118,0.5)]' : 'text-slate-400 hover:text-white font-bold'" class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition-all">
                    <?php echo e(__('app.catalog.all_categories')); ?>

                </button>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button @click="activeCategory = '<?php echo e($category->slug); ?>'" :class="activeCategory === '<?php echo e($category->slug); ?>' ? 'bg-[#00E676] text-black font-extrabold shadow-[0_0_15px_rgba(0,230,118,0.5)]' : 'text-slate-400 hover:text-white font-bold'" class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition-all">
                        <?php echo e($category->name); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Dynamic Product Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div x-show="activeCategory === 'all' || activeCategory === '<?php echo e($product->category->slug); ?>'" 
                     x-transition:enter="transition ease-out duration-400"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="venom-card rounded-3xl p-6 flex flex-col justify-between group relative overflow-hidden reveal-on-scroll delay-<?php echo e(($index % 3 + 1) * 100); ?>">
                    
                    <div>
                        <!-- Category Badge -->
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-[#00E676]/10 text-[#00E676] text-[10px] font-extrabold uppercase tracking-widest border border-[#00E676]/30">
                                <?php echo e($product->category->name); ?>

                            </span>
                            <?php if($product->tip_size): ?>
                                <span class="text-[10px] text-slate-400 font-semibold bg-[#0a0f0d] px-2 py-0.5 rounded border border-[#1f2e24]">
                                    <?php echo e($product->tip_size); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Product Image Showcase -->
                        <div class="my-6 h-56 flex items-center justify-center relative overflow-hidden rounded-2xl bg-[#0a0f0d]/50 p-4 border border-[#1f2e24]">
                            <img src="<?php echo e($product->image_path ?: 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=800&q=80'); ?>" 
                                 alt="<?php echo e($product->name); ?>" 
                                 class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-500 drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)]">
                        </div>

                        <!-- Title & Description -->
                        <h3 class="text-xl font-bold text-white font-outfit group-hover:text-[#00E676] transition-colors line-clamp-1">
                            <?php echo e(app()->getLocale() === 'id' ? $product->name_id : $product->name_en); ?>

                        </h3>
                        <p class="text-xs text-slate-400 mt-2 line-clamp-2 leading-relaxed font-normal">
                            <?php echo e(app()->getLocale() === 'id' ? $product->description_id : $product->description_en); ?>

                        </p>
                    </div>

                    <!-- Price & Actions -->
                    <div class="mt-6 pt-4 border-t border-[#1f2e24] flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-500 block uppercase font-bold"><?php echo e(__('app.catalog.price_label')); ?></span>
                            <span class="text-lg font-black text-[#00E676] font-outfit">
                                <?php echo e($product->formatted_price); ?>

                            </span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <!-- View Specs Button -->
                            <button @click="activeModalProduct = <?php echo e($product->toJson()); ?>" class="p-2.5 rounded-xl bg-[#141D17] hover:bg-[#00E676]/20 border border-[#00E676]/30 text-[#00E676] transition-colors" title="<?php echo e(__('app.catalog.view_specs')); ?>">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>

                            <!-- Tokopedia Buy Link -->
                            <a href="<?php echo e($product->tokopedia_url ?: 'https://www.tokopedia.com/severus'); ?>" target="_blank" class="px-3 py-2 rounded-xl bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-xs uppercase tracking-wider flex items-center shadow-[0_0_10px_rgba(66,181,73,0.3)] transition-all">
                                <img src="<?php echo e(asset('images/tokopedia.png')); ?>" alt="Tokopedia" class="h-3.5 w-3.5 mr-1 object-contain">
                                <span>Tokopedia</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- 3. Cue Technology Spotlight Section -->
    <section id="technology" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-28">
        <div class="venom-card p-8 sm:p-12 rounded-3xl relative overflow-hidden reveal-on-scroll">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-80 h-80 bg-[#00E676]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-3xl space-y-6">
                <span class="px-3 py-1.5 rounded-full bg-[#00E676]/10 border border-[#00E676]/30 text-[#00E676] text-xs font-extrabold uppercase tracking-wider">
                    <?php echo e(__('app.tech.badge')); ?>

                </span>

                <h2 class="text-3xl sm:text-5xl font-black text-white font-outfit uppercase tracking-tight">
                    <?php echo e(__('app.tech.title_prefix')); ?> <span class="text-[#00E676]"><?php echo e(__('app.tech.title_highlight')); ?></span>
                </h2>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    <?php echo e(__('app.tech.description')); ?>

                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 border-t border-[#1f2e24]">
                    <div class="space-y-1">
                        <span class="text-2xl font-black text-[#00E676] font-outfit">0.12mm</span>
                        <h4 class="text-xs font-bold text-white uppercase"><?php echo e(__('app.tech.attr1_title')); ?></h4>
                        <p class="text-[11px] text-slate-400"><?php echo e(__('app.tech.attr1_desc')); ?></p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-2xl font-black text-[#00E676] font-outfit">99.8%</span>
                        <h4 class="text-xs font-bold text-white uppercase"><?php echo e(__('app.tech.attr2_title')); ?></h4>
                        <p class="text-[11px] text-slate-400"><?php echo e(__('app.tech.attr2_desc')); ?></p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-2xl font-black text-[#00E676] font-outfit">3/8x8 & Uni-Loc</span>
                        <h4 class="text-xs font-bold text-white uppercase"><?php echo e(__('app.tech.attr3_title')); ?></h4>
                        <p class="text-[11px] text-slate-400"><?php echo e(__('app.tech.attr3_desc')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Product Spec Sheet Modal -->
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
             class="venom-card w-full max-w-2xl p-6 sm:p-8 rounded-3xl space-y-6 relative border border-[#00E676]/40 shadow-2xl max-h-[90vh] overflow-y-auto">
            
            <button @click="activeModalProduct = null" class="absolute top-6 right-6 p-2 rounded-xl bg-[#0a0f0d] text-slate-400 hover:text-white border border-[#1f2e24]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <template x-if="activeModalProduct">
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 rounded-full bg-[#00E676]/20 text-[#00E676] text-xs font-bold uppercase tracking-wider" x-text="activeModalProduct.category ? activeModalProduct.category.name : 'Severus Product'"></span>
                        <span class="text-xs font-semibold text-slate-400">Technical Spec Sheet</span>
                    </div>

                    <h3 class="text-2xl font-black text-white font-outfit uppercase" x-text="activeModalProduct.name_en"></h3>

                    <div class="h-64 rounded-2xl bg-[#0a0f0d] p-4 flex items-center justify-center border border-[#1f2e24]">
                        <img :src="activeModalProduct.image_path || 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=800&q=80'" :alt="activeModalProduct.name_en" class="max-h-full max-w-full object-contain drop-shadow-[0_0_20px_rgba(0,230,118,0.3)]">
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="p-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24]">
                            <span class="text-slate-500 font-bold block uppercase">Tip Diameter</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.tip_size || '12.4mm Premium'"></span>
                        </div>
                        <div class="p-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24]">
                            <span class="text-slate-500 font-bold block uppercase">Joint System</span>
                            <span class="text-white font-extrabold text-sm" x-text="activeModalProduct.joint_type || 'Radial / Uni-Loc Compatible'"></span>
                        </div>
                    </div>

                    <p class="text-xs text-slate-300 leading-relaxed" x-text="activeModalProduct.description_en"></p>

                    <div class="pt-4 border-t border-[#1f2e24] flex items-center justify-between gap-3">
                        <span class="text-2xl font-black text-[#00E676] font-outfit" x-text="'Rp ' + Number(activeModalProduct.price_idr).toLocaleString('id-ID')"></span>
                        
                        <div class="flex items-center space-x-2">
                            <a :href="activeModalProduct.tokopedia_url || 'https://www.tokopedia.com/severus'" target="_blank" class="px-4 py-2.5 rounded-xl bg-[#42b549] text-white font-extrabold text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(66,181,73,0.5)] flex items-center">
                                <img src="<?php echo e(asset('images/tokopedia.png')); ?>" alt="Tokopedia" class="h-4 w-4 mr-1.5 object-contain">
                                <span>Tokopedia</span>
                            </a>
                            <a href="https://shopee.co.id/severuscues" target="_blank" class="px-4 py-2.5 rounded-xl bg-[#ee4d2d] text-white font-extrabold text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(238,77,45,0.5)] flex items-center">
                                <img src="<?php echo e(asset('images/shopee.png')); ?>" alt="Shopee" class="h-4 w-4 mr-1.5 object-contain">
                                <span>Shopee</span>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/landing.blade.php ENDPATH**/ ?>