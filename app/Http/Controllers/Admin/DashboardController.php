<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Analytic;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJobs = Job::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $totalViews = Analytic::sum('views');
        
        // Get last 30 days views data for chart
        $viewsData = Analytic::where('date', '>=', Carbon::now()->subDays(30))
            ->selectRaw('DATE(date) as date, SUM(views) as views')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $recentEnrollments = Enrollment::with('course')->latest()->take(10)->get();
        
        return view('admin.dashboard', compact('totalJobs', 'totalCourses', 'totalEnrollments', 'totalViews', 'viewsData', 'recentEnrollments'));
    }
}