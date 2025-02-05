<?php




namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyPostsController extends Controller
{
    public function index()
    {
        // get the posts by the logged-in user using Auth::id()
        $blogs = Blog::where('user_id', Auth::id())->latest()->paginate(4);


        return view('blog.myPosts', compact('blogs'));
    }
}
