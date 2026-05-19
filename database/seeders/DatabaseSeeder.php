<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@foundrsearch.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $categories = [
            'SaaS & Software',
            'FinTech',
            'HealthTech',
            'EdTech',
            'E-commerce & Retail',
            'AI & Machine Learning',
            'GreenTech & Sustainability',
        ];

        foreach ($categories as $category) {
            \App\Models\StartupCategory::create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category),
            ]);
        }
    }
}
