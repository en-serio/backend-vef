<?php
//lo del . env
$servidor = "localhost"; 
$usuario = "root"; 
$contrasena = ""; 
$base_de_datos = "php-bcknd"; 

$conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
} else {
    echo "Conectado :D";
}
?>