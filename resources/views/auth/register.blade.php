@extends('layouts.app')
@section('content')
    <html>

    <head>
        <title>Register Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            /* From Uiverse.io by csemszepp */
            body {
                width: 100%;
                height: 100%;
                --s: 200px;
                /* control the size */
                --c1: #1d1d1d;
                --c2: #4e4f51;
                --c3: #3c3c3c;

                background: repeating-conic-gradient(from 30deg,
                        #0000 0 120deg,
                        var(--c3) 0 180deg) calc(0.5 * var(--s)) calc(0.5 * var(--s) * 0.577),
                    repeating-conic-gradient(from 30deg,
                        var(--c1) 0 60deg,
                        var(--c2) 0 120deg,
                        var(--c3) 0 180deg);
                background-size: var(--s) calc(var(--s) * 0.577);
            }

            .input-group {
                position: relative;
            }

            .input {
                border: solid 1.5px #9e9e9e;
                border-radius: 1rem;
                background: none;
                padding: 1rem;
                font-size: 1rem;
                color: #212121;
                transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
                width: 100%;
            }

            .user-label {
                position: absolute;
                left: 15px;
                color: #757575;
                pointer-events: none;
                transform: translateY(1rem);
                transition: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            }

            .input:focus,
            .input:valid {
                outline: none;
                border: 1.5px solid #1a73e8;
            }

            .input:focus~.user-label,
            .input:valid~.user-label {
                transform: translateY(-50%) scale(0.8);
                background-color: #f5f5f5;
                padding: 0 .2em;
                color: #1a73e8;
            }

            .card {
                border-radius: 1.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .btn-primary {
                border-radius: 1rem;
                padding: 0.5rem 1.5rem;
            }

            .form-check-label {
                font-size: 0.9rem;
            }

            a {
                text-decoration: none;
                color: #1a73e8;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center fs-4 fw-bold">Register</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="input-group mb-4">
                                    <input id="name" type="text" class="input @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autofocus>
                                    <label for="name" class="user-label">Name</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4">
                                    <input id="email" type="email" class="input @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required>
                                    <label for="email" class="user-label">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4">
                                    <input id="password" type="password"
                                        class="input @error('password') is-invalid @enderror" name="password" required>
                                    <label for="password" class="user-label">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4">
                                    <input id="password_confirmation" type="password" class="input"
                                        name="password_confirmation" required>
                                    <label for="password_confirmation" class="user-label">Confirm Password</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}">Already have an account? Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
