<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — BlogYaari Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-secondary/50 h-screen flex items-center justify-center p-6 selection:bg-accent/30">
    <div class="w-full max-w-md animate-scale-in">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-xl border border-border mb-6">
                <span class="text-accent text-3xl font-bold">✦</span>
            </div>
            <h1 class="text-3xl font-bold tracking-tight mb-2">Welcome Back</h1>
            <p class="text-muted-foreground">Sign in to manage your publishing empire.</p>
        </div>

        <div class="glass p-10 rounded-3xl shadow-dashboard">
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold mb-2 px-1">Email Address</label>
                    <div class="relative group">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground group-focus-within:text-accent transition-colors"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full pl-12 pr-6 py-4 bg-white/50 border border-border rounded-2xl focus:border-accent focus:bg-white outline-none transition-all" placeholder="admin@blogyaari.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2 px-1">Password</label>
                    <div class="relative group">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground group-focus-within:text-accent transition-colors"></i>
                        <input type="password" name="password" required class="w-full pl-12 pr-6 py-4 bg-white/50 border border-border rounded-2xl focus:border-accent focus:bg-white outline-none transition-all" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-4 h-4 rounded border-border text-accent focus:ring-accent">
                        <span class="text-xs text-muted-foreground group-hover:text-foreground transition-colors">Remember me</span>
                    </label>
                    <a href="#" class="text-xs font-bold text-accent hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-white rounded-2xl font-bold shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center mt-10 text-sm text-muted-foreground">
            Don't have an account? <a href="#" class="font-bold text-accent hover:underline">Contact Support</a>
        </p>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
