@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex flex-col items-center justify-center overflow-hidden bg-primary">
    <!-- Video Background -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-40">
        <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260319_015952_e1deeb12-8fb7-4071-a42a-60779fc64ab6.mp4" type="video/mp4">
    </video>
    
    <!-- Overlay Gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/20 to-background"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center text-white">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 tracking-tight animate-fade-up delay-100">
            Publish with <span class="font-display italic text-accent">Confidence</span>
        </h1>
        
        <p class="text-lg md:text-xl text-white/70 max-w-2xl mx-auto mb-10 animate-fade-up delay-200">
            Create, manage, publish, and filter blogs with a lightning-fast modern publishing experience built for the future.
        </p>
        
        <div class="flex flex-wrap items-center justify-center gap-4 animate-fade-up delay-300">
            <a href="{{ route('blogs.index') }}" class="px-8 py-4 bg-accent text-white rounded-full font-bold btn-hover shadow-lg shadow-accent/25">Start Reading</a>
            <a href="{{ route('admin.login') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full font-bold hover:bg-white/20 transition-all btn-hover">Admin Dashboard</a>
        </div>
    </div>

    <!-- Floating Dashboard Preview -->
    <div class="relative mt-20 w-full max-w-5xl mx-auto px-6 h-64 md:h-96 animate-float">
        <div class="absolute inset-x-0 top-0 glass-dark rounded-2xl shadow-dashboard border border-white/10 overflow-hidden transform rotate-x-6 scale-95 opacity-90 transition-all hover:scale-100 hover:opacity-100 glow-hover duration-500">
            <!-- Dashboard Sidebar -->
            <div class="flex h-[500px]">
                <div class="w-64 border-r border-white/10 p-6 hidden md:block">
                    <div class="flex items-center gap-2 mb-10">
                        <span class="text-accent">✦</span>
                        <span class="font-bold">Dashboard</span>
                    </div>
                    <div class="space-y-4">
                        <div class="h-4 w-32 bg-white/5 rounded-full"></div>
                        <div class="h-4 w-40 bg-white/5 rounded-full"></div>
                        <div class="h-4 w-24 bg-white/5 rounded-full"></div>
                    </div>
                </div>
                <!-- Dashboard Content -->
                <div class="flex-1 p-8">
                    <div class="flex justify-between items-center mb-10">
                        <div class="h-8 w-48 bg-white/5 rounded-lg"></div>
                        <div class="flex gap-4">
                            <div class="h-10 w-10 bg-white/5 rounded-full"></div>
                            <div class="h-10 w-32 bg-accent rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="h-32 glass bg-white/5 rounded-xl border border-white/10"></div>
                        <div class="h-32 glass bg-white/5 rounded-xl border border-white/10"></div>
                        <div class="h-32 glass bg-white/5 rounded-xl border border-white/10"></div>
                    </div>
                    <div class="mt-8 h-48 glass bg-white/5 rounded-xl border border-white/10 p-6">
                        <div class="h-4 w-full bg-white/5 rounded-full mb-4"></div>
                        <div class="h-4 w-2/3 bg-white/5 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Section -->
<section class="py-32">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16 reveal">
            <div>
                <span class="text-accent font-bold uppercase tracking-widest text-xs mb-4 block">Curated Content</span>
                <h2 class="text-4xl font-bold tracking-tight">Featured Stories</h2>
            </div>
            <a href="{{ route('blogs.index') }}" class="group flex items-center gap-2 font-bold hover:text-accent transition-colors">
                View All Blogs
                <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredBlogs as $blog)
                <div class="reveal delay-{{ $loop->index * 100 }}">
                    @include('partials.blog-card', ['blog' => $blog])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-32 bg-muted/30">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold tracking-tight mb-16 reveal">Explore Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('blogs.index') }}?category={{ $category->id }}" class="group p-8 glass rounded-2xl hover:scale-105 transition-all duration-300 reveal delay-{{ $loop->index * 50 }}">
                <div class="w-12 h-12 mx-auto mb-6 rounded-xl flex items-center justify-center text-white" style="background-color: {{ $category->color }}">
                    <i data-lucide="{{ $category->icon }}"></i>
                </div>
                <h4 class="font-bold mb-2">{{ $category->name }}</h4>
                <p class="text-xs text-muted-foreground">{{ $category->blogs_count }} Articles</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
