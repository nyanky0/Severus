@extends('layouts.app')

@section('title', 'Severus Cues — Strike. Slither. Prevail.')

@section('header')
<header x-data="{ scrolled: false, mobileMenuOpen: false }"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        :class="currentTheme === 'venom' ? 'navbar-gradient-blur--venom' : 'navbar-gradient-blur--reaper'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between" :class="scrolled ? 'py-3' : 'py-5'">

            <!-- Brand -->
            <a href="#home" @click.prevent="$dispatch('scroll-to', 'home')" class="flex items-center space-x-3 group">
                <div class="relative">
                    <img src="{{ asset('images/logo.png') }}" alt="Severus Logo" class="h-10 sm:h-12 w-auto transform group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 rounded-full blur-md opacity-0 group-hover:opacity-100 transition-opacity"
                         :class="currentTheme === 'venom' ? 'bg-[#00E676]/25' : 'bg-[#E23B3B]/25'"></div>
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-xl sm:text-2xl text-white tracking-widest uppercase font-outfit">
                        SEVERUS <span class="transition-colors" :class="currentTheme === 'venom' ? 'text-[#00E676] group-hover:text-[#10b981]' : 'text-[#E23B3B] group-hover:text-[#FF4D5E]'">CUES</span>
                    </span>
                    <span x-text="currentTheme === 'venom' ? 'Venom Precision' : 'Reaper Precision'" class="text-[9px] uppercase tracking-[0.28em] text-slate-400 font-bold -mt-1">Reaper Precision</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center space-x-8 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="#home" @click.prevent="$dispatch('scroll-to', 'home')" class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.home') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
                <a href="#why-carbon" @click.prevent="$dispatch('scroll-to', 'why-carbon')" class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.why_carbon') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
                <a href="{{ route('products.index') }}"  class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.collection') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
                <a href="#technology" @click.prevent="$dispatch('scroll-to', 'technology')" class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.technology') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
            </nav>

            <!-- Right cluster: theme switch + hamburger -->
            <div class="flex items-center space-x-3">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-11 h-11 rounded-2xl glass flex items-center justify-center text-white cursor-pointer" aria-label="Toggle menu">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>


        </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-[#080608]/95 backdrop-blur-2xl border-b border-white/10 px-6 py-6 space-y-4 shadow-2xl"
         x-cloak>
        <nav class="flex flex-col space-y-3 font-outfit text-sm font-bold uppercase tracking-wider text-slate-200">
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'home')" href="#home" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.home') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'why-carbon')" href="#why-carbon" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.why_carbon') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a  href="{{ route('products.index') }}" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.collection') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'technology')" href="#technology" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.technology') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </nav>
    </div>
</header>
@endsection

