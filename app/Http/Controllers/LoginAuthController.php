<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAuthController extends Controller
{
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

}
