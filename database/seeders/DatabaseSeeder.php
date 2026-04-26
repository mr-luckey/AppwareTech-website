<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed admin user
        $this->call(\Database\Seeders\AdminUserSeeder::class);

        // Seed partners
        $this->call(\Database\Seeders\PartnerSeeder::class);

        // Seed team members
        $this->call(\Database\Seeders\TeamMemberSeeder::class);

        // Create Services
        $services = [
            ['name' => 'Web Development', 'description' => 'Custom web applications using Laravel, PHP, and modern frameworks', 'icon' => 'fas fa-code', 'order' => 1],
            ['name' => 'WordPress', 'description' => 'Professional WordPress websites and custom themes', 'icon' => 'fab fa-wordpress', 'order' => 2],
            ['name' => 'SEO Optimization', 'description' => 'Improve your website ranking and visibility', 'icon' => 'fas fa-chart-line', 'order' => 3],
            ['name' => 'Flutter Development', 'description' => 'Cross-platform mobile apps for iOS and Android', 'icon' => 'fab fa-flutter', 'order' => 4],
            ['name' => 'Graphic Designing', 'description' => 'Creative designs for your brand identity', 'icon' => 'fas fa-palette', 'order' => 5],
            ['name' => 'Article Writing', 'description' => 'Professional content writing services', 'icon' => 'fas fa-pen-fancy', 'order' => 6],
            ['name' => 'POS System', 'description' => 'Complete point of sale solutions', 'icon' => 'fas fa-cash-register', 'order' => 7],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create FAQs
        $faqs = [
            ['question' => 'What services do you offer?', 'answer' => 'We offer Web Development, WordPress, SEO, Flutter, Graphic Design, Article Writing, and POS System services.', 'order' => 1],
            ['question' => 'How long does it take to complete a project?', 'answer' => 'Project timeline depends on the complexity. We provide estimated timelines after initial consultation.', 'order' => 2],
            ['question' => 'Do you provide support after project completion?', 'answer' => 'Yes, we provide 3 months of free technical support after project completion.', 'order' => 3],
            ['question' => 'What are your payment terms?', 'answer' => 'We require 50% advance payment and 50% upon project completion.', 'order' => 4],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        // Create Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'AppWareTech', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Innovative Software Solutions', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Leading software development company offering web, mobile, and IT solutions', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'primary_color', 'value' => '#4a90e2', 'type' => 'color', 'group' => 'design'],
            ['key' => 'secondary_color', 'value' => '#2c3e50', 'type' => 'color', 'group' => 'design'],
            ['key' => 'hero_title', 'value' => 'AppWareTech - Innovative Software Solutions', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'We deliver cutting-edge technology solutions for your business', 'type' => 'textarea', 'group' => 'hero'],
            ['key' => 'address', 'value' => '123 Business Avenue, Suite 100, New York, NY 10001', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+1 (234) 567-8900', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@appwaretech.com', 'type' => 'email', 'group' => 'contact'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}