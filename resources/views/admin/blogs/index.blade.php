@extends('admin.layouts.admin')

@section('title', 'Manage Blogs — BlogYaari')

@section('admin_content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
    <div>
        <h1 class="text-3xl font-bold tracking-tight mb-2">Manage Blogs</h1>
        <p class="text-muted-foreground">You have {{ $blogs->total() }} total blog posts in your library.</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="px-6 py-3 bg-accent text-white rounded-xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-accent/20">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Create New Post
    </a>
</div>

<div class="glass rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-xs font-bold uppercase tracking-widest text-muted-foreground bg-muted/30 border-b border-border">
                    <th class="py-5 px-8">Post Details</th>
                    <th class="py-5 px-6">Category</th>
                    <th class="py-5 px-6 text-center">Status</th>
                    <th class="py-5 px-6 text-center">Date</th>
                    <th class="py-5 px-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @foreach($blogs as $blog)
                <tr class="group hover:bg-secondary/30 transition-all">
                    <td class="py-5 px-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                                <img src="{{ $blog->featured_image }}" class="w-full h-full object-cover">
                            </div>
                            <div class="max-w-xs md:max-w-md">
                                <p class="font-bold truncate">{{ $blog->title }}</p>
                                <p class="text-xs text-muted-foreground line-clamp-1 mt-1">{{ $blog->short_description }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-5 px-6">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $blog->category->color }}"></span>
                            <span class="text-sm font-medium">{{ $blog->category->name }}</span>
                        </div>
                    </td>
                    <td class="py-5 px-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $blog->status == 'published' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                            {{ $blog->status }}
                        </span>
                    </td>
                    <td class="py-5 px-6 text-center text-xs text-muted-foreground font-medium">
                        {{ $blog->publish_date->format('M d, Y') }}
                    </td>
                    <td class="py-5 px-6 text-right">
                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="p-2.5 bg-surface border border-border rounded-xl text-muted-foreground hover:text-accent hover:border-accent transition-all shadow-sm">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="p-2.5 bg-surface border border-border rounded-xl text-muted-foreground hover:text-accent hover:border-accent transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 bg-surface border border-border rounded-xl text-muted-foreground hover:text-danger hover:border-danger transition-all shadow-sm">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8">
    {{ $blogs->links() }}
</div>
@endsection
