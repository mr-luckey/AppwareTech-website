@extends('admin.layouts.app')

@section('title', 'Course Details - ' . $course->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-graduation-cap me-2"></i>Course Details</h2>
    <div>
        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary me-2">
            <i class="fas fa-edit me-1"></i>Edit Course
        </a>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                        @else
                        <div style="width: 100%; height: 200px; background: #e9ecef; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3 class="mb-2">{{ $course->title }}</h3>
                        <div class="mb-2">
                            <span class="badge bg-{{ $course->level == 'beginner' ? 'success' : ($course->level == 'intermediate' ? 'warning' : 'danger') }}">
                                {{ ucfirst($course->level) }}
                            </span>
                            <span class="badge bg-{{ $course->is_active ? 'success' : 'secondary' }} ms-2">
                                {{ $course->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <p class="text-muted mb-2">{{ $course->short_description }}</p>
                        <div class="row text-muted">
                            <div class="col-md-6">
                                <strong>Duration:</strong> {{ $course->duration }}
                            </div>
                            <div class="col-md-6">
                                <strong>Price:</strong> ${{ number_format($course->price, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Course Description</h5>
            </div>
            <div class="card-body">
                {!! $course->description !!}
            </div>
        </div>

        @if($course->content)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Course Content</h5>
            </div>
            <div class="card-body">
                {!! $course->content !!}
            </div>
        </div>
        @endif

        @if($course->curriculum)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Curriculum</h5>
            </div>
            <div class="card-body">
                <div class="accordion" id="curriculumAccordion">
                    @foreach($course->curriculum as $index => $module)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $index }}">
                                {{ $module['title'] }}
                            </button>
                        </h2>
                        <div id="module{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#curriculumAccordion">
                            <div class="accordion-body">
                                <p>{{ $module['description'] }}</p>
                                @if(isset($module['lessons']) && count($module['lessons']) > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($module['lessons'] as $lesson)
                                    <li class="list-group-item">
                                        <i class="fas fa-play-circle text-primary me-2"></i>
                                        {{ $lesson['title'] }}
                                        @if(isset($lesson['duration']))
                                        <span class="badge bg-light text-dark ms-2">{{ $lesson['duration'] }}</span>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h6 class="mb-0">Course Information</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Level:</strong>
                    </div>
                    <div class="col-6 text-end">
                        <span class="badge bg-{{ $course->level == 'beginner' ? 'success' : ($course->level == 'intermediate' ? 'warning' : 'danger') }}">
                            {{ ucfirst($course->level) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Duration:</strong>
                    </div>
                    <div class="col-6 text-end">
                        {{ $course->duration }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Price:</strong>
                    </div>
                    <div class="col-6 text-end">
                        ${{ number_format($course->price, 2) }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-6 text-end">
                        <span class="badge bg-{{ $course->is_active ? 'success' : 'secondary' }}">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-6 text-end">
                        {{ $course->created_at->format('M d, Y') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <strong>Updated:</strong>
                    </div>
                    <div class="col-6 text-end">
                        {{ $course->updated_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
        </div>

        @if($course->meta_title || $course->meta_description)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white">
                <h6 class="mb-0">SEO Information</h6>
            </div>
            <div class="card-body">
                @if($course->meta_title)
                <div class="mb-3">
                    <strong>Meta Title:</strong>
                    <p class="text-muted">{{ $course->meta_title }}</p>
                </div>
                @endif
                @if($course->meta_description)
                <div class="mb-0">
                    <strong>Meta Description:</strong>
                    <p class="text-muted">{{ $course->meta_description }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h6 class="mb-3">Actions</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Course
                    </a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Delete Course
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize any interactive elements if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Add any course-specific JavaScript here
    });
</script>
@endpush