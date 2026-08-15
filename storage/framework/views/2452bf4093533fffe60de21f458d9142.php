<?php $__env->startSection('content'); ?>
<div class="min-h-screen pt-28 pb-16 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between venom-card p-6 rounded-2xl">
        <div>
            <h1 class="text-2xl font-black text-white uppercase tracking-wider">Marketing Banners & Text Editor</h1>
            <p class="text-xs text-slate-400">Update hero headlines, subtitles, and promotional copy in English and Indonesian</p>
        </div>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-4 py-2 rounded-xl bg-[#121a15] border border-[#1f2e24] text-slate-300 text-xs font-bold uppercase">
            &larr; Back to Dashboard
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="p-4 rounded-xl bg-[#00e676]/10 border border-[#00e676]/40 text-[#00e676] text-sm font-semibold">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.contents.update')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>

        <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="venom-card p-6 rounded-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-[#1f2e24] pb-3">
                    <span class="text-xs font-black text-[#00e676] uppercase tracking-wider"><?php echo e($content->key_name); ?></span>
                    <span class="text-[10px] text-slate-500 uppercase">Section: <?php echo e($content->section); ?></span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase mb-1">English Text</label>
                        <textarea name="contents[<?php echo e($content->id); ?>][value_en]" rows="2" class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm"><?php echo e($content->value_en); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase mb-1">Indonesian Text</label>
                        <textarea name="contents[<?php echo e($content->id); ?>][value_id]" rows="2" class="w-full px-4 py-3 rounded-xl bg-[#0a0f0d] border border-[#1f2e24] text-white text-sm"><?php echo e($content->value_id); ?></textarea>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#00e676] to-[#10b981] text-black font-extrabold text-xs uppercase tracking-wider shadow-[0_0_25px_rgba(0,230,118,0.4)]">
            Save All Content Updates
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/contents/index.blade.php ENDPATH**/ ?>