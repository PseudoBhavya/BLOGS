@extends('layouts.app')

@section('title', 'Browse Blogs — BlogYaari')

@section('content')
<!-- Header -->
<section class="pt-40 pb-20 bg-muted/30">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6 reveal">All Stories</h1>
        <p class="text-muted-foreground text-lg max-w-2xl mx-auto reveal delay-100">
            Discover the latest insights from our world-class authors. Filter by category or search to find exactly what you need.
        </p>
    </div>
</section>

<!-- Filter & Search Bar -->
<section class="sticky top-20 z-40 py-6 glass border-b border-border">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
            <!-- Search -->
            <div class="relative w-full lg:w-96 group">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground group-focus-within:text-accent transition-colors"></i>
                <input type="text" id="search-input" placeholder="Search articles..." class="w-full pl-12 pr-6 py-3 bg-muted/50 rounded-xl border border-transparent focus:border-accent focus:bg-white outline-none transition-all">
            </div>

            <!-- Categories -->
            <div class="flex flex-wrap items-center justify-center gap-2">
                <button class="category-filter active px-5 py-2.5 rounded-full text-sm font-medium transition-all" data-id="">All</button>
                @foreach($categories as $category)
                <button class="category-filter px-5 py-2.5 rounded-full text-sm font-medium bg-muted hover:bg-muted-foreground/10 transition-all" data-id="{{ $category->id }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <!-- Sort -->
            <div class="relative w-full lg:w-48">
                <select id="sort-filter" class="w-full px-6 py-3 bg-muted/50 rounded-xl border border-transparent focus:border-accent focus:bg-white outline-none appearance-none cursor-pointer text-sm font-medium transition-all">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground pointer-events-none"></i>
            </div>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-20 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <div id="blog-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('partials.blog-list', ['blogs' => $blogs])
        </div>
        
        <!-- Loading Skeleton (Hidden) -->
        <div id="skeleton-container" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @for($i = 0; $i < 6; $i++)
            <div class="glass rounded-2xl overflow-hidden">
                <div class="h-64 skeleton"></div>
                <div class="p-8 space-y-4">
                    <div class="h-4 w-1/3 skeleton"></div>
                    <div class="h-6 w-full skeleton"></div>
                    <div class="h-6 w-2/3 skeleton"></div>
                    <div class="h-4 w-full skeleton"></div>
                </div>
            </div>
            @endfor
        </div>

        <!-- Empty State (Hidden) -->
        <div id="empty-state" class="hidden py-20 text-center">
            <div class="w-24 h-24 mx-auto mb-8 bg-muted rounded-full flex items-center justify-center">
                <i data-lucide="search-x" class="w-12 h-12 text-muted-foreground"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">No blogs found</h3>
            <p class="text-muted-foreground">Try adjusting your filters or search keywords.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let currentCategory = '';
        let currentSearch = '';
        let currentSort = 'newest';
        let debounceTimer;

        function fetchBlogs() {
            $('#blog-container').addClass('opacity-50 pointer-events-none');
            $('#skeleton-container').removeClass('hidden');
            $('#empty-state').addClass('hidden');

            $.ajax({
                url: "{{ route('blogs.filter') }}",
                type: 'GET',
                data: {
                    category: currentCategory,
                    search: currentSearch,
                    sort: currentSort
                },
                success: function(response) {
                    $('#blog-container').html(response).removeClass('opacity-50 pointer-events-none');
                    $('#skeleton-container').addClass('hidden');
                    
                    if ($.trim(response) === '') {
                        $('#empty-state').removeClass('hidden');
                    }
                    
                    lucide.createIcons();
                }
            });
        }

        // Search Input with Debounce
        $('#search-input').on('keyup', function() {
            clearTimeout(debounceTimer);
            currentSearch = $(this).val();
            debounceTimer = setTimeout(fetchBlogs, 300);
        });

        // Category Filter
        $('.category-filter').click(function() {
            $('.category-filter').removeClass('active bg-accent text-white').addClass('bg-muted');
            $(this).addClass('active bg-accent text-white').removeClass('bg-muted');
            currentCategory = $(this).data('id');
            fetchBlogs();
        });

        // Sort Filter
        $('#sort-filter').change(function() {
            currentSort = $(this).val();
            fetchBlogs();
        });
    });
</script>
<style>
    .category-filter.active {
        background-color: var(--color-accent);
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
</style>
@endpush
