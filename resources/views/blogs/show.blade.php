@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $blog->title }}</h1>
        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid mb-4"
            style="height: 400px; object-fit: cover; display: block; margin-left: auto; margin-right: auto;">
        <center>
            <div class="blog-content">
                {!! $blog->content !!}
            </div>
        </center>
        <p class="text-center text-muted">By {{ $blog->user->name }} | {{ $blog->created_at->format('M d, Y') }}</p>

        @auth
            @if (Auth::id() === $blog->user_id)
                <!-- show edit and delete buttons for only the owner of the blog -->
                <div class="text-center mt-3">
                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endif
        @endauth

        <div class="text-center mt-3">
            <a href="{{ url('/') }}" class="btn btn-secondary">Back to Blogs</a>
        </div>
    </div>
@endsection
