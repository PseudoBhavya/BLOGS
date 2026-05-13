<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard — BlogYaari')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-primary text-foreground selection:bg-accent/30 font-body overflow-x-hidden" data-theme="dark">
    <div class="flex min-h-screen overflow-x-hidden">
        <aside class="w-72 bg-primary border-r border-border sticky top-0 h-screen hidden lg:flex flex-col p-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold tracking-tight mb-12">
                <span class="text-accent">✦</span> BlogYaari
            </a>

            <nav class="flex-1 space-y-2">
                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-4 px-4">Management</p>

                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    All Blogs
                </a>

                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i data-lucide="folder" class="w-5 h-5"></i>
                    Categories
                </a>

                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mt-10 mb-4 px-4">System</p>

                <a href="#" class="sidebar-link">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Authors
                </a>

                <a href="#" class="sidebar-link">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Settings
                </a>
            </nav>

            <div class="pt-8 border-t border-border">
                <div class="flex items-center gap-3 px-4">
                    <div class="w-10 h-10 rounded-full bg-accent text-white flex items-center justify-center font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-muted-foreground uppercase font-bold tracking-wider">Administrator</p>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-muted-foreground hover:text-danger transition-colors">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col bg-primary min-w-0">
            <header class="h-20 bg-primary/95 backdrop-blur-xl border-b border-border px-8 flex items-center justify-between sticky top-0 z-40">
                <div class="flex items-center gap-4 lg:hidden">
                    <span class="text-accent text-xl font-bold">✦</span>
                    <h1 class="font-bold">BlogYaari</h1>
                </div>

                <div class="hidden md:flex items-center gap-4 bg-surface px-4 py-2 rounded-xl border border-border focus-within:border-accent transition-all">
                    <i data-lucide="search" class="w-4 h-4 text-muted-foreground"></i>
                    <input type="text" placeholder="Global search..." class="bg-transparent border-none outline-none text-sm w-64 text-foreground placeholder-muted-foreground">
                </div>

                <div class="flex items-center gap-6">
                    <button class="relative p-2 text-muted-foreground hover:text-foreground transition-colors">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-accent rounded-full border-2 border-primary"></span>
                    </button>
                    <a href="{{ route('admin.blogs.create') }}" class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-accent text-white rounded-xl text-sm font-bold hover:scale-105 transition-all shadow-lg shadow-accent/20">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        New Blog
                    </a>
                </div>
            </header>

            <div class="flex-1 bg-primary px-6 py-6 sm:px-8 lg:px-10">
                <div class="w-full">
                    @if(session('success'))
                        <div class="toast toast-success flex items-center gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="toast toast-error flex items-center gap-3">
                            <i data-lucide="alert-circle" class="w-5 h-5"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('admin_content')
                </div>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');

        setTimeout(() => {
            $('.toast').fadeOut();
        }, 5000);
    </script>
</body>
</html>
