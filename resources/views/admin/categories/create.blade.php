@extends('admin.layouts.admin')

@section('title', 'Create Category — BlogYaari')

@section('admin_content')
<div class="mb-10 flex items-center gap-4">
    <a href="{{ route('admin.categories.index') }}" class="p-2 hover:bg-muted rounded-xl transition-all">
        <i data-lucide="chevron-left" class="w-6 h-6"></i>
    </a>
    <div>
        <h1 class="text-3xl font-bold tracking-tight mb-2">New Category</h1>
        <p class="text-muted-foreground">Create a new container for your amazing stories.</p>
    </div>
</div>

<div class="max-w-2xl">
    <div class="glass p-10 rounded-3xl shadow-sm">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div>
                <label class="block text-sm font-bold mb-3 px-1 text-foreground">Category Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-6 py-4 bg-surface border border-border rounded-2xl focus:border-accent focus:bg-surface outline-none transition-all font-bold text-foreground" placeholder="e.g. Artificial Intelligence">
                @error('name') <p class="mt-2 text-xs text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold mb-3 px-1 text-foreground">Brand Color</label>
                    <div class="flex items-center gap-4">
                        <input type="color" name="color" value="#6366f1" class="w-14 h-14 rounded-xl border-none outline-none cursor-pointer bg-transparent">
                        <p class="text-xs text-muted-foreground font-medium">Used for accents and badges.</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-3 px-1 text-foreground">Icon</label>
                    <select name="icon" required class="w-full px-4 py-4 bg-surface border border-border rounded-xl focus:border-accent focus:bg-surface outline-none transition-all text-sm appearance-none cursor-pointer font-bold text-foreground">
                        <option value="cpu">CPU</option>
                        <option value="palette">Palette</option>
                        <option value="briefcase">Briefcase</option>
                        <option value="code">Code</option>
                        <option value="bot">Bot</option>
                        <option value="heart">Heart</option>
                        <option value="zap">Zap</option>
                        <option value="camera">Camera</option>
                        <option value="globe">Globe</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold mb-3 px-1 text-foreground">Description</label>
                <textarea name="description" rows="3" class="w-full px-6 py-4 bg-surface border border-border rounded-2xl focus:border-accent focus:bg-surface outline-none transition-all resize-none text-foreground" placeholder="What kind of stories go here?">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-primary text-white rounded-2xl font-bold shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                Create Category
            </button>
        </form>
    </div>
</div>
@endsection
