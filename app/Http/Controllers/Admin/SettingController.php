<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'AppWareTech'),
            'site_tagline' => Setting::get('site_tagline', 'Software Solutions'),
            'site_description' => Setting::get('site_description', 'Professional software development company'),
            'site_keywords' => Setting::get('site_keywords', 'web development, software, laravel, wordpress, flutter'),
            'favicon' => Setting::get('favicon', ''),
            'logo' => Setting::get('logo', ''),
            'primary_color' => Setting::get('primary_color', '#4a90e2'),
            'secondary_color' => Setting::get('secondary_color', '#2c3e50'),
            'header_bg' => Setting::get('header_bg', '#2c3e50'),
            'footer_description' => Setting::get('footer_description', 'Innovative software solutions for modern businesses'),
            'facebook_url' => Setting::get('facebook_url', ''),
            'twitter_url' => Setting::get('twitter_url', ''),
            'linkedin_url' => Setting::get('linkedin_url', ''),
            'instagram_url' => Setting::get('instagram_url', ''),
            'address' => Setting::get('address', '123 Business Ave, Suite 100'),
            'phone' => Setting::get('phone', '+1 234 567 8900'),
            'email' => Setting::get('email', 'info@appwaretech.com'),
        ];

        $user = auth()->user();

        return view('admin.settings.index', compact('settings', 'user'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'favicon' => 'nullable|image|max:1024',
            'logo' => 'nullable|image|max:2048',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'header_bg' => 'nullable|string|max:7',
            'footer_description' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $faviconPath = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $faviconPath, 'text', 'general');
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::set('logo', $logoPath, 'text', 'general');
        }

        // Update text settings
        $textSettings = [
            'site_name', 'site_tagline', 'site_description', 'site_keywords',
            'primary_color', 'secondary_color', 'header_bg', 'footer_description',
            'facebook_url', 'twitter_url', 'linkedin_url', 'instagram_url', 'address', 'phone', 'email'
        ];

        foreach ($textSettings as $key) {
            if (isset($validated[$key])) {
                Setting::set($key, $validated[$key], 'text', 'general');
            }
        }

        // Clear cache
        Cache::flush();

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }

    /**
     * Show change password form.
     */
    public function showChangePassword()
    {
        return view('admin.settings.password');
    }

    /**
     * Update admin credentials (username/email and password).
     */
    public function updateCredentials(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.settings')->with('success', 'Admin credentials updated successfully.');
    }

    /**
     * Show admin profile settings.
     */
    public function showProfile()
    {
        $user = auth()->user();
        return view('admin.settings.profile', compact('user'));
    }

    /**
     * Update admin profile.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.settings.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show change password form (separate).
     */
    public function showPasswordForm()
    {
        return view('admin.settings.change-password');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.settings.password')->with('success', 'Password updated successfully.');
    }
}