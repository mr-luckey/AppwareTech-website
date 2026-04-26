@extends('admin.layouts.app')

@section('title', 'Add New Service')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Add New Service</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Service Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Icon Class</label>
                    <input type="text" name="icon" class="form-control" placeholder="fas fa-cog">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="0" min="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Create Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
