<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required',
            'content' => 'required',
            'publish_date' => 'required|date',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|url', // Using URL for simplicity in this assessment
        ]);

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'short_description' => $request->short_description,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'status' => $request->status,
            'featured_image' => $request->featured_image ?? 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&q=80&w=1200',
            'reading_time' => ceil(str_word_count($request->content) / 200),
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required',
            'content' => 'required',
            'publish_date' => 'required|date',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|url',
        ]);

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'status' => $request->status,
            'featured_image' => $request->featured_image ?? $blog->featured_image,
            'reading_time' => ceil(str_word_count($request->content) / 200),
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
