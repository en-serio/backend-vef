<?php

class Usuario{
    private $conexion;

    public function __construct($conexion){
        $this->conexion = $conexion;
    }

    public function obtenerUsuario($usuario){
        $sql = "SELECT * from usuarios where usuario = ?";
        $statement = $this->conexion->prepare($sql);
        $statement->bind_param("s", $usuario);
        $statement->execute();
        $resultado = $statement->get_result();
        if($resultado->num_rows > 0){
            return $resultado->fetch_assoc();
        }else{
            return null;
        }
    }

    public function registrarUsuario($usuario, $contrasena, $nombre, $apellido){
        //particular esta hardcodeado
        $sql = "INSERT INTO usuarios (usuario, contrasenya, nombre, apellido, rol_usuario) VALUES (?, ?, ?, ?, 'particular')";
        $statement = $this->conexion->prepare($sql);
        $statement->bind_param("ssss", $usuario, $contrasena, $nombre, $apellido);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}