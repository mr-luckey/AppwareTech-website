@extends('admin.layouts.app')

@section('title', 'Partners')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Partners</h1>
                <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Partner
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
                    @if($partners->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-handshake fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No partners found</h5>
                            <p class="text-muted">Add your first partner to get started.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($partners as $partner)
                                    <tr>
                                        <td class="text-center">
                                            @if($partner->logo)
                                                <img src="{{ asset('storage/' . $partner->logo) }}" 
                                                     alt="{{ $partner->name }}" 
                                                     style="width: 60px; height: 60px; object-fit: cover; display: block; margin: 0 auto;">
                                            @else
                                                <div style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                                    <i class="fas fa-building text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $partner->name }}</strong>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.partners.edit', $partner) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.partners.destroy', $partner) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this partner?')">
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
                            {{ $partners->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection