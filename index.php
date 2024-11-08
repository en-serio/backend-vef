<!-- <form action="vehiculo.php" method="post">
    Description: <input type="text" name="description">
    Email: <input type="text" name="email">
    Password <input type="password" name="password">
    <input type="submit">
</form> -->

<?php

// Autocarga de clases (con namespaces o PSR-4 en un proyecto más complejo)
require_once './router/Router.php';
//require_once './config/database.php';
require_once './class/controller/HomeController.php';


// Inicia el enrutador y define las rutas
$router = new Router();

// Define una ruta simple para la página de inicio
$router->addRoute('/', 'HomeController@index');


// Maneja la solicitud
$router->handleRequest($_SERVER['REQUEST_URI']);
