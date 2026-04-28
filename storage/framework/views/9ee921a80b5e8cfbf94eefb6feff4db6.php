

<?php $__env->startSection('title', 'View Enrollment'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user me-2"></i>Enrollment Details #<?php echo e($enrollment->id); ?></h2>
    <a href="<?php echo e(route('admin.enrollments.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Enrollments
    </a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Applicant Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Full Name</label>
                        <p class="mb-0 fw-bold"><?php echo e($enrollment->name); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Email Address</label>
                        <p class="mb-0"><?php echo e($enrollment->email); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Phone Number</label>
                        <p class="mb-0"><?php echo e($enrollment->phone); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Submitted On</label>
                        <p class="mb-0"><?php echo e($enrollment->created_at->format('M d, Y h:i A')); ?></p>
                    </div>
                    <?php if($enrollment->message): ?>
                    <div class="col-md-12">
                        <label class="text-muted small">Message</label>
                        <p class="mb-0"><?php echo e($enrollment->message); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if($enrollment->course): ?>
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Course Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?php if($enrollment->course->image): ?>
                        <img src="<?php echo e(asset('storage/' . $enrollment->course->image)); ?>" alt="<?php echo e($enrollment->course->title); ?>" class="img-fluid rounded">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <h5><?php echo e($enrollment->course->title); ?></h5>
                        <p class="text-muted mb-2"><?php echo e(Str::limit($enrollment->course->short_description ?? $enrollment->course->description, 200)); ?></p>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="badge bg-primary"><?php echo e(ucfirst($enrollment->course->level)); ?></span>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted"><i class="fas fa-clock me-1"></i><?php echo e($enrollment->course->duration); ?></span>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted"><i class="fas fa-dollar-sign me-1"></i><?php echo e(number_format($enrollment->course->price, 2)); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Actions</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Current Status</label>
                    <div class="mb-3">
                        <span class="badge bg-<?php echo e($enrollment->status == 'pending' ? 'warning' : ($enrollment->status == 'approved' ? 'success' : 'danger')); ?> fs-6">
                            <?php echo e(ucfirst($enrollment->status)); ?>

                        </span>
                    </div>
                </div>

                <form action="<?php echo e(route('admin.enrollments.update-status', $enrollment)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" <?php echo e($enrollment->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="approved" <?php echo e($enrollment->status == 'approved' ? 'selected' : ''); ?>>Approved</option>
                            <option value="rejected" <?php echo e($enrollment->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-save me-1"></i>Update Status
                    </button>
                </form>

                <hr>

                <form action="<?php echo e(route('admin.enrollments.destroy', $enrollment)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash me-1"></i>Delete Enrollment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/enrollments/show.blade.php ENDPATH**/ ?>