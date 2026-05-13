<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBlogs = Blog::with(['category', 'user'])
            ->where('status', 'published')
            ->orderBy('publish_date', 'desc')
            ->take(3)
            ->get();

        $categories = Category::withCount('blogs')->get();

        return view('home', compact('featuredBlogs', 'categories'));
    }
}
