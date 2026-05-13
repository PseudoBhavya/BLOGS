@extends('admin.layouts.admin')

@section('title', 'Manage Categories — BlogYaari')

@section('admin_content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
    <div>
        <h1 class="text-3xl font-bold tracking-tight mb-2">Categories</h1>
        <p class="text-muted-foreground">Organize your content into meaningful sections.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-accent text-white rounded-xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-accent/20">
        <i data-lucide="plus" class="w-5 h-5"></i>
        New Category
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($categories as $category)
    <div class="glass p-8 rounded-3xl shadow-sm group hover:scale-[1.02] transition-all">
        <div class="flex items-start justify-between mb-8">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-lg" style="background-color: {{ $category->color }}">
                <i data-lucide="{{ $category->icon }}" class="w-7 h-7"></i>
            </div>
            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 hover:bg-surface rounded-lg transition-all text-muted-foreground"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 hover:bg-surface rounded-lg transition-all text-muted-foreground hover:text-danger"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                </form>
            </div>
        </div>
        
        <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
        <p class="text-xs text-muted-foreground mb-6 line-clamp-2">{{ $category->description ?? 'No description provided.' }}</p>
        
        <div class="flex items-center justify-between pt-6 border-t border-border">
            <span class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Stats</span>
            <span class="text-xs font-bold">{{ $category->blogs_count }} Articles</span>
        </div>
    </div>
    @endforeach
</div>
@endsection
