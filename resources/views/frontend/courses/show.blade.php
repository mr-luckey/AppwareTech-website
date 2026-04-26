@extends('layouts.app')

@section('title', $course->title . ' - ' . \App\Models\Setting::get('site_name'))
@section('meta_description', Str::limit(strip_tags($course->description), 160))

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto" data-aos="fade-up">
            <div class="card border-0 shadow-sm">
                @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title h2 mb-3">{{ $course->title }}</h1>
                    
                    <div class="mb-4">
                        <span class="badge bg-primary me-2">{{ ucfirst($course->level) }}</span>
                        <span class="text-muted"><i class="fas fa-clock me-1"></i>{{ $course->duration }}</span>
                        <span class="text-primary fw-bold ms-3">${{ number_format($course->price, 2) }}</span>
                    </div>
                    
                    <div class="course-description">
                        <h3>About this Course</h3>
                        {!! $course->description !!}
                    </div>
                    
                    @if($course->content)
                    <div class="course-content mt-4">
                        <h3>Course Content</h3>
                        {!! $course->content !!}
                    </div>
                    @endif
                    
                    @if($course->curriculum && count($course->curriculum) > 0)
                    <div class="course-curriculum mt-4">
                        <h3>Curriculum</h3>
                        <ul>
                            @foreach($course->curriculum as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <button class="btn btn-primary btn-lg enroll-btn" data-course-id="{{ $course->id }}" data-course-title="{{ $course->title }}">Enroll Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enrollment Modal (same as index page) -->
<div id="enrollmentModal" class="modal-popup">
    <div class="modal-content-custom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Enroll in Course</h3>
            <button type="button" class="btn-close" onclick="closeModal()"></button>
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
    
    .course-description h1, .course-description h2, .course-description h3,
    .course-content h1, .course-content h2, .course-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .course-description p, .course-content p {
        margin-bottom: 1rem;
        line-height: 1.8;
    }
</style>

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
@endsection