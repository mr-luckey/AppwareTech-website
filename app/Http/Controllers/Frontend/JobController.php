<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Analytic;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('is_active', true)->latest()->paginate(10);
        return view('frontend.jobs.index', compact('jobs'));
    }

    public function show($slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        $job->incrementViews();
        
        // Track analytics
        Analytic::track(request()->url());
        
        return view('frontend.jobs.show', compact('job'));
    }
    
    public function apply(Request $request, $slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cover_letter' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        // Store resume file
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('job-applications', 'public');
        }
        
        // Create application
        $application = JobApplication::create([
            'job_id' => $job->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cover_letter' => $request->cover_letter,
            'resume' => $resumePath,
            'status' => 'pending',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully. Wait for response.'
        ]);
    }
}