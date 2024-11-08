<?php

class Router
{
    private $routes = [];

    // Agrega una nueva ruta
    public function addRoute($uri, $controllerAction)
    {
        $this->routes[$uri] = $controllerAction;
    }

    // Maneja la solicitud entrante
    public function handleRequest($requestUri)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        
        if (isset($this->routes[$uri])) {
            list($controllerName, $action) = explode('@', $this->routes[$uri]);
            $controller = new $controllerName();
            $controller->$action();
        } else {
            // Muestra la página de error si la ruta no existe
            echo "Error 404: Página no encontrada";
        }
    }
}
