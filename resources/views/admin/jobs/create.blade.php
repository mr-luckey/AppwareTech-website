@extends('admin.layouts.app')

@section('title', 'Add New Job')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Add New Job</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Job Title *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" class="form-control" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Job Type *</label>
                    <select name="type" class="form-control" required>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="remote">Remote</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Salary Range</label>
                    <input type="text" name="salary_range" class="form-control" placeholder="e.g., $50,000 - $70,000">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Job Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control summernote" rows="10" required></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Requirements (One per line)</label>
                <textarea name="requirements" class="form-control" rows="5" placeholder="Bachelor's degree in CS&#10;3+ years experience&#10;Knowledge of Laravel"></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Benefits (One per line)</label>
                <textarea name="benefits" class="form-control" rows="5" placeholder="Health insurance&#10;Paid time off&#10;Remote work options"></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" class="form-control">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Description (SEO)</label>
                    <textarea name="meta_description" class="form-control" rows="2"></textarea>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Create Job</button>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endpush
@endsection