<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <main>
        <section>
            <h1>Registro</h1>
            <form action="index.php?c=LoginController&a=registrarUsuario" method="POST">
                <div>
                    <label for="userName">Nombre de usuario</label>
                    <input type="text" id="userName" name="userName" required>
                </div>
                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <button type="submit">Registrarse</button>
            </form>
        </section>
    </main>
</body>
</html>