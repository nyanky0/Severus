<?php $__env->startSection('content'); ?>
<div class="min-h-screen pt-28 pb-16 flex items-center justify-center px-4">
    <div class="max-w-md w-full venom-card p-8 rounded-2xl border border-[#00e676]/40 shadow-[0_0_30px_rgba(0,230,118,0.2)]">
        <div class="text-center mb-8">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Severus Logo" class="h-16 w-auto mx-auto object-contain filter drop-shadow-[0_0_10px_rgba(0,230,118,0.8)]">
            <h2 class="text-2xl font-black text-white mt-4 uppercase tracking-wider"><?php echo e(__('app.admin.title')); ?></h2>
            <p class="text-xs text-slate-400 mt-1">Authorized Severus Team Access Only</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/40 text-red-400 text-xs">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.login.submit')); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Team Email</label>
                <input type="email" name="email" value="<?php echo e(old('email', 'admin@severus.com')); ?>" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] focus:border-[#00e676] text-white text-sm outline-none transition-colors">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] focus:border-[#00e676] text-white text-sm outline-none transition-colors">
            </div>

            <div class="flex items-center justify-between text-xs text-slate-400">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="rounded bg-[#0a0f0d] border-[#1f2e24] text-[#00e676]">
                    <span>Remember Me</span>
                </label>
                <span class="text-[10px] text-slate-500">Default: admin@severus.com / severus123</span>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_20px_rgba(0,230,118,0.4)] hover:shadow-[0_0_30px_rgba(0,230,118,0.6)] transition-all">
                <?php echo e(__('app.admin.login')); ?>

            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/login.blade.php ENDPATH**/ ?>