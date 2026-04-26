@php use App\Models\Setting; @endphp
@extends('layouts.app')

@section('title', 'Our Courses - ' . Setting::get('site_name'))
@section('meta_description', 'Professional courses to enhance your skills')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold">Our Courses</h1>
            <p class="lead">Choose from our wide range of professional courses</p>
        </div>
    </div>
    
    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <div class="card h-100 border-0 shadow-sm card-hover">
                @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 220px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title h4">{{ $course->title }}</h5>
                        <span class="badge bg-primary">{{ ucfirst($course->level) }}</span>
                    </div>
                    <p class="text-primary fw-bold h5 mb-2">${{ number_format($course->price, 2) }}</p>
                    <p class="text-muted mb-2"><i class="fas fa-clock me-1"></i>{{ $course->duration }}</p>
                    <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                    <button class="btn btn-primary enroll-btn" data-course-id="{{ $course->id }}" data-course-title="{{ $course->title }}">Enroll Now</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $courses->links() }}
    </div>
</div>

<!-- Enrollment Modal -->
<div id="enrollmentModal" class="modal-popup">
    <div class="modal-content-custom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Enroll in Course</h3>
            <button class="btn-close" onclick="closeModal()"></button>
        </div>
        <form id="enrollmentForm">
            @csrf
            <input type="hidden" name="course_id" id="course_id">
            <div class="mb-3">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone *</label>
                <input type="tel" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Enrollment</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let currentCourseId = null;
    
    document.querySelectorAll('.enroll-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentCourseId = this.dataset.courseId;
            document.getElementById('course_id').value = currentCourseId;
            document.getElementById('enrollmentModal').style.display = 'block';
        });
    });
    
    function closeModal() {
        document.getElementById('enrollmentModal').style.display = 'none';
    }
    
    document.getElementById('enrollmentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch(`/courses/${currentCourseId}/enroll`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert(data.message);
                closeModal();
                this.reset();
            } else {
                alert('Error submitting enrollment');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
    
    window.onclick = function(event) {
        const modal = document.getElementById('enrollmentModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endpush

<style>
    .modal-popup {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
    }
    
    .modal-content-custom {
        background-color: white;
        margin: 5% auto;
        padding: 30px;
        width: 90%;
        max-width: 500px;
        border-radius: 15px;
        animation: slideDown 0.5s ease;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
@endsection