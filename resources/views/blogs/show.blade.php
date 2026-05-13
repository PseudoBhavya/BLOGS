@extends('layouts.app')

@section('title', $blog->title . ' — BlogYaari')

@section('content')
<!-- Blog Hero -->
<section class="pt-40 pb-20 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="flex flex-wrap items-center gap-4 mb-8 animate-fade-up">
            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-white" style="background-color: {{ $blog->category->color }}">
                {{ $blog->category->name }}
            </span>
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                {{ $blog->publish_date->format('F d, Y') }}
            </div>
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <i data-lucide="clock" class="w-4 h-4"></i>
                {{ $blog->reading_time }} min read
            </div>
        </div>

        <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-8 leading-tight animate-fade-up delay-100">
            {{ $blog->title }}
        </h1>

        <div class="flex items-center gap-4 animate-fade-up delay-200">
            <div class="w-12 h-12 rounded-full bg-muted overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=6366f1&color=fff" alt="{{ $blog->user->name }}">
            </div>
            <div>
                <p class="font-bold text-sm">{{ $blog->user->name }}</p>
                <p class="text-xs text-muted-foreground">Author & Contributor</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Image -->
<section class="max-w-6xl mx-auto px-6 mb-20 reveal">
    <div class="aspect-[21/9] rounded-3xl overflow-hidden shadow-2xl">
        <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
    </div>
</section>

<!-- Content Section -->
<section class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-20">
    <!-- Sidebar / Sharing -->
    <div class="hidden lg:block lg:col-span-1">
        <div class="sticky top-40 flex flex-col items-center gap-6">
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground [writing-mode:vertical-rl] mb-4">Share Story</p>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-border hover:bg-accent hover:text-white hover:border-accent transition-all"><i data-lucide="twitter" class="w-5 h-5"></i></a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-border hover:bg-accent hover:text-white hover:border-accent transition-all"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-border hover:bg-accent hover:text-white hover:border-accent transition-all"><i data-lucide="link" class="w-5 h-5"></i></a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:col-span-8 lg:col-start-2">
        <div class="prose animate-fade-in">
            {!! nl2br(e($blog->content)) !!}
        </div>

        <!-- Tags / Category -->
        <div class="mt-20 pt-10 border-t border-border flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="text-sm font-bold text-muted-foreground">Posted in:</span>
                <a href="#" class="text-sm font-bold text-accent hover:underline">{{ $blog->category->name }}</a>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-sm text-muted-foreground">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                    {{ number_format($blog->views) }} views
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar (Maybe author bio or newsletter) -->
    <div class="lg:col-span-3">
        <div class="sticky top-40 space-y-12">
            <!-- Author Card -->
            <div class="p-8 glass rounded-2xl">
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-muted-foreground">About Author</h4>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-full bg-muted overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=6366f1&color=fff" alt="{{ $blog->user->name }}">
                    </div>
                    <div>
                        <p class="font-bold">{{ $blog->user->name }}</p>
                        <p class="text-xs text-muted-foreground">Tech Journalist</p>
                    </div>
                </div>
                <p class="text-sm text-muted-foreground leading-relaxed">
                    {{ $blog->user->bio ?? 'Passionate storyteller covering the intersection of technology and design.' }}
                </p>
            </div>

            <!-- Subscribe -->
            <div class="p-8 bg-accent text-white rounded-2xl shadow-xl shadow-accent/20">
                <h4 class="font-bold mb-4">Weekly Insights</h4>
                <p class="text-sm text-white/80 mb-6">Join 10,000+ others and get the latest stories delivered to your inbox.</p>
                <input type="email" placeholder="Email address" class="w-full px-4 py-3 bg-white/10 rounded-xl border border-white/20 text-white placeholder:text-white/50 outline-none mb-4">
                <button class="w-full py-3 bg-white text-accent font-bold rounded-xl hover:bg-white/90 transition-all">Subscribe</button>
            </div>
        </div>
    </div>
</section>

<!-- Related Blogs -->
@if($relatedBlogs->count() > 0)
<section class="py-32 bg-muted/20 mt-32">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-16 reveal">More from {{ $blog->category->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedBlogs as $related)
                <div class="reveal delay-{{ $loop->index * 100 }}">
                    @include('partials.blog-card', ['blog' => $related])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
