<?php $__env->startSection('title', 'Job Opportunities - ' . \App\Models\Setting::get('site_name')); ?>
<?php $__env->startSection('meta_description', 'Find latest job opportunities at ' . \App\Models\Setting::get('site_name')); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5 mt-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold" style="color: #ffffff;">Job Opportunities</h1>
            <p class="lead" style="color: rgba(255,255,255,0.85);">Find your dream career with us</p>
        </div>
    </div>
    
    <div class="row g-4">
        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 col-12">
            <div class="card h-100 border-0 shadow-sm card-hover" data-aos="fade-up">
                <?php if($job->image): ?>
                <img src="<?php echo e(asset('storage/' . $job->image)); ?>" class="card-img-top job-img" alt="<?php echo e($job->title); ?>">
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <h3 class="card-title h4"><?php echo e($job->title); ?></h3>
                    <div class="mb-2">
                        <?php if($job->type): ?>
                        <span class="badge bg-primary me-2"><?php echo e(ucfirst($job->type)); ?></span>
                        <?php endif; ?>
                        <?php if($job->location): ?>
                        <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i><?php echo e($job->location); ?></span>
                        <?php endif; ?>
                        <?php if($job->salary_range): ?>
                        <span class="text-muted ms-3"><i class="fas fa-dollar-sign me-1"></i><?php echo e($job->salary_range); ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="card-text flex-grow-1"><?php echo e(Str::limit(strip_tags($job->description), 150)); ?></p>
                    <a href="<?php echo e(route('jobs.show', $job->slug)); ?>" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($jobs->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/frontend/jobs/index.blade.php ENDPATH**/ ?>