<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
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


    //show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }


    //process for login form submission
    public function login(LoginUserRequest $request)
    {

        $data =  $request->validated();
        

        if (Auth::attempt($data)) {
            return redirect()->route('home')->with('success', 'Welcome, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }



    //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
