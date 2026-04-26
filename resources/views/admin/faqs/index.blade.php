@extends('admin.layouts.app')

@section('title', 'FAQs Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-question-circle me-2"></i>FAQs Management</h2>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New FAQ
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        @if($faqs->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">Order</th>
                        <th>Question</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $faq->order }}</span>
                        </td>
                        <td>
                            <strong>{{ Str::limit($faq->question, 80) }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-{{ $faq->is_active ? 'success' : 'secondary' }}">
                                {{ $faq->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
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
            {{ $faqs->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-question-circle fa-4x text-muted mb-3"></i>
            <h5>No FAQs found</h5>
            <p class="text-muted">Start by adding your first FAQ.</p>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New FAQ
            </a>
        </div>
        @endif
    </div>
</div>
@endsection