<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1581090700227-1e8eab4d969d?fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        .auth-card {
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">

    <!-- Top-right ticket button -->
    <div class="position-absolute top-0 end-0 m-3">
        <a href="{{ route('ticket.create') }}" class="btn btn-primary btn-sm shadow">
            Generate Ticket
        </a>
    </div>


    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="auth-card p-4 shadow w-100" style="max-width: 480px;">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
