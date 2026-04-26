<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactSettings = [
            'page_title' => Setting::get('contact_page_title', 'Contact Us'),
            'page_description' => Setting::get('contact_page_description', 'Get in touch with us. We would love to hear from you.'),
            'show_map' => Setting::get('contact_show_map', '1'),
            'show_form' => Setting::get('contact_show_form', '1'),
            'show_info' => Setting::get('contact_show_info', '1'),
            'address' => Setting::get('contact_address', '123 Business Ave, Suite 100'),
            'phone' => Setting::get('contact_phone', '+1 234 567 8900'),
            'email' => Setting::get('contact_email', 'info@appwaretech.com'),
            'map_embed' => Setting::get('contact_map_embed', ''),
        ];

        return view('frontend.contact', compact('contactSettings'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Here you can send email or save to database
        // For now, just redirect back with success message

        return redirect()->back()->with('success', 'Thank you for contacting us. We will get back to you soon!');
    }
}