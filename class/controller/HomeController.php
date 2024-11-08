<?php

class HomeController
{
    // Acción para la página de inicio
    public function index()
    {
        // Llama a la vista de inicio
        require_once './views/login.php';
    }

}

