<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(url('/')); ?>">
                <i class="fas fa-rocket me-2"></i>
                <?php echo e(\App\Models\Setting::get('site_name', 'AppWareTech')); ?>

            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('services.index')); ?>">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('jobs.index')); ?>">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('courses.index')); ?>">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar {
        background: rgba(10, 15, 35, 0.9) !important;
        backdrop-filter: blur(20px);
        padding: 15px 0;
        border-bottom: 1px solid rgba(108, 92, 231, 0.2);
    }
    
    .navbar-brand {
        font-size: 1.5rem;
        color: #ffffff !important;
        text-shadow: 0 2px 10px rgba(108, 92, 231, 0.3);
    }
    
    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        margin: 0 10px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .navbar-nav .nav-link:hover {
        color: #ffffff !important;
        text-shadow: 0 0 20px rgba(0, 210, 255, 0.5);
    }
    
    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .navbar-nav .nav-link:hover::after {
        width: 80%;
    }
    
    .navbar-toggler {
        border: 1px solid rgba(108, 92, 231, 0.3);
    }
    
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
</style>
<?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/partials/header.blade.php ENDPATH**/ ?>