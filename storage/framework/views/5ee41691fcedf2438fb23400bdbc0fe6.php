

<?php $__env->startSection('title', 'Courses Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-graduation-cap me-2"></i>Courses Management</h2>
    <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Course
    </a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <?php if($courses->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Level</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="course-checkbox" value="<?php echo e($course->id); ?>">
                        </td>
                        <td>
                            <?php if($course->image): ?>
                            <img src="<?php echo e(asset('storage/' . $course->image)); ?>" alt="<?php echo e($course->title); ?>" style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                            <div style="width: 60px; height: 40px; background: #e9ecef; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php echo e($course->title); ?></strong>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($course->level == 'beginner' ? 'success' : ($course->level == 'intermediate' ? 'warning' : 'danger')); ?>">
                                <?php echo e(ucfirst($course->level)); ?>

                            </span>
                        </td>
                        <td>$<?php echo e(number_format($course->price, 2)); ?></td>
                        <td><?php echo e($course->duration); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($course->is_active ? 'success' : 'secondary'); ?>">
                                <?php echo e($course->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.courses.edit', $course)); ?>" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo e(route('admin.courses.show', $course)); ?>" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="<?php echo e(route('admin.courses.destroy', $course)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
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

        <div class="d-flex justify-content-between align-items-center mt-3">
            <form action="<?php echo e(route('admin.courses.bulk-delete')); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete selected courses?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <input type="hidden" name="course_ids" id="bulkCourseIds">
                <button type="submit" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
                    <i class="fas fa-trash me-1"></i>Delete Selected
                </button>
            </form>
            <div>
                <?php echo e($courses->links()); ?>

            </div>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
            <h5>No courses found</h5>
            <p class="text-muted">Start by adding your first course.</p>
            <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Course
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Select all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.course-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkDeleteBtn();
    });

    // Individual checkbox change
    document.querySelectorAll('.course-checkbox').forEach(cb => {
        cb.addEventListener('change', toggleBulkDeleteBtn);
    });

    function toggleBulkDeleteBtn() {
        const checked = document.querySelectorAll('.course-checkbox:checked').length;
        const bulkBtn = document.getElementById('bulkDeleteBtn');
        const bulkInput = document.getElementById('bulkCourseIds');
        
        if (checked > 0) {
            bulkBtn.style.display = 'inline-block';
            const ids = Array.from(document.querySelectorAll('.course-checkbox:checked')).map(cb => cb.value);
            bulkInput.value = ids.join(',');
        } else {
            bulkBtn.style.display = 'none';
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>