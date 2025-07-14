<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Style Barbershop') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700|playfair+display:400,500,600&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-barber-pattern {
            background-image: url("{{ asset('images/auth-bg-pattern.png') }}");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="font-poppins text-gray-900 antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side - Background Image -->
        <div class="lg:w-1/2 bg-barber-pattern relative hidden lg:flex items-center justify-center p-12">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative z-10 text-white text-center">
                <h1 class="text-4xl font-bold mb-4 font-playfair uppercase">sistem layanan <br> checklist mobil tangki</h1>
                <p class="text-xl mb-6">Masuk ke akun Anda untuk mengakses seluruh fitur</p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-12">
            <a href="/" class="mb-8">
                <img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="h-16">
            </a>

            <div class="w-full sm:max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-8 py-6">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $title ?? 'Welcome Back' }}</h2>
                        <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan</p>
                    </div>

                    {{ $slot }}
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-gray-600">
                {{-- @if (Route::has('register') && (!isset($hideRegister) || !$hideRegister))
                    <p>Belum punya akun?
                        <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-700 font-medium">Daftar
                            sekarang</a>
                    </p>
                @endif --}}
            </div>
        </div>
    </div>
</body>

</html>
