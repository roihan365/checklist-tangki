<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Layanan Checklist Mobil Tangki Pertamina') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/pertamina-favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-pertamina-pattern {
            background-color: #006b3d;
            background-image: linear-gradient(135deg, #006b3d 0%, #003d66 100%);
        }
    </style>
</head>

<body class="font-poppins text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Login Card -->
        <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Pertamina Header -->
            <div class="bg-white py-6 px-8 text-center">
                <img src="https://www.pertamina.com/images/Pertamina_Logo.svg" alt="Pertamina Logo" class="h-16 mx-auto mb-4">
                <h1 class="text-xl font-bold text-gray-800">FORM LOGIN</h1>
                <div class="mt-2 h-1 w-20 bg-red-600 mx-auto"></div>
            </div>

            <!-- Form Section -->
            <div class="px-8 py-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>