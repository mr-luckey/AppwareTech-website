

<?php $__env->startSection('title', 'Manage Jobs'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Jobs Management</h2>
    <a href="<?php echo e(route('admin.jobs.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Job
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($job->id); ?></td>
                        <td><?php echo e($job->title); ?></td>
                        <td><?php echo e($job->location); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($job->type == 'full-time' ? 'primary' : ($job->type == 'part-time' ? 'info' : 'secondary')); ?>">
                                <?php echo e(ucfirst($job->type)); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($job->is_active ? 'success' : 'danger'); ?>">
                                <?php echo e($job->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </td>
                        <td><?php echo e(number_format($job->views)); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.jobs.edit', $job)); ?>" class="btn btn-sm btn-info btn-action">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.jobs.destroy', $job)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($jobs->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/jobs/index.blade.php ENDPATH**/ ?>