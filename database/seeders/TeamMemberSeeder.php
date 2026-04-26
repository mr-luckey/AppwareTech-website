<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('team_members')->insert([
            [
                'name' => 'Ali Raza',
                'role' => 'CEO',
                'description' => 'Founder and chief visionary, Ali is the driving force behind the company.',
                'image' => 'team/ali.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara Khan',
                'role' => 'CTO',
                'description' => 'Sara loves taking on challenges and leading the tech team.',
                'image' => 'team/sara.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahmed Iqbal',
                'role' => 'Lead Developer',
                'description' => 'Ahmed is a passionate developer and a great team player.',
                'image' => 'team/ahmed.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fatima Noor',
                'role' => 'Designer',
                'description' => 'Fatima creates beautiful user experiences and interfaces.',
                'image' => 'team/fatima.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
