<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        $blogs = Blog::with(['category', 'user'])
            ->where('status', 'published')
            ->orderBy('publish_date', 'desc')
            ->paginate(6);

        if ($request->ajax()) {
            return view('partials.blog-list', compact('blogs'))->render();
        }

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $blog->increment('views');

        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }

    public function filter(Request $request)
    {
        $query = Blog::with(['category', 'user'])->where('status', 'published');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sort')) {
            $sort = $request->sort == 'oldest' ? 'asc' : 'desc';
            $query->orderBy('publish_date', $sort);
        } else {
            $query->orderBy('publish_date', 'desc');
        }

        $blogs = $query->paginate(6);

        return view('partials.blog-list', compact('blogs'))->render();
    }
}
