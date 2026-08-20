<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#060506">

    <title>@yield('title', config('app.name', 'Severus Cues')) — Reaper Edition</title>
    <meta name="description" content="Severus Cues — Premium Billiard Cues, High-Friction Venom Chalk & Accessories. Official Tokopedia, Shopee & Instagram Partner.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & Vite CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        venom: {
                            base: '#070d0a',
                            card: '#0d1712',
                            emerald: '#00E676',
                            accent: '#10B981',
                            glow: 'rgba(0, 230, 118, 0.28)',
                        },
                        reaper: {
                            base: '#080608',
                            card: '#120e11',
                            red: '#E23B3B',
                            flame: '#FF4D5E',
                            glow: 'rgba(234, 59, 59, 0.30)',
                        },
                        obsidian: '#060506',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                        cinzel: ['Cinzel', 'serif'],
                        mono: ['JetBrains Mono', 'ui-monospace', 'monospace'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS (Grim Reaper / Snake design system) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- anime.js — entrance choreography -->
    <script defer src="https://cdn.jsdelivr.net/npm/animejs@4.0.0/dist/anime.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body x-data="{ 
        currentTheme: 'reaper',
        isDarkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleDarkMode() {
            this.isDarkMode = !this.isDarkMode;
            if (this.isDarkMode) {
                localStorage.theme = 'dark';
                document.documentElement.classList.add('dark');
            } else {
                localStorage.theme = 'light';
                document.documentElement.classList.remove('dark');
            }
        }
    }" 
    class="{{ request()->is('admin*') ? 'bg-gray-50 dark:bg-obsidian text-gray-900 dark:text-slate-100' : 'bg-obsidian text-slate-100' }} antialiased min-h-screen flex flex-col justify-between overflow-x-hidden relative transition-colors duration-300">

    <!-- Fixed Infinite Carbon Background + Pure-CSS Snake Scale Overlay -->
    <div class="reaper-infinite-bg"></div>
    <div class="snake-scale-overlay" aria-hidden="true"></div>

    <!-- App Header & Navigation -->
    @yield('header')

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Reaper Footer with Build Version -->
    <footer class="bg-[#070607] border-t border-white/10 py-12 px-4 sm:px-6 lg:px-8 mt-24">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Severus Logo" class="h-9 w-auto">
                <div class="flex flex-col">
                    <span class="font-black text-lg text-white tracking-widest uppercase font-outfit">SEVERUS <span class="text-[#E23B3B]">CUES</span></span>
                    <span class="text-[9px] uppercase tracking-[0.28em] text-slate-500 font-bold">Reaper Edition</span>
                </div>
            </div>

            <div class="flex flex-col items-center sm:items-end gap-2 text-xs text-slate-500 font-medium">
                <span>&copy; {{ date('Y') }} Severus Cues. Strike. Slither. Prevail.</span>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full border border-white/10 bg-white/5 font-mono text-[10px] text-slate-400 tracking-wider">
                    BUILD
                    <span class="ml-1.5 px-2 py-0.5 rounded bg-[#E23B3B]/15 border border-[#E23B3B]/30 text-[#E23B3B] font-bold">{{ \App\Support\Version::current() }}</span>
                </span>
            </div>
        </div>
    </footer>

    <!-- Global Scroll-Reveal / Motion Observer -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -60px 0px',
                threshold: 0.12
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));

            // Respect reduced-motion: kill heavy loops
            const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (prefersReduced) {
                document.documentElement.classList.add('motion-reduced');
                document.querySelectorAll('.ember-particle').forEach(p => p.remove());
            }
        });
    </script>

    <!-- Page-specific scripts (pushed from child views) -->
    @stack('scripts')
</body>
</html>

