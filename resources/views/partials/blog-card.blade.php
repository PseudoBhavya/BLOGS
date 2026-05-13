<article class="group relative flex flex-col glass rounded-2xl overflow-hidden hover-card h-full">
    <div class="relative h-64 overflow-hidden">
        <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-md border border-white/20" style="background-color: {{ $blog->category->color }}99">
                {{ $blog->category->name }}
            </span>
        </div>
    </div>
    
    <div class="p-8 flex flex-col flex-1">
        <div class="flex items-center gap-3 text-xs text-muted-foreground mb-4">
            <span>{{ $blog->publish_date->format('M d, Y') }}</span>
            <span class="w-1 h-1 rounded-full bg-muted-foreground"></span>
            <span>{{ $blog->reading_time }} min read</span>
        </div>
        
        <h3 class="text-xl font-bold mb-4 line-clamp-2 leading-tight group-hover:text-accent transition-colors">
            {{ $blog->title }}
        </h3>
        
        <p class="text-muted-foreground text-sm line-clamp-3 mb-6 flex-1">
            {{ $blog->short_description }}
        </p>
        
        <a href="{{ route('blogs.show', $blog->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-accent group/btn">
            Read Article
            <i data-lucide="chevron-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
        </a>
    </div>
</article>
