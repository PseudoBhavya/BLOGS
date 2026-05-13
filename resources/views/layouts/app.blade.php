<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BlogYaari — The Future of Smarter Blogging')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-background text-foreground selection:bg-accent/30">
    <!-- Reading Progress -->
    <div id="reading-progress" class="reading-progress" style="width: 0%"></div>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-bold tracking-tight">
                <span class="text-accent">✦</span> BlogYaari
            </a>
            
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm font-medium hover:text-accent transition-colors">Home</a>
                <a href="{{ route('blogs.index') }}" class="text-sm font-medium hover:text-accent transition-colors">Blogs</a>
                <a href="#" class="text-sm font-medium hover:text-accent transition-colors">Categories</a>
                <a href="{{ route('admin.login') }}" class="px-5 py-2.5 bg-primary text-primary-foreground rounded-full text-sm font-medium hover:bg-primary/90 transition-all hover:scale-105">Admin Portal</a>
            </div>

            <button id="mobile-menu-btn" class="md:hidden p-2">
                <i data-lucide="menu"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-[60] glass mobile-menu md:hidden">
        <div class="flex flex-col items-center justify-center h-full gap-8">
            <button id="mobile-menu-close" class="absolute top-6 right-6 p-2">
                <i data-lucide="x" class="w-8 h-8"></i>
            </button>
            <a href="{{ route('home') }}" class="text-2xl font-bold hover:text-accent">Home</a>
            <a href="{{ route('blogs.index') }}" class="text-2xl font-bold hover:text-accent">Blogs</a>
            <a href="{{ route('admin.login') }}" class="text-2xl font-bold hover:text-accent">Admin</a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-muted py-20 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight mb-6 block">
                    <span class="text-accent">✦</span> BlogYaari
                </a>
                <p class="text-muted-foreground max-w-sm">
                    The modern publishing platform for forward-thinking developers and designers. 
                    Create, manage, and share your stories with the world.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-6">Explore</h4>
                <ul class="space-y-4 text-sm text-muted-foreground">
                    <li><a href="{{ route('home') }}" class="hover:text-accent">Home</a></li>
                    <li><a href="{{ route('blogs.index') }}" class="hover:text-accent">All Blogs</a></li>
                    <li><a href="#" class="hover:text-accent">Categories</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6">Platform</h4>
                <ul class="space-y-4 text-sm text-muted-foreground">
                    <li><a href="{{ route('admin.login') }}" class="hover:text-accent">Admin Login</a></li>
                    <li><a href="#" class="hover:text-accent">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-accent">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-12 mt-12 border-t border-border flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-muted-foreground">© 2026 BlogYaari. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="text-muted-foreground hover:text-accent"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                <a href="#" class="text-muted-foreground hover:text-accent"><i data-lucide="github" class="w-5 h-5"></i></a>
                <a href="#" class="text-muted-foreground hover:text-accent"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('#navbar').addClass('glass shadow-sm h-16').removeClass('h-20');
            } else {
                $('#navbar').removeClass('glass shadow-sm h-16').addClass('h-20');
            }

            // Reading progress
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            $('#reading-progress').css('width', scrolled + "%");
        });

        // Mobile menu toggle
        $('#mobile-menu-btn').click(function() {
            $('#mobile-menu').addClass('open');
        });
        $('#mobile-menu-close').click(function() {
            $('#mobile-menu').removeClass('open');
        });

        // Reveal on scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
    @stack('scripts')
</body>
</html>
