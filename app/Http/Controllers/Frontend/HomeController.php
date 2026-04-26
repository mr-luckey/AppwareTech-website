<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Job;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $recentJobs = Job::where('is_active', true)->latest()->take(3)->get();
        $featuredCourses = Course::where('is_active', true)->latest()->take(4)->get();

        $teamMembers = \App\Models\TeamMember::all();
        $partners = \App\Models\Partner::all();
        $testimonials = Testimonial::all();
        $faqs = Faq::where('is_active', true)->orderBy('order')->get();

        return view('frontend.home', compact('services', 'recentJobs', 'featuredCourses', 'teamMembers', 'partners', 'testimonials', 'faqs'));
    }
}