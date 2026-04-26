@extends('layouts.app')

@section('title', 'About Us - ' . \App\Models\Setting::get('site_name'))
@section('meta_description', 'Learn about AppWareTech - our mission, vision, and team')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold">About Us</h1>
            <p class="lead" style="font-size: 1.3rem; color: #ffffff;">Delivering excellence in software development since 2015</p>
        </div>
    </div>
    
    <div class="row align-items-center mb-5">
        <div class="col-lg-6" data-aos="fade-right">
            <h2 style="color: #ffffff; font-size: 2rem;">Our Story</h2>
            <p class="lead" style="font-size: 1.1rem; color: #ffffff;">AppWareTech was founded with a vision to provide innovative software solutions that drive business growth.</p>
            <p style="font-size: 1.1rem; color: #ffffff;">We specialize in web development, mobile applications, and digital transformation services. Our team of experienced developers and designers work tirelessly to deliver cutting-edge solutions that meet our clients' unique needs.</p>
            <p style="font-size: 1.1rem; color: #ffffff;">With over 500+ successful projects delivered and 300+ happy clients worldwide, we have established ourselves as a trusted partner in the software development industry.</p>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="img-fluid rounded shadow">
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12 text-center mb-4" data-aos="fade-up">
            <h2 style="color: #ffffff; font-size: 2rem;">Our Mission & Vision</h2>
        </div>
        <div class="col-md-6 mb-4" data-aos="fade-up">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="service-icon mx-auto mb-3">
                    <i class="fas fa-bullseye fa-2x"></i>
                </div>
                <h3 style="color: #ffffff; font-size: 1.5rem;">Our Mission</h3>
                <p style="font-size: 1.05rem; color: #ffffff;">To empower businesses with innovative technology solutions that drive growth, efficiency, and success in the digital age.</p>
            </div>
        </div>
        <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="service-icon mx-auto mb-3">
                    <i class="fas fa-eye fa-2x"></i>
                </div>
                <h3 style="color: #ffffff; font-size: 1.5rem;">Our Vision</h3>
                <p style="font-size: 1.05rem; color: #ffffff;">To become a global leader in software development, known for innovation, quality, and exceptional client satisfaction.</p>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12 text-center mb-4" data-aos="fade-up">
            <h2 style="color: #ffffff; font-size: 2rem;">Why Choose Us?</h2>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up">
            <div class="text-center">
                <i class="fas fa-medal fa-3x text-primary mb-3"></i>
                <h4 style="color: #ffffff; font-size: 1.3rem;">Quality Assurance</h4>
                <p style="font-size: 1.05rem; color: #ffffff;">Rigorous testing and quality checks ensure bug-free, reliable software.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
                <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                <h4 style="color: #ffffff; font-size: 1.3rem;">On-Time Delivery</h4>
                <p style="font-size: 1.05rem; color: #ffffff;">We respect deadlines and deliver projects on time, every time.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
                <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                <h4 style="color: #ffffff; font-size: 1.3rem;">24/7 Support</h4>
                <p style="font-size: 1.05rem; color: #ffffff;">Round-the-clock technical support for all your business needs.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .service-icon {
        width: 70px;
        height: 70px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .service-icon i {
        color: white;
    }
</style>
@endsection