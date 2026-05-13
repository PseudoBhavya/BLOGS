<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_blogs' => Blog::count(),
            'total_categories' => Category::count(),
            'total_views' => Blog::sum('views'),
            'published_today' => Blog::whereDate('publish_date', today())->count(),
        ];

        $recentBlogs = Blog::with('category')->orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::withCount('blogs')->get();

        return view('admin.dashboard', compact('stats', 'recentBlogs', 'categories'));
    }
}
