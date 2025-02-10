<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterAuthController extends Controller
{


     //show the registration form
     public function showRegisterForm()
     {
         return view('auth.register');
     }
 
 
     //process for registration form submission
     public function register(RegisterUserRequest $request)
     {
         $data = $request->validated();
 
         User::create($data);
 
         return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
     }
}
