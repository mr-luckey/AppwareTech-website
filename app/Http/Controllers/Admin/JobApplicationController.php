<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::with('job');
        
        // Filter by job if specified
        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }
        
        // Filter by status if specified
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Show unread first, then by latest
        $applications = $query->orderBy('read_at')->orderBy('created_at', 'desc')->paginate(15);
        
        // Get all jobs for filter dropdown
        $jobs = Job::where('is_active', true)->get();
        
        // Count statistics
        $stats = [
            'total' => JobApplication::count(),
            'pending' => JobApplication::where('status', 'pending')->count(),
            'approved' => JobApplication::where('status', 'approved')->count(),
            'rejected' => JobApplication::where('status', 'rejected')->count(),
            'shortlisted' => JobApplication::where('status', 'shortlisted')->count(),
            'unread' => JobApplication::whereNull('read_at')->count(),
        ];
        
        return view('admin.job-applications.index', compact('applications', 'jobs', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $application)
    {
        // Mark as read
        $application->markAsRead();
        
        return view('admin.job-applications.show', compact('application'));
    }

    /**
     * Update the status of the application.
     */
    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,shortlisted',
            'admin_notes' => 'nullable|string',
        ]);
        
        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);
        
        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $application)
    {
        // Delete resume file if exists
        if ($application->resume) {
            Storage::disk('public')->delete($application->resume);
        }
        
        $application->delete();
        
        return redirect()->route('admin.job-applications.index')->with('success', 'Application deleted successfully.');
    }
    
    /**
     * Bulk delete applications.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'application_ids' => 'required|array',
            'application_ids.*' => 'exists:job_applications,id',
        ]);
        
        $applications = JobApplication::whereIn('id', $request->application_ids)->get();
        
        foreach ($applications as $application) {
            if ($application instanceof JobApplication && $application->resume) {
                Storage::disk('public')->delete($application->resume);
            }
            if ($application instanceof JobApplication) {
                $application->delete();
            }
        }
        
        return redirect()->route('admin.job-applications.index')->with('success', 'Selected applications deleted successfully.');
    }
}