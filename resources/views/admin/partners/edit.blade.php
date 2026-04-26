@extends('admin.layouts.app')

@section('title', 'Edit Partner')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Edit Partner</h1>
                <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $partner->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            <div class="form-text">Upload a new logo to replace the current one (JPEG, PNG, GIF, max 2MB)</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($partner->logo)
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label>
                                <div>
                                    <img src="{{ asset('storage/' . $partner->logo) }}" 
                                         alt="{{ $partner->name }}" 
                                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid #dee2e6;">
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Partner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection