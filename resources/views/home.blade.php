@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-center mb-4">Latest Blogs</h1>

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

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>




        @if ($blogs->isEmpty())
            <p class="text-center">No blogs available for this category.</p>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            background-color: #fff;
            padding: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 8px 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .card-body p.text-muted {
            font-size: 0.8rem;
            color: #999;
        }

        @media (max-width: 768px) {
            .card-img-top {
                height: 150px;
            }

            .card-body {
                padding: 15px;
            }
        }
    </style>
@endsection
