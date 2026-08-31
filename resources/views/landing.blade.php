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
                <a href="#shaft-guide" @click.prevent="$dispatch('scroll-to', 'shaft-guide')" class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.shaft_guide') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
                <a href="{{ route('products.index') }}"  class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.collection') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
                {{-- OPTIONAL: To re-enable Technology link, uncomment below:
                <a href="#technology" @click.prevent="$dispatch('scroll-to', 'technology')" class="transition-colors py-1 relative group cursor-pointer" :class="currentTheme === 'venom' ? 'hover:text-[#00E676]' : 'hover:text-[#E23B3B]'">
                    {{ __('app.nav.technology') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                </a>
                --}}
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
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'shaft-guide')" href="#shaft-guide" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.shaft_guide') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a  href="{{ route('products.index') }}" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.collection') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            {{-- OPTIONAL: To re-enable Technology link, uncomment below:
            <a @click.prevent="mobileMenuOpen = false; $dispatch('scroll-to', 'technology')" href="#technology" class="py-3 min-h-[48px] px-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-between cursor-pointer">
                <span>{{ __('app.nav.technology') }}</span>
                <svg class="w-4 h-4" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            --}}
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

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal whitespace-pre-line">
                    {{ $siteContents['hero_subtitle'] ?? __('app.hero.subtitle') }}
                </p>


                <!-- Hero CTAs -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-4">
                    <a href="{{ route('products.index') }}" 
                       class="px-7 py-4 rounded-2xl flex items-center justify-center text-xs font-black uppercase tracking-wider cursor-pointer transition-all min-h-[48px]"
                       :class="currentTheme === 'venom' ? 'btn-venom' : 'btn-reaper'">
                        <span>{{ __('app.hero.explore_btn') }}</span>
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
    <!-- CARBON VS WOOD — Why Carbon dominates -->
    <!-- ===================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <!-- Left visual: carbon vs wood concept -->
            <div class="lg:col-span-5 relative">
                <div class="aspect-square rounded-3xl bg-gradient-to-br from-[#1a1418] via-[#120e11] to-[#080608] border border-white/10 p-8 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-[2px] h-3/4 bg-gradient-to-b from-transparent via-[#E23B3B]/40 to-transparent rotate-12"></div>
                    </div>
                    <div class="relative z-10 text-center space-y-6">
                        <div class="space-y-1">
                            <span class="text-4xl font-black text-white font-outfit block">CARBON</span>
                            <span class="text-3xl font-black text-[#E23B3B] font-outfit block">&gt;</span>
                            <span class="text-4xl font-black text-slate-500 font-outfit block">WOOD</span>
                        </div>
                        <div class="flex items-center justify-center space-x-4 text-[10px] font-mono text-slate-500 uppercase tracking-widest">
                            <span>Modern Tech</span>
                            <span class="w-2 h-2 rounded-full bg-[#E23B3B]"></span>
                            <span>Traditional</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: benefits list -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full border text-xs font-extrabold uppercase tracking-wider bg-[#E23B3B]/10 border-[#E23B3B]/30 text-[#FF4D5E]">
                    <span class="w-2 h-2 rounded-full bg-[#E23B3B]"></span>
                    <span>Carbon vs. Wood Analysis</span>
                </div>

                <h2 class="text-3xl sm:text-5xl font-black text-white font-cinzel uppercase tracking-tight">
                    WHY CARBON <span class="text-glow-reaper">DOMINATES</span>
                </h2>

                <div class="space-y-4">



                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <div class="w-10 h-10 rounded-xl bg-[#E23B3B]/15 border border-[#E23B3B]/30 flex items-center justify-center shrink-0">
                            <span class="text-sm font-black text-[#E23B3B]">1</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white uppercase">Lightweight</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Carbon fiber shafts are significantly lighter than wood, reducing arm fatigue during long sessions and allowing faster cue ball control.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <div class="w-10 h-10 rounded-xl bg-[#E23B3B]/15 border border-[#E23B3B]/30 flex items-center justify-center shrink-0">
                            <span class="text-sm font-black text-[#E23B3B]">2</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white uppercase">More Durable</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Less prone to warping, damage, or bending over time. Wood shafts warp with humidity and temperature changes — carbon stays true forever.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <div class="w-10 h-10 rounded-xl bg-[#E23B3B]/15 border border-[#E23B3B]/30 flex items-center justify-center shrink-0">
                            <span class="text-sm font-black text-[#E23B3B]">3</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white uppercase">Harder to Bend or Damage</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Perfect for intense players. Carbon's molecular structure resists impact stress that would crack or splinter a wood shaft.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <div class="w-10 h-10 rounded-xl bg-[#E23B3B]/15 border border-[#E23B3B]/30 flex items-center justify-center shrink-0">
                            <span class="text-sm font-black text-[#E23B3B]">4</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white uppercase">Smoother Feel</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Frosted satin finish that's pleasant to the touch. Easy to maintain — a quick wipe down keeps it looking and feeling good as new.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <div class="w-10 h-10 rounded-xl bg-[#E23B3B]/15 border border-[#E23B3B]/30 flex items-center justify-center shrink-0">
                            <span class="text-sm font-black text-[#E23B3B]">5</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white uppercase">Temperature Resistant</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Can withstand extreme temperatures without warping or losing structural integrity. Wood swells, contracts, and cracks.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <div class="w-10 h-10 rounded-xl bg-[#E23B3B]/15 border border-[#E23B3B]/30 flex items-center justify-center shrink-0">
                            <span class="text-sm font-black text-[#E23B3B]">6</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white uppercase">Consistent Straightness</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Carbon's stronger physical structure maintains consistent straightness in the long run. No gradual warping that plagues traditional wood shafts.</p>
                        </div>
                    </div>
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
    <!-- 4. SHAFT GUIDE SECTION (SEVERUS I & REAPER) -->
    <!-- ===================================================== -->
    <section id="shaft-guide" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 scroll-mt-28">
        <!-- Section Header -->
        <div class="text-center space-y-4 reveal-on-scroll">
            <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full border text-xs font-extrabold uppercase tracking-widest transition-all"
                 :class="currentTheme === 'venom' ? 'bg-[#00E676]/10 border-[#00E676]/30 text-[#00E676]' : 'bg-[#E23B3B]/10 border-[#E23B3B]/30 text-[#FF4D5E]'">
                <span class="w-2 h-2 rounded-full animate-ping" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                <span>SEVERUS CARBON SHAFT LINEUP</span>
            </div>

            <!-- Boska Display Title -->
            <h2 class="font-boska font-black text-5xl sm:text-7xl lg:text-8xl text-white tracking-wide drop-shadow-[0_0_25px_rgba(226,59,59,0.4)]">
                Shaft Guide
            </h2>

            <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto font-light leading-relaxed">
                Explore the engineering, pro taper profiles, ferrule construction, and joint compatibility of the Severus flagship carbon fiber shafts.
            </p>
        </div>

        <!-- 2 Column Comparison Grid for Severus I & Reaper -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10">

            <!-- Card 1: SEVERUS I -->
            <div class="p-8 sm:p-10 rounded-3xl relative overflow-hidden transition-all duration-500 reveal-on-scroll border flex flex-col justify-between group"
                 :class="currentTheme === 'venom' 
                    ? 'bg-gradient-to-b from-[#0a140f] to-[#060a08] border-[#00E676]/30 hover:border-[#00E676]/60 shadow-[0_0_30px_rgba(0,230,118,0.15)]' 
                    : 'bg-gradient-to-b from-[#140b0e] to-[#080506] border-[#E23B3B]/30 hover:border-[#E23B3B]/60 shadow-[0_0_30px_rgba(226,59,59,0.15)]'">
                
                <!-- Atmospheric glow -->
                <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full blur-[90px] pointer-events-none opacity-40 transition-all"
                     :class="currentTheme === 'venom' ? 'bg-[#00E676]/20' : 'bg-[#E23B3B]/20'"></div>

                <div class="space-y-8 relative z-10">
                    <!-- Title & Badge -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-white/10">
                        <div>
                            <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-slate-400 font-bold block mb-1">PRO CARBON SHAFT</span>
                            <h3 class="text-3xl sm:text-4xl font-black text-white font-cinzel tracking-wider">
                                SEVERUS I
                            </h3>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-[11px] font-black uppercase tracking-wider bg-white/5 border border-white/15 text-slate-200">
                            Hybrid Pro Taper
                        </span>
                    </div>

                    <!-- Taper Visualizer Diagram (Interactive SVG) -->
                    <div class="p-6 rounded-2xl bg-black/60 border border-white/10 space-y-4">
                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-400 uppercase">
                            <span>Taper Profile</span>
                            <span class="font-bold text-white">Hybrid Pro Taper</span>
                        </div>

                        <!-- SVG Shaft Outline -->
                        <div class="w-full py-3 flex items-center justify-center">
                            <svg class="w-full max-w-[420px] h-20" viewBox="0 0 400 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Background grid marks -->
                                <line x1="20" y1="40" x2="380" y2="40" stroke="rgba(255,255,255,0.06)" stroke-dasharray="4 4" stroke-width="1"/>
                                
                                <!-- Shaft Body Outline -->
                                <polygon points="30,20 220,28 340,30 340,50 220,52 30,60" 
                                         fill="url(#severusGradient)" 
                                         stroke="white" 
                                         stroke-width="2" 
                                         stroke-linejoin="round"/>
                                
                                <!-- Ferrule & Tip -->
                                <rect x="340" y="30" width="16" height="20" fill="#121212" stroke="white" stroke-width="1.5"/>
                                <path d="M356,31 Q364,40 356,49 Z" fill="#00E676" opacity="0.8"/>

                                <!-- Dimension Callouts -->
                                <line x1="370" y1="26" x2="370" y2="54" stroke="#888" stroke-width="1"/>
                                <text x="375" y="34" fill="#FFFFFF" font-size="11" font-weight="900" font-family="Outfit, sans-serif">12.4MM</text>
                                <text x="375" y="52" fill="#888888" font-size="11" font-weight="900" font-family="Outfit, sans-serif">11.8MM</text>

                                <!-- Joint Base mark -->
                                <text x="25" y="74" fill="#666" font-size="9" font-family="Outfit, sans-serif" font-weight="700">JOINT</text>
                                <text x="330" y="74" fill="#00E676" font-size="9" font-family="Outfit, sans-serif" font-weight="700">TIP</text>

                                <defs>
                                    <linearGradient id="severusGradient" x1="30" y1="40" x2="340" y2="40" gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#141414"/>
                                        <stop offset="100%" stop-color="#2a2a2a"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>

                        <div class="text-center">
                            <span class="text-xs font-mono font-black uppercase tracking-[0.2em]" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                                HYBRID PRO TAPER &bull; 12.4MM / 11.8MM
                            </span>
                        </div>
                    </div>

                    <!-- Specs Breakdown -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Key Specs -->
                        <div class="space-y-3">
                            <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400">Specifications</h4>
                            <ul class="space-y-2 text-xs text-slate-200">
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span class="font-bold">STANDARD BLACK TIP (S)</span>
                                </li>
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span class="font-bold">BAKELITE FERRULE BLACK</span>
                                </li>
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span class="font-bold">29 INCH LENGTH</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Compatible Joints -->
                        <div class="space-y-3">
                            <h4 class="text-xs font-mono font-bold uppercase tracking-wider" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                                Compatible Joints
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-black uppercase tracking-wider text-white">
                                    UNILOCK
                                </span>
                                <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-black uppercase tracking-wider text-white">
                                    RADIAL 3/8X8
                                </span>
                                <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-black uppercase tracking-wider text-white">
                                    5/16X18
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-8 border-t border-white/10 flex items-center justify-between">
                    <span class="text-[11px] font-mono text-slate-400">SEVERUS PRECISION I</span>
                    <a href="{{ route('products.index') }}" class="text-xs font-bold uppercase tracking-wider hover:underline" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                        Browse Cues &rarr;
                    </a>
                </div>
            </div>


            <!-- Card 2: REAPER (Flagship Edition) -->
            <div class="p-8 sm:p-10 rounded-3xl relative overflow-hidden transition-all duration-500 reveal-on-scroll border flex flex-col justify-between group"
                 :class="currentTheme === 'venom'
                    ? 'bg-gradient-to-b from-[#0a1811] via-[#08100c] to-[#050806] border-[#00E676]/40 hover:border-[#00E676]/80 shadow-[0_0_40px_rgba(0,230,118,0.25)]'
                    : 'bg-gradient-to-b from-[#1f0d11] via-[#12080a] to-[#080405] border-[#E23B3B]/40 hover:border-[#E23B3B]/80 shadow-[0_0_40px_rgba(226,59,59,0.25)]'">
                
                <!-- Red / Crimson atmospheric smoke glow -->
                <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full blur-[100px] pointer-events-none opacity-60 transition-all animate-pulse"
                     :class="currentTheme === 'venom' ? 'bg-[#00E676]/25' : 'bg-[#E23B3B]/30'"></div>

                <div class="space-y-8 relative z-10">
                    <!-- Title & Badge -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-white/10">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-3xl sm:text-4xl font-black font-boska tracking-wide text-white drop-shadow-[0_0_15px_rgba(226,59,59,0.5)]">
                                Reaper
                            </h3>
                            <!-- Grim Reaper Silhouette SVG Icon matching the poster -->
                            <div class="w-10 h-10 rounded-full flex items-center justify-center p-1"
                                 :class="currentTheme === 'venom' ? 'bg-[#00E676]/20 text-[#00E676]' : 'bg-[#E23B3B]/20 text-[#E23B3B]'">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C7.5 2 4.5 5.5 4.5 10c0 3.2 1.8 6 4.5 7.5V22l3-2 3 2v-4.5c2.7-1.5 4.5-4.3 4.5-7.5 0-4.5-3-8-7.5-8zm0 2.5c3.2 0 5.2 2.7 5.2 5.5 0 2.8-2 5.2-5.2 5.2s-5.2-2.4-5.2-5.2c0-2.8 2-5.5 5.2-5.5zm7 2l3.5-3.5-1.4-1.4L18 4.2V2h-2v3.8l-1.5 1.5 1.4 1.4L17.5 7v13h2V6.5z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-[11px] font-black uppercase tracking-wider font-mono shadow-[0_0_15px_rgba(226,59,59,0.4)]"
                              :class="currentTheme === 'venom' ? 'bg-[#00E676] text-black' : 'bg-[#E23B3B] text-white'">
                            True Pro Taper
                        </span>
                    </div>

                    <!-- Taper Visualizer Diagram (Interactive SVG) -->
                    <div class="p-6 rounded-2xl bg-black/70 border border-white/15 space-y-4">
                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-400 uppercase">
                            <span>Taper Profile</span>
                            <span class="font-bold" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#FF4D5E]'">True Pro Taper (Stepped)</span>
                        </div>

                        <!-- SVG Shaft Outline -->
                        <div class="w-full py-3 flex items-center justify-center">
                            <svg class="w-full max-w-[420px] h-20" viewBox="0 0 400 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Background grid marks -->
                                <line x1="20" y1="40" x2="380" y2="40" stroke="rgba(255,255,255,0.06)" stroke-dasharray="4 4" stroke-width="1"/>
                                
                                <!-- Shaft Body Outline with Extended Straight Pro Taper -->
                                <polygon points="30,20 180,30 250,30 340,30 340,50 250,50 180,50 30,60" 
                                         fill="url(#reaperGradient)" 
                                         stroke="white" 
                                         stroke-width="2" 
                                         stroke-linejoin="round"/>
                                
                                <!-- Juma White Ferrule & Clear Tip -->
                                <rect x="340" y="30" width="16" height="20" fill="#F8FAFC" stroke="white" stroke-width="1.5"/>
                                <path d="M356,31 Q364,40 356,49 Z" fill="#E23B3B" opacity="0.9"/>

                                <!-- Dimension Callouts -->
                                <line x1="370" y1="22" x2="370" y2="58" stroke="#888" stroke-width="1"/>
                                <text x="375" y="28" fill="#FFFFFF" font-size="11" font-weight="900" font-family="Outfit, sans-serif">12.4MM</text>
                                <text x="375" y="44" fill="#E23B3B" font-size="11" font-weight="900" font-family="Outfit, sans-serif">12.2MM</text>
                                <text x="375" y="58" fill="#888888" font-size="11" font-weight="900" font-family="Outfit, sans-serif">11.8MM</text>

                                <!-- Joint Base mark -->
                                <text x="25" y="74" fill="#666" font-size="9" font-family="Outfit, sans-serif" font-weight="700">JOINT</text>
                                <text x="330" y="74" fill="#E23B3B" font-size="9" font-family="Outfit, sans-serif" font-weight="700">TIP</text>

                                <defs>
                                    <linearGradient id="reaperGradient" x1="30" y1="40" x2="340" y2="40" gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#1f0a0d"/>
                                        <stop offset="60%" stop-color="#3d1419"/>
                                        <stop offset="100%" stop-color="#1a0a0c"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>

                        <div class="text-center">
                            <span class="text-xs font-mono font-black uppercase tracking-[0.2em]" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#FF4D5E]'">
                                TRUE PRO TAPER &bull; 12.4MM / 12.2MM / 11.8MM
                            </span>
                        </div>
                    </div>

                    <!-- Specs Breakdown -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Key Specs -->
                        <div class="space-y-3">
                            <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400">Specifications</h4>
                            <ul class="space-y-2 text-xs text-slate-200">
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                                    <span class="font-bold">SEVERUS PREMIUM CLEAR TIP (S)</span>
                                </li>
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                                    <span class="font-bold">JUMA FERRULE WHITE</span>
                                </li>
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                                    <span class="font-bold">SUPER LOW DEFLECTION</span>
                                </li>
                                <li class="flex items-center space-x-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                                    <span class="font-bold">30 INCH LENGTH</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Compatible Joints -->
                        <div class="space-y-3">
                            <h4 class="text-xs font-mono font-bold uppercase tracking-wider" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                                Compatible Joints
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-black uppercase tracking-wider text-white">
                                    UNILOCK
                                </span>
                                <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-black uppercase tracking-wider text-white">
                                    RADIAL 3/8X8
                                </span>
                                <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-black uppercase tracking-wider text-white">
                                    WAVY
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-8 border-t border-white/10 flex items-center justify-between">
                    <span class="text-[11px] font-mono" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">REAPER EDITION FLAGSHIP</span>
                    <a href="{{ route('products.index') }}" class="text-xs font-bold uppercase tracking-wider hover:underline" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                        Browse Cues &rarr;
                    </a>
                </div>
            </div>

        </div>

        <!-- Play Shaft Spotlight Banner with Cleaned Image & Rich Typography -->
        <div class="p-8 sm:p-12 rounded-3xl relative overflow-hidden transition-all duration-500 reveal-on-scroll border"
             :class="currentTheme === 'venom' 
                ? 'bg-gradient-to-br from-[#0a1811] via-[#0d1f16] to-[#060a08] border-[#00E676]/30 shadow-[0_0_40px_rgba(0,230,118,0.15)]' 
                : 'bg-gradient-to-br from-[#1c0d12] via-[#14080b] to-[#080405] border-[#E23B3B]/30 shadow-[0_0_40px_rgba(226,59,59,0.2)]'">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <!-- Left: Text & Captions (Clean, high-legibility HTML text) -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full border text-[11px] font-extrabold uppercase tracking-wider"
                         :class="currentTheme === 'venom' ? 'bg-[#00E676]/10 border-[#00E676]/30 text-[#00E676]' : 'bg-[#E23B3B]/10 border-[#E23B3B]/30 text-[#FF4D5E]'">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        <span>AUTHENTIC SOLID CARBON FIBER</span>
                    </div>

                    <h3 class="font-cinzel text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-wider uppercase">
                        PLAY SHAFT
                    </h3>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                        Our cues feature authentic carbon construction, not just carbon layers. Elevate your game with a free cue sleeve + joint protector. Perfect for both beginners and pro players, our shafts offer low deflection, a smooth feel, and unrivaled consistency. Make the transition to carbon fiber and discover a new level of precision.
                    </p>

                    <!-- Feature pills -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                            <span class="text-xs font-mono font-bold text-white uppercase block">Free Accessories</span>
                            <p class="text-xs text-slate-400">Includes protective cue sleeve & matching joint protector.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                            <span class="text-xs font-mono font-bold uppercase block" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#FF4D5E]'">100% Solid Carbon</span>
                            <p class="text-xs text-slate-400">Authentic multi-axial weave, not surface coating.</p>
                        </div>
                    </div>

                    <div class="pt-2 flex flex-wrap gap-4">
                        <a href="{{ route('products.index') }}" 
                           class="px-7 py-3.5 rounded-2xl font-black text-xs uppercase tracking-wider transition-all min-h-[48px] flex items-center justify-center cursor-pointer"
                           :class="currentTheme === 'venom' ? 'btn-venom' : 'btn-reaper'">
                            Explore All Shafts
                        </a>
                    </div>
                </div>

                <!-- Right: Cleaned Photo Showcase -->
                <div class="lg:col-span-6 relative rounded-2xl overflow-hidden border border-white/10 group shadow-2xl">
                    <img src="{{ asset('images/carbon_play_shaft_clean.jpg') }}" 
                         alt="Severus Carbon Play Shafts Detail" 
                         class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>

        <!-- Watermark Footer in section -->
        <div class="text-center pt-2">
            <span class="font-cinzel text-xl sm:text-2xl font-black tracking-[0.35em] text-white/20 uppercase">
                SEVERUS
            </span>
        </div>
    </section>

    <!-- ===================================================== -->
    <!-- 5. EDGAR ALLAN POE PHILOSOPHY & BRAND MANIFESTO -->
    <!-- ===================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Edgar Allan Poe Gothic Quote Banner (Pure Typography Caption) -->
        <div class="relative p-8 sm:p-12 rounded-3xl border overflow-hidden text-center reveal-on-scroll"
             :class="currentTheme === 'venom' 
                ? 'bg-gradient-to-r from-[#060a08] via-[#0d1712] to-[#060a08] border-[#00E676]/30 shadow-[0_0_40px_rgba(0,230,118,0.12)]' 
                : 'bg-gradient-to-r from-[#0a0507] via-[#160a0d] to-[#0a0507] border-[#E23B3B]/30 shadow-[0_0_40px_rgba(226,59,59,0.18)]'">
            
            <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-80 h-80 rounded-full blur-[90px] pointer-events-none opacity-40"
                 :class="currentTheme === 'venom' ? 'bg-[#00E676]/20' : 'bg-[#E23B3B]/25'"></div>

            <div class="relative z-10 space-y-4 max-w-3xl mx-auto">
                <span class="text-4xl sm:text-5xl font-cinzel select-none block opacity-40 leading-none"
                      :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">
                    &ldquo;
                </span>

                <blockquote class="text-xl sm:text-2xl lg:text-3xl font-cinzel font-black tracking-wider uppercase leading-relaxed text-white"
                            :class="currentTheme === 'venom' ? 'text-glow-venom' : 'text-glow-reaper'">
                    “There is no exquisite beauty... without some strangeness in the proportion.”
                </blockquote>

                <div class="pt-3 flex items-center justify-center space-x-3">
                    <span class="w-10 h-[1px] bg-white/20"></span>
                    <span class="text-xs font-mono uppercase tracking-[0.25em] text-slate-400 font-bold">
                        EDGAR ALLAN POE
                    </span>
                    <span class="w-10 h-[1px] bg-white/20"></span>
                </div>
            </div>
        </div>

        <!-- 2-Column Lifestyle Photography Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
            
            <!-- Left Photo: Quote on Red Felt ("Where the game is not just played, it's lived") -->
            <div class="group relative rounded-3xl overflow-hidden border p-2.5 transition-all duration-500 reveal-on-scroll"
                 :class="currentTheme === 'venom' 
                    ? 'border-[#00E676]/30 hover:border-[#00E676]/60 bg-[#0a140f]/60 shadow-[0_0_35px_rgba(0,230,118,0.15)]' 
                    : 'border-[#E23B3B]/30 hover:border-[#E23B3B]/60 bg-[#140b0e]/60 shadow-[0_0_35px_rgba(226,59,59,0.2)]'">
                
                <div class="relative rounded-2xl overflow-hidden aspect-square flex items-center justify-center bg-black/40">
                    <img src="{{ asset('images/lifestyle_quote.jpg') }}" 
                         alt="Severus - Where the game is not just played, it's lived" 
                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>

            <!-- Right Photo: Joint Precision & Assembly Close-up -->
            <div class="group relative rounded-3xl overflow-hidden border p-2.5 transition-all duration-500 reveal-on-scroll delay-150"
                 :class="currentTheme === 'venom' 
                    ? 'border-[#00E676]/30 hover:border-[#00E676]/60 bg-[#0a140f]/60 shadow-[0_0_35px_rgba(0,230,118,0.15)]' 
                    : 'border-[#E23B3B]/30 hover:border-[#E23B3B]/60 bg-[#140b0e]/60 shadow-[0_0_35px_rgba(226,59,59,0.2)]'">
                
                <div class="relative rounded-2xl overflow-hidden aspect-square flex items-center justify-center bg-black/40">
                    <img src="{{ asset('images/lifestyle_joint.jpg') }}" 
                         alt="Severus Cue Joint Detail and Craftsmanship" 
                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>

        </div>
    </section>

    {{-- 
    [HIDDEN SECTION: 6. SPECIFICATIONS & CRAFTSMANSHIP (01-04 NUMBERED CARDS)]
    To re-enable this section on the home page, remove the opening and closing comment tags of this block.

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
    --}}


    {{-- 
    [HIDDEN SECTION: 7. CUE TECHNOLOGY SPOTLIGHT (0.12mm DEFLECTION, 99.8% CHALK RETENTION)]
    To re-enable this section on the home page, remove the opening and closing comment tags of this block.

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
    --}}


    {{-- 
    [HIDDEN SECTION: 8. FINALE BANNER — STRIKE WITH REAPER PRECISION]
    To re-enable this section on the home page, remove the opening and closing comment tags of this block.

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
    --}}


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

