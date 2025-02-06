@extends('layouts.app')
@section('content')
    <html>

    <head>
        <title>Login Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            /* From Uiverse.io by csemszepp */
            body {}

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
                width: 500px;
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center fs-4 fw-bold">{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login-supplier') }}">
                            @csrf

                            <div class="input-group mb-4">
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email" class="user-label">{{ __('Email Address') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-4">
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                                    name="password" required>
                                <label for="password" class="user-label">{{ __('Password') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                <p class="mb-0">{{ __('Need an account?') }} <a
                                        href="/register">{{ __('Register') }}</a></p>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="mt-3 text-center">
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </html>
@endsection
