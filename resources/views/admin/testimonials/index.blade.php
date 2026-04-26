@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Testimonials</h1>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Testimonial
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
                    @if($testimonials->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No testimonials found</h5>
                            <p class="text-muted">Add your first testimonial to get started.</p>
                        </div>
                    @else
                        <div class="row">
                            @foreach($testimonials as $testimonial)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="text-center p-3">
                                        @if($testimonial->image)
                                            <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                                 class="rounded-circle" 
                                                 style="width: 120px; height: 120px; object-fit: cover;" 
                                                 alt="{{ $testimonial->name }}">
                                        @else
                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto" 
                                                 style="width: 120px; height: 120px;">
                                                <i class="fas fa-user fa-3x text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $testimonial->name }}</h5>
                                        <p class="card-text text-muted">{{ $testimonial->caption }}</p>
                                    </div>
                                    <div class="card-footer bg-white border-0 pb-3">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $testimonials->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection