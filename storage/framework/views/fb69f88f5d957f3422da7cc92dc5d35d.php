

<?php $__env->startSection('title', 'Edit Job'); ?>

<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Job</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.jobs.update', $job)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Job Title *</label>
                    <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $job->title)); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" class="form-control" value="<?php echo e(old('location', $job->location)); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Job Type *</label>
                    <select name="type" class="form-control" required>
                        <?php $__currentLoopData = ['full-time', 'part-time', 'remote', 'contract']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php if(old('type', $job->type) === $type): echo 'selected'; endif; ?>><?php echo e(ucfirst($type)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Salary Range</label>
                    <input type="text" name="salary_range" class="form-control" value="<?php echo e(old('salary_range', $job->salary_range)); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Job Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control summernote" rows="10" required><?php echo e(old('description', $job->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Requirements (One per line)</label>
                <textarea name="requirements" class="form-control" rows="5"><?php echo e(old('requirements', is_array($job->requirements) ? implode("\n", $job->requirements) : '')); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Benefits (One per line)</label>
                <textarea name="benefits" class="form-control" rows="5"><?php echo e(old('benefits', is_array($job->benefits) ? implode("\n", $job->benefits) : '')); ?></textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" <?php if(old('is_active', $job->is_active)): echo 'checked'; endif; ?>>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Job</button>
            <a href="<?php echo e(route('admin.jobs.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/jobs/edit.blade.php ENDPATH**/ ?>