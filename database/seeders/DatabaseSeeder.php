<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\PageSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Admin
        Admin::firstOrCreate(
            ['username' => 'admin'],
            ['password_hash' => Hash::make('password123')]
        );

        // 2. Seed Sections from local JSON files if they exist
        $sections = ['about', 'contact', 'footer', 'header', 'navbar', 'portfolio', 'recent-posts', 'team'];

        foreach ($sections as $section) {
            $path = public_path("src/data/{$section}.json");
            if (file_exists($path)) {
                $data = json_decode(file_get_contents($path), true);
                PageSection::updateOrCreate(
                    ['section' => $section],
                    ['content' => $data, 'updated_at' => now()]
                );
            }
        }
    }
}
