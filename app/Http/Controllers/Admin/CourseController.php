<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
            'is_active' => 'nullable',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
        }

        $validated['image'] = $imagePath;
        $validated['is_active'] = $request->has('is_active');
        $validated['curriculum'] = $request->curriculum ? json_decode($request->curriculum, true) : null;

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
            'is_active' => 'nullable',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['curriculum'] = $request->curriculum ? json_decode($request->curriculum, true) : null;

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Delete image if exists
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }

    /**
     * Bulk delete courses.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $courses = Course::whereIn('id', $request->course_ids)->get();
        foreach ($courses as $course) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $course->delete();
        }

        return redirect()->route('admin.courses.index')->with('success', 'Selected courses deleted successfully.');
    }
}