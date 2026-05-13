<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        $blogs = [
            [
                'title' => 'The Future of AI in Web Development',
                'short_description' => 'How artificial intelligence is reshaping how we build and maintain modern web applications.',
                'content' => 'Artificial Intelligence is no longer just a buzzword; it is actively changing the landscape of web development. From AI-driven design tools to automated code generation and intelligent testing frameworks, developers are finding new ways to integrate machine learning into their workflows. In this article, we explore the current state of AI in development and what the next decade might hold for our industry.',
                'featured_image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=1200',
            ],
            [
                'title' => 'Mastering Glassmorphism in Modern UI',
                'short_description' => 'A comprehensive guide to implementing the popular glass effect using Tailwind CSS.',
                'content' => 'Glassmorphism has become one of the most significant design trends of the decade. Characterized by its frosted-glass look, multi-layered approach, and vibrant background colors, it provides a sense of depth and hierarchy that feels both modern and premium. We will break down the CSS properties required to achieve this look and how Tailwind v4 makes it easier than ever.',
                'featured_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=1200',
            ],
            [
                'title' => 'Building Scalable Laravel Applications',
                'short_description' => 'Best practices for ensuring your Laravel project can handle massive traffic and data.',
                'content' => 'Laravel provides an incredible foundation, but as your application grows, you need to think about scalability. This post covers caching strategies, database optimization, queuing systems, and load balancing. Learn how to architect your Laravel backend to scale from dozens to millions of users without breaking a sweat.',
                'featured_image' => 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&q=80&w=1200',
            ],
            [
                'title' => 'Design Systems for Startups',
                'short_description' => 'Why you should start with a design system even for the smallest projects.',
                'content' => 'Consistency is key to a premium user experience. A design system isn\'t just for large corporations; startups can benefit immensely from early adoption. We discuss how to build a lean design system that grows with your product, ensuring that every button, font choice, and spacing remains consistent throughout your application.',
                'featured_image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&q=80&w=1200',
            ],
        ];

        foreach ($blogs as $index => $blogData) {
            Blog::create([
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'title' => $blogData['title'],
                'slug' => Str::slug($blogData['title']),
                'short_description' => $blogData['short_description'],
                'content' => $blogData['content'],
                'featured_image' => $blogData['featured_image'],
                'publish_date' => now()->subDays(rand(1, 30)),
                'status' => 'published',
                'views' => rand(100, 5000),
                'reading_time' => rand(3, 10),
            ]);
        }
    }
}
