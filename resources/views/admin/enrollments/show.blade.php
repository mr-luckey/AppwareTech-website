@extends('admin.layouts.app')

@section('title', 'View Enrollment')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user me-2"></i>Enrollment Details #{{ $enrollment->id }}</h2>
    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Enrollments
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Applicant Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Full Name</label>
                        <p class="mb-0 fw-bold">{{ $enrollment->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Email Address</label>
                        <p class="mb-0">{{ $enrollment->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Phone Number</label>
                        <p class="mb-0">{{ $enrollment->phone }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Submitted On</label>
                        <p class="mb-0">{{ $enrollment->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    @if($enrollment->message)
                    <div class="col-md-12">
                        <label class="text-muted small">Message</label>
                        <p class="mb-0">{{ $enrollment->message }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($enrollment->course)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Course Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($enrollment->course->image)
                        <img src="{{ asset('storage/' . $enrollment->course->image) }}" alt="{{ $enrollment->course->title }}" class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $enrollment->course->title }}</h5>
                        <p class="text-muted mb-2">{{ Str::limit($enrollment->course->short_description ?? $enrollment->course->description, 200) }}</p>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="badge bg-primary">{{ ucfirst($enrollment->course->level) }}</span>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted"><i class="fas fa-clock me-1"></i>{{ $enrollment->course->duration }}</span>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted"><i class="fas fa-dollar-sign me-1"></i>{{ number_format($enrollment->course->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Actions</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Current Status</label>
                    <div class="mb-3">
                        <span class="badge bg-{{ $enrollment->status == 'pending' ? 'warning' : ($enrollment->status == 'approved' ? 'success' : 'danger') }} fs-6">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('admin.enrollments.update-status', $enrollment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $enrollment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $enrollment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $enrollment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-save me-1"></i>Update Status
                    </button>
                </form>

                <hr>

                <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash me-1"></i>Delete Enrollment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection