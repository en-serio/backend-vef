<?php

function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("El archivo .env no existe en la ruta especificada: $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar líneas de comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Separar clave y valor
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        // Cargar variable en el entorno si no existe
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}
