<?php $__env->startSection('title', $job->title . ' - ' . \App\Models\Setting::get('site_name')); ?>
<?php $__env->startSection('meta_description', Str::limit(strip_tags($job->description), 160)); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* Hide header specifically on job show page */
        header {
            display: none !important;
        }
        /* Adjust main content to start at top with some spacing */
        main {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        /* Back button styling */
        .btn-back {
            position: fixed;
            top: 1rem;
            left: 1rem;
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 1000;
        }
        .btn-back:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-back i {
            font-size: 1.1rem;
        }
    </style>
    <div class="mb-4">
        <a href="<?php echo e(route('jobs.index')); ?>" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i> Back to Jobs
        </a>
    </div>
    <!-- Related Information Section -->
    <div class="mt-5 mb-4 text-center">
        <h2 class="fw-bold mb-3" style="color: #ffffff; font-size: 2.5rem;">Job Details & Application Information</h2>
        <p style="font-size: 1.2rem; color: #ffffff;">
            Find all the information you need about this position and learn how to apply successfully.
        </p>
    </div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto" data-aos="fade-up">
            <div class="card border-0 shadow-sm mt-5">
                <?php if($job->image): ?>
                <img src="<?php echo e(asset('storage/' . $job->image)); ?>" class="card-img-top job-detail-img" alt="<?php echo e($job->title); ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h1 class="card-title h2 mb-3"><?php echo e($job->title); ?></h1>
                    
                    <div class="mb-4">
                        <span class="badge bg-primary me-2"><?php echo e(ucfirst($job->type)); ?></span>
                        <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i><?php echo e($job->location); ?></span>
                        <?php if($job->salary_range): ?>
                        <span class="text-muted ms-3"><i class="fas fa-dollar-sign me-1"></i><?php echo e($job->salary_range); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="job-description">
                        <?php echo $job->description; ?>

                    </div>
                    
                    <?php if($job->requirements && count($job->requirements) > 0): ?>
                    <div class="mt-4">
                        <h4>Requirements:</h4>
                        <ul>
                            <?php $__currentLoopData = $job->requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($requirement); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($job->benefits && count($job->benefits) > 0): ?>
                    <div class="mt-4">
                        <h4>Benefits:</h4>
                        <ul>
                            <?php $__currentLoopData = $job->benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($benefit); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#applyModal">
                            <i class="fas fa-paper-plane me-2"></i>Apply Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Apply Modal - FIXED VERSION (Form fully clickable & text visible) -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #1a1f2e; border: 1px solid rgba(108, 92, 231, 0.3); border-radius: 12px;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(108, 92, 231, 0.2);">
                <h5 class="modal-title fw-bold text-white" id="applyModalLabel">Apply for <?php echo e($job->title); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="jobApplicationForm" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="applicant_name" class="form-label text-white fw-semibold mb-2">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="applicant_name" name="name" placeholder="e.g., John Doe" required
                               style="background: #2a2f3e; border: 1px solid #3a4050; color: white; border-radius: 8px; padding: 10px 14px;">
                        <div class="invalid-feedback">Please enter your full name.</div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="applicant_email" class="form-label text-white fw-semibold mb-2">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="applicant_email" name="email" placeholder="e.g., john@example.com" required
                               style="background: #2a2f3e; border: 1px solid #3a4050; color: white; border-radius: 8px; padding: 10px 14px;">
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-3">
                        <label for="applicant_phone" class="form-label text-white fw-semibold mb-2">Phone Number</label>
                        <input type="tel" class="form-control" id="applicant_phone" name="phone" placeholder="e.g., +92 300 1234567"
                               style="background: #2a2f3e; border: 1px solid #3a4050; color: white; border-radius: 8px; padding: 10px 14px;">
                    </div>

                    <!-- Resume Field -->
                    <div class="mb-3">
                        <label for="applicant_resume" class="form-label text-white fw-semibold mb-2">Resume/CV <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="applicant_resume" name="resume" accept=".pdf,.doc,.docx" required
                               style="background: #2a2f3e; border: 1px solid #3a4050; color: white; border-radius: 8px; padding: 8px 14px;">
                        <small class="text-muted mt-1 d-block">✓ Supported formats: PDF, DOC, DOCX (Max 2MB)</small>
                    </div>

                    <!-- Cover Letter Field -->
                    <div class="mb-3">
                        <label for="applicant_cover" class="form-label text-white fw-semibold mb-2">Cover Letter (Optional)</label>
                        <textarea class="form-control" id="applicant_cover" name="cover_letter" rows="4" placeholder="Tell us why you're the perfect fit for this role..."
                                  style="background: #2a2f3e; border: 1px solid #3a4050; color: white; border-radius: 8px; padding: 10px 14px;"></textarea>
                    </div>

                    <!-- Response Message Area -->
                    <div id="responseMessage" class="mb-3"></div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100" id="submitApplicationBtn" style="padding: 12px; font-weight: 600; border-radius: 8px;">
                        <span id="submitText">Submit Application</span>
                        <span id="submittingText" class="d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Submitting...
                        </span>
                    </button>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(108, 92, 231, 0.2);">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Additional Styles to Override Any Conflicts -->
<style>
    /* Ensure modal is above everything and clickable */
    .modal {
        z-index: 1060 !important;
    }
    .modal-backdrop {
        z-index: 1050 !important;
    }
    .modal-dialog {
        z-index: 1061 !important;
    }
    .modal-content {
        background: #1a1f2e !important;
        border-radius: 12px !important;
        pointer-events: auto !important;
    }
    .modal-body {
        pointer-events: auto !important;
    }
    /* Form inputs inside modal must be usable */
    .modal input, 
    .modal textarea, 
    .modal select, 
    .modal button {
        pointer-events: auto !important;
    }
    /* Fix for any overlay issues */
    body.modal-open {
        overflow: hidden !important;
        padding-right: 0 !important;
    }
    /* Ensure form labels and text are clearly visible */
    .modal .form-label,
    .modal .modal-title {
        color: #ffffff !important;
    }
    /* Input placeholder color */
    .modal input::placeholder,
    .modal textarea::placeholder {
        color: #8a8f9e !important;
        opacity: 1 !important;
    }
    /* Focus state for inputs */
    .modal input:focus,
    .modal textarea:focus {
        background: #2a2f3e !important;
        border-color: #6c5ce7 !important;
        box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2) !important;
        color: white !important;
        outline: none !important;
    }
    /* Invalid feedback style */
    .modal .invalid-feedback {
        color: #ff6b6b !important;
        font-size: 0.8rem !important;
    }
    /* Success message styling */
    .alert-success {
        background: rgba(40, 167, 69, 0.15) !important;
        border-color: #28a745 !important;
        color: #28a745 !important;
    }
    /* Danger message styling */
    .alert-danger {
        background: rgba(220, 53, 69, 0.15) !important;
        border-color: #dc3545 !important;
        color: #dc3545 !important;
    }
    /* Job description text styling for readability */
    .job-description {
        color: #e2e8f0;
    }
    .job-description h1, 
    .job-description h2, 
    .job-description h3, 
    .job-description h4, 
    .job-description h5 {
        color: #ffffff;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    .job-description p {
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.8;
    }
    .job-description ul, 
    .job-description ol {
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 1rem;
    }
    .job-description li {
        margin-bottom: 0.5rem;
    }
    /* Override any inherited opacity or pointer-events issues */
    .modal .form-control,
    .modal .form-control:focus,
    .modal .form-control:active,
    .modal .form-control:hover {
        opacity: 1 !important;
        pointer-events: auto !important;
        user-select: text !important;
    }
    /* Make sure modal dialog is not transparent */
    .modal-content,
    .modal-header,
    .modal-body,
    .modal-footer {
        background-color: #1a1f2e !important;
    }
    /* Button hover states */
    .modal .btn-primary:hover {
        background-color: #5b4bc4 !important;
        border-color: #5b4bc4 !important;
    }
    .modal .btn-secondary:hover {
        background-color: #3a4050 !important;
        border-color: #3a4050 !important;
    }
</style>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove any duplicate modals and ensure the correct modal is initialized
    // Check if Bootstrap is loaded
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS is not loaded! Modal will not work.');
        return;
    }
    
    // Initialize modal properly (optional, but good practice)
    const modalElement = document.getElementById('applyModal');
    let modalInstance = null;
    if (modalElement) {
        modalInstance = new bootstrap.Modal(modalElement);
    }
    
    const form = document.getElementById('jobApplicationForm');
    const submitBtn = document.getElementById('submitApplicationBtn');
    const submitText = document.getElementById('submitText');
    const submittingText = document.getElementById('submittingText');
    const responseMessage = document.getElementById('responseMessage');
    
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        console.error('CSRF token not found!');
    }
    
    if(form) {
        // Remove any existing event listeners by replacing with a new one
        form.removeEventListener('submit', formSubmitHandler);
        form.addEventListener('submit', formSubmitHandler);
    }
    
    async function formSubmitHandler(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Clear previous response message
        if (responseMessage) responseMessage.innerHTML = '';
        
        // Basic client-side validation
        const name = document.getElementById('applicant_name')?.value.trim();
        const email = document.getElementById('applicant_email')?.value.trim();
        const resume = document.getElementById('applicant_resume')?.files[0];
        
        let isValid = true;
        
        if (!name) {
            showFieldError('applicant_name', 'Please enter your full name.');
            isValid = false;
        } else {
            clearFieldError('applicant_name');
        }
        
        if (!email) {
            showFieldError('applicant_email', 'Please enter your email address.');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showFieldError('applicant_email', 'Please enter a valid email address (e.g., name@example.com).');
            isValid = false;
        } else {
            clearFieldError('applicant_email');
        }
        
        if (!resume) {
            showFieldError('applicant_resume', 'Please upload your resume/CV.');
            isValid = false;
        } else {
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!allowedTypes.includes(resume.type)) {
                showFieldError('applicant_resume', 'Only PDF, DOC, or DOCX files are allowed.');
                isValid = false;
            } else if (resume.size > 2 * 1024 * 1024) {
                showFieldError('applicant_resume', 'File size must be less than 2MB.');
                isValid = false;
            } else {
                clearFieldError('applicant_resume');
            }
        }
        
        if (!isValid) {
            return;
        }
        
        // Disable submit button and show loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            if (submitText) submitText.classList.add('d-none');
            if (submittingText) submittingText.classList.remove('d-none');
        }
        
        try {
            const formData = new FormData(form);
            
            const response = await fetch("<?php echo e(route('jobs.apply', $job->slug)); ?>", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const result = await response.json();
            
            if (response.ok && result.success) {
                if (responseMessage) {
                    responseMessage.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #28a745; border-radius: 8px;">
                            <i class="fas fa-check-circle me-2"></i> ${escapeHtml(result.message)}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0.8);"></button>
                        </div>
                    `;
                }
                
                // Reset form
                form.reset();
                
                // Close modal after 2 seconds
                setTimeout(() => {
                    if (modalInstance) {
                        modalInstance.hide();
                    } else if (typeof bootstrap !== 'undefined' && modalElement) {
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        if (modal) modal.hide();
                    }
                    // Reset response message after modal closes
                    if (responseMessage) responseMessage.innerHTML = '';
                }, 2000);
            } else {
                const errorMsg = result.message || 'An error occurred. Please try again.';
                if (responseMessage) {
                    responseMessage.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #dc3545; border-radius: 8px;">
                            <i class="fas fa-exclamation-circle me-2"></i> ${escapeHtml(errorMsg)}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0.8);"></button>
                        </div>
                    `;
                }
            }
        } catch(error) {
            console.error('Form submission error:', error);
            if (responseMessage) {
                responseMessage.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #dc3545; border-radius: 8px;">
                        <i class="fas fa-exclamation-circle me-2"></i> Network error. Please check your connection and try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0.8);"></button>
                    </div>
                `;
            }
        } finally {
            // Re-enable submit button
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitText) submitText.classList.remove('d-none');
                if (submittingText) submittingText.classList.add('d-none');
            }
        }
    }
    
    function showFieldError(fieldId, message) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.add('is-invalid');
            let feedbackDiv = field.nextElementSibling;
            if (!feedbackDiv || !feedbackDiv.classList.contains('invalid-feedback')) {
                feedbackDiv = document.createElement('div');
                feedbackDiv.className = 'invalid-feedback';
                field.parentNode.insertBefore(feedbackDiv, field.nextSibling);
            }
            feedbackDiv.textContent = message;
        }
    }
    
    function clearFieldError(fieldId) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.remove('is-invalid');
            const feedbackDiv = field.nextElementSibling;
            if (feedbackDiv && feedbackDiv.classList.contains('invalid-feedback')) {
                feedbackDiv.textContent = '';
            }
        }
    }
    
    function isValidEmail(email) {
        const re = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        return re.test(email);
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* Additional global styles to ensure modal usability */
    .modal-open {
        overflow: hidden !important;
    }
    .modal-open .modal {
        overflow-x: hidden !important;
        overflow-y: auto !important;
    }
    /* Ensure form inputs are fully interactive */
    .modal .form-control,
    .modal .form-control:focus {
        opacity: 1 !important;
        background-color: #2a2f3e !important;
        color: white !important;
    }
    /* Fix for any accidental pointer-events restrictions */
    .modal,
    .modal * {
        pointer-events: auto !important;
    }
    /* But in modal backdrop we still want to block clicks */
    .modal-backdrop {
        pointer-events: auto !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/frontend/jobs/show.blade.php ENDPATH**/ ?>