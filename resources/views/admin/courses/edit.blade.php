@extends('admin.layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-graduation-cap me-2"></i>Edit Course</h2>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Courses
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $course->title) }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2" maxlength="500">{{ old('short_description', $course->short_description) }}</textarea>
                        <small class="text-muted">Brief description for card display (max 500 characters)</small>
                        @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="mb-3">
                        <label for="content" class="form-label">Course Content</label>
                        <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $course->content) }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Course Image</label>
                        @if($course->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" style="max-width: 200px; border-radius: 5px;">
                        </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="imagePreview" class="mt-2"></div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $course->duration) }}" placeholder="e.g., 12 Weeks, 40 Hours" required>
                        @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $course->price) }}" required>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div class="mb-3">
                        <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" required>
                            <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active', $course->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- SEO Section -->
            <h5 class="mb-3">SEO Settings</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $course->meta_title) }}" maxlength="255">
                        @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2" maxlength="500">{{ old('meta_description', $course->meta_description) }}</textarea>
                        @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Course
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 
                    '<img src="' + e.target.result + '" alt="Preview" style="max-width: 200px; max-height: 150px; border-radius: 5px;">';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection