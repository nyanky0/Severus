<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Severus Cues') }} - Venom Precision Billiards</title>
    <meta name="description" content="Severus Cues - Premium Billiard Cues, High-Friction Toxic Chalk & Accessories. Official Tokopedia Store Partner.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & Vite CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        venom: {
                            base: '#0A0F0D',
                            card: '#141D17',
                            emerald: '#00E676',
                            accent: '#10B981',
                            glow: 'rgba(0, 230, 118, 0.25)',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 6rem;
        }
        .navbar-gradient-blur {
            background: linear-gradient(180deg, rgba(10, 15, 13, 0.98) 0%, rgba(10, 15, 13, 0.88) 65%, rgba(10, 15, 13, 0.50) 90%, rgba(10, 15, 13, 0) 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
        .venom-card {
            background: linear-gradient(135deg, rgba(20, 29, 23, 0.80) 0%, rgba(10, 15, 13, 0.92) 100%);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(0, 230, 118, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .venom-card:hover {
            border-color: rgba(0, 230, 118, 0.55);
            box-shadow: 0 12px 40px 0 rgba(0, 230, 118, 0.22), 0 0 20px rgba(0, 230, 118, 0.15);
            transform: translateY(-4px);
        }
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-[#0A0F0D] text-slate-100 antialiased selection:bg-[#00E676] selection:text-black min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- App Header & Navigation -->
    @yield('header')

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- App Footer -->
    <footer class="bg-[#070b09] border-t border-[#141d17] py-12 px-4 sm:px-6 lg:px-8 mt-24">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Severus Logo" class="h-9 w-auto">
                <span class="font-black text-xl text-white tracking-widest uppercase">SEVERUS <span class="text-[#00E676]">CUES</span></span>
            </div>

            <div class="flex items-center space-x-6 text-xs text-slate-400 font-medium">
                <a href="#home" class="hover:text-[#00E676] transition-colors">Home</a>
                <a href="#cues" class="hover:text-[#00E676] transition-colors">Cues</a>
                <a href="#chalk" class="hover:text-[#00E676] transition-colors">Chalk</a>
                <a href="#accessories" class="hover:text-[#00E676] transition-colors">Accessories</a>
                <a href="https://www.tokopedia.com/severus" target="_blank" class="hover:text-[#42b549] transition-colors">Tokopedia Store</a>
            </div>

            <div class="text-xs text-slate-500">
                &copy; {{ date('Y') }} Severus Cues. Strike With Venom Precision.
            </div>
        </div>
    </footer>

    <!-- Framer Motion Style Intersection Observer & Smooth Scroll JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Framer Motion Style Scroll Reveal Observer
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
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

            // 2. Smooth Offset Scroll Handler for Nav Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId !== '#') {
                        const targetEl = document.querySelector(targetId);
                        if (targetEl) {
                            e.preventDefault();
                            const navOffset = 90; // Fixed navbar height offset
                            const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - navOffset;

                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });

            // 3. Smooth Window Resize Observer (Prevents CLS layout shift)
            let resizeTimer;
            window.addEventListener('resize', () => {
                document.body.classList.add('is-resizing');
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    document.body.classList.remove('is-resizing');
                }, 200);
            });
        });
    </script>
</body>
</html>
