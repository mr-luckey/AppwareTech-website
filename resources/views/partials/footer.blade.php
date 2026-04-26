<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3" style="color: #ffffff;">
                    <i class="fas fa-rocket me-2"></i>{{ \App\Models\Setting::get('site_name', 'AppWareTech') }}
                </h5>
                <p style="color: rgba(255,255,255,0.7);">Professional software development company delivering innovative solutions for your business growth.</p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3" style="color: #ffffff;">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Home</a></li>
                    <li class="mb-2"><a href="{{ route('services.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Services</a></li>
                    <li class="mb-2"><a href="{{ route('jobs.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Jobs</a></li>
                    <li class="mb-2"><a href="{{ route('courses.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Courses</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3" style="color: #ffffff;">Contact Info</h6>
                <ul class="list-unstyled">
                    <li class="mb-2" style="color: rgba(255,255,255,0.7);">
                        <i class="fas fa-envelope me-2"></i>info@appwaretech.com
                    </li>
                    <li class="mb-2" style="color: rgba(255,255,255,0.7);">
                        <i class="fas fa-phone me-2"></i>+92 300 1234567
                    </li>
                    <li class="mb-2" style="color: rgba(255,255,255,0.7);">
                        <i class="fas fa-map-marker-alt me-2"></i>Lahore, Pakistan
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3" style="color: #ffffff;">Newsletter</h6>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Subscribe for latest updates</p>
                <form class="mt-2">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(108, 92, 231, 0.3); color: #ffffff;">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <hr style="border-color: rgba(108, 92, 231, 0.2); margin: 30px 0;">
        <div class="text-center">
            <p style="color: rgba(255,255,255,0.6); margin-bottom: 0;">
                &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'AppWareTech') }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>
