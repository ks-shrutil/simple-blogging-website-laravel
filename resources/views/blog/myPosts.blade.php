@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">My Posts</h1>

        @if($blogs->isEmpty())
            <p class="text-center">You have not created any posts yet.</p>
        @else
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 rounded">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit($blog->content, 50) }}</p>
                                <p class="text-muted">Posted on {{ $blog->created_at->format('M d, Y') }}</p>
                                <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-success">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
