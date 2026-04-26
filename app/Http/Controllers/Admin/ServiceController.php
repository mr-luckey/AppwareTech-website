<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service = new Service($request->except('image'));

        if ($request->hasFile('image')) {
            $service->image = $request->file('image')->store('services', 'public');
        }

        $service->slug = Str::slug($request->name);
        $service->is_active = $request->boolean('is_active');
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return redirect()->route('admin.services.edit', $service);
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $service->image = $request->file('image')->store('services', 'public');
        }

        $service->slug = Str::slug($request->name);
        $service->is_active = $request->boolean('is_active');
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}