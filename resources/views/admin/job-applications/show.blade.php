@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Application Details</h1>
                <a href="{{ route('admin.job-applications.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Applications
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Application Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Information</h5>
                    @php
                        $statusClass = [
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            'shortlisted' => 'info'
                        ][$application->status];
                    @endphp
                    <span class="badge bg-{{ $statusClass }} fs-6">{{ ucfirst($application->status) }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Applicant Name</label>
                            <p class="fw-bold">{{ $application->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Email Address</label>
                            <p><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Phone Number</label>
                            <p>{{ $application->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Applied On</label>
                            <p>{{ $application->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Job Position</label>
                            <p>
                                <a href="{{ route('admin.jobs.edit', $application->job) }}" class="text-decoration-none">
                                    {{ $application->job->title }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Read Status</label>
                            <p>
                                @if($application->read_at)
                                    <span class="text-success"><i class="fas fa-check-circle me-1"></i>Read on {{ $application->read_at->format('M d, Y H:i A') }}</span>
                                @else
                                    <span class="text-warning"><i class="fas fa-circle me-1"></i>Unread</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($application->resume)
                    <div class="mb-3">
                        <label class="text-muted small">Resume/CV</label>
                        <div class="mt-1">
                            <a href="{{ asset('storage/' . $application->resume) }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                <i class="fas fa-file-download me-2"></i>Download Resume
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($application->cover_letter)
                    <div class="mb-3">
                        <label class="text-muted small">Cover Letter</label>
                        <div class="mt-1 p-3 bg-light rounded">
                            {{ $application->cover_letter }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.job-applications.update-status', $application) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" placeholder="Add notes about this application...">{{ $application->admin_notes }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Update Application
                        </button>
                    </form>
                </div>
            </div>

            <!-- Job Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Job Information</h5>
                </div>
                <div class="card-body">
                    <h6>{{ $application->job->title }}</h6>
                    <p class="text-muted mb-2">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $application->job->location }}
                    </p>
                    <p class="text-muted mb-2">
                        <span class="badge bg-primary">{{ ucfirst($application->job->type) }}</span>
                    </p>
                    <a href="{{ route('admin.jobs.edit', $application->job) }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-edit me-2"></i>View Job Details
                    </a>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card mt-4 border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Once you delete this application, there is no going back. Please be certain.</p>
                    <form action="{{ route('admin.job-applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection