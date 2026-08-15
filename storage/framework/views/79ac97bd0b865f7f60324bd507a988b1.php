<?php $__env->startSection('content'); ?>
<div x-data="{ 
    selectedCategory: 'all', 
    showModal: false, 
    activeProduct: null,
    fetchDetail(productId) {
        fetch('/api/products/' + productId)
            .then(res => res.json())
            .then(data => {
                this.activeProduct = data;
                this.showModal = true;
            });
    }
}">
    <!-- 1. Top Fixed Navigation Bar -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <a href="<?php echo e(route('landing')); ?>" class="flex items-center space-x-3 group">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Cues Logo" class="h-10 w-auto object-contain transition-transform group-hover:scale-110 filter drop-shadow-[0_0_10px_rgba(0,230,118,0.6)]">
                    <div class="flex flex-col">
                        <span class="text-xl font-black tracking-wider text-white group-hover:text-[#00e676] transition-colors">SEVERUS <span class="text-[#00e676]">CUES</span></span>
                        <span class="text-[10px] text-slate-400 tracking-widest uppercase font-semibold">Billiards & Accessories</span>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    <a href="#home" class="text-slate-200 hover:text-[#00e676] transition-colors py-1 border-b-2 border-transparent hover:border-[#00e676]"><?php echo e(__('app.nav.home')); ?></a>
                    <a href="#cues" class="text-slate-200 hover:text-[#00e676] transition-colors py-1 border-b-2 border-transparent hover:border-[#00e676]"><?php echo e(__('app.nav.cues')); ?></a>
                    <a href="#chalk" class="text-slate-200 hover:text-[#00e676] transition-colors py-1 border-b-2 border-transparent hover:border-[#00e676]"><?php echo e(__('app.nav.chalk')); ?></a>
                    <a href="#accessories" class="text-slate-200 hover:text-[#00e676] transition-colors py-1 border-b-2 border-transparent hover:border-[#00e676]"><?php echo e(__('app.nav.accessories')); ?></a>
                    <a href="#technology" class="text-slate-200 hover:text-[#00e676] transition-colors py-1 border-b-2 border-transparent hover:border-[#00e676]"><?php echo e(__('app.nav.technology')); ?></a>
                </nav>

                <!-- Actions: Tokopedia & Language Switcher -->
                <div class="flex items-center space-x-4">
                    <!-- Tokopedia Button -->
                    <a href="https://www.tokopedia.com/severus" target="_blank" class="hidden sm:inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-[#42b549] to-[#369b3d] hover:from-[#369b3d] hover:to-[#2e8233] text-white font-bold text-xs tracking-wider uppercase shadow-[0_0_15px_rgba(66,181,73,0.4)] transition-all transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        Tokopedia Store
                    </a>

                    <!-- Bilingual Switcher (EN / ID) -->
                    <div class="flex items-center bg-[#121a15] border border-[#1f2e24] rounded-lg p-1">
                        <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="px-2.5 py-1 text-xs font-bold rounded <?php echo e(app()->getLocale() === 'en' ? 'bg-[#00e676] text-black shadow-[0_0_10px_rgba(0,230,118,0.5)]' : 'text-slate-400 hover:text-white'); ?>">EN</a>
                        <a href="<?php echo e(route('lang.switch', 'id')); ?>" class="px-2.5 py-1 text-xs font-bold rounded <?php echo e(app()->getLocale() === 'id' ? 'bg-[#00e676] text-black shadow-[0_0_10px_rgba(0,230,118,0.5)]' : 'text-slate-400 hover:text-white'); ?>">ID</a>
                    </div>

                    <!-- Team Portal Access -->
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="p-2 rounded-lg bg-[#00e676]/20 border border-[#00e676]/50 text-[#00e676] hover:bg-[#00e676]/30 transition-colors" title="Admin Dashboard">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('admin.login')); ?>" class="p-2 rounded-lg bg-[#121a15] border border-[#1f2e24] text-slate-400 hover:text-white transition-colors" title="Team Login">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Hero Section -->
    <section id="home" class="relative pt-32 pb-20 md:pt-40 md:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Hero Text Content -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full bg-[#00e676]/10 border border-[#00e676]/30 text-[#00e676] text-xs font-extrabold uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-[#00e676] animate-ping"></span>
                    <span><?php echo e(__('app.hero.badge')); ?></span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-[1.08] text-white">
                    <?php echo e($siteContents['hero_title'] ?? __('app.hero.title')); ?>

                </h1>

                <!-- Subtitle Copy -->
                <p class="text-lg sm:text-xl text-slate-300 max-w-2xl font-light leading-relaxed">
                    <?php echo e($siteContents['hero_subtitle'] ?? __('app.hero.subtitle')); ?>

                </p>

                <!-- Call to Action Buttons -->
                <div class="pt-4 flex flex-wrap gap-4 items-center">
                    <a href="#cues" class="px-8 py-4 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-sm uppercase tracking-wider shadow-[0_0_25px_rgba(0,230,118,0.4)] hover:shadow-[0_0_35px_rgba(0,230,118,0.6)] transition-all transform hover:-translate-y-1">
                        <?php echo e(__('app.hero.cta_explore')); ?>

                    </a>

                    <a href="https://www.tokopedia.com/severus" target="_blank" class="px-8 py-4 rounded-xl bg-[#121a15] hover:bg-[#1a261f] border border-[#00e676]/40 text-[#00e676] font-bold text-sm uppercase tracking-wider transition-all transform hover:-translate-y-1 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#42b549]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        <?php echo e(__('app.hero.cta_tokopedia')); ?>

                    </a>
                </div>

                <!-- Feature Highlights Bar -->
                <div class="pt-8 border-t border-[#1f2e24] grid grid-cols-3 gap-4 text-center sm:text-left">
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-white">0.02<span class="text-[#00e676] text-lg">mm</span></div>
                        <div class="text-xs text-slate-400 font-medium">Ultra Low Deflection</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-white">9.9<span class="text-[#00e676] text-lg">/10</span></div>
                        <div class="text-xs text-slate-400 font-medium">Chalk Friction Matrix</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-white">100<span class="text-[#00e676] text-lg">%</span></div>
                        <div class="text-xs text-slate-400 font-medium">Tokopedia Verified</div>
                    </div>
                </div>
            </div>

            <!-- Right Hero Visual Art (Snake Logo & Cue Stick Composite) -->
            <div class="lg:col-span-5 relative flex justify-center items-center">
                <div class="relative w-full max-w-md aspect-square rounded-3xl p-8 bg-gradient-to-b from-[#121a15]/80 to-[#0a0f0d]/90 border border-[#00e676]/30 shadow-[0_0_50px_rgba(0,230,118,0.2)] backdrop-blur-xl flex flex-col justify-center items-center group">
                    
                    <!-- Glowing Snake S Logo -->
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Snake Logo" class="w-64 h-64 object-contain filter drop-shadow-[0_0_20px_rgba(0,230,118,0.8)] animate-float">

                    <!-- Floating Badge -->
                    <div class="absolute bottom-6 bg-[#0a0f0d]/90 border border-[#00e676]/60 rounded-full px-5 py-2 flex items-center space-x-3 shadow-lg">
                        <span class="w-3 h-3 rounded-full bg-[#00e676] animate-pulse"></span>
                        <span class="text-xs font-bold tracking-wider text-white uppercase">Official Tokopedia Store Ready</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Tokopedia Official Store Section -->
    <section class="py-12 bg-gradient-to-r from-[#06180e] via-[#0a1f13] to-[#06180e] border-y border-[#1f2e24]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 rounded-2xl bg-[#42b549]/20 border border-[#42b549]/40 flex items-center justify-center text-[#42b549]">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <?php echo e(__('app.tokopedia.title')); ?>

                        <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-black uppercase bg-[#42b549] text-white">Tokopedia Shop</span>
                    </h3>
                    <p class="text-sm text-slate-300 mt-1">
                        <?php echo e(__('app.tokopedia.description')); ?>

                    </p>
                </div>
            </div>
            <a href="https://www.tokopedia.com/severus" target="_blank" class="px-6 py-3 rounded-xl bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-sm uppercase tracking-wider shadow-[0_0_20px_rgba(66,181,73,0.4)] transition-all whitespace-nowrap">
                <?php echo e(__('app.tokopedia.visit_btn')); ?> &rarr;
            </a>
        </div>
    </section>

    <!-- 4. Product Catalog Showcase -->
    <section id="cues" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight uppercase">
                <?php echo e(__('app.products.title')); ?>

            </h2>
            <p class="mt-4 text-slate-400 text-base sm:text-lg">
                <?php echo e(__('app.products.subtitle')); ?>

            </p>

            <!-- Category Filter Tabs -->
            <div class="mt-8 flex flex-wrap justify-center gap-2">
                <a href="<?php echo e(route('landing')); ?>#cues" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider border transition-all <?php echo e(request('category') == null || request('category') == 'all' ? 'bg-[#00e676] text-black border-[#00e676] shadow-[0_0_15px_rgba(0,230,118,0.4)]' : 'bg-[#121a15] text-slate-300 border-[#1f2e24] hover:border-[#00e676]/40'); ?>">
                    <?php echo e(__('app.products.all')); ?>

                </a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('landing', ['category' => $cat->slug])); ?>#cues" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider border transition-all <?php echo e(request('category') == $cat->slug ? 'bg-[#00e676] text-black border-[#00e676] shadow-[0_0_15px_rgba(0,230,118,0.4)]' : 'bg-[#121a15] text-slate-300 border-[#1f2e24] hover:border-[#00e676]/40'); ?>">
                        <?php echo e($cat->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="venom-card rounded-2xl overflow-hidden flex flex-col justify-between group">
                    <div>
                        <!-- Product Image & Badges -->
                        <div class="relative h-64 overflow-hidden bg-[#050806] flex items-center justify-center p-6 border-b border-[#1f2e24]">
                            <?php if($product->is_featured): ?>
                                <div class="absolute top-4 left-4 z-10 px-3 py-1 rounded-full bg-gradient-to-r from-[#00e676] to-[#10b981] text-black text-[10px] font-black tracking-widest uppercase shadow-md">
                                    <?php echo e(__('app.products.featured')); ?>

                                </div>
                            <?php endif; ?>

                            <div class="absolute top-4 right-4 z-10 px-2.5 py-1 rounded bg-[#0a0f0d]/80 border border-[#00e676]/40 text-[#00e676] text-[10px] font-bold">
                                <?php echo e($product->category->name); ?>

                            </div>

                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110 filter drop-shadow-[0_0_10px_rgba(0,0,0,0.8)]">
                        </div>

                        <!-- Product Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white group-hover:text-[#00e676] transition-colors leading-snug">
                                <?php echo e($product->name); ?>

                            </h3>

                            <p class="mt-2 text-sm text-slate-400 line-clamp-2 leading-relaxed">
                                <?php echo e($product->description); ?>

                            </p>

                            <!-- Key Attribute Snippet -->
                            <div class="mt-4 grid grid-cols-2 gap-2 text-xs border-y border-[#1f2e24] py-3">
                                <?php if($product->tip_size): ?>
                                    <div>
                                        <span class="text-slate-500 block text-[10px] uppercase font-bold">Tip Diameter</span>
                                        <span class="text-slate-200 font-semibold"><?php echo e($product->tip_size); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($product->joint_type): ?>
                                    <div>
                                        <span class="text-slate-500 block text-[10px] uppercase font-bold">Joint Pin</span>
                                        <span class="text-slate-200 font-semibold"><?php echo e($product->joint_type); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($product->chalk_friction): ?>
                                    <div class="col-span-2">
                                        <span class="text-slate-500 block text-[10px] uppercase font-bold">Friction Matrix</span>
                                        <span class="text-[#00e676] font-semibold"><?php echo e($product->chalk_friction); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer: Price & Actions -->
                    <div class="p-6 pt-0 space-y-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold"><?php echo e(__('app.products.price_idr')); ?></span>
                                <span class="text-xl font-black text-[#00e676]"><?php echo e($product->formatted_price_idr); ?></span>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#10b981]/20 text-[#10b981] border border-[#10b981]/30">
                                <?php echo e(__('app.products.synced_with_tokopedia')); ?>

                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <!-- View Modal -->
                            <button @click="fetchDetail(<?php echo e($product->id); ?>)" class="w-full py-2.5 rounded-lg bg-[#121a15] hover:bg-[#1f2e24] border border-[#1f2e24] text-slate-200 hover:text-white font-bold text-xs uppercase tracking-wider transition-colors">
                                <?php echo e(__('app.products.view_details')); ?>

                            </button>

                            <!-- Buy on Tokopedia -->
                            <a href="<?php echo e($product->tokopedia_url ?: 'https://www.tokopedia.com/severus'); ?>" target="_blank" class="w-full py-2.5 rounded-lg bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-xs uppercase tracking-wider text-center flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                <?php echo e(__('app.products.buy_now')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- 5. Technology Spotlight (Viper Tech) -->
    <section id="technology" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t border-[#1f2e24]">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-widest text-[#00e676] bg-[#00e676]/10 px-3 py-1 rounded-full border border-[#00e676]/30">PRO EQUIPMENT STANDARD</span>
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight uppercase mt-4">
                <?php echo e(__('app.tech.title')); ?>

            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- 3K Carbon Shaft -->
            <div class="venom-card p-8 rounded-2xl space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#00e676]/20 border border-[#00e676]/40 flex items-center justify-center text-[#00e676]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white"><?php echo e(__('app.tech.carbon_title')); ?></h3>
                <p class="text-sm text-slate-400 leading-relaxed"><?php echo e(__('app.tech.carbon_desc')); ?></p>
            </div>

            <!-- Nano Chalk -->
            <div id="chalk" class="venom-card p-8 rounded-2xl space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#00e676]/20 border border-[#00e676]/40 flex items-center justify-center text-[#00e676]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white"><?php echo e(__('app.tech.chalk_title')); ?></h3>
                <p class="text-sm text-slate-400 leading-relaxed"><?php echo e(__('app.tech.chalk_desc')); ?></p>
            </div>

            <!-- Gloves & Accessories -->
            <div id="accessories" class="venom-card p-8 rounded-2xl space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#00e676]/20 border border-[#00e676]/40 flex items-center justify-center text-[#00e676]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white"><?php echo e(__('app.tech.glove_title')); ?></h3>
                <p class="text-sm text-slate-400 leading-relaxed"><?php echo e(__('app.tech.glove_desc')); ?></p>
            </div>
        </div>
    </section>

    <!-- 6. Interactive Product Spec Modal (Alpine.js) -->
    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         style="display: none;">
        
        <div @click.away="showModal = false" class="bg-[#0a0f0d] border border-[#00e676]/50 rounded-2xl max-w-2xl w-full overflow-hidden shadow-[0_0_50px_rgba(0,230,118,0.3)]">
            <template x-if="activeProduct">
                <div>
                    <!-- Modal Header -->
                    <div class="p-6 bg-[#121a15] border-b border-[#1f2e24] flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-[#00e676] uppercase tracking-wider" x-text="activeProduct.category_name"></span>
                            <h3 class="text-2xl font-bold text-white mt-1" x-text="activeProduct.name"></h3>
                        </div>
                        <button @click="showModal = false" class="text-slate-400 hover:text-white text-2xl font-bold p-2">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <img :src="activeProduct.image_url" :alt="activeProduct.name" class="w-full h-48 object-cover rounded-xl border border-[#1f2e24]">
                            <div>
                                <span class="text-xs text-slate-400 uppercase font-bold block"><?php echo e(__('app.products.price_idr')); ?></span>
                                <div class="text-3xl font-black text-[#00e676] mt-1" x-text="activeProduct.formatted_price_idr"></div>
                                <p class="text-sm text-slate-300 mt-3 leading-relaxed" x-text="activeProduct.description"></p>
                            </div>
                        </div>

                        <!-- Technical Specs Matrix -->
                        <div class="bg-[#121a15] p-4 rounded-xl border border-[#1f2e24]">
                            <h4 class="text-xs font-extrabold text-[#00e676] uppercase tracking-wider mb-3"><?php echo e(__('app.products.specifications')); ?></h4>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div>
                                    <span class="text-slate-400 block font-medium"><?php echo e(__('app.products.tip_size')); ?></span>
                                    <span class="text-white font-bold" x-text="activeProduct.tip_size"></span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-medium"><?php echo e(__('app.products.joint_type')); ?></span>
                                    <span class="text-white font-bold" x-text="activeProduct.joint_type"></span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-medium"><?php echo e(__('app.products.weight')); ?></span>
                                    <span class="text-white font-bold" x-text="activeProduct.weight_oz"></span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-medium"><?php echo e(__('app.products.deflection')); ?></span>
                                    <span class="text-white font-bold" x-text="activeProduct.deflection_grade"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="p-6 bg-[#121a15] border-t border-[#1f2e24] flex items-center justify-between">
                        <button @click="showModal = false" class="px-5 py-2.5 rounded-lg bg-[#0a0f0d] text-slate-300 hover:text-white font-bold text-xs uppercase border border-[#1f2e24]">
                            <?php echo e(__('app.products.close')); ?>

                        </button>

                        <a :href="activeProduct.tokopedia_url" target="_blank" class="px-6 py-2.5 rounded-lg bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-xs uppercase tracking-wider flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            <?php echo e(__('app.products.buy_now')); ?>

                        </a>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/landing.blade.php ENDPATH**/ ?>