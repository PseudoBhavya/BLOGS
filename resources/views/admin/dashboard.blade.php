@extends('admin.layouts.admin')

@section('title', 'Dashboard — BlogYaari')

@section('admin_content')
<div class="mb-10">
    <h1 class="text-3xl font-bold tracking-tight mb-2">Dashboard Overview</h1>
    <p class="text-muted-foreground">Welcome back, {{ auth()->user()->name }}. Here's what's happening with your blog today.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <div class="p-8 glass rounded-2xl shadow-sm animate-fade-up">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3 bg-accent/10 rounded-xl text-accent">
                <i data-lucide="file-text" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Lifetime</span>
        </div>
        <p class="text-3xl font-bold mb-1">{{ number_format($stats['total_blogs']) }}</p>
        <p class="text-xs text-muted-foreground font-medium">Total Published Blogs</p>
    </div>

    <div class="p-8 glass rounded-2xl shadow-sm animate-fade-up delay-100">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3 bg-success/10 rounded-xl text-success">
                <i data-lucide="eye" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">+12% vs last mo</span>
        </div>
        <p class="text-3xl font-bold mb-1">{{ number_format($stats['total_views']) }}</p>
        <p class="text-xs text-muted-foreground font-medium">Lifetime Page Views</p>
    </div>

    <div class="p-8 glass rounded-2xl shadow-sm animate-fade-up delay-200">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3 bg-warning/10 rounded-xl text-warning">
                <i data-lucide="folder" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Categories</span>
        </div>
        <p class="text-3xl font-bold mb-1">{{ number_format($stats['total_categories']) }}</p>
        <p class="text-xs text-muted-foreground font-medium">Active Blog Categories</p>
    </div>

    <div class="p-8 glass rounded-2xl shadow-sm animate-fade-up delay-300">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3 bg-accent/10 rounded-xl text-accent">
                <i data-lucide="plus" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Today</span>
        </div>
        <p class="text-3xl font-bold mb-1">{{ number_format($stats['published_today']) }}</p>
        <p class="text-xs text-muted-foreground font-medium">New Posts Today</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Posts Table -->
    <div class="lg:col-span-2 glass rounded-2xl p-8 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-bold">Recent Blog Posts</h3>
            <a href="{{ route('admin.blogs.index') }}" class="text-xs font-bold text-accent hover:underline">View all posts</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-bold uppercase tracking-widest text-muted-foreground border-b border-border">
                        <th class="pb-4 px-2">Title</th>
                        <th class="pb-4 px-2 text-center">Status</th>
                        <th class="pb-4 px-2 text-center">Views</th>
                        <th class="pb-4 px-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($recentBlogs as $blog)
                    <tr class="group hover:bg-secondary/30 transition-all">
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ $blog->featured_image }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-sm font-bold truncate max-w-[240px]">{{ $blog->title }}</p>
                                    <p class="text-[10px] font-medium text-muted-foreground">{{ $blog->category->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-2 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $blog->status == 'published' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                                {{ $blog->status }}
                            </span>
                        </td>
                        <td class="py-4 px-2 text-center text-xs font-medium text-muted-foreground">
                            {{ number_format($blog->views) }}
                        </td>
                        <td class="py-4 px-2 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="p-2 hover:bg-white rounded-lg transition-all"><i data-lucide="edit-3" class="w-4 h-4 text-muted-foreground"></i></a>
                                <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="p-2 hover:bg-white rounded-lg transition-all"><i data-lucide="external-link" class="w-4 h-4 text-muted-foreground"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Category Distribution -->
    <div class="glass rounded-2xl p-8 shadow-sm">
        <h3 class="font-bold mb-8">Category Metrics</h3>
        <div class="space-y-6">
            @foreach($categories as $cat)
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-bold">{{ $cat->name }}</span>
                    <span class="text-xs text-muted-foreground">{{ $cat->blogs_count }} posts</span>
                </div>
                <div class="h-2 w-full bg-muted rounded-full overflow-hidden">
                    @php 
                        $total = $stats['total_blogs'] > 0 ? $stats['total_blogs'] : 1;
                        $percent = ($cat->blogs_count / $total) * 100;
                    @endphp
                    <div class="h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%; background-color: {{ $cat->color }}"></div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 p-6 bg-secondary/50 rounded-2xl border border-border">
            <h4 class="text-xs font-bold uppercase tracking-widest text-muted-foreground mb-4">Quick Insights</h4>
            <p class="text-xs text-muted-foreground italic">
                "Your articles in <strong>Development</strong> are receiving 45% more engagement than other categories this week."
            </p>
        </div>
    </div>
</div>
@endsection
