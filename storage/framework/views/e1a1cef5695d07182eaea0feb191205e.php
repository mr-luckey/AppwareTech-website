<?php $__env->startSection('title', \App\Models\Setting::get('site_name', 'AppWareTech') . ' - Professional Software Solutions'); ?>
<?php $__env->startSection('meta_description', \App\Models\Setting::get('site_description', 'Leading software development company offering web, mobile, and IT solutions')); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="hero-section text-white py-5 position-relative overflow-hidden">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="hero-content">
<h1 class="display-4 fw-bold mb-3 hero-title" style="font-size: 4.5rem; color: #ffffff;" data-aos="fade-right" data-aos-delay="100">
    <?php echo e(\App\Models\Setting::get('hero_title', 'Build better software with AppWareTech')); ?>

</h1>
<p class="lead mb-4 hero-subtitle" data-aos="fade-right" data-aos-delay="200" style="color: #ffffff; font-size: 1.3rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); font-weight: 500;">
    <?php echo e(\App\Models\Setting::get('hero_subtitle', 'Web, Mobile, SEO and Business Software Solutions tailored for your growth.')); ?>

</p>
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="300">
                            <a href="#services" class="btn btn-light btn-lg me-3 hero-btn">
                                <i class="fas fa-rocket me-2"></i>Explore Services
                            </a>
                            <a href="<?php echo e(route('contact')); ?>" class="btn btn-outline-light btn-lg hero-btn">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="hero-image-container" data-aos="fade-left" data-aos-delay="400">
                        <div class="hero-image-bg"></div>
                        <img src="https://images.unsplash.com/photo-1518773553398-650c184e0bb3?q=80&w=1200&auto=format&fit=crop" 
                             class="img-fluid rounded-4 shadow-lg hero-img" 
                             alt="Tech Team"
                             style="max-width: 100%; height: auto; object-fit: cover;">
                        <div class="hero-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-bg-elements">
            <div class="bg-circle bg-circle-1"></div>
            <div class="bg-circle bg-circle-2"></div>
            <div class="bg-circle bg-circle-3"></div>
            <div class="bg-triangle"></div>
            <div class="floating-shape shape-1"></div>
            <div class="floating-shape shape-2"></div>
            <div class="floating-shape shape-3"></div>
            <div class="floating-shape shape-4"></div>
            <div class="floating-shape shape-5"></div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5">
        <div class="container">
<div class="text-center mb-5" data-aos="fade-up">
    <h2 class="fw-bold" style="font-size: 4rem; color: #ffffff;">
        <i class="fas fa-rocket heading-image me-2"></i> Our Services
    </h2>
    <p style="font-size: 1.4rem; color: #ffffff; font-weight: 500;">Solutions delivered by experienced engineers.</p>
