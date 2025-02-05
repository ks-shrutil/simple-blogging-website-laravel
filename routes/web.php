<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyPostsController;
use App\Models\Blog;

// home Page (shows blogs)
Route::get('/', [BlogController::class, 'index'])->name('home');

//used to display the registration form
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
//used to process for registration form submission
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


//used to display the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//used to process for login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


//if any user is loggedin, so you can logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');




// //if any user is loggedin, so you can create a blog
// Route::get('/blog/create', [BlogController::class, 'create'])->middleware('auth');
// //store the blog
// Route::post('/blog/store', [BlogController::class, 'store'])->middleware('auth');



// // when i click Read more button show the full content of blog
// Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
// // edit the blog
// Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->middleware('auth')->name('blog.edit');

// //updating the blog
// Route::put('/blog/{id}', [BlogController::class, 'update'])->middleware('auth')->name('blog.update');
// //delete the blog
// Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->middleware('auth')->name('blog.destroy');




Route::middleware(['auth'])->group(function () {
    // resourceful Routes
    Route::resource('categories', CategoryController::class);
});


Route::resource('blog', BlogController::class);


//show the category wise blog
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');



Route::middleware(['auth'])->group(function () {
    Route::get('/my-posts', [MyPostsController::class, 'index'])->name('myPosts.index');
});
