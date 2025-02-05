@extends('layouts.navbar')

@section('content')
    <h2 class="text-center">{{ $category->name }} Blogs</h2>
    @if (isset($query))
        <h5 class="text-center">Search results for "{{ $query }}"</h5>
    @endif

    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        {{-- if $blog->content contains HTML tags, using {!! ... !!} allows them to be 
                        rendered instead of being shown as plain text --}}
                        <p class="card-text">{!! Str::limit($blog->content, 20) !!}</p>
                        <p class="text-muted">By {{ $blog->user->name }} | {{ $blog->created_at->format('M d, Y') }}</p>
                        <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
@endsection
