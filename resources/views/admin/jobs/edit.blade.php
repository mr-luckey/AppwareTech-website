@extends('admin.layouts.app')

@section('title', 'Edit Job')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Job</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Job Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $job->location) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Job Type *</label>
                    <select name="type" class="form-control" required>
                        @foreach (['full-time', 'part-time', 'remote', 'contract'] as $type)
                            <option value="{{ $type }}" @selected(old('type', $job->type) === $type)>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Salary Range</label>
                    <input type="text" name="salary_range" class="form-control" value="{{ old('salary_range', $job->salary_range) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Job Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control summernote" rows="10" required>{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Requirements (One per line)</label>
                <textarea name="requirements" class="form-control" rows="5">{{ old('requirements', is_array($job->requirements) ? implode("\n", $job->requirements) : '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Benefits (One per line)</label>
                <textarea name="benefits" class="form-control" rows="5">{{ old('benefits', is_array($job->benefits) ? implode("\n", $job->benefits) : '') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" @checked(old('is_active', $job->is_active))>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Job</button>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
