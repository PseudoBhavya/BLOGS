@extends('admin.layouts.admin')

@section('title', 'Edit Post — BlogYaari')

@section('admin_content')
<div class="mb-10 flex items-center gap-4">
    <a href="{{ route('admin.blogs.index') }}" class="p-2 hover:bg-muted rounded-xl transition-all">
        <i data-lucide="chevron-left" class="w-6 h-6"></i>
    </a>
    <div>
        <h1 class="text-3xl font-bold tracking-tight mb-2">Edit Post</h1>
        <p class="text-muted-foreground">Modify your story and update your readers.</p>
    </div>
</div>

<form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @method('PUT')
    
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <div class="glass p-10 rounded-3xl shadow-sm">
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold mb-3">Blog Title</label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="w-full px-6 py-4 bg-surface border border-border rounded-2xl focus:border-accent focus:bg-surface outline-none transition-all text-xl font-bold text-foreground" placeholder="The Future of Smarter Blogging...">
                    @error('title') <p class="mt-2 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-3">Short Description</label>
                    <textarea name="short_description" required rows="3" class="w-full px-6 py-4 bg-surface border border-border rounded-2xl focus:border-accent focus:bg-surface outline-none transition-all resize-none text-foreground" placeholder="A brief hook for your readers...">{{ old('short_description', $blog->short_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-3">Full Article Content</label>
                    <textarea name="content" required rows="15" class="w-full px-6 py-4 bg-surface border border-border rounded-2xl focus:border-accent focus:bg-surface outline-none transition-all text-foreground" placeholder="Write your story here...">{{ old('content', $blog->content) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Settings -->
    <div class="space-y-6">
        <div class="glass p-8 rounded-3xl shadow-sm">
            <h3 class="font-bold mb-6 text-sm uppercase tracking-widest text-muted-foreground">Publishing Settings</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold mb-2">Category</label>
                    <select name="category_id" required class="w-full px-4 py-3 bg-surface border border-border rounded-xl focus:border-accent focus:bg-surface outline-none transition-all text-sm appearance-none text-foreground">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $blog->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold mb-2">Publish Date</label>
                    <input type="date" name="publish_date" value="{{ old('publish_date', $blog->publish_date->format('Y-m-d')) }}" required class="w-full px-4 py-3 bg-surface border border-border rounded-xl focus:border-accent focus:bg-surface outline-none transition-all text-sm text-foreground">
                </div>

                <div>
                    <label class="block text-xs font-bold mb-2">Status</label>
                    <select name="status" required class="w-full px-4 py-3 bg-surface border border-border rounded-xl focus:border-accent focus:bg-surface outline-none transition-all text-sm text-foreground">
                        <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ $blog->status == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="glass p-8 rounded-3xl shadow-sm">
            <h3 class="font-bold mb-6 text-sm uppercase tracking-widest text-muted-foreground">Featured Media</h3>
            <div>
                <label class="block text-xs font-bold mb-2">Image URL</label>
                <input type="url" name="featured_image" id="image_url" value="{{ old('featured_image', $blog->featured_image) }}" class="w-full px-4 py-3 bg-surface border border-border rounded-xl focus:border-accent focus:bg-surface outline-none transition-all text-sm mb-4 text-foreground" placeholder="https://images.unsplash.com/...">
                <div id="image_preview" class="aspect-video rounded-xl bg-muted overflow-hidden flex items-center justify-center border-2 border-dashed border-border group">
                    <img src="{{ $blog->featured_image }}" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full py-4 bg-primary text-white rounded-2xl font-bold shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
            <i data-lucide="save" class="w-5 h-5"></i>
            Update Story
        </button>
    </div>
</form>

<script>
    $('#image_url').on('input', function() {
        const url = $(this).val();
        if (url) {
            $('#image_preview').html(`<img src="${url}" class="w-full h-full object-cover">`);
        } else {
            $('#image_preview').html('<p class="text-xs text-muted-foreground">No image selected</p>');
        }
    });
</script>
@endsection
