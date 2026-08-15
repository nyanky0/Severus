<?php $__env->startSection('content'); ?>
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 venom-card p-6 rounded-2xl">
        <div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-wider"><?php echo e(__('app.admin.title')); ?></h1>
                <span class="px-2.5 py-1 rounded bg-[#00e676]/20 text-[#00e676] text-xs font-bold border border-[#00e676]/40">Active Team Session</span>
            </div>
            <p class="text-xs text-slate-400 mt-1"><?php echo e(__('app.admin.welcome')); ?> &bull; Admin Portal</p>
        </div>

        <div class="flex items-center space-x-3">
            <form action="<?php echo e(route('admin.tokopedia.sync')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-[#42b549] hover:bg-[#369b3d] text-white font-extrabold text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(66,181,73,0.4)] flex items-center transition-all">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <?php echo e(__('app.admin.sync_now')); ?>

                </button>
            </form>

            <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-[#121a15] hover:bg-red-500/20 border border-[#1f2e24] hover:border-red-500/40 text-slate-300 hover:text-red-400 font-bold text-xs uppercase transition-colors">
                    <?php echo e(__('app.admin.logout')); ?>

                </button>
            </form>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="p-4 rounded-xl bg-[#00e676]/10 border border-[#00e676]/40 text-[#00e676] text-sm font-semibold">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Quick Navigation Links -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="<?php echo e(route('admin.products.index')); ?>" class="venom-card p-6 rounded-2xl group flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 block uppercase">Product Catalog</span>
                <span class="text-2xl font-black text-white group-hover:text-[#00e676] transition-colors"><?php echo e($totalProducts); ?> Items</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#00e676]/10 border border-[#00e676]/30 flex items-center justify-center text-[#00e676] group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </a>

        <a href="<?php echo e(route('admin.products.create')); ?>" class="venom-card p-6 rounded-2xl group flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 block uppercase">Content Upload</span>
                <span class="text-2xl font-black text-white group-hover:text-[#00e676] transition-colors">+ Add Product</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#00e676]/10 border border-[#00e676]/30 flex items-center justify-center text-[#00e676] group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
        </a>

        <a href="<?php echo e(route('admin.contents.index')); ?>" class="venom-card p-6 rounded-2xl group flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 block uppercase">Marketing Copy</span>
                <span class="text-2xl font-black text-white group-hover:text-[#00e676] transition-colors">Edit Banners</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#00e676]/10 border border-[#00e676]/30 flex items-center justify-center text-[#00e676] group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 012.828 0l2.828 2.828a2 2 0 010 2.828l-8.414 8.414H9v-2.828l8.586-8.586z"></path></svg>
            </div>
        </a>
    </div>

    <!-- Tokopedia Sync Audit Log -->
    <div class="venom-card p-6 rounded-2xl space-y-4">
        <h3 class="text-lg font-bold text-white uppercase tracking-wider flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#42b549]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            Tokopedia Live Sync Audit Logs
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-[#0a0f0d] text-slate-400 uppercase font-bold border-b border-[#1f2e24]">
                    <tr>
                        <th class="p-3">Product Name</th>
                        <th class="p-3">Old Price (IDR)</th>
                        <th class="p-3">Synced Price (IDR)</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1f2e24]">
                    <?php $__empty_1 = true; $__currentLoopData = $recentSyncLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="p-3 font-semibold text-white"><?php echo e($log->product->name ?? 'System Verification'); ?></td>
                            <td class="p-3">Rp <?php echo e(number_format($log->old_price_idr, 0, ',', '.')); ?></td>
                            <td class="p-3 text-[#00e676] font-bold">Rp <?php echo e(number_format($log->new_price_idr, 0, ',', '.')); ?></td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold <?php echo e($log->status === 'SUCCESS' ? 'bg-green-500/20 text-green-400' : 'bg-slate-500/20 text-slate-400'); ?>">
                                    <?php echo e($log->status); ?>

                                </span>
                            </td>
                            <td class="p-3 text-slate-500"><?php echo e($log->created_at->format('Y-m-d H:i:s')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-slate-500">No sync logs recorded yet. Click "Sync Tokopedia Prices Now" above.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>