@section('content')
<div x-data="{
    scrollTo(id) {
        const target = document.getElementById(id);
        if (target) {
            const headerOffset = 90;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
        }
    }
}"
     @scroll-to.window="scrollTo($event.detail)"
     class="space-y-28 pt-28 relative">


    <!-- ===================================================== -->
    <!-- 1. HERO — Reaper/Snake stage -->
    <!-- ===================================================== -->
    <section id="home" class="relative overflow-hidden pt-8 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto scroll-mt-28">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[520px] h-[520px] rounded-full blur-[150px] pointer-events-none transition-all duration-500"
             :class="currentTheme === 'venom' ? 'bg-[#00E676]/15' : 'bg-[#E23B3B]/15'"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <!-- Left: copy -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full border text-xs font-extrabold uppercase tracking-wider transition-all"
                     :class="currentTheme === 'venom' ? 'bg-[#00E676]/10 border-[#00E676]/30 text-[#00E676]' : 'bg-[#E23B3B]/10 border-[#E23B3B]/30 text-[#FF4D5E]'">
                    <span class="w-2 h-2 rounded-full animate-ping"
                          :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                    <span>{{ $siteContents['hero_title'] ?? __('app.hero.badge') }}</span>
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white leading-[1.02] uppercase font-cinzel tracking-tight">
                    {{ __('app.hero.headline_prefix') }}
                    <span class="text-transparent bg-clip-text transition-all duration-500"
                          :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">
                        {{ __('app.hero.headline_highlight') }}
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    {{ $siteContents['hero_subtitle'] ?? __('app.hero.subtitle') }}
                </p>


                <!-- Hero CTAs -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-4">
                    <a href="{{ route('products.index') }}" 
                       class="px-7 py-4 rounded-2xl flex items-center justify-center text-xs font-black uppercase tracking-wider cursor-pointer transition-all min-h-[48px]"
                       :class="currentTheme === 'venom' ? 'btn-venom' : 'btn-reaper'">
                        <span>{{ __('app.hero.explore_btn') }}</span>
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </a>

                    <a href="https://www.tokopedia.com/severus" target="_blank" class="px-5 py-3.5 rounded-2xl bg-white/5 hover:bg-[#42b549]/20 border border-[#42b549]/40 text-[#42b549] font-bold text-xs uppercase tracking-wider flex items-center transition-all min-h-[48px]">
                        <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia" class="h-4 w-4 mr-1.5 object-contain">
                        <span>Tokopedia</span>
                    </a>

                    <a href="https://shopee.co.id/severuscues" target="_blank" class="px-5 py-3.5 rounded-2xl bg-white/5 hover:bg-[#ee4d2d]/20 border border-[#ee4d2d]/40 text-[#ee4d2d] font-bold text-xs uppercase tracking-wider flex items-center transition-all min-h-[48px]">
                        <img src="{{ asset('images/shopee.png') }}" alt="Shopee" class="h-4 w-4 mr-1.5 object-contain">
                        <span>Shopee</span>
                    </a>

                    <a href="https://www.instagram.com/severuscues/" target="_blank" class="px-5 py-3.5 rounded-2xl bg-white/5 hover:bg-[#E1306C]/20 border border-[#E1306C]/40 text-[#E1306C] font-bold text-xs uppercase tracking-wider flex items-center transition-all min-h-[48px]" title="Instagram @severuscues">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.667-.014 4.947-.072 4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.149-4.358-2.618-6.78-6.98-6.98zm0 4.85c-2.756 0-4.989 2.233-4.989 4.987 0 2.755 2.233 4.988 4.989 4.988s4.989-2.233 4.989-4.988c0-2.755-2.233-4.988-4.989-4.988zm0 1.738c1.795 0 3.25 1.455 3.25 3.25S13.795 14.59 12 14.59 8.75 13.135 8.75 11.339s1.455-3.25 3.25-3.25zm5.188-2.555a1.169 1.169 0 11-2.337 0 1.169 1.169 0 012.337 0z"/></svg>
                        <span>Instagram</span>
                    </a>
                </div>

                <!-- Guarantee badge with serpent shimmer -->
                <div class="pt-2 text-center lg:text-left">
                    <span class="serpent-shimmer inline-flex items-center space-x-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">
                        <svg class="w-3.5 h-3.5" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        <span>{{ $siteContents['hero_guarantee'] ?? __('app.hero.guarantee') }}</span>
                    </span>
                </div>
            </div>


            <!-- Right: 3D cue stage (orbital rings + slanted cue) -->
            <div class="lg:col-span-5 relative perspective-container reveal-on-scroll reveal-zoom">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full blur-[100px] pointer-events-none transition-all duration-500"
                     :class="currentTheme === 'venom' ? 'bg-[#00E676]/20' : 'bg-[#E23B3B]/20'"></div>

                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 sm:w-96 sm:h-96 rounded-full border border-dashed animate-orbit-ring-1"
                     :class="currentTheme === 'venom' ? 'border-[#00E676]/40' : 'border-[#E23B3B]/40'"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-56 h-56 sm:w-72 sm:h-72 rounded-full border border-dashed animate-orbit-ring-2"
                     :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'"></div>

                <div class="relative z-10 flex items-center justify-center">
                    <img src="{{ asset('images/slanted_cue_3d.png') }}" alt="Severus carbon pool cue" class="w-64 sm:w-80 lg:w-96 animate-slanted-cue">
                </div>

                <div class="absolute bottom-2 left-2 z-20 glass rounded-2xl px-4 py-3 flex items-center gap-3">
                    <span class="text-[10px] uppercase tracking-[0.22em] font-bold"
                          :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">SEVERUS</span>
                    <span class="text-slate-500 font-mono text-[10px]">/ 01 — REAPER EDITION</span>
                </div>
            </div>
        </div>

        <!-- Ember particles (decorative) -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            <span class="ember-particle" style="left:12%; animation-duration:9s; animation-delay:0s;"></span>
            <span class="ember-particle" style="left:32%; animation-duration:11s; animation-delay:1.4s;"></span>
            <span class="ember-particle" style="left:56%; animation-duration:8.2s; animation-delay:0.6s;"></span>
            <span class="ember-particle" style="left:74%; animation-duration:12s; animation-delay:2.2s;"></span>
            <span class="ember-particle" style="left:90%; animation-duration:10s; animation-delay:0.3s;"></span>
        </div>
    </section>


    <!-- ===================================================== -->
    <!-- 2. WHY CARBON? — Reaper advantages -->
    <!-- ===================================================== -->
    <section id="why-carbon" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 scroll-mt-28">
        <div class="relative py-12 px-6 rounded-3xl bg-reaper-texture border border-white/10 shadow-2xl text-center space-y-6 reveal-on-scroll overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-[#E23B3B]/10 via-transparent to-black/80 pointer-events-none"></div>
            <div class="relative z-10">
                <span class="severus-badge serpent-shimmer mb-4">{{ __('app.why_carbon.badge') }}</span>
            </div>
            <div class="relative z-10">
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white font-cinzel uppercase tracking-wider fang-underline">
                    <span class="text-glow-reaper">{{ __('app.why_carbon.main_title') }}</span>
                </h2>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-reaper-texture p-8 sm:p-10 rounded-2xl border border-white/10 relative flex flex-col justify-between space-y-8 corner-frame-tl shadow-2xl reveal-on-scroll delay-100 group transition-all hover:-translate-y-2 duration-500 ease-out"
                 :class="currentTheme === 'venom' ? 'hover:border-[#00E676]/60 hover:shadow-[0_15px_40px_-10px_rgba(0,230,118,0.5)]' : 'hover:border-[#E23B3B]/60 hover:shadow-[0_15px_40px_-10px_rgba(226,59,59,0.5)]'">
                <div class="space-y-8">
                    <h3 class="text-2xl sm:text-3xl font-black text-white font-cinzel tracking-wider uppercase"
                        :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">
                        {{ __('app.why_carbon.feature1_title') }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-100 font-semibold leading-relaxed tracking-wider uppercase font-sans">
                        {{ __('app.why_carbon.feature1_body') }}
                    </p>
                    <p class="text-xs sm:text-sm text-white font-extrabold tracking-widest uppercase pt-4 font-sans">
                        {{ __('app.why_carbon.feature1_highlight') }}
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-reaper-texture p-8 sm:p-10 rounded-2xl border border-white/10 relative flex flex-col justify-between space-y-8 shadow-2xl reveal-on-scroll delay-200 group transition-all hover:-translate-y-2 duration-500 ease-out"
                 :class="currentTheme === 'venom' ? 'hover:border-[#00E676]/60 hover:shadow-[0_15px_40px_-10px_rgba(0,230,118,0.5)]' : 'hover:border-[#E23B3B]/60 hover:shadow-[0_15px_40px_-10px_rgba(226,59,59,0.5)]'">
                <div class="space-y-8">
                    <div class="flex items-center justify-center space-x-3">
                        <span class="h-[1px] bg-slate-400/40 flex-1"></span>
                        <h3 class="text-2xl sm:text-3xl font-black text-white font-cinzel tracking-wider uppercase px-2 text-center whitespace-nowrap"
                            :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">
                            {{ __('app.why_carbon.feature2_title') }}
                        </h3>
                        <span class="h-[1px] bg-slate-400/40 flex-1"></span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-100 font-semibold leading-relaxed tracking-wider uppercase font-sans">
                        {{ __('app.why_carbon.feature2_body') }}
                    </p>
                    <p class="text-xs sm:text-sm text-white font-extrabold tracking-widest uppercase pt-4 font-sans">
                        {{ __('app.why_carbon.feature2_highlight') }}
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-reaper-texture p-8 sm:p-10 rounded-2xl border border-white/10 relative flex flex-col justify-between space-y-8 corner-frame-tr shadow-2xl reveal-on-scroll delay-300 group transition-all hover:-translate-y-2 duration-500 ease-out"
                 :class="currentTheme === 'venom' ? 'hover:border-[#00E676]/60 hover:shadow-[0_15px_40px_-10px_rgba(0,230,118,0.5)]' : 'hover:border-[#E23B3B]/60 hover:shadow-[0_15px_40px_-10px_rgba(226,59,59,0.5)]'">
                <div class="space-y-8">
                    <h3 class="text-2xl sm:text-3xl font-black text-white font-cinzel tracking-wider uppercase"
                        :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">
                        {{ __('app.why_carbon.feature3_title') }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-100 font-semibold leading-relaxed tracking-wider uppercase font-sans">
                        {{ __('app.why_carbon.feature3_body') }}
                    </p>
                    <p class="text-xs sm:text-sm text-white font-extrabold tracking-widest uppercase pt-4 font-sans">
                        {{ __('app.why_carbon.feature3_highlight') }}
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ===================================================== -->
    <!-- 3. ENGINEERING LAB — stat dials -->
    <!-- ===================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="p-8 sm:p-12 rounded-3xl relative overflow-hidden reveal-on-scroll transition-all duration-500"
             :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
            <div class="absolute inset-0 pointer-events-none"
                 :class="currentTheme === 'venom' ? 'bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#00E676]/10 via-transparent to-transparent' : 'bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#E23B3B]/10 via-transparent to-transparent'"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-4 space-y-4 text-left">
                    <div class="flex items-center space-x-2 text-xs font-mono text-slate-400 uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full snake-breath" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                        <span>ENGINEERING LAB</span>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-black text-white font-outfit uppercase">VENOM CARBON SHAFTS</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Tested by world-class billiard professionals. Radial pin joint precision and hydrophobic chalk retention matrix.
                    </p>
                </div>

                <div class="lg:col-span-8 flex flex-wrap items-center justify-around gap-6 pt-4 lg:pt-0">
                    <div class="flex flex-col items-center justify-center p-6 rounded-3xl bg-[#060506]/80 border shadow-xl min-w-[140px] transform hover:scale-105 transition-all"
                         :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'">
                        <span class="text-xs font-mono text-slate-400 uppercase block mb-1">ACCURACY</span>
                        <span class="text-3xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">0.12mm</span>
                        <span class="text-[10px] text-slate-500 mt-1">LOW DEFLECTION</span>
                    </div>

                    <div class="flex flex-col items-center justify-center p-6 rounded-3xl shadow-2xl min-w-[140px] transform hover:scale-105 transition-all"
                         :class="currentTheme === 'venom' ? 'bg-[#00E676] text-black shadow-[0_0_30px_rgba(0,230,118,0.5)]' : 'bg-[#E23B3B] text-white shadow-[0_0_30px_rgba(226,59,59,0.5)]'">
                        <span class="text-xs font-mono font-bold uppercase block mb-1">RETENTION</span>
                        <span class="text-3xl font-black font-outfit">99.8%</span>
                        <span class="text-[10px] font-extrabold uppercase mt-1">CHALK FRICTION</span>
                    </div>

                    <div class="flex flex-col items-center justify-center p-6 rounded-3xl bg-[#060506]/80 border shadow-xl min-w-[140px] transform hover:scale-105 transition-all"
                         :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'">
                        <span class="text-xs font-mono text-slate-400 uppercase block mb-1">JOINT PIN</span>
                        <span class="text-2xl font-black text-white font-outfit">UNI-LOC</span>
                        <span class="text-[10px] text-slate-500 mt-1">RADIAL BRASS</span>
                    </div>

                    <div class="flex flex-col items-center justify-center p-6 rounded-3xl bg-[#060506]/80 border shadow-xl min-w-[140px] transform hover:scale-105 transition-all"
                         :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'">
                        <span class="text-xs font-mono text-slate-400 uppercase block mb-1">FLAGSHIP</span>
                        <span class="text-2xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">Rp 2.95M</span>
                        <span class="text-[10px] text-slate-500 mt-1">REAPER V2 PRO</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===================================================== -->
    <!-- 4. BIG TYPOGRAPHY + numbered spec cards -->
    <!-- ===================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center space-y-3 reveal-on-scroll">
            <span class="text-xs font-mono uppercase tracking-[0.25em] font-bold"
                  :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                &bull; SPECIFICATIONS & CRAFTSMANSHIP
            </span>
            <h2 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white font-outfit uppercase tracking-tight">
                ENGINEERED BY <span class="text-transparent bg-clip-text" :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">SEVERUS CUES</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-3xl space-y-4 reveal-on-scroll delay-100 transition-all" :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
                <span class="text-3xl font-mono font-black" :class="currentTheme === 'venom' ? 'text-[#00E676]/40' : 'text-[#E23B3B]/40'">01</span>
                <h4 class="text-lg font-black text-white uppercase font-outfit">Carbon Core</h4>
                <p class="text-xs text-slate-400 leading-relaxed">Multi-directional 3K carbon weave shaft engineered for maximum kinetic energy transfer.</p>
            </div>

            <div class="p-6 rounded-3xl space-y-4 reveal-on-scroll delay-200 transition-all" :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
                <span class="text-3xl font-mono font-black" :class="currentTheme === 'venom' ? 'text-[#00E676]/40' : 'text-[#E23B3B]/40'">02</span>
                <h4 class="text-lg font-black text-white uppercase font-outfit">Toxic Chalk</h4>
                <p class="text-xs text-slate-400 leading-relaxed">Hydrophobic nano-grain friction matrix eliminating miscues on English spin shots.</p>
            </div>

            <div class="p-6 rounded-3xl space-y-4 reveal-on-scroll delay-300 transition-all" :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
                <span class="text-3xl font-mono font-black" :class="currentTheme === 'venom' ? 'text-[#00E676]/40' : 'text-[#E23B3B]/40'">03</span>
                <h4 class="text-lg font-black text-white uppercase font-outfit">TrueLock Pin</h4>
                <p class="text-xs text-slate-400 leading-relaxed">Precision-milled brass joint collars supporting both Radial and Uni-Loc joint systems.</p>
            </div>

            <div class="p-6 rounded-3xl space-y-4 reveal-on-scroll delay-400 transition-all" :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
                <span class="text-3xl font-mono font-black" :class="currentTheme === 'venom' ? 'text-[#00E676]/40' : 'text-[#E23B3B]/40'">04</span>
                <h4 class="text-lg font-black text-white uppercase font-outfit">Pro Warranty</h4>
                <p class="text-xs text-slate-400 leading-relaxed">100% authentic Severus guarantee with official Tokopedia and Shopee store fulfillment.</p>
            </div>
        </div>
    </section>


    <!-- ===================================================== -->
    <!-- 5. INTERACTIVE PRODUCT CATALOG -->
    <!-- ===================================================== -->


    <!-- ===================================================== -->
    <!-- 6. CUE TECHNOLOGY SPOTLIGHT -->
    <!-- ===================================================== -->
    <section id="technology" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-28">
        <div class="p-8 sm:p-12 rounded-3xl relative overflow-hidden reveal-on-scroll transition-all duration-500"
             :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-80 h-80 rounded-full blur-3xl pointer-events-none transition-all duration-500"
                 :class="currentTheme === 'venom' ? 'bg-[#00E676]/10' : 'bg-[#E23B3B]/10'"></div>

            <div class="max-w-3xl space-y-6">
                <span class="px-3 py-1.5 rounded-full border text-xs font-extrabold uppercase tracking-wider transition-all"
                      :class="currentTheme === 'venom' ? 'bg-[#00E676]/10 border-[#00E676]/30 text-[#00E676]' : 'bg-[#E23B3B]/10 border-[#E23B3B]/30 text-[#FF4D5E]'">
                    {{ __('app.tech.badge') }}
                </span>

                <h2 class="text-3xl sm:text-5xl font-black text-white font-outfit uppercase tracking-tight">
                    {{ __('app.tech.title_prefix') }}
                    <span :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">{{ __('app.tech.title_highlight') }}</span>
                </h2>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    {{ __('app.tech.description') }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 border-t border-white/10">
                    <div class="space-y-1">
                        <span class="text-2xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">0.12mm</span>
                        <h4 class="text-xs font-bold text-white uppercase">{{ __('app.tech.attr1_title') }}</h4>
                        <p class="text-[11px] text-slate-400">{{ __('app.tech.attr1_desc') }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-2xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">99.8%</span>
                        <h4 class="text-xs font-bold text-white uppercase">{{ __('app.tech.attr2_title') }}</h4>
                        <p class="text-[11px] text-slate-400">{{ __('app.tech.attr2_desc') }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-2xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">3/8x8 & Uni-Loc</span>
                        <h4 class="text-xs font-bold text-white uppercase">{{ __('app.tech.attr3_title') }}</h4>
                        <p class="text-[11px] text-slate-400">{{ __('app.tech.attr3_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================== -->
    <!-- 7. FINALE BANNER — Strike. Slither. Prevail. -->
    <!-- ===================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 reveal-on-scroll">
        <div class="relative py-16 px-6 rounded-3xl border overflow-hidden shadow-2xl transition-all duration-500"
             :class="currentTheme === 'venom' ? 'bg-gradient-to-r from-[#060907] via-[#0d1712] to-[#060907] border-[#00E676]/30' : 'bg-gradient-to-r from-[#0a0606] via-[#1a1418] to-[#0a0606] border-[#E23B3B]/30'">
            <div class="absolute inset-0 blur-3xl pointer-events-none transition-all duration-500"
                 :class="currentTheme === 'venom' ? 'bg-[#00E676]/10' : 'bg-[#E23B3B]/10'"></div>

            <div class="relative z-10 space-y-6 max-w-3xl mx-auto">
                <div class="w-16 h-16 mx-auto rounded-full border flex items-center justify-center shadow-2xl transition-all"
                     :class="currentTheme === 'venom' ? 'bg-[#00E676]/20 border-[#00E676]/50 text-[#00E676] shadow-[0_0_25px_rgba(0,230,118,0.5)]' : 'bg-[#E23B3B]/20 border-[#E23B3B]/50 text-[#E23B3B] shadow-[0_0_25px_rgba(226,59,59,0.5)]'">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>

                <h2 class="text-4xl sm:text-6xl font-black text-white font-cinzel uppercase tracking-tight">
                    STRIKE WITH
                    <span :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'" x-text="currentTheme === 'venom' ? 'VENOM PRECISION' : 'REAPER PRECISION'">REAPER PRECISION</span>
                </h2>

                <p class="text-sm text-slate-300">Champions worldwide play with Severus high-tech carbon cues. Deadly on the table, unforgettable off it.</p>

                <div class="flex items-center justify-center space-x-4 pt-2">
                    <a href="{{ route('products.index') }}" 
                       class="px-8 py-3.5 rounded-xl font-black text-xs uppercase tracking-wider hover:scale-105 transition-all cursor-pointer min-h-[48px]"
                       :class="currentTheme === 'venom' ? 'bg-[#00E676] text-black shadow-[0_0_20px_rgba(0,230,118,0.5)]' : 'bg-[#E23B3B] text-white shadow-[0_0_20px_rgba(226,59,59,0.5)]'">
                        Shop Collection
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ===================================================== -->
    <!-- 8. PRODUCT SPEC SHEET MODAL -->
    <!-- ===================================================== -->


</div>

<!-- anime.js — entrance choreography for hero emblem -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const A = window.anime; // v4 UMD exposes window.anime
        if (prefersReduced || !A || !A.animate) return;

        // Fade + lift the hero copy
        const heroEls = document.querySelectorAll('#home h1, #home .inline-flex, #home p, #home .flex.wrap');
        if (heroEls.length) {
            heroAnimate(A, heroEls);
        }
    });

    async function heroAnimate(A, els) {
        try {
            await A.animate(els, {
                opacity: [0, 1],
                translateY: [22, 0],
                duration: 900,
                ease: 'outExpo',
                delay: A.stagger(120, { start: 120 })
            }).finished;

            // Cue scale entrance
            const cue = document.querySelector('#home img.animate-slanted-cue');
            if (cue) {
                A.animate(cue, {
                    scale: [0.85, 1],
                    duration: 700,
                    ease: 'outBack',
                    delay: 150
                });
            }
        } catch (e) {
            // animation is optional polish; never block the page
        }
    }
</script>
@endpush
@endsection

