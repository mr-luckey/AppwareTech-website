@extends('layouts.app')

@section('title', 'Job Opportunities - ' . \App\Models\Setting::get('site_name'))
@section('meta_description', 'Find latest job opportunities at ' . \App\Models\Setting::get('site_name'))

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5 mt-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold" style="color: #ffffff;">Job Opportunities</h1>
            <p class="lead" style="color: rgba(255,255,255,0.85);">Find your dream career with us</p>
        </div>
    </div>
    
    <div class="row g-4">
        @foreach($jobs as $job)
        <div class="col-md-4 col-12">
            <div class="card h-100 border-0 shadow-sm card-hover" data-aos="fade-up">
                @if($job->image)
                <img src="{{ asset('storage/' . $job->image) }}" class="card-img-top job-img" alt="{{ $job->title }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h3 class="card-title h4">{{ $job->title }}</h3>
                    <div class="mb-2">
                        @if($job->type)
                        <span class="badge bg-primary me-2">{{ ucfirst($job->type) }}</span>
                        @endif
                        @if($job->location)
                        <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}</span>
                        @endif
                        @if($job->salary_range)
                        <span class="text-muted ms-3"><i class="fas fa-dollar-sign me-1"></i>{{ $job->salary_range }}</span>
                        @endif
                    </div>
                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($job->description), 150) }}</p>
                    <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
