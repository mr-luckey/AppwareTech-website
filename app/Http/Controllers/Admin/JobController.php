<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $job = new Job($request->except(['image', 'requirements', 'benefits', 'is_active']));

        if ($request->hasFile('image')) {
            $job->image = $request->file('image')->store('jobs', 'public');
        }

        $job->slug = Str::slug($request->title);
        $job->requirements = $request->requirements ? explode("\n", $request->requirements) : [];
        $job->benefits = $request->benefits ? explode("\n", $request->benefits) : [];
        $job->is_active = $request->has('is_active') ? true : false;
        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        return redirect()->route('admin.jobs.edit', $job);
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $job->fill($request->except(['image', 'requirements', 'benefits', 'is_active']));

        if ($request->hasFile('image')) {
            $job->image = $request->file('image')->store('jobs', 'public');
        }

        $job->slug = Str::slug($request->title);
        $job->requirements = $request->requirements ? explode("\n", $request->requirements) : [];
        $job->benefits = $request->benefits ? explode("\n", $request->benefits) : [];
        $job->is_active = $request->has('is_active') ? true : false;
        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
