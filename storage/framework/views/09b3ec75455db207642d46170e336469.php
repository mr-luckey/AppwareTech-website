<?php use App\Models\Setting; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin Panel - <?php echo e(Setting::get('site_name')); ?></title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }
        
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #34495e;
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .card-stats {
            transition: transform 0.3s ease;
        }
        
        .card-stats:hover {
            transform: translateY(-5px);
        }
        
        .data-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-3 text-center border-bottom border-secondary">
                    <h4><?php echo e(Setting::get('site_name', 'AppWareTech')); ?></h4>
                    <small>Admin Panel</small>
                </div>
                <nav class="nav flex-column mt-3">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="fas fa-dashboard"></i> Dashboard
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.jobs.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.jobs.index')); ?>">
                        <i class="fas fa-briefcase"></i> Jobs
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.job-applications.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.job-applications.index')); ?>">
                        <i class="fas fa-file-alt"></i> Job Applications
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.courses.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.courses.index')); ?>">
                        <i class="fas fa-graduation-cap"></i> Courses
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.enrollments.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.enrollments.index')); ?>">
                        <i class="fas fa-users"></i> Enrollments
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.faqs.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.faqs.index')); ?>">
                        <i class="fas fa-question-circle"></i> FAQs
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.services.index')); ?>">
                        <i class="fas fa-cogs"></i> Services
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.team-members.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.team-members.index')); ?>">
                        <i class="fas fa-users"></i> Team Members
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.partners.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.partners.index')); ?>">
                        <i class="fas fa-handshake"></i> Partners
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.testimonials.index')); ?>">
                        <i class="fas fa-comments"></i> Testimonials
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.contact.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.contact.index')); ?>">
                        <i class="fas fa-envelope"></i> Contact Page
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.settings*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.settings')); ?>">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <nav class="navbar navbar-admin navbar-expand-lg mb-4">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="adminNavbar">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle"></i> Admin
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="<?php echo e(url('/')); ?>">View Website</a></li>
                                        <li><a class="dropdown-item" href="<?php echo e(route('admin.password.edit')); ?>">Change Password</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
                <div class="px-4 pb-4">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Summernote for textareas
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>