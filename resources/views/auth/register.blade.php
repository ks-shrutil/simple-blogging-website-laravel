@extends('layouts.navbar')

@section('content')
    <style>
        .register-container {
            max-width: 450px;
            margin: 70px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .register-container h2 {
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .register-container .form-label {
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

        .btn-register {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-weight: bold;

        }

        .btn-register:hover {
            background-color: #218838;
        }

        .register-footer {
            text-align: center;
            margin-top: 20px;
        }

        .register-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="container">
        <div class="register-container">
            <center>
                <h1>Registration</h1>
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
            <form action="/register" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                        placeholder="John Doe">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="example@gmail.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-register w-100">Register</button>
            </form>

            <div class="register-footer">
                <p>Already have an account? <a href="/login">Login here</a></p>
            </div>
        </div>
    </div>
@endsection
