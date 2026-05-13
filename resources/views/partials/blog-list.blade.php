@foreach($blogs as $blog)
    <div class="animate-fade-up" style="animation-delay: {{ ($loop->index % 6) * 100 }}ms">
        @include('partials.blog-card', ['blog' => $blog])
    </div>
@endforeach

@if($blogs->hasPages())
<div class="col-span-full mt-12 flex justify-center">
    {{ $blogs->appends(request()->query())->links() }}
</div>
@endif
