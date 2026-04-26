<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Analytic;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)->latest()->paginate(9);
        return view('frontend.courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $course->incrementViews();
        
        // Track analytics
        Analytic::track(request()->url());
        
        return view('frontend.courses.show', compact('course'));
    }

    public function enroll(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
        ]);

        $enrollment = Enrollment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'course_id' => $course->id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Your enrollment has been submitted successfully! Please wait for admin approval. We will contact you soon.'
        ]);
    }
}