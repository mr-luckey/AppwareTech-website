<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('partners')->insert([
            [
                'name' => 'TechSoft',
                'logo' => 'partners/techsoft.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'WebGenius',
                'logo' => 'partners/webgenius.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cloudify',
                'logo' => 'partners/cloudify.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DesignPro',
                'logo' => 'partners/designpro.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
