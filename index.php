<!-- <?php if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) { echo 'No tengo mysqli'; } else { echo 'Prueba tengo mysqli'; } ?> -->

<?php
require_once 'class/entity/Usuario.php';
require_once 'class/entity/Conexion.php';
require_once 'class/controller/LoginController.php';

$controlador = isset($_GET['c']) ? $_GET['c'] : 'LoginController';
$funcion = isset($_GET['a']) ? $_GET['a'] : 'mostrarLogin';

$claseControlador = ucfirst($controlador);

if (class_exists($claseControlador)) {
  $instancia = new $claseControlador();

  if (method_exists($claseControlador, $funcion)) {
      $instancia->$funcion();
  } else {
      echo "Ha ocurrido un error.";
  }
} else {
  echo "Ha sucedido un error.";
}
?>