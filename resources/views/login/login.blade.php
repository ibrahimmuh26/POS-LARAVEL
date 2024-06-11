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
                                                <input id="username"
                                                    class="floating-input form-control @error('username') is-invalid @enderror"
                                                    type="text" name="username" placeholder=" "
                                                    value="{{ old('username') }}" autocomplete="off" required autofocus>
                                                <label>Email</label>
                                            </div>
                                            {{-- @error('username') --}}
                                            <div class="mb-4" style="margin-top: -20px">
                                                <div class="text-danger small" id="errorMessage">Incorrect username or
                                                    password.</div>
                                            </div>
                                            {{-- @enderror --}}

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input id="password"
                                                    class="floating-input form-control @error('password') is-invalid @enderror @error('password') is-invalid @enderror"
                                                    type="password" value="{{ old('password') }}" name="password"
                                                    placeholder=" " required autofocus>
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                Not a Member yet?
                                                {{-- <form action="{{ route('register') }}" method="get"><a
                                                    href="javascript:void(0)" class="text-primary">Register</a></form>
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
    <script>
        // const form = document.getElementById('loginForm');
        // form.addEventListener('submit', function(event) {
        //     event.preventDefault();

        //     const formData = new FormData(form);
        //     const url = 'http://127.0.0.1:8000/api/login';

        //     fetch(url, {
        //             method: 'POST',
        //             body: formData
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log(data);
        //         })
        //         .catch(error => {
        //             console.error(error);
        //         });
        // });
    </script>
@endsection