</div>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                    <div class="card h-100 border-0 shadow-sm card-hover text-center p-3">
                        <div class="service-icon mx-auto">
                            <i class="<?php echo e($service->icon ?: 'fas fa-cog'); ?> fa-2x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 2rem; color: #ffffff;"><?php echo e($service->name); ?></h5>
                            <p class="card-text" style="font-size: 1.2rem; color: #ffffff;"><?php echo e(Illuminate\Support\Str::limit($service->description, 120)); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">No active services yet.</div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?php echo e(route('services.index')); ?>" class="btn btn-outline-light btn-lg">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Stats Counter Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-2 mb-4" data-aos="fade-up">
                    <div class="counter-icon mb-2"><i class="fas fa-project-diagram fa-2x text-primary"></i></div>
                    <h3 class="display-4 fw-bold" style="font-size: 3rem !important;"><span class="counter" data-count="500">0</span>+</h3>
                    <p style="font-size: 1.1rem; color: #ffffff;">Projects</p>
                </div>
                <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="counter-icon mb-2"><i class="fas fa-smile-beam fa-2x text-success"></i></div>
                    <h3 class="display-4 fw-bold" style="font-size: 3rem !important;"><span class="counter" data-count="300">0</span>+</h3>
                    <p style="font-size: 1.1rem;">Happy Clients</p>
                </div>
                <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="counter-icon mb-2"><i class="fas fa-users fa-2x text-info"></i></div>
                    <h3 class="display-4 fw-bold" style="font-size: 3rem !important;"><span class="counter" data-count="50">0</span>+</h3>
                    <p style="font-size: 1.1rem;">Expert Team</p>
                </div>
                <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="counter-icon mb-2"><i class="fas fa-handshake fa-2x text-warning"></i></div>
                    <h3 class="display-4 fw-bold" style="font-size: 3rem !important;"><span class="counter" data-count="13">0</span>+</h3>
                    <p style="font-size: 1.1rem;">Partnerships</p>
                </div>
                <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-icon mb-2"><i class="fas fa-clock fa-2x text-warning"></i></div>
                    <h3 class="display-4 fw-bold" style="font-size: 3rem !important;"><span class="counter" data-count="190">0</span>+</h3>
                    <p style="font-size: 1.1rem;">Years Experience</p>
                </div>
                <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="counter-icon mb-2"><i class="fas fa-user-tie fa-2x text-info"></i></div>
                    <h3 class="display-4 fw-bold" style="font-size: 3rem !important;"><span class="counter" data-count="8">0</span>+</h3>
                    <p style="font-size: 1.1rem;">Expert Members</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Members Section -->
    <section class="py-5 position-relative" style="background: rgba(10, 15, 35, 0.9);">
        <div class="scene-3d position-absolute top-0 start-0 w-100 h-100" style="z-index: 0; overflow: hidden; pointer-events: none;">
            <div class="orb orb-1" style="width: 350px; height: 350px; top: -120px; left: 5%; animation-duration: 22s; background: radial-gradient(circle at 30% 30%, rgba(0,210,255,0.35), rgba(108,92,231,0.25));"></div>
            <div class="orb orb-2" style="width: 250px; height: 250px; bottom: -80px; right: 8%; animation-duration: 28s; background: radial-gradient(circle at 30% 30%, rgba(168,85,247,0.4), rgba(0,210,255,0.2));"></div>
            <div class="orb orb-3" style="width: 200px; height: 200px; top: 50%; left: 20%; animation-duration: 30s; background: radial-gradient(circle at 30% 30%, rgba(108,92,231,0.35), rgba(168,85,247,0.2));"></div>
        </div>
        <div class="container position-relative" style="z-index: 5;">
            <h2 class="fw-bold text-center mb-5" style="font-size: 4rem; color: #ffffff;">Our Team Members</h2>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-3">
                        <img src="<?php echo e(asset('storage/' . $member->image)); ?>" class="rounded-circle mb-3 mx-auto team-member-img" alt="<?php echo e($member->name); ?>">
                        <h5 class="fw-bold mb-1" style="color: #ffffff; font-size: 1.7rem;"><?php echo e($member->name); ?></h5>
                        <p class="text-muted small mb-2" style="color: rgba(255,255,255,0.85); font-size: 1.2rem;"><?php echo e($member->role); ?></p>
                        <p class="small" style="color: #ffffff;"><?php echo e(Illuminate\Support\Str::limit($member->description, 60)); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">No team members added yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5" style="font-size: 4rem; color: #ffffff;">Our Partners</h2>
            <div class="row g-4 justify-content-center">
                <?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-6 col-md-3 text-center">
                    <div class="card border-0 shadow-sm p-3 align-items-center h-100">
                        <img src="<?php echo e(asset('storage/' . $partner->logo)); ?>" alt="<?php echo e($partner->name); ?>" style="max-width:80px;max-height:80px;object-fit:contain;" class="mb-2">
                        <div class="fw-bold" style="color: #ffffff;"><?php echo e($partner->name); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">No partners added yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 position-relative" style="background: rgba(10, 15, 35, 0.85);">
        <div class="scene-3d position-absolute top-0 start-0 w-100 h-100" style="z-index: 0; overflow: hidden;">
            <div class="orb orb-1" style="width: 300px; height: 300px; top: -100px; left: 10%; animation-duration: 20s;"></div>
            <div class="orb orb-2" style="width: 200px; height: 200px; bottom: -50px; right: 10%; animation-duration: 25s; background: radial-gradient(circle at 30% 30%, rgba(0,210,255,0.2), rgba(108,92,231,0.08));"></div>
        </div>
        <div class="container position-relative" style="z-index: 5;">
            <h2 class="fw-bold text-center mb-5" style="font-size: 4rem; color: #ffffff;">Testimonials</h2>
            <div class="row g-4 justify-content-center">
                <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <?php if($testimonial->image): ?>
                            <img src="<?php echo e(asset('storage/' . $testimonial->image)); ?>" 
                                 class="rounded-circle mb-3 mx-auto testimonial-img" 
                                 alt="<?php echo e($testimonial->name); ?>">
                        <?php else: ?>
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                        <?php endif; ?>
                        <h5 class="fw-bold mb-2" style="color: #ffffff;"><?php echo e($testimonial->name); ?></h5>
                        <p class="text-muted mb-0" style="color: rgba(255,255,255,0.75);"><?php echo e($testimonial->caption); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center" style="color: rgba(255,255,255,0.75);">No testimonials added yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Recent Jobs Section -->
    <section class="py-5 position-relative" style="background: rgba(10, 15, 35, 0.85);">
        <div class="scene-3d position-absolute top-0 start-0 w-100 h-100" style="z-index: 0; overflow: hidden;">
            <div class="orb orb-2" style="width: 350px; height: 350px; top: -150px; right: 5%; animation-duration: 22s; background: radial-gradient(circle at 30% 30%, rgba(0,210,255,0.35), rgba(108,92,231,0.15));"></div>
            <div class="orb orb-3" style="width: 250px; height: 250px; bottom: -80px; left: 5%; animation-duration: 28s; background: radial-gradient(circle at 30% 30%, rgba(168,85,247,0.4), rgba(0,210,255,0.2));"></div>
        </div>
        <div class="container position-relative" style="z-index: 5;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="font-size: 4rem; color: #ffffff;">Recent Jobs</h2>
                    <p class="text-muted mb-0" style="font-size: 1.3rem; color: rgba(255,255,255,0.9);">Apply for the latest openings.</p>
                </div>
                <a href="<?php echo e(route('jobs.index')); ?>" class="btn btn-outline-light">View All Jobs</a>
            </div>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $recentJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <?php if($job->image): ?>
                        <img src="<?php echo e(asset('storage/' . $job->image)); ?>" class="card-img-top job-img" alt="<?php echo e($job->title); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.8rem; color: #ffffff;"><?php echo e($job->title); ?></h5>
                            <p class="text-muted mb-2" style="color: rgba(255,255,255,0.85); font-size: 1.1rem;"><i class="fas fa-map-marker-alt me-1"></i><?php echo e($job->location); ?></p>
                            <p class="card-text" style="color: #ffffff;"><?php echo e(Illuminate\Support\Str::limit(strip_tags($job->description), 100)); ?></p>
                            <a href="<?php echo e(route('jobs.show', $job->slug)); ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center" style="color: rgba(255,255,255,0.75);">No jobs posted yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Featured Courses Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold" style="color: #ffffff;">Featured Courses</h2>
                <p class="lead" style="color: #ffffff;">Upgrade your skills with our professional courses</p>
            </div>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $featuredCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <?php if($course->image): ?>
                        <img src="<?php echo e(asset('storage/' . $course->image)); ?>" class="card-img-top job-img" alt="<?php echo e($course->title); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h6 class="text-primary" style="color: var(--accent-color);"><?php echo e(ucfirst($course->level)); ?></h6>
                            <h5 class="card-title" style="color: #ffffff;"><?php echo e($course->title); ?></h5>
                            <p class="card-text text-muted" style="color: #ffffff;"><?php echo e(Illuminate\Support\Str::limit($course->description, 90)); ?></p>
                            <button class="btn btn-primary btn-sm enroll-btn" data-course-slug="<?php echo e($course->slug); ?>">Enroll</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">No courses available yet.</div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-outline-primary btn-lg">View All Courses</a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 position-relative" style="background: rgba(10, 15, 35, 0.85);">
        <div class="scene-3d position-absolute top-0 start-0 w-100 h-100" style="z-index: 0; overflow: hidden;">
            <div class="orb orb-1" style="width: 250px; height: 250px; bottom: -80px; right: 10%; animation-duration: 26s;"></div>
        </div>
        <div class="container position-relative" style="z-index: 5;">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="font-size: 4rem; color: #ffffff;">Frequently Asked Questions</h2>
            </div>
            <div class="accordion" id="faqAccordion">
                <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="accordion-item" style="background: rgba(25, 35, 60, 0.6); border: 1px solid rgba(108, 92, 231, 0.2); border-radius: 12px; margin-bottom: 10px;">
                    <h2 class="accordion-header" id="faqHeading<?php echo e($faq->id); ?>">
                        <button class="accordion-button <?php echo e($loop->first ? '' : 'collapsed'); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?php echo e($faq->id); ?>" style="background: transparent; color: #ffffff; border: none; font-weight: 600;">
                            <?php echo e($faq->question); ?>

                        </button>
                    </h2>
                    <div id="faqCollapse<?php echo e($faq->id); ?>" class="accordion-collapse collapse <?php echo e($loop->first ? 'show' : ''); ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="color: rgba(255,255,255,0.85);"><?php echo e($faq->answer); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center" style="color: rgba(255,255,255,0.75);">No FAQs added yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="fw-bold" style="font-size: 4.5rem; color: #ffffff;">Ready To Start Your Project?</h2>
            <p class="text-muted mb-4" style="font-size: 1.4rem; color: #ffffff;">Talk to our team and get a custom plan for your business.</p>
            <a href="<?php echo e(route('contact')); ?>" class="btn btn-primary btn-lg">Get Free Consultation</a>
        </div>
    </section>

     <!-- Enrollment Modal -->
     <div id="enrollmentModal" class="modal-popup">
         <div class="modal-content-custom" style="background: rgba(25, 35, 60, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(108, 92, 231, 0.3); border-radius: 20px; overflow: hidden; max-width: 500px; margin: 0 auto; position: relative;">
             <div class="d-flex justify-content-between align-items-center mb-4" style="padding: 20px; border-bottom: 1px solid rgba(108, 92, 231, 0.2);">
                 <h3 class="mb-0" style="color: #ffffff; font-size: 1.8rem;">Enroll in Course</h3>
                 <button type="button" class="btn-close" onclick="closeModal()" style="background: transparent; border: none; font-size: 2rem; color: rgba(255,255,255,0.8); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s ease;">
                     <span>&times;</span>
                 </button>
             </div>
             <form id="enrollmentForm">
                 <?php echo csrf_field(); ?>
                 <div class="mb-4" style="padding: 0 20px;">
                     <label class="form-label" style="color: rgba(255,255,255,0.85); font-weight: 500; margin-bottom: 8px; display: block;">Full Name *</label>
                     <input type="text" name="name" class="form-control" required style="background: rgba(25, 35, 60, 0.85); border: 1px solid rgba(108, 92, 231, 0.3); border-radius: 12px; color: #ffffff; padding: 14px 16px; font-size: 1rem; width: 100%;">
                 </div>
                 <div class="mb-4" style="padding: 0 20px;">
                     <label class="form-label" style="color: rgba(255,255,255,0.85); font-weight: 500; margin-bottom: 8px; display: block;">Email *</label>
                     <input type="email" name="email" class="form-control" required style="background: rgba(25, 35, 60, 0.85); border: 1px solid rgba(108, 92, 231, 0.3); border-radius: 12px; color: #ffffff; padding: 14px 16px; font-size: 1rem; width: 100%;">
                 </div>
                 <div class="mb-4" style="padding: 0 20px;">
                     <label class="form-label" style="color: rgba(255,255,255,0.85); font-weight: 500; margin-bottom: 8px; display: block;">Phone *</label>
                     <input type="tel" name="phone" class="form-control" required style="background: rgba(25, 35, 60, 0.85); border: 1px solid rgba(108, 92, 231, 0.3); border-radius: 12px; color: #ffffff; padding: 14px 16px; font-size: 1rem; width: 100%;">
                 </div>
                 <div class="mb-4" style="padding: 0 20px;">
                     <label class="form-label" style="color: rgba(255,255,255,0.85); font-weight: 500; margin-bottom: 8px; display: block;">Message</label>
                     <textarea name="message" class="form-control" rows="4" style="background: rgba(25, 35, 60, 0.85); border: 1px solid rgba(108, 92, 231, 0.3); border-radius: 12px; color: #ffffff; padding: 14px 16px; font-size: 1rem; width: 100%; resize: vertical;"></textarea>
                 </div>
                 <div style="padding: 0 20px 20px;">
                     <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border: none; padding: 14px 30px; border-radius: 50px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; position: relative; overflow: hidden; letter-spacing: 0.5px;">
                         Submit Enrollment
                     </button>
                 </div>
             </form>
         </div>
     </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-count');
            const duration = 2000;
            const increment = target / (duration / 16);
            let count = 0;
            const updateCount = () => {
                count += increment;
                if (count < target) {
                    counter.innerText = Math.ceil(count);
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => observer.observe(counter));

        // Enrollment Modal
        let currentCourseSlug = null;
        document.querySelectorAll('.enroll-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                currentCourseSlug = this.dataset.courseSlug;
                document.getElementById('enrollmentModal').style.display = 'block';
            });
        });

        function closeModal() {
            document.getElementById('enrollmentModal').style.display = 'none';
        }

        document.getElementById('enrollmentForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const response = await fetch('/courses/' + currentCourseSlug + '/enroll', {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            const data = await response.json();
            if (data.success) {
                alert(data.message);
                this.reset();
                closeModal();
            } else {
                alert('Enrollment failed.');
            }
        });

        window.onclick = function(event) {
            const modal = document.getElementById('enrollmentModal');
            if (event.target === modal) closeModal();
        };
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .heading-image {
        width: 2em;
        height: 2em;
        margin-right: 0.5em;
        display: inline-block;
        vertical-align: middle;
        animation: rotate3dY 20s infinite linear;
        color: var(--accent-color);
    }

    @keyframes rotate3dY {
        from { transform: rotateY(0deg); }
        to { transform: rotateY(360deg); }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .typing-effect {
        overflow: hidden;
        border-right: .15em solid var(--accent-color);
        white-space: nowrap;
        margin: 0 auto;
        letter-spacing: .15em;
        animation: 
            typing 3.5s steps(30, end),
            blink-caret .5s step-end infinite;
    }
    
    /* The typing effect */
    @keyframes typing {
        from { width: 0 }
        to { width: 100% }
    }
    
    /* The typewriter cursor effect */
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: var(--accent-color) }
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/frontend/home.blade.php ENDPATH**/ ?>