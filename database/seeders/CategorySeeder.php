<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'The latest in tech and gadgets.', 'color' => '#6366f1', 'icon' => 'cpu'],
            ['name' => 'Design', 'slug' => 'design', 'description' => 'UI/UX and graphic design trends.', 'color' => '#ec4899', 'icon' => 'palette'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Startup and corporate world insights.', 'color' => '#f59e0b', 'icon' => 'briefcase'],
            ['name' => 'Development', 'slug' => 'development', 'description' => 'Programming and software engineering.', 'color' => '#10b981', 'icon' => 'code'],
            ['name' => 'AI & ML', 'slug' => 'ai-ml', 'description' => 'Artificial Intelligence and Machine Learning.', 'color' => '#8b5cf6', 'icon' => 'bot'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Work-life balance and hobbies.', 'color' => '#06b6d4', 'icon' => 'heart'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
