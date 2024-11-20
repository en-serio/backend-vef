<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Vincular Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="../assets/media/Bootstrap-logo.png" class="rounded-circle" alt="Logo" style="width: 80px;">
                    </div>
                    <h4 class="text-center mb-4">Regístrate</h4>
                    <form id="registerForm" method="post" onsubmit="return validateForm()">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label pt-2">Nombre</label>
                                <input type="text" class="form-control form-control-lg " id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido1" class="form-label pt-2">Primer apellido</label>
                                <input type="text" class="form-control form-control-lg " id="apellido1" name="apellido1" placeholder="Primer apellido" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido2" class="form-label pt-2">Segundo apellido</label>
                                <input type="text" class="form-control form-control-lg " id="apellido2" name="apellido2" placeholder="Segundo apellido" required>
                            </div>
                            <div class= "col-md-6">
                                <label for="telefono" class="form-label pt-2">Teléfono</label>
                                <input type="text" class="form-control form-control-lg " id="telefono" name="telefono" placeholder="Teléfono de contacto"  required>
                            </div>
                        </div>
                        <hr class="my-4" style="border-top: 2px solid #ddd;">
                        <div class="row mb-3">
                            <div class= "col-md-6">
                                <label for="userName" class="form-label pt-2">Usuario</label>
                                <input type="text" class="form-control form-control-lg" id="userName" name="username" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rol" class="form-label pt-2">Tipo de usuario 
                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Por defecto cliente, para otro tipo de usuario, contacte con administración.">
                                    </i>
                                </label>
                                <input type="text" class="form-control form-control-lg pt-2" id="claveRol" name="claveRol" placeholder="" value="cliente" required>
                            </div>

                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label pt-2">Email</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Introduce email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmEmail" class="form-label pt-2">Repite el email</label>
                                <input type="email" class="form-control form-control-lg" id="confirmEmail" name="confirmEmail" placeholder="Repite email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label pt-2">Contraseña</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Introduce contraseña" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label pt-2">Repite contraseña</label>
                                <input type="password" class="form-control form-control-lg" id="confirmPassword" name="confirmPassword" placeholder="Repite la contraseña"required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <button type="submit" class="btn btn-primary btn-lg registroBtn mt-2 w-100">Registrarse</button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button type="button" class="btn btn-secondary btn-lg loginBtn mt-2 w-100" onclick="window.location.href='login.php'">
                                    Volver al login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Vincular Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/register.js"></script>

</body>
</html>

