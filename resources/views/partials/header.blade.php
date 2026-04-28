<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
			<a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('appwaretech-logo3.jpeg') }}" alt="AppWareTech Logo" class="appwaretech-logo me-2">
				{{ \App\Models\Setting::get('site_name', 'AppWareTech') }}
			</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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
            padding: 25px 0; /* Increased from 15px 0 */
            border-bottom: 1px solid rgba(108, 92, 231, 0.2);
        }
        
        .navbar-brand {
            font-size: 1.8rem; /* Increased from 1.5rem */
            color: #ffffff !important;
            text-shadow: 0 2px 10px rgba(108, 92, 231, 0.3);
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            margin: 0 12px; /* Increased from 0 10px */
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 12px; /* Added padding for better click area */
            border-radius: 6px;
        }
        
        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            text-shadow: 0 0 20px rgba(0, 210, 255, 0.5);
            background: rgba(108, 92, 231, 0.15); /* Added background on hover */
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
            border-radius: 6px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:hover {
            background: rgba(108, 92, 231, 0.2); /* Added background on hover */
            border-color: rgba(108, 92, 231, 0.4);
            transform: scale(1.05);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
    
    <style>
        .appwaretech-logo {
            width: 50px; /* Increased from 40px */
            height: 50px; /* Increased from 40px */
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
    </style>
