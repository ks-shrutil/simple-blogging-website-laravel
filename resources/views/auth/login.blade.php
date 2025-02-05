@extends('layouts.navbar')

@section('content')
    <style>
        .login-container {
            max-width: 450px;
            margin: 70px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .login-container .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-login {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-weight: bold;

        }

        .btn-login:hover {
            background-color: #139925;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
        }

        .login-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="container">
        <div class="login-container">
            <center>
                <h1>Login</h1>
                <br>
                <h4>Login to Your Account.</h4>
                <br>
                <br>
            </center>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="/login" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="example@gmail.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>

            <div class="login-footer">
                <p>Don't have an account? <a href="/register">Register here</a></p>
            </div>
        </div>
    </div>
@endsection
