{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 50px;">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html> --}}
@extends('login.body.main')

@section('container')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">

                                <h2 class="mb-2">Log In</h2>
                                <p>Login to stay connected.</p>

                                <form id="loginForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input
                                                    class="floating-input form-control @error('email') is-invalid @enderror @error('username') is-invalid @enderror"
                                                    type="text" name="email" id="email" value="{{ old('email') }}"
                                                    autocomplete="off" required autofocus>
                                                <label>Email/Username</label>
                                            </div>
                                            {{-- @error('username')
                                                <div class="mb-4" style="margin-top: -20px">
                                                    <div class="text-danger small">Incorrect username or password.</div>
                                                </div>
                                            @enderror
                                            @error('email')
                                                <div class="mb-4" style="margin-top: -20px">
                                                    <div class="text-danger small">Incorrect username or password.</div>
                                                </div>
                                            @enderror --}}
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input
                                                    class="floating-input form-control @error('email') is-invalid @enderror @error('username') is-invalid @enderror"
                                                    type="password" name="password" placeholder=" " id="password" required>
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            {{-- <p>
                                                Not a Member yet? <a href="{{ route('register') }}"
                                                    class="text-primary">Register</a>
                                            </p> --}}
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="#" class="text-primary float-right">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-5 content-right">
                            <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();

                const data = {
                    email: $('#email').val(),
                    password: $('#password').val(),
                }
                console.log(data);

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/login',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '/dashboard';
                        } else {
                            alert(response);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
