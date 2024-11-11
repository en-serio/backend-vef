<?php

class LoginController
{
    public function mostrarLogin()
    {
        require_once 'views/login.php';
    }

    public function mostrarRegistro()
    {
        require_once 'views/registro.php';
    }

    public function iniciarSesion()
    {
        if (isset($_POST['userName']) && isset($_POST['password'])) {
            $usuario = $_POST['userName'];
            $contrasenya = $_POST['password'];
            
            $usuario = htmlspecialchars($_POST['userName']);
            $contrasenya = htmlspecialchars($_POST['password']);

            global $conexion;
            $usuarioModel = new Usuario($conexion);
            $usuario = $usuarioModel->obtenerUsuario($usuario);
    
            if ($usuario) {
                if(password_verify($contrasenya, $usuario['contrasenya'])){
                    $_SESSION['usuario'] = $usuario;
                    header("Location: index.php?c=transfer&a=mostrarTransferencias");
                }else{
                    header("Location: index.php?c=loginController&a=mostrarLogin&error=2");
                }
            } else {
                header("Location: index.php?c=loginController&a=mostrarLogin&error=2");
            }
        }else{
            header("Location: index.php?c=loginController&a=mostrarLogin&error=1");
        }
    }

    public function registrarUsuario(){
        if (isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['nombre']) && isset($_POST['apellido'])) {
            $usuario = $_POST['userName'];
            $contrasenya = $_POST['password'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            
            $usuario = htmlspecialchars($_POST['userName']);
            $contrasenya = htmlspecialchars($_POST['password']);
            $nombre = htmlspecialchars($_POST['nombre']);
            $apellido = htmlspecialchars($_POST['apellido']);

            $contrasenyaHasheada = password_hash($contrasenya, PASSWORD_DEFAULT);
            global $conexion;
            $usuarioModel = new Usuario($conexion);
            $usuario = $usuarioModel->registrarUsuario($usuario, $contrasenyaHasheada, $nombre, $apellido);
    
            if ($usuario) {
                header("Location: index.php?c=loginController&a=mostrarLogin");
            } else {
                header("Location: index.php?c=loginController&a=mostrarRegistro&error=2");
            }
        }else{
            header("Location: index.php?c=loginController&a=mostrarRegistro&error=1");
        }
    }
}