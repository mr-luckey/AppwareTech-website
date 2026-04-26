

<?php $__env->startSection('title', 'Manage Services'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Services Management</h2>
    <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Service
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($service->id); ?></td>
                        <td><?php echo e($service->name); ?></td>
                        <td><i class="<?php echo e($service->icon ?: 'fas fa-cog'); ?>"></i></td>
                        <td><?php echo e($service->order); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($service->is_active ? 'success' : 'danger'); ?>">
                                <?php echo e($service->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn btn-sm btn-info btn-action">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.services.destroy', $service)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Delete this service?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No services found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($services->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/services/index.blade.php ENDPATH**/ ?>