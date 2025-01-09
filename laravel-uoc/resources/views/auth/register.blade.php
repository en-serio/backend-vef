<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registro</title>

    <!-- Importar recursos compilados por Vite -->
    @vite(['resources/js/app.js'])

    <!-- Estilos adicionales -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ Vite::asset('resources/images/Bootstrap-logo.png') }}" class="rounded-circle" alt="Logo" style="width: 80px;">
                    </div>
                    <h4 class="text-center mb-4">Regístrate</h4>
                    
                    <!-- Formulario de registro -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf <!-- Token CSRF obligatorio -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="action" value="login">
                        <!-- Información personal -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido1" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control form-control-lg" id="apellido1" name="apellido1" placeholder="Primer apellido" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido2" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control form-control-lg" id="apellido2" name="apellido2" placeholder="Segundo apellido" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control form-control-lg" id="telefono" name="telefono" placeholder="Teléfono" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Información de cuenta -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userName" class="form-label">Usuario</label>
                                <input type="text" class="form-control form-control-lg" id="userName" name="username" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rol" class="form-label">Tipo de usuario</label>
                                <input type="text" class="form-control form-control-lg" id="claveRol" name="rol" value="cliente" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Introduce email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmEmail" class="form-label">Repite el email</label>
                                <input type="email" class="form-control form-control-lg" id="confirmEmail" placeholder="Repite email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Repite contraseña</label>
                                <input type="password" class="form-control form-control-lg" id="confirmPassword" placeholder="Repite contraseña" required>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Registrarse</button>
                            </div>
                            <div class="col-12 col-md-4">
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-lg w-100">Volver al login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
