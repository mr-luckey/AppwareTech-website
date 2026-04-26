@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Jobs</h6>
                            <h2 class="mb-0">{{ $totalJobs }}</h2>
                        </div>
                        <div class="bg-primary rounded-circle p-3">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Courses</h6>
                            <h2 class="mb-0">{{ $totalCourses }}</h2>
                        </div>
                        <div class="bg-success rounded-circle p-3">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Enrollments</h6>
                            <h2 class="mb-0">{{ $totalEnrollments }}</h2>
                        </div>
                        <div class="bg-info rounded-circle p-3">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Views</h6>
                            <h2 class="mb-0">{{ number_format($totalViews) }}</h2>
                        </div>
                        <div class="bg-warning rounded-circle p-3">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Website Traffic (Last 30 Days)</h5>
                </div>
                <div class="card-body">
                    <canvas id="trafficChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Enrollments</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($recentEnrollments as $enrollment)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $enrollment->name }}</h6>
                                    <small class="text-muted">{{ $enrollment->course->title }}</small>
                                </div>
                                <span class="badge bg-{{ $enrollment->status == 'pending' ? 'warning' : 'success' }}">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('trafficChart').getContext('2d');
    const viewsData = @json($viewsData);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: viewsData.map(item => item.date),
            datasets: [{
                label: 'Page Views',
                data: viewsData.map(item => item.views),
                borderColor: '#4a90e2',
                backgroundColor: 'rgba(74, 144, 226, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection