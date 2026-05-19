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

        $categoryModels = [];
        foreach ($categories as $category) {
            $categoryModels[] = \App\Models\StartupCategory::create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category),
            ]);
        }

        // Create Startup Owner 1
        $owner1 = \App\Models\User::create([
            'name' => 'John Founder',
            'email' => 'owner@foundrsearch.com',
            'password' => bcrypt('password'),
            'role' => 'startup_owner',
        ]);

        // Create Startup for Owner 1
        $startup1 = \App\Models\Startup::create([
            'user_id' => $owner1->id,
            'startup_category_id' => $categoryModels[0]->id, // SaaS
            'name' => 'CloudFlow Systems',
            'slug' => 'cloudflow-systems',
            'description' => 'CloudFlow Systems offers next-generation serverless workflow automation utilities that streamline dev workflows and cut hosting expenses by up to 40%. Join thousands of developers who run automation nodes instantly in the cloud.',
            'stage' => 'Seed',
            'status' => 'approved',
        ]);

        // Create products for Startup 1
        \App\Models\Product::create([
            'startup_id' => $startup1->id,
            'title' => 'Developer License (LTD)',
            'description' => 'Get a lifetime subscription to CloudFlow Automation Node. Includes unlimited tasks, 5 team members, and priority Slack support.',
            'price' => 99.00,
            'type' => 'digital',
        ]);

        // Create services for Startup 1
        \App\Models\Service::create([
            'startup_id' => $startup1->id,
            'title' => 'Custom Integration Consulting',
            'description' => 'Our lead architects will integrate CloudFlow into your AWS/GCP serverless stacks within 5 business days.',
            'price' => 499.00,
            'delivery_days' => 5,
        ]);

        // Create Job Posting for Startup 1
        \App\Models\JobPosting::create([
            'startup_id' => $startup1->id,
            'title' => 'Senior Backend Developer (Laravel/SaaS)',
            'description' => 'We are seeking a senior engineer to manage our integration API nodes. Strong PHP 8.x knowledge, standard SQL, and Redis queue management are required.',
            'salary_range' => '$80k - $110k',
            'type' => 'full-time',
            'status' => 'active',
        ]);

        // Create Startup Owner 2
        $owner2 = \App\Models\User::create([
            'name' => 'Alice Tech',
            'email' => 'owner2@foundrsearch.com',
            'password' => bcrypt('password'),
            'role' => 'startup_owner',
        ]);

        // Create Startup for Owner 2
        $startup2 = \App\Models\Startup::create([
            'user_id' => $owner2->id,
            'startup_category_id' => $categoryModels[5]->id, // AI & ML
            'name' => 'Apex Intelligence',
            'slug' => 'apex-intelligence',
            'description' => 'Apex Intelligence builds LLM fine-tuning pipelines and semantic database indexes to let enterprise customers query structural records in plain English.',
            'stage' => 'Pre-Seed',
            'status' => 'approved',
        ]);

        // Create Job for Startup 2
        \App\Models\JobPosting::create([
            'startup_id' => $startup2->id,
            'title' => 'AI Engineer Intern',
            'description' => 'Join our core R&D team fine-tuning deep models on specialized tabular financial tables. Basic Python and PyTorch knowledge required.',
            'salary_range' => '$3k - $5k / month',
            'type' => 'internship',
            'status' => 'active',
        ]);

        // Create Investor
        $investorUser = \App\Models\User::create([
            'name' => 'Marcus VC',
            'email' => 'investor@foundrsearch.com',
            'password' => bcrypt('password'),
            'role' => 'investor',
        ]);

        \App\Models\Investor::create([
            'user_id' => $investorUser->id,
            'organization' => 'Apex Ventures',
            'investment_range' => '$100k - $500k',
            'bio' => 'Partner at Apex Ventures focusing on early-stage enterprise B2B SaaS and Artificial Intelligence systems.',
            'is_verified' => true,
        ]);

    }
}
