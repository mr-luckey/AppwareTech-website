<?php $__env->startSection('title', 'Our Services - ' . \App\Models\Setting::get('site_name')); ?>
<?php $__env->startSection('meta_description', 'Explore our comprehensive range of professional services designed to help your business grow.'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5 mt-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold" style="font-size: 4rem; color: #ffffff;">Our Services</h1>
            <p class="lead" style="font-size: 1.4rem; color: rgba(255,255,255,0.85);">Comprehensive solutions tailored for your business needs</p>
        </div>
    </div>
    
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
            <div class="card h-100 border-0 shadow-sm card-hover text-center p-4">
                <div class="service-icon mx-auto">
                    <i class="<?php echo e($service->icon ?: 'fas fa-cogs'); ?> fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title h4 mb-3" style="color: #ffffff; font-size: 2rem;"><?php echo e($service->name); ?></h5>
                    <p class="card-text" style="color: rgba(255,255,255,0.8); font-size: 1.1rem;"><?php echo e(Illuminate\Support\Str::limit($service->description, 200)); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center" style="color: rgba(255,255,255,0.7);">
            <h3>No services available yet.</h3>
            <p>Please check back later or contact us for custom solutions.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/frontend/services/index.blade.php ENDPATH**/ ?>