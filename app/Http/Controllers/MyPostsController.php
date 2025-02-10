<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;

class MyPostsController extends Controller
{
    public function index()
    {
        // get the posts by the logged-in user using Auth::id()
        $blogs = Blog::where('user_id', Auth::id())->latest()->paginate(4);


        return view('blog.my-posts', compact('blogs'));
    }
}
