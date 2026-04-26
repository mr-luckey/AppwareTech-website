@extends('admin.layouts.app')

@section('title', 'Manage Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Services Management</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Service
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td><i class="{{ $service->icon ?: 'fas fa-cog' }}"></i></td>
                        <td>{{ $service->order }}</td>
                        <td>
                            <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-info btn-action">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Delete this service?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No services found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
