@extends('admin.layouts.app')

@section('title', 'Contact Page Management')

@section('content')
<div class="mb-4">
    <h2><i class="fas fa-envelope me-2"></i>Contact Page Management</h2>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.contact.update') }}" method="POST">
            @csrf
            
            <h5 class="mb-3">Page Content</h5>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_page_title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('contact_page_title') is-invalid @enderror" id="contact_page_title" name="contact_page_title" value="{{ old('contact_page_title', $contactSettings['contact_page_title']) }}" required>
                        @error('contact_page_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_page_description" class="form-label">Page Description</label>
                        <input type="text" class="form-control @error('contact_page_description') is-invalid @enderror" id="contact_page_description" name="contact_page_description" value="{{ old('contact_page_description', $contactSettings['contact_page_description']) }}">
                        @error('contact_page_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Contact Information</h5>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email', $contactSettings['contact_email']) }}" required>
                        @error('contact_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $contactSettings['contact_phone']) }}" required>
                        @error('contact_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('contact_address') is-invalid @enderror" id="contact_address" name="contact_address" value="{{ old('contact_address', $contactSettings['contact_address']) }}" required>
                        @error('contact_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Google Map</h5>
            
            <div class="mb-3">
                <label for="contact_map_embed" class="form-label">Map Embed Code</label>
                <textarea class="form-control @error('contact_map_embed') is-invalid @enderror" id="contact_map_embed" name="contact_map_embed" rows="4" placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ old('contact_map_embed', $contactSettings['contact_map_embed']) }}</textarea>
                <small class="text-muted">Paste the iframe embed code from Google Maps</small>
                @error('contact_map_embed')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Display Options</h5>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="contact_show_info" name="contact_show_info" {{ old('contact_show_info', $contactSettings['contact_show_info']) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="contact_show_info">Show Contact Information</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="contact_show_form" name="contact_show_form" {{ old('contact_show_form', $contactSettings['contact_show_form']) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="contact_show_form">Show Contact Form</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="contact_show_map" name="contact_show_map" {{ old('contact_show_map', $contactSettings['contact_show_map']) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="contact_show_map">Show Google Map</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Save Contact Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection