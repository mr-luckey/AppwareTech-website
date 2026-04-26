<?php $__env->startSection('title', 'Contact Us - ' . \App\Models\Setting::get('site_name')); ?>
<?php $__env->startSection('meta_description', 'Get in touch with AppWareTech for your software development needs'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5 mt-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold"><?php echo e($contactSettings['page_title']); ?></h1>
            <p class="lead" style="font-size: 1.3rem; color: #ffffff;"><?php echo e($contactSettings['page_description']); ?></p>
        </div>
    </div>
    
    <div class="row">
        <?php if($contactSettings['show_info'] == '1'): ?>
        <div class="col-lg-5 mb-4" data-aos="fade-right">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="mb-4" style="color: #ffffff; font-size: 1.5rem;">Get In Touch</h3>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-0" style="color: #ffffff;">Address</h5>
                                <p class="mb-0" style="color: #ffffff; font-size: 1.05rem;"><?php echo e($contactSettings['address']); ?></p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-0" style="color: #ffffff;">Phone</h5>
                                <p class="mb-0" style="color: #ffffff; font-size: 1.05rem;"><?php echo e($contactSettings['phone']); ?></p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-0" style="color: #ffffff;">Email</h5>
                                <p class="mb-0" style="color: #ffffff; font-size: 1.05rem;"><?php echo e($contactSettings['email']); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5 style="color: #ffffff;">Follow Us</h5>
                        <div class="social-links">
                            <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/company/112490319/admin/dashboard/" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if($contactSettings['show_form'] == '1'): ?>
        <div class="col-lg-7 mb-4" data-aos="fade-left">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-4" style="color: #ffffff; font-size: 1.5rem;">Send us a Message</h3>
                    
                    <form action="<?php echo e(route('contact.submit')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Subject *</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Message *</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if($contactSettings['show_map'] == '1'): ?>
<div class="row mt-4" data-aos="fade-up">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463878.29488595825!2d46.85247065000001!3d24.725191849999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2s!4v1777120044605!5m2!1sen!2s" width="120%" height="450" style="border:0; display: block; margin-left: -10%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function initMap() {
        // Default coordinates (New York)
        const location = { lat: 40.7128, lng: -74.0060 };
        
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: location,
        });
        
        const marker = new google.maps.Marker({
            position: location,
            map: map,
            title: "AppWareTech Office"
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/frontend/contact.blade.php ENDPATH**/ ?>