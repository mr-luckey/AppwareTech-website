<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <?php if (! empty(trim($__env->yieldContent('title')))): ?>
        <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(\App\Models\Setting::get('site_name', 'AppWareTech')); ?></title>
    <?php else: ?>
        <title><?php echo e(\App\Models\Setting::get('site_name', 'AppWareTech')); ?> - <?php echo e(\App\Models\Setting::get('site_tagline', 'Software Solutions')); ?></title>
    <?php endif; ?>
    
    <?php echo $__env->yieldContent('meta_tags'); ?>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', \App\Models\Setting::get('site_description', 'Professional software development company')); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'web development, software, laravel, wordpress, flutter'); ?>">
    <meta name="author" content="AppWareTech">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', \App\Models\Setting::get('site_name', 'AppWareTech')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', \App\Models\Setting::get('site_description', '')); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('images/logo.png')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', \App\Models\Setting::get('site_name', 'AppWareTech')); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', \App\Models\Setting::get('site_description', '')); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(\App\Models\Setting::get('favicon', asset('images/favicon.ico'))); ?>">
    
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: <?php echo e(\App\Models\Setting::get('primary_color', '#6c5ce7')); ?>;
            --primary-light: <?php echo e(\App\Models\Setting::get('primary_color', '#6c5ce7')); ?>33;
            --secondary-color: <?php echo e(\App\Models\Setting::get('secondary_color', '#a855f7')); ?>;
            --accent-color: #00d2ff;
            --heading-color: #ffffff;
            --text-color: rgba(255,255,255,0.9);
            --glass-bg: rgba(15, 25, 45, 0.65);
        }
        
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(135deg, #0a0f23 0%, #101850 50%, #0a0f23 100%);
            min-height: 100vh;
            color: var(--text-color);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }
        
        /* 3D Background Scene - Applies to entire body */
        .scene-3d {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }
        
        /* Enhanced 3D Cube Styles */
        .cube {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 220px;
            height: 220px;
            transform-style: preserve-3d;
            transform: translate(-50%, -50%) rotateX(-25deg) rotateY(35deg);
            animation: rotateCube 25s infinite linear;
        }
        
        .face {
            position: absolute;
            width: 220px;
            height: 220px;
            border: 2px solid rgba(108, 92, 231, 0.4);
            background: rgba(25, 35, 60, 0.7);
            backdrop-filter: blur(15px);
            box-shadow: 
                inset 0 0 30px rgba(0, 210, 255, 0.3),
                0 0 15px rgba(108, 92, 231, 0.2);
            background: linear-gradient(
                135deg,
                rgba(25, 35, 60, 0.8) 0%,
                rgba(35, 45, 70, 0.6) 100%
            );
        }
        
        .front  { transform: translateZ(110px); }
        .back   { transform: rotateY(180deg) translateZ(110px); }
        .right  { transform: rotateY(90deg) translateZ(110px); }
        .left   { transform: rotateY(-90deg) translateZ(110px); }
        .top    { transform: rotateX(90deg) translateZ(110px); }
        .bottom { transform: rotateX(-90deg) translateZ(110px); }
        
        @keyframes rotateCube {
            0% { 
                transform: translate(-50%, -50%) rotateX(-25deg) rotateY(35deg);
            }
            20% { 
                transform: translate(-50%, -50%) rotateX(-15deg) rotateY(110deg);
            }
            40% { 
                transform: translate(-50%, -50%) rotateX(25deg) rotateY(180deg);
            }
            60% { 
                transform: translate(-50%, -50%) rotateX(-10deg) rotateY(270deg);
            }
            80% { 
                transform: translate(-50%, -50%) rotateX(20deg) rotateY(340deg);
            }
            100% { 
                transform: translate(-50%, -50%) rotateX(-25deg) rotateY(395deg);
            }
        }
        
        /* Add glow effect to faces */
        .face::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(0, 210, 255, 0.4) 50%,
                transparent 70%
            );
            z-index: -1;
            border-radius: inherit;
            animation: glowMove 6s linear infinite;
        }
        
        @keyframes glowMove {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 200% 50%;
            }
        }
        
        /* Keep orb styles for reference but don't use them */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(1px);
            opacity: 0.6;
            animation: float 20s infinite ease-in-out;
            display: none; /* Hide the old orbs */
        }
        
        .orb-1 { top: 10%; left: 10%; animation-delay: 0s; }
        .orb-2 { bottom: 20%; right: 10%; animation-delay: -5s; }
        .orb-3 { top: 50%; left: 20%; animation-delay: -10s; }
        .orb-4 { top: 10%; left: -50px; animation-delay: -15s; }
        .orb-5 { bottom: 10%; left: 30%; animation-delay: -7s; }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(20px, -30px) rotate(90deg); }
            50% { transform: translate(-10px, 20px) rotate(180deg); }
            75% { transform: translate(30px, 10px) rotate(270deg); }
        }
        
        .orb {
            background: radial-gradient(circle at 30% 30%, 
                rgba(0, 210, 255, 0.3), 
                rgba(108, 92, 231, 0.15));
        }
        
        /* Card Hover with 3D effect */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.675, 0.32, 1.28);
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        
        .card-hover:hover {
            transform: translateY(-8px) rotateX(2deg) rotateY(1deg);
            box-shadow: 
                0 20px 40px rgba(108, 92, 231, 0.3),
                0 0 60px rgba(0, 210, 255, 0.1);
        }
        
        /* Glassmorphism Cards */
        .glass-card {
            background: rgba(25, 35, 60, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(108, 92, 231, 0.3);
            border-radius: 20px;
            overflow: hidden;
        }
        
        /* Consistent Card Design */
        .card {
            background: rgba(25, 35, 60, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(108, 92, 231, 0.3);
            border-radius: 20px;
            overflow: hidden;
        }
        
        .card .card-body {
            color: var(--text-color);
        }
        
        /* White text for headings and content */
        .card .card-title,
        .card .card-text,
        .card h5, .card h4, .card h3, .card h2, .card h1 {
            color: #ffffff !important;
        }
        
        .text-white-custom {
            color: #ffffff !important;
        }
        
        /* Service Icon */
        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.3);
            transition: transform 0.3s ease;
        }
        
        .service-icon i {
            color: #ffffff;
            font-size: 2rem;
        }
        
        .card-hover:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        /* Counter */
        .counter {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .counter-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        /* Job Images */
        .job-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .job-detail-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        
        /* Team & Testimonial Images */
        .team-member-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(108, 92, 231, 0.5);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }
        
        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(108, 92, 231, 0.5);
        }
        
        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 12px 25px rgba(108, 92, 231, 0.4),
                0 0 30px rgba(0, 210, 255, 0.2);
        }
        
        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::after {
            left: 100%;
        }
        
        /* Header */
        header {
            background: rgba(10, 15, 35, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(108, 92, 231, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        /* Footer */
        footer {
            background: rgba(10, 15, 35, 0.95);
            border-top: 1px solid rgba(108, 92, 231, 0.2);
            padding: 40px 0 20px;
            margin-top: auto;
        }
        
        /* Section backgrounds for 3D visibility */
        section {
            position: relative;
            z-index: 1;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- 3D Background -->
    <div class="scene-3d">
        <div class="cube">
            <div class="face front"></div>
            <div class="face back"></div>
            <div class="face right"></div>
            <div class="face left"></div>
            <div class="face top"></div>
            <div class="face bottom"></div>
        </div>
    </div>
    
    <!-- Header -->
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Main Content -->
    <main style="position: relative; z-index: 1;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <!-- Footer -->
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 50
            });
            
            // Parallax effect for orbs - follows mouse
            const orbs = document.querySelectorAll('.orb');
            window.addEventListener('mousemove', (e) => {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;
                
                orbs.forEach((orb, index) => {
                    const speed = (index + 1) * 20;
                    const x = (mouseX - 0.5) * speed;
                    const y = (mouseY - 0.5) * speed;
                    orb.style.transform = `translate(${x}px, ${y}px)`;
                });
            });
            
            // Mobile menu toggle
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarMenu = document.querySelector('.navbar-collapse');
            if(navbarToggler && navbarMenu) {
                navbarToggler.addEventListener('click', function() {
                    navbarMenu.classList.toggle('show');
                });
            }
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\wordpress\htdocs\New folder\appwaretech\resources\views/layouts/app.blade.php ENDPATH**/ ?>