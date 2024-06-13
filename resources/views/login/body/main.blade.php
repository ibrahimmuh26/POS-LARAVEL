<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>POS Dash | Responsive Bootstrap 4 Admin Dashboard Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

    {{-- @csrf --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">

</head>

<body>
    <!-- loader Start -->
    {{-- <div id="loading">
        <div id="loading-center"></div>
        </div> --}}
    <!-- loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                @yield('container')
            </div>
        </section>
    </div>
    <!-- Wrapper End-->

    <!-- Backend Bundle JavaScript -->
    {{-- <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script> --}}

    {{-- @yield('specificpagescripts') --}}

    <!-- App JavaScript -->
    {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}

</body>

</html>
