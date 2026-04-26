@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="mb-4">
    <h2><i class="fas fa-cog me-2"></i>Settings</h2>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
            <i class="fas fa-globe me-1"></i>General Settings
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
            <i class="fas fa-user me-1"></i>Admin Profile
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
            <i class="fas fa-lock me-1"></i>Change Password
        </button>
    </li>
</ul>

<div class="tab-content" id="settingsTabsContent">
    <!-- General Settings Tab -->
    <div class="tab-pane fade show active" id="general" role="tabpanel">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="mb-3">Site Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required>
                                @error('site_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="site_tagline" class="form-label">Site Tagline</label>
                                <input type="text" class="form-control @error('site_tagline') is-invalid @enderror" id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}">
                                @error('site_tagline')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <textarea class="form-control @error('site_description') is-invalid @enderror" id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description']) }}</textarea>
                        @error('site_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="site_keywords" class="form-label">Site Keywords</label>
                        <input type="text" class="form-control @error('site_keywords') is-invalid @enderror" id="site_keywords" name="site_keywords" value="{{ old('site_keywords', $settings['site_keywords']) }}">
                        <small class="text-muted">Comma separated keywords for SEO</small>
                        @error('site_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Branding</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                @if($settings['logo'])
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" style="max-height: 60px;">
                                </div>
                                @endif
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="favicon" class="form-label">Favicon</label>
                                @if($settings['favicon'])
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" style="max-height: 40px;">
                                </div>
                                @endif
                                <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="favicon" name="favicon" accept="image/*">
                                @error('favicon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="primary_color" class="form-label">Primary Color</label>
                                <input type="color" class="form-control form-control-color @error('primary_color') is-invalid @enderror" id="primary_color" name="primary_color" value="{{ old('primary_color', $settings['primary_color']) }}">
                                @error('primary_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="secondary_color" class="form-label">Secondary Color</label>
                                <input type="color" class="form-control form-control-color @error('secondary_color') is-invalid @enderror" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $settings['secondary_color']) }}">
                                @error('secondary_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="header_bg" class="form-label">Header Background</label>
                                <input type="color" class="form-control form-control-color @error('header_bg') is-invalid @enderror" id="header_bg" name="header_bg" value="{{ old('header_bg', $settings['header_bg']) }}">
                                @error('header_bg')
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $settings['email']) }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $settings['phone']) }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $settings['address']) }}">
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="footer_description" class="form-label">Footer Description</label>
                        <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footer_description" name="footer_description" rows="2">{{ old('footer_description', $settings['footer_description']) }}</textarea>
                        @error('footer_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Social Media Links</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}">
                                @error('facebook_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url']) }}">
                                @error('twitter_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url']) }}">
                                @error('linkedin_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Admin Profile Tab -->
    <div class="tab-pane fade" id="profile" role="tabpanel">
        @include('admin.settings.profile')
    </div>

    <!-- Change Password Tab -->
    <div class="tab-pane fade" id="password" role="tabpanel">
        @include('admin.settings.change-password')
    </div>
</div>
@endsection