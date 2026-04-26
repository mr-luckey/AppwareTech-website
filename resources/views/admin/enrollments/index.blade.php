@extends('admin.layouts.app')

@section('title', 'Enrollments Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i>Enrollments Management</h2>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Pending</h6>
                        <h2 class="mb-0">{{ $pendingCount }}</h2>
                    </div>
                    <i class="fas fa-clock fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Approved</h6>
                        <h2 class="mb-0">{{ $approvedCount }}</h2>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Rejected</h6>
                        <h2 class="mb-0">{{ $rejectedCount }}</h2>
                    </div>
                    <i class="fas fa-times-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Total</h6>
                        <h2 class="mb-0">{{ $pendingCount + $approvedCount + $rejectedCount }}</h2>
                    </div>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.enrollments.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Filter by Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Filter by Course</label>
                <select name="course" class="form-select">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Enrollments Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        @if($enrollments->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                    <tr>
                        <td>#{{ $enrollment->id }}</td>
                        <td><strong>{{ $enrollment->name }}</strong></td>
                        <td>{{ $enrollment->email }}</td>
                        <td>{{ $enrollment->phone }}</td>
                        <td>
                            @if($enrollment->course)
                            <span class="text-primary">{{ Str::limit($enrollment->course->title, 30) }}</span>
                            @else
                            <span class="text-muted">Course Deleted</span>
                            @endif
                        </td>
                        <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $enrollment->status == 'pending' ? 'warning' : ($enrollment->status == 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $enrollments->withQueryString()->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-3"></i>
            <h5>No enrollments found</h5>
            <p class="text-muted">Enrollments will appear here when users submit the enrollment form.</p>
        </div>
        @endif
    </div>
</div>
@endsection