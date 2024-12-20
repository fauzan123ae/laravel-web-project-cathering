<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900"
            style="background-image: url('{{ asset('images/platter-2009590.jpg') }}'); background-size: cover; background-position: center;">

            <div class="flex justify-center items-center flex-column min-h-screen">
                <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="flex justify-center">
                        <!-- Membesarkan ukuran logo lebih besar -->
                        <img src="{{ asset('images/11zon_cropped.png') }}" alt="Logo" class="h-48 w-auto">
                    </div>
                    <div class="text-center mt-12 text-3xl font-semibold leading-tight text-gray-900 dark:text-white">
                        Selamat Datang Di Dapur Fauzan
                    </div>

                    <div class="mt-12 d-flex justify-content-center gap-4">
                        <!-- Login Button -->
                        <a href="{{ route('login') }}" class="btn btn-warning py-2 px-4 rounded-3">
                            Login
                        </a>

                        <!-- Register Button -->
                        <a href="{{ route('register') }}" class="btn btn-warning py-2 px-4 rounded-3">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
