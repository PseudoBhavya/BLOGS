@extends('admin.layouts.admin')

@section('title', 'Dashboard — BlogYaari')

@section('admin_content')
<div class="w-full space-y-8">
    <section class="relative overflow-hidden border border-border bg-[radial-gradient(circle_at_top_left,rgba(99,102,241,0.24),transparent_28%),linear-gradient(180deg,rgba(15,20,35,0.98),rgba(15,20,35,0.92))] rounded-[2.25rem] px-6 py-8 md:px-8 md:py-10 shadow-dashboard">
        <div class="absolute inset-0 pointer-events-none bg-[linear-gradient(135deg,rgba(255,255,255,0.04),transparent_20%,transparent_80%,rgba(255,255,255,0.03))]"></div>
        <div class="relative flex flex-col gap-8 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-4xl">
                <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] font-bold uppercase tracking-[0.35em] text-accent mb-5">
                    <span class="w-2 h-2 rounded-full bg-accent"></span>
                    Admin command center
                </p>
                <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-4 text-balance">Dashboard Overview</h1>
                <p class="text-muted-foreground text-base md:text-lg max-w-3xl leading-7">
                    Welcome back, {{ auth()->user()->name }}. Track publishing activity, category momentum, and content performance from a single dark workspace.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:flex sm:flex-wrap">
                <a href="{{ route('admin.blogs.create') }}" class="px-5 py-3 rounded-2xl bg-accent text-white font-bold shadow-lg shadow-accent/20 hover:translate-y-[-1px] transition-transform text-center">New Blog</a>
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-3 rounded-2xl bg-white/5 border border-white/10 font-bold hover:border-accent transition-colors text-center">Manage Categories</a>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <div class="dashboard-metric-card animate-fade-up">
            <div class="dashboard-metric-top">
                <div class="dashboard-icon accent"><i data-lucide="file-text" class="w-6 h-6"></i></div>
                <span class="dashboard-kicker">Lifetime</span>
            </div>
            <p class="dashboard-value">{{ number_format($stats['total_blogs']) }}</p>
            <p class="dashboard-label">Total Published Blogs</p>
        </div>

        <div class="dashboard-metric-card animate-fade-up delay-100">
            <div class="dashboard-metric-top">
                <div class="dashboard-icon success"><i data-lucide="eye" class="w-6 h-6"></i></div>
                <span class="dashboard-kicker">Views</span>
            </div>
            <p class="dashboard-value">{{ number_format($stats['total_views']) }}</p>
            <p class="dashboard-label">Lifetime Page Views</p>
        </div>

        <div class="dashboard-metric-card animate-fade-up delay-200">
            <div class="dashboard-metric-top">
                <div class="dashboard-icon warning"><i data-lucide="folder" class="w-6 h-6"></i></div>
                <span class="dashboard-kicker">Categories</span>
            </div>
            <p class="dashboard-value">{{ number_format($stats['total_categories']) }}</p>
            <p class="dashboard-label">Active Blog Categories</p>
        </div>

        <div class="dashboard-metric-card animate-fade-up delay-300">
            <div class="dashboard-metric-top">
                <div class="dashboard-icon accent"><i data-lucide="plus" class="w-6 h-6"></i></div>
                <span class="dashboard-kicker">Today</span>
            </div>
            <p class="dashboard-value">{{ number_format($stats['published_today']) }}</p>
            <p class="dashboard-label">New Posts Today</p>
        </div>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-[minmax(0,1.8fr)_minmax(360px,1fr)] gap-6 items-start">
        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <p class="dashboard-panel-kicker">Publishing feed</p>
                    <h3 class="dashboard-panel-title">Recent Blog Posts</h3>
                </div>
                <a href="{{ route('admin.blogs.index') }}" class="text-sm font-bold text-accent hover:underline">View all posts</a>
            </div>

            <div class="overflow-hidden rounded-[1.6rem] border border-border bg-white/2">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left">
                        <thead>
                            <tr class="text-[11px] font-bold uppercase tracking-[0.25em] text-muted-foreground bg-white/[0.03] border-b border-border">
                                <th class="py-4 px-5">Title</th>
                                <th class="py-4 px-5 text-center">Status</th>
                                <th class="py-4 px-5 text-center">Views</th>
                                <th class="py-4 px-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($recentBlogs as $blog)
                            <tr class="group hover:bg-white/[0.03] transition-colors">
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl overflow-hidden flex-shrink-0 border border-border shadow-sm">
                                            <img src="{{ $blog->featured_image }}" class="w-full h-full object-cover" alt="{{ $blog->title }}">
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold truncate max-w-[280px]">{{ $blog->title }}</p>
                                            <p class="text-xs font-medium text-muted-foreground">{{ $blog->category->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-5 text-center">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $blog->status == 'published' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                                        {{ $blog->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-5 text-center text-sm font-medium text-muted-foreground">{{ number_format($blog->views) }}</td>
                                <td class="py-4 px-5 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="p-2.5 rounded-xl border border-border bg-surface hover:border-accent transition-colors"><i data-lucide="edit-3" class="w-4 h-4 text-muted-foreground"></i></a>
                                        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="p-2.5 rounded-xl border border-border bg-surface hover:border-accent transition-colors"><i data-lucide="external-link" class="w-4 h-4 text-muted-foreground"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <aside class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <p class="dashboard-panel-kicker">Category heatmap</p>
                    <h3 class="dashboard-panel-title">Category Metrics</h3>
                </div>
            </div>

            <div class="space-y-5">
                @foreach($categories as $cat)
                <div class="rounded-2xl border border-border bg-white/[0.02] p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-bold">{{ $cat->name }}</span>
                        <span class="text-xs text-muted-foreground">{{ $cat->blogs_count }} posts</span>
                    </div>
                    @php
                        $total = $stats['total_blogs'] > 0 ? $stats['total_blogs'] : 1;
                        $percent = ($cat->blogs_count / $total) * 100;
                    @endphp
                    <div class="h-2 w-full bg-muted rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%; background-color: {{ $cat->color }}"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 p-6 rounded-[1.6rem] border border-border bg-gradient-to-br from-surface/80 to-white/[0.02]">
                <h4 class="text-[11px] font-bold uppercase tracking-[0.3em] text-muted-foreground mb-4">Quick Insight</h4>
                <p class="text-sm text-muted-foreground leading-6">
                    Articles in <strong>Development</strong> are receiving 45% more engagement than other categories this week.
                </p>
            </div>
        </aside>
    </section>
</div>
@endsection
