<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyPostsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\RegisterAuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Blog;


Route::get('/', [BlogController::class, 'index'])->name('home');
 

Route::get('/register', [RegisterAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterAuthController::class, 'register'])->name('register.post');


Route::get('/login', [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginAuthController::class, 'login'])->name('login.post');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');



Route::middleware(['auth'])->group(function () {
    // resourceful Routes
    Route::resource('categories', CategoryController::class);
});


Route::resource('blog', BlogController::class);


Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/my-posts', [MyPostsController::class, 'index'])->name('myPosts.index');
});

Route::get('/search', [BlogController::class, 'search'])->name('blog.search');
