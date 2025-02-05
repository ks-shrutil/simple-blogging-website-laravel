@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">My Blogs</h2>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{!! Str::limit($blog->content, 20) !!}</p>

                            <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>

    </div>
@endsection
