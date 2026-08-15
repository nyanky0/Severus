<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Severus Cues')); ?> - <?php echo e(__('app.brand_tagline')); ?></title>

    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN + Custom Styles for immediate rendering -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        venom: {
                            50: '#e6fffa',
                            100: '#b2f5ea',
                            400: '#38b2ac',
                            500: '#00e676',
                            600: '#10b981',
                            800: '#064e3b',
                            900: '#0a0f0d',
                            950: '#050806',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <style>
        body {
            background-color: #0a0f0d;
            color: #f1f5f9;
            font-family: 'Outfit', 'Inter', sans-serif;
        }
        .venom-card {
            background: linear-gradient(180deg, rgba(18, 26, 21, 0.95) 0%, rgba(10, 15, 13, 0.98) 100%);
            border: 1px solid rgba(31, 46, 36, 0.9);
            backdrop-filter: blur(16px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .venom-card:hover {
            border-color: rgba(0, 230, 118, 0.6);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -10px rgba(0, 230, 118, 0.3);
        }
        .venom-glow-text {
            text-shadow: 0 0 20px rgba(0, 230, 118, 0.5);
        }
    </style>
</head>
<body class="bg-[#0a0f0d] text-slate-100 antialiased selection:bg-[#00e676] selection:text-black">

    <!-- Global Layout Wrapper -->
    <div class="min-h-screen flex flex-col justify-between relative overflow-hidden">
        
        <!-- Ambient Venom Green Radial Background Blur -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-gradient-to-b from-[#00e676]/15 via-[#10b981]/5 to-transparent rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute top-[40%] right-[-200px] w-[500px] h-[500px] bg-[#00e676]/10 rounded-full blur-3xl pointer-events-none z-0"></div>

        <!-- Content Body -->
        <main class="relative z-10 flex-grow">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 bg-[#050806] border-t border-[#1f2e24] py-12 px-4 sm:px-6 lg:px-8 mt-20">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Cues Logo" class="h-10 w-auto object-contain rounded filter drop-shadow-[0_0_8px_rgba(0,230,118,0.5)]">
                        <span class="text-2xl font-extrabold tracking-wider text-white">SEVERUS <span class="text-[#00e676]">CUES</span></span>
                    </div>
                    <p class="text-slate-400 text-sm max-w-md leading-relaxed">
                        <?php echo e(__('app.footer.about')); ?>

                    </p>
                    <div class="mt-4 flex items-center space-x-3">
                        <a href="https://www.tokopedia.com/severus" target="_blank" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#42b549]/20 hover:bg-[#42b549]/30 border border-[#42b549]/40 text-[#42b549] font-medium text-xs tracking-wider uppercase transition-all">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            Tokopedia Official Store
                        </a>
                    </div>
                </div>

                <!-- Quick Navigation -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-[#00e676] mb-4">Navigation</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="#cues" class="hover:text-[#00e676] transition-colors"><?php echo e(__('app.nav.cues')); ?></a></li>
                        <li><a href="#chalk" class="hover:text-[#00e676] transition-colors"><?php echo e(__('app.nav.chalk')); ?></a></li>
                        <li><a href="#accessories" class="hover:text-[#00e676] transition-colors"><?php echo e(__('app.nav.accessories')); ?></a></li>
                        <li><a href="#technology" class="hover:text-[#00e676] transition-colors"><?php echo e(__('app.nav.technology')); ?></a></li>
                    </ul>
                </div>

                <!-- Language & Team Access -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-[#00e676] mb-4">Portal & Language</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="px-3 py-1 text-xs rounded font-bold border transition-colors <?php echo e(app()->getLocale() === 'en' ? 'bg-[#00e676] text-black border-[#00e676]' : 'border-[#1f2e24] text-slate-400 hover:text-white'); ?>">EN</a>
                            <a href="<?php echo e(route('lang.switch', 'id')); ?>" class="px-3 py-1 text-xs rounded font-bold border transition-colors <?php echo e(app()->getLocale() === 'id' ? 'bg-[#00e676] text-black border-[#00e676]' : 'border-[#1f2e24] text-slate-400 hover:text-white'); ?>">ID</a>
                        </div>
                        <div>
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-xs text-[#00e676] hover:underline flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                    <?php echo e(__('app.nav.dashboard')); ?>

                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('admin.login')); ?>" class="text-xs text-slate-400 hover:text-white flex items-center transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    <?php echo e(__('app.footer.team_access')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="max-w-7xl mx-auto mt-10 pt-6 border-t border-[#1f2e24] flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
                <p>&copy; <?php echo e(date('Y')); ?> Severus Cues. <?php echo e(__('app.footer.rights')); ?></p>
                <p class="mt-2 md:mt-0">Venom Green Edition &bull; Tokopedia Store Verified</p>
            </div>
        </footer>
    </div>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>