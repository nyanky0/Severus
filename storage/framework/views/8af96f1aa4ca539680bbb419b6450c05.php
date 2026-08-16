<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Severus Cues')); ?> - Venom Precision Billiards</title>
    <meta name="description" content="Severus Cues - Premium Billiard Cues, High-Friction Toxic Chalk & Accessories. Official Tokopedia, Shopee & Instagram Partner.">

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
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    
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
    <?php echo $__env->yieldContent('header'); ?>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- App Footer with Official Tokopedia, Shopee & Instagram Brand Logos -->
    <footer class="bg-[#070b09] border-t border-[#141d17] py-12 px-4 sm:px-6 lg:px-8 mt-24">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-3">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Logo" class="h-9 w-auto">
                <span class="font-black text-xl text-white tracking-widest uppercase">SEVERUS <span class="text-[#00E676]">CUES</span></span>
            </div>

            <!-- Official Store Logos -->
            <div class="flex flex-wrap items-center justify-center gap-6 text-xs text-slate-400 font-bold uppercase tracking-wider">
                <a href="https://www.tokopedia.com/severus" target="_blank" class="hover:text-[#42b549] transition-colors flex items-center">
                    <img src="<?php echo e(asset('images/tokopedia.png')); ?>" alt="Tokopedia" class="h-4 w-4 mr-1.5 object-contain">
                    Tokopedia
                </a>
                <a href="https://shopee.co.id/severuscues" target="_blank" class="hover:text-[#ee4d2d] transition-colors flex items-center">
                    <img src="<?php echo e(asset('images/shopee.png')); ?>" alt="Shopee" class="h-4 w-4 mr-1.5 object-contain">
                    Shopee
                </a>
                <a href="https://www.instagram.com/severuscues/" target="_blank" class="hover:text-[#E1306C] transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-[#E1306C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    Instagram
                </a>
            </div>

            <div class="text-xs text-slate-500">
                &copy; <?php echo e(date('Y')); ?> Severus Cues. Strike With Venom Precision.
            </div>
        </div>
    </footer>

    <!-- Global Auto-Scroll & Motion Observer Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Framer Motion Style Scroll Reveal Observer
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.10
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>