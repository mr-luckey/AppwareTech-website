@extends('admin.layouts.app')

@section('title', 'Team Members')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Team Members</h1>
                <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Team Member
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    @if($teamMembers->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No team members found</h5>
                            <p class="text-muted">Add your first team member to get started.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamMembers as $member)
                                    <tr>
                                        <td class="text-center">
                                            @if($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}" 
                                                     alt="{{ $member->name }}" 
                                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%; display: block; margin: 0 auto;">
                                            @else
                                                <div style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $member->name }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $member->role }}</span>
                                        </td>
                                        <td>
                                            {{ Str::limit($member->description, 100) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.team-members.edit', $member) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.team-members.destroy', $member) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this team member?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $teamMembers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection