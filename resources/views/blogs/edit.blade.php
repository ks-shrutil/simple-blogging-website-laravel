@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center">
                        <h4>Edit Blog</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Blog Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $blog->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Blog Content</label>
                                <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                @if ($blog->image)
                                    <div>
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                            style="width: 200px;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload New Image</label>
                                <input type="file" name="image" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark w-50">Update Blog</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
