<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/js/app.js'])

    <!-- CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    
</head>
<body class="vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-4" href="{{ route('dashboard') }}">
                <img src="{{ Vite::asset('resources/images/Bootstrap-logo.png') }}" class="rounded-circle" alt="Logo" style="width: 30px;">
                <span class="ms-2">Gestión de Transfers VEF</span>
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="vh-100 mt-5">
        <div class="container-fluid h-100">
            @include('layouts.sidebar')        <!-- Sidebar -->
            <div class="main-content">
                @yield('content') <!-- Contenido dinámico -->
            </div>
        </div>
    </main>

    <!-- Modales Comunes -->
    @include('misc.modalEdit')
    @include('transfer.stepper')

    <!-- JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts') <!-- Scripts adicionales -->
</body>
</html>
