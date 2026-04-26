

<?php $__env->startSection('title', 'Contact Page Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h2><i class="fas fa-envelope me-2"></i>Contact Page Management</h2>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?php echo e(route('admin.contact.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <h5 class="mb-3">Page Content</h5>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_page_title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['contact_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact_page_title" name="contact_page_title" value="<?php echo e(old('contact_page_title', $contactSettings['contact_page_title'])); ?>" required>
                        <?php $__errorArgs = ['contact_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_page_description" class="form-label">Page Description</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['contact_page_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact_page_description" name="contact_page_description" value="<?php echo e(old('contact_page_description', $contactSettings['contact_page_description'])); ?>">
                        <?php $__errorArgs = ['contact_page_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Contact Information</h5>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact_email" name="contact_email" value="<?php echo e(old('contact_email', $contactSettings['contact_email'])); ?>" required>
                        <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact_phone" name="contact_phone" value="<?php echo e(old('contact_phone', $contactSettings['contact_phone'])); ?>" required>
                        <?php $__errorArgs = ['contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['contact_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact_address" name="contact_address" value="<?php echo e(old('contact_address', $contactSettings['contact_address'])); ?>" required>
                        <?php $__errorArgs = ['contact_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Google Map</h5>
            
            <div class="mb-3">
                <label for="contact_map_embed" class="form-label">Map Embed Code</label>
                <textarea class="form-control <?php $__errorArgs = ['contact_map_embed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact_map_embed" name="contact_map_embed" rows="4" placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'><?php echo e(old('contact_map_embed', $contactSettings['contact_map_embed'])); ?></textarea>
                <small class="text-muted">Paste the iframe embed code from Google Maps</small>
                <?php $__errorArgs = ['contact_map_embed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Display Options</h5>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="contact_show_info" name="contact_show_info" <?php echo e(old('contact_show_info', $contactSettings['contact_show_info']) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="contact_show_info">Show Contact Information</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="contact_show_form" name="contact_show_form" <?php echo e(old('contact_show_form', $contactSettings['contact_show_form']) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="contact_show_form">Show Contact Form</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="contact_show_map" name="contact_show_map" <?php echo e(old('contact_show_map', $contactSettings['contact_show_map']) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="contact_show_map">Show Google Map</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Save Contact Settings
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/contact/index.blade.php ENDPATH**/ ?>