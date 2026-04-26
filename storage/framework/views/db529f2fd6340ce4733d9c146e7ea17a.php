

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Application Details</h1>
                <a href="<?php echo e(route('admin.job-applications.index')); ?>" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Applications
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Application Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Information</h5>
                    <?php
                        $statusClass = [
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            'shortlisted' => 'info'
                        ][$application->status];
                    ?>
                    <span class="badge bg-<?php echo e($statusClass); ?> fs-6"><?php echo e(ucfirst($application->status)); ?></span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Applicant Name</label>
                            <p class="fw-bold"><?php echo e($application->name); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Email Address</label>
                            <p><a href="mailto:<?php echo e($application->email); ?>"><?php echo e($application->email); ?></a></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Phone Number</label>
                            <p><?php echo e($application->phone ?? 'N/A'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Applied On</label>
                            <p><?php echo e($application->created_at->format('M d, Y H:i A')); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Job Position</label>
                            <p>
                                <a href="<?php echo e(route('admin.jobs.edit', $application->job)); ?>" class="text-decoration-none">
                                    <?php echo e($application->job->title); ?>

                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Read Status</label>
                            <p>
                                <?php if($application->read_at): ?>
                                    <span class="text-success"><i class="fas fa-check-circle me-1"></i>Read on <?php echo e($application->read_at->format('M d, Y H:i A')); ?></span>
                                <?php else: ?>
                                    <span class="text-warning"><i class="fas fa-circle me-1"></i>Unread</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <?php if($application->resume): ?>
                    <div class="mb-3">
                        <label class="text-muted small">Resume/CV</label>
                        <div class="mt-1">
                            <a href="<?php echo e(asset('storage/' . $application->resume)); ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                                <i class="fas fa-file-download me-2"></i>Download Resume
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($application->cover_letter): ?>
                    <div class="mb-3">
                        <label class="text-muted small">Cover Letter</label>
                        <div class="mt-1 p-3 bg-light rounded">
                            <?php echo e($application->cover_letter); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.job-applications.update-status', $application)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" <?php echo e($application->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="approved" <?php echo e($application->status == 'approved' ? 'selected' : ''); ?>>Approved</option>
                                <option value="rejected" <?php echo e($application->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                <option value="shortlisted" <?php echo e($application->status == 'shortlisted' ? 'selected' : ''); ?>>Shortlisted</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" placeholder="Add notes about this application..."><?php echo e($application->admin_notes); ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Update Application
                        </button>
                    </form>
                </div>
            </div>

            <!-- Job Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Job Information</h5>
                </div>
                <div class="card-body">
                    <h6><?php echo e($application->job->title); ?></h6>
                    <p class="text-muted mb-2">
                        <i class="fas fa-map-marker-alt me-1"></i><?php echo e($application->job->location); ?>

                    </p>
                    <p class="text-muted mb-2">
                        <span class="badge bg-primary"><?php echo e(ucfirst($application->job->type)); ?></span>
                    </p>
                    <a href="<?php echo e(route('admin.jobs.edit', $application->job)); ?>" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-edit me-2"></i>View Job Details
                    </a>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card mt-4 border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Once you delete this application, there is no going back. Please be certain.</p>
                    <form action="<?php echo e(route('admin.job-applications.destroy', $application)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/job-applications/show.blade.php ENDPATH**/ ?>