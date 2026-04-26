<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ]);

        $validated['order'] = $validated['order'] ?? Faq::max('order') + 1;
        $validated['is_active'] = $request->has('is_active');

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ]);

        $validated['order'] = $validated['order'] ?? $faq->order;
        $validated['is_active'] = $request->has('is_active');

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Reorder FAQs.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
        ]);

        foreach ($request->orders as $id => $order) {
            Faq::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Bulk delete FAQs.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'faq_ids' => 'required|array',
            'faq_ids.*' => 'exists:faqs,id',
        ]);

        Faq::whereIn('id', $request->faq_ids)->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'Selected FAQs deleted successfully.');
    }
}