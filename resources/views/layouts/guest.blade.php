<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Nexo Credito') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="font-sans auth-shell">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card card p-4 shadow-lg bg-white">
            <div class="text-center mb-4">
                <a href="/" class="d-inline-block text-decoration-none">
                    <span class="brand-mark mb-2">N</span>
                    <div class="fw-bold text-dark">Nexo Credito</div>
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>

</html>
