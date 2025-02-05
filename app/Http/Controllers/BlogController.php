<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //show the home page
    public function index()
    {
        // fetch the latest blogs
        $blogs = Blog::latest()->paginate(4);
        /*compact() creates an array where the key is 'blogs' and the value is the 
        $blogs variable (the collection of blog posts). this array is passed to 
        the view, allowing you to access the $blogs variable in the home.blade.php view file.*/
        return view('home', compact('blogs'));
    }


    //show the create blog page
    public function create()
    {
        return view('blogs.create');
    }

    //store the blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        } else {
            return back()->withErrors(['image' => 'Image upload failed!']);
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect('/')->with('success', 'Blog created successfully!');
    }



    // show the details of a specific blog post
    public function show($id)
    {
        //find() method will give you the matching record if it exists. If the record isn’t found, it will return null

        //findOrFail(), if the record is not found, it throws a ModelNotFoundException exception instead of returning null

        // find the blog by ID otherwise fail if not found
        $blog = Blog::findOrFail($id);

        // return the blog details view
        return view('blogs.show', compact('blog'));
    }


    // show the form for editing blog post
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        if (Auth::id() !== $blog->user_id) {
            return redirect('/')->with('error', 'Unauthorized access!');
        }

        return view('blogs.edit', compact('blog'));
    }



    // update the specified blog post in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        // update blog details
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;

        // if a new image is uploaded, delete the old one and save the new one
        if ($request->hasFile('image')) {

            // file_exists Checks whether a file or directory exists
            if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
                //unlink() is used to delete the file
                unlink(public_path('storage/' . $blog->image));
            }

            // store new image
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }

        $blog->save();

        return redirect()->route('blog.show', $blog->id)->with('success', 'Blog updated successfully!');
    }


    //delete a blog
    public function destroy($id)
    {
        //find() method will give you the matching record if it exists. If the record isn’t found, it will return null

        //findOrFail(), if the record is not found, it throws a ModelNotFoundException exception instead of returning null
        $blog = Blog::findOrFail($id);

        //it compares the authenticated user's ID to the user ID of the blog owner.
        if (Auth::id() !== $blog->user_id) {
            return redirect('/')->with('error', 'Unauthorized access!');
        }

        $blog->delete();

        return redirect('/')->with('success', 'Blog deleted successfully!');
    }


    public function search(Request $request)
    {
        //the function extracts the search query entered by the user from the request
        $query = $request->input('query');

        //condition checks if the title contains the search term
        $blogs = Blog::where('title', 'LIKE', "%{$query}%")

            //condition checks if the content contains the search term
            /*the %{$query}% in LIKE ensures a partial match, meaning it finds 
        results where the title or content contains the search term anywhere*/
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->paginate(4);

        return view('home', compact('blogs', 'query'));
    }
}
