<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller
{
    /**
     * Limpia los datos enviados por POST.
     *
     * @param array $data
     * @return array
     */
    protected static function cleanPost(array $data): array
    {
        return filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    /**
     * Limpia los datos enviados por GET.
     *
     * @param array $data
     * @return array
     */
    protected static function cleanGet(array $data): array
    {
        return filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    /**
     * Encripta una contraseña utilizando el algoritmo predeterminado.
     *
     * @param string $password
     * @return string
     */
    protected static function encriptarPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifica si una contraseña ingresada coincide con la almacenada encriptada.
     *
     * @param string $passwordIngresado
     * @param string $passwordEncriptado
     * @return bool
     */
    protected static function verifyPass(string $passwordIngresado, string $passwordEncriptado): bool
    {
        return password_verify($passwordIngresado, $passwordEncriptado);
    }

    /**
     * Sanitiza y valida una dirección de correo electrónico.
     *
     * @param string $email
     * @return string|false
     */
    public static function sanitize_email(string $email)
    {
        $escaped_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        return filter_var($escaped_email, FILTER_VALIDATE_EMAIL) ? $escaped_email : false;
    }
}
