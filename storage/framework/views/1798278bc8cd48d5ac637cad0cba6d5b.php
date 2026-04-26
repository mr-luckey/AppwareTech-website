

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Jobs</h6>
                            <h2 class="mb-0"><?php echo e($totalJobs); ?></h2>
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
                            <h2 class="mb-0"><?php echo e($totalCourses); ?></h2>
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
                            <h2 class="mb-0"><?php echo e($totalEnrollments); ?></h2>
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
                            <h2 class="mb-0"><?php echo e(number_format($totalViews)); ?></h2>
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
                        <?php $__currentLoopData = $recentEnrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0"><?php echo e($enrollment->name); ?></h6>
                                    <small class="text-muted"><?php echo e($enrollment->course->title); ?></small>
                                </div>
                                <span class="badge bg-<?php echo e($enrollment->status == 'pending' ? 'warning' : 'success'); ?>">
                                    <?php echo e(ucfirst($enrollment->status)); ?>

                                </span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const ctx = document.getElementById('trafficChart').getContext('2d');
    const viewsData = <?php echo json_encode($viewsData, 15, 512) ?>;
    
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>