<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Vincular Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
<body class="bg-light">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="../assets/media/Bootstrap-logo.png" class="rounded-circle" alt="Logo" style="width: 80px;">
                        </div>
                        <h4 class="text-center mb-4">Inicia sesión</h4>
                        <form id="loginForm" method="post">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control form-control-lg" id="userName" name="userName" placeholder="Introduce nombre de usuario" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Introduce contraseña" required>
                            </div>

                            <div class="row">
                            <div class="col-12 col-md-8">
                                <button type="submit" class="btn btn-primary btn-lg loginBtn mt-2 w-100">Login</button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button type="button" class="btn btn-secondary btn-lg registerBtn mt-2 w-100" onclick="window.location.href='../views/register.php'">Registrarse</button>
                            </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/login.js"></script>

</body>
</html>

