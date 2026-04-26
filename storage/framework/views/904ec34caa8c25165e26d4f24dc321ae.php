

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Job Applications</h1>
                <div class="d-flex gap-2">
                    <a href="<?php echo e(route('admin.jobs.index')); ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Jobs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card card-stats bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($stats['total']); ?></h5>
                    <p class="card-text">Total Applications</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-stats bg-warning text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($stats['unread']); ?></h5>
                    <p class="card-text">Unread</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-stats bg-info text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($stats['pending']); ?></h5>
                    <p class="card-text">Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-stats bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($stats['approved']); ?></h5>
                    <p class="card-text">Approved</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-stats bg-danger text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($stats['rejected']); ?></h5>
                    <p class="card-text">Rejected</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-stats bg-secondary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($stats['shortlisted']); ?></h5>
                    <p class="card-text">Shortlisted</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.job-applications.index')); ?>" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="job_id" class="form-label">Filter by Job</label>
                                <select name="job_id" id="job_id" class="form-select">
                                    <option value="">All Jobs</option>
                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($job->id); ?>" <?php echo e(request('job_id') == $job->id ? 'selected' : ''); ?>>
                                            <?php echo e($job->title); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Filter by Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                                    <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                    <option value="shortlisted" <?php echo e(request('status') == 'shortlisted' ? 'selected' : ''); ?>>Shortlisted</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-2"></i>Filter
                                    </button>
                                    <a href="<?php echo e(route('admin.job-applications.index')); ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-refresh me-2"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="row">
        <div class="col-12">
            <div class="card data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Applications List</h5>
                    <?php if($applications->count() > 0): ?>
                        <form action="<?php echo e(route('admin.job-applications.bulk-delete')); ?>" method="POST" id="bulkDeleteForm">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="application_ids[]" id="bulkDeleteIds">
                            <button type="submit" class="btn btn-danger btn-sm" id="bulkDeleteBtn" disabled>
                                <i class="fas fa-trash me-2"></i>Bulk Delete
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if($applications->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Applicant</th>
                                        <th>Job</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Date Applied</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="<?php echo e($application->isUnread() ? 'table-warning' : ''); ?>">
                                            <td>
                                                <input type="checkbox" class="application-checkbox" value="<?php echo e($application->id); ?>">
                                            </td>
                                            <td>
                                                <div>
                                                    <strong><?php echo e($application->name); ?></strong>
                                                    <?php if($application->isUnread()): ?>
                                                        <span class="badge bg-warning ms-2">New</span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($application->cover_letter): ?>
                                                    <small class="text-muted"><?php echo e(Str::limit($application->cover_letter, 100)); ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?php echo e($application->job->title); ?></span>
                                            </td>
                                            <td>
                                                <a href="mailto:<?php echo e($application->email); ?>"><?php echo e($application->email); ?></a>
                                            </td>
                                            <td>
                                                <?php echo e($application->phone ?? 'N/A'); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $statusClass = [
                                                        'pending' => 'warning',
                                                        'approved' => 'success',
                                                        'rejected' => 'danger',
                                                        'shortlisted' => 'info'
                                                    ][$application->status];
                                                ?>
                                                <span class="badge bg-<?php echo e($statusClass); ?>"><?php echo e(ucfirst($application->status)); ?></span>
                                            </td>
                                            <td>
                                                <?php echo e($application->created_at->format('M d, Y H:i')); ?>

                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo e(route('admin.job-applications.show', $application)); ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class="fas fa-check"></i> Status
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <form action="<?php echo e(route('admin.job-applications.update-status', $application)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <input type="hidden" name="status" value="approved">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-check text-success"></i> Approve
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="<?php echo e(route('admin.job-applications.update-status', $application)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-times text-danger"></i> Reject
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="<?php echo e(route('admin.job-applications.update-status', $application)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <input type="hidden" name="status" value="shortlisted">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-star text-info"></i> Shortlist
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="<?php echo e(route('admin.job-applications.update-status', $application)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <input type="hidden" name="status" value="pending">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-clock text-warning"></i> Pending
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <form action="<?php echo e(route('admin.job-applications.destroy', $application)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this application?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger mt-1">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Showing <?php echo e($applications->firstItem()); ?> to <?php echo e($applications->lastItem()); ?> of <?php echo e($applications->total()); ?> applications
                            </div>
                            <?php echo e($applications->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No applications found</h5>
                            <p class="text-muted">When applicants apply for jobs, they will appear here.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const applicationCheckboxes = document.querySelectorAll('.application-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkDeleteIds = document.getElementById('bulkDeleteIds');
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        applicationCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkDeleteButton();
    });

    // Individual checkbox change
    applicationCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkDeleteButton);
    });

    function updateBulkDeleteButton() {
        const checkedCheckboxes = document.querySelectorAll('.application-checkbox:checked');
        const isChecked = checkedCheckboxes.length > 0;
        
        bulkDeleteBtn.disabled = !isChecked;
        
        if (isChecked) {
            const ids = Array.from(checkedCheckboxes).map(cb => cb.value);
            bulkDeleteIds.value = ids;
        } else {
            bulkDeleteIds.value = '';
        }
    }

    // Confirm bulk delete
    bulkDeleteForm.addEventListener('submit', function(e) {
        if (!bulkDeleteBtn.disabled) {
            const checkedCount = document.querySelectorAll('.application-checkbox:checked').length;
            if (!confirm(`Are you sure you want to delete ${checkedCount} selected application(s)?`)) {
                e.preventDefault();
            }
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/job-applications/index.blade.php ENDPATH**/ ?>