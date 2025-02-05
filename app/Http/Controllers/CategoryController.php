<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $blogs = Blog::where('category_id', $id)->latest()->paginate(4);

        return view('categories.show', compact('blogs', 'category'));
    }
}
