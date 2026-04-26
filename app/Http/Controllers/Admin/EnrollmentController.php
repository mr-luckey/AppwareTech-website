<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Enrollment::with('course');
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Filter by course
        if ($request->has('course') && $request->course !== '') {
            $query->where('course_id', $request->course);
        }
        
        $enrollments = $query->latest()->paginate(15);
        $courses = Course::where('is_active', true)->get();
        $pendingCount = Enrollment::where('status', 'pending')->count();
        $approvedCount = Enrollment::where('status', 'approved')->count();
        $rejectedCount = Enrollment::where('status', 'rejected')->count();
        
        return view('admin.enrollments.index', compact('enrollments', 'courses', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load('course');
        return view('admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $enrollment->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Enrollment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }

    /**
     * Bulk delete enrollments.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'enrollment_ids' => 'required|array',
            'enrollment_ids.*' => 'exists:enrollments,id',
        ]);

        Enrollment::whereIn('id', $request->enrollment_ids)->delete();

        return redirect()->route('admin.enrollments.index')->with('success', 'Selected enrollments deleted successfully.');
    }
}