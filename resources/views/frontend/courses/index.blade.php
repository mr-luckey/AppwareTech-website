@extends('layouts.app')

@section('title', 'Our Courses - ' . \App\Models\Setting::get('site_name'))
@section('meta_description', 'Professional courses to enhance your skills')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold">Our Courses</h1>
            <p class="lead" style="font-size: 1.3rem; color: #ffffff;">Choose from our wide range of professional courses</p>
        </div>
    </div>
    
    <div class="row g-4">
        @forelse($courses as $course)
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <div class="card h-100 border-0 shadow-sm card-hover">
                @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 220px; object-fit: cover;">
                @else
                <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                    <i class="fas fa-graduation-cap fa-4x"></i>
                </div>
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title h4">{{ $course->title }}</h5>
                        <span class="badge bg-primary">{{ ucfirst($course->level) }}</span>
                    </div>
                    <p class="text-primary fw-bold h5 mb-2">${{ number_format($course->price, 2) }}</p>
                    <p class="text-muted mb-2"><i class="fas fa-clock me-1"></i>{{ $course->duration }}</p>
                    <p class="card-text">{{ Str::limit($course->short_description ?? $course->description, 100) }}</p>
                    <button class="btn btn-primary enroll-btn" data-course-slug="{{ $course->slug }}" data-course-title="{{ $course->title }}">
                        <i class="fas fa-user-plus me-1"></i>Enroll Now
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h4>No Courses Available</h4>
                <p>Please check back later for new courses.</p>
            </div>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $courses->links() }}
    </div>
</div>

<!-- Enrollment Modal -->
<div id="enrollmentModal" class="modal-popup" style="display: none;">
    <div class="modal-content-custom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Enroll in Course</h3>
            <button type="button" class="btn-close" onclick="closeModal()"></button>
        </div>
        <p class="text-muted mb-3">Course: <strong id="modalCourseTitle"></strong></p>
        <form id="enrollmentForm">
            @csrf
            <input type="hidden" name="course_slug" id="course_slug">
            <div class="mb-3">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message (Optional)</label>
                <textarea name="message" class="form-control" rows="3" placeholder="Any questions or comments?"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                <i class="fas fa-paper-plane me-1"></i>Submit Enrollment
            </button>
        </form>
    </div>
</div>

<!-- Success Alert -->
<div id="successAlert" class="alert-popup" style="display: none;">
    <div class="alert-content">
        <div class="text-center mb-3">
            <i class="fas fa-check-circle text-success fa-3x mb-2"></i>
            <h4>Enrollment Submitted!</h4>
        </div>
        <p id="successMessage" class="text-center mb-3"></p>
        <button class="btn btn-primary w-100" onclick="closeSuccessAlert()">OK</button>
    </div>
</div>

<style>
    .modal-popup {
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-content-custom {
        background-color: white;
        padding: 30px;
        width: 90%;
        max-width: 500px;
        border-radius: 15px;
        animation: slideDown 0.3s ease;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .alert-popup {
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .alert-content {
        background-color: white;
        padding: 40px;
        width: 90%;
        max-width: 400px;
        border-radius: 15px;
        animation: slideDown 0.3s ease;
        text-align: center;
    }
</style>

@push('scripts')
<script>
    let currentCourseSlug = null;
    
    document.querySelectorAll('.enroll-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentCourseSlug = this.dataset.courseSlug;
            const courseTitle = this.dataset.courseTitle;
            document.getElementById('course_slug').value = currentCourseSlug;
            document.getElementById('modalCourseTitle').textContent = courseTitle;
            document.getElementById('enrollmentModal').style.display = 'flex';
        });
    });
    
    function closeModal() {
        document.getElementById('enrollmentModal').style.display = 'none';
    }
    
    function closeSuccessAlert() {
        document.getElementById('successAlert').style.display = 'none';
        document.getElementById('enrollmentForm').reset();
        closeModal();
    }
    
    document.getElementById('enrollmentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Submitting...';
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch(`/courses/${currentCourseSlug}/enroll`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('successMessage').textContent = data.message;
                document.getElementById('successAlert').style.display = 'flex';
            } else {
                alert('Error submitting enrollment. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Submit Enrollment';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Submit Enrollment';
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('enrollmentModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('successAlert').addEventListener('click', function(event) {
        if (event.target === this) {
            closeSuccessAlert();
        }
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
@endsection