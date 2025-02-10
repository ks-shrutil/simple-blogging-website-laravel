<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;

class CategoryController extends Controller
{

    //show the category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $blogs = Blog::where('category_id', $id)->latest()->paginate(4);

        return view('categories.show', compact('blogs', 'category'));
    }
}
