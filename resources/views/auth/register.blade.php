
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register - URL Shortener JDK</title>
        <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
        <link
        rel="shortcut icon"
        href="{{ asset('assets/images/logo/favicon.svg') }}"
        type="image/x-icon"
        />
        <link
        rel="shortcut icon"
        href="{{ asset('assets/images/logo/favicon.png') }}"
        type="image/png"
        />
    </head>

    <body>
        <div id="auth">
        <div class="row h-100">
            <div class="col-lg-6 col-6">
                <div id="auth-left">
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">
                    Input your data to register to our website.
                    </p>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                            type="text"
                            class="form-control form-control-xl @error('fullname') is-invalid @enderror"
                            placeholder="Fullname"
                            name="fullname"
                            />
                            @error('fullname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                            type="text"
                            class="form-control form-control-xl @error('username') is-invalid @enderror"
                            placeholder="Username"
                            name="username"
                            />
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                            type="text"
                            class="form-control form-control-xl @error('email') is-invalid @enderror"
                            placeholder="Email"
                            name="email"
                            />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                            type="password"
                            class="form-control form-control-xl"
                            placeholder="Password"
                            name="password"
                            />
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                            type="password"
                            class="form-control form-control-xl"
                            placeholder="Confirm Password"
                            name="confirm_password"
                            />
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Sign Up
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold">Log in</a>.
                    </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
