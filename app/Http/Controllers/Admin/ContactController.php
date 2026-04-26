<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    /**
     * Display contact page settings.
     */
    public function index()
    {
        $contactSettings = [
            'contact_email' => Setting::get('contact_email', 'info@appwaretech.com'),
            'contact_phone' => Setting::get('contact_phone', '+1 234 567 8900'),
            'contact_address' => Setting::get('contact_address', '123 Business Ave, Suite 100'),
            'contact_map_embed' => Setting::get('contact_map_embed', ''),
            'contact_page_title' => Setting::get('contact_page_title', 'Contact Us'),
            'contact_page_description' => Setting::get('contact_page_description', 'Get in touch with us. We would love to hear from you.'),
            'contact_show_map' => Setting::get('contact_show_map', '1'),
            'contact_show_form' => Setting::get('contact_show_form', '1'),
            'contact_show_info' => Setting::get('contact_show_info', '1'),
        ];

        return view('admin.contact.index', compact('contactSettings'));
    }

    /**
     * Update contact page settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'contact_address' => 'required|string',
            'contact_map_embed' => 'nullable|string',
            'contact_page_title' => 'required|string|max:255',
            'contact_page_description' => 'nullable|string',
            'contact_show_map' => 'nullable',
            'contact_show_form' => 'nullable',
            'contact_show_info' => 'nullable',
        ]);

        // Update settings
        Setting::set('contact_email', $validated['contact_email'], 'text', 'contact');
        Setting::set('contact_phone', $validated['contact_phone'], 'text', 'contact');
        Setting::set('contact_address', $validated['contact_address'], 'text', 'contact');
        Setting::set('contact_map_embed', $validated['contact_map_embed'] ?? '', 'text', 'contact');
        Setting::set('contact_page_title', $validated['contact_page_title'], 'text', 'contact');
        Setting::set('contact_page_description', $validated['contact_page_description'] ?? '', 'text', 'contact');
        Setting::set('contact_show_map', $request->has('contact_show_map') ? '1' : '0', 'text', 'contact');
        Setting::set('contact_show_form', $request->has('contact_show_form') ? '1' : '0', 'text', 'contact');
        Setting::set('contact_show_info', $request->has('contact_show_info') ? '1' : '0', 'text', 'contact');

        // Clear cache
        Cache::flush();

        return redirect()->route('admin.contact.index')->with('success', 'Contact page settings updated successfully.');
    }

    /**
     * Display contact form submissions (if you want to store them).
     */
    public function submissions()
    {
        // This would require a contact_submissions table
        // For now, we'll just show the settings
        return redirect()->route('admin.contact.index');
    }
}