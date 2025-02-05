@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $category->name }} Blogs</h1>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->content, 20) }}</p>
                            <p class="text-muted">By {{ $blog->user->name }} | {{ $blog->created_at->format('M d, Y') }}</p>
                            <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($blogs->isEmpty())
            <p class="text-center">No blogs available in this category.</p>
        @endif
    </div>
@endsection
