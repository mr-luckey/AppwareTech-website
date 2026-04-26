@extends('admin.layouts.app')

@section('title', 'Manage Jobs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Jobs Management</h2>
    <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Job
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->location }}</td>
                        <td>
                            <span class="badge bg-{{ $job->type == 'full-time' ? 'primary' : ($job->type == 'part-time' ? 'info' : 'secondary') }}">
                                {{ ucfirst($job->type) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $job->is_active ? 'success' : 'danger' }}">
                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ number_format($job->views) }}</td>
                        <td>
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-info btn-action">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection