@extends('layouts.app')
@section('content')
    <html>

    <head>
        <title>reg</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <body>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <div>
                                        <label>Name:</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name') }}" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="password" required />
                                </div>
                                <div>
                                    <label>Confirm Password:</label>
                                    <input type="password" class="form-control" name="password_confirmation" required />
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                                <a href={{ '/login' }}>Sudah punya akun? Login</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>
