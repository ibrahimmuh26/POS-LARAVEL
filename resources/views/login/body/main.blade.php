<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>POS Dash | Responsive Bootstrap 4 Admin Dashboard Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
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
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

    @yield('specificpagescripts')

    <!-- App JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
<script>
    const loginForm = document.getElementById('loginForm');
    const errorMessageElement = document.getElementById('errorMessage');
    // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // var csrf = document.querySelector('meta[name="csrf-token"]').content;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    loginForm.addEventListener('submit', async function(event) {
        event.preventDefault();
        console.log(csrfToken);

        const data = {
            username: document.getElementById('username').value,
            password: document.getElementById('password').value,
        };

        try {
            const response = await axios.post('http://127.0.0.1:8000/api/login', data, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',

                },
            });

            console.log(response);
            alert('Data telah terkirim!');
        } catch (error) {
            if (error.response) {

                alert('Terjadi kesalahan saat mengirim data. Error Code: ' + error.response.status);
            } else {
                console.error('Error', error);
                alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
            }
        }
    });
    // loginForm.addEventListener('submit', async function (event) => {
    //     event.preventDefault();

    //     const username = document.getElementById('username').value;
    //     const password = document.getElementById('password').value;

    //     // Validasi sederhana
    //     // if (username === '' || password === '') {
    //     //     errorMessageElement.textContent = 'Username dan password tidak boleh kosong!';
    //     //     return;
    //     // }

    //     // Panggil API login Anda di sini
    //     // Ganti dengan URL API login Anda dan ganti data POST dengan username dan password
    //     fetch('http://127.0.0.1:8000/api/login', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify({
    //                 username: username,
    //                 password: password
    //             })
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.status === 'success') {
    //                 // Login berhasil, redirect ke halaman lain
    //                 window.location.href = 'dashboard.html';
    //             } else {
    //                 errorMessageElement.textContent = data.message;
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //             errorMessageElement.textContent = 'Terjadi kesalahan. Coba lagi nanti.';
    //         });
    // });
</script>

</html>
