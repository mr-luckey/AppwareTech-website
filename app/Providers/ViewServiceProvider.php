<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            try {
                // Share common settings with all views
                $settings = [
                    'site_name' => Setting::get('site_name', 'AppWareTech'),
                    'site_tagline' => Setting::get('site_tagline', 'Software Solutions'),
                    'primary_color' => Setting::get('primary_color', '#4a90e2'),
                    'secondary_color' => Setting::get('secondary_color', '#2c3e50'),
                    'logo' => Setting::get('logo'),
                    'favicon' => Setting::get('favicon'),
                    'header_bg' => Setting::get('header_bg', '#2c3e50'),
                    'hero_title' => Setting::get('hero_title', 'AppWareTech - Innovative Software Solutions'),
                    'hero_subtitle' => Setting::get('hero_subtitle', 'We deliver cutting-edge technology solutions for your business'),
                    'hero_bg_start' => Setting::get('hero_bg_start', '#4a90e2'),
                    'hero_bg_end' => Setting::get('hero_bg_end', '#2c3e50'),
                    'hero_image' => Setting::get('hero_image'),
                    'address' => Setting::get('address', '123 Business Avenue, Suite 100, New York, NY 10001'),
                    'phone' => Setting::get('phone', '+1 (234) 567-8900'),
                    'email' => Setting::get('email', 'info@appwaretech.com'),
                    'facebook_url' => Setting::get('facebook_url'),
                    'twitter_url' => Setting::get('twitter_url'),
                    'linkedin_url' => Setting::get('linkedin_url'),
                    'footer_description' => Setting::get('footer_description', 'Innovative software solutions for modern businesses'),
                    'site_description' => Setting::get('site_description', 'Leading software development company'),
                    'site_keywords' => Setting::get('site_keywords', 'web development, software, laravel, wordpress, flutter'),
                ];
                
                $view->with('settings', $settings);
            } catch (\Exception $e) {
                // If settings table doesn't exist yet, use defaults
                $view->with('settings', [
                    'site_name' => 'AppWareTech',
                    'site_tagline' => 'Software Solutions',
                    'primary_color' => '#4a90e2',
                    'secondary_color' => '#2c3e50',
                ]);
            }
        });
    }
    
    public function register()
    {
        //
    }
}