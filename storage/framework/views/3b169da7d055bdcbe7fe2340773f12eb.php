

<?php $__env->startSection('title', 'Enrollments Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i>Enrollments Management</h2>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Pending</h6>
                        <h2 class="mb-0"><?php echo e($pendingCount); ?></h2>
                    </div>
                    <i class="fas fa-clock fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Approved</h6>
                        <h2 class="mb-0"><?php echo e($approvedCount); ?></h2>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Rejected</h6>
                        <h2 class="mb-0"><?php echo e($rejectedCount); ?></h2>
                    </div>
                    <i class="fas fa-times-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Total</h6>
                        <h2 class="mb-0"><?php echo e($pendingCount + $approvedCount + $rejectedCount); ?></h2>
                    </div>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('admin.enrollments.index')); ?>" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Filter by Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                    <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Filter by Course</label>
                <select name="course" class="form-select">
                    <option value="">All Courses</option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($course->id); ?>" <?php echo e(request('course') == $course->id ? 'selected' : ''); ?>><?php echo e($course->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <a href="<?php echo e(route('admin.enrollments.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-redo me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Enrollments Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <?php if($enrollments->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>#<?php echo e($enrollment->id); ?></td>
                        <td><strong><?php echo e($enrollment->name); ?></strong></td>
                        <td><?php echo e($enrollment->email); ?></td>
                        <td><?php echo e($enrollment->phone); ?></td>
                        <td>
                            <?php if($enrollment->course): ?>
                            <span class="text-primary"><?php echo e(Str::limit($enrollment->course->title, 30)); ?></span>
                            <?php else: ?>
                            <span class="text-muted">Course Deleted</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($enrollment->created_at->format('M d, Y')); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($enrollment->status == 'pending' ? 'warning' : ($enrollment->status == 'approved' ? 'success' : 'danger')); ?>">
                                <?php echo e(ucfirst($enrollment->status)); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.enrollments.show', $enrollment)); ?>" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="<?php echo e(route('admin.enrollments.destroy', $enrollment)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <?php echo e($enrollments->withQueryString()->links()); ?>

        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-3"></i>
            <h5>No enrollments found</h5>
            <p class="text-muted">Enrollments will appear here when users submit the enrollment form.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/enrollments/index.blade.php ENDPATH**/ ?>