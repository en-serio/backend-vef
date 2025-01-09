<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/userEntity.php';
/*include_once '../entity/dbConnection.php';
include_once '../controller/controller.php';
include_once '../entity/userEntity.php';*/

class controller
{
    
    protected static function cleanPost():array
    {

        $clean = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $clean;
    }

    protected static function cleanGet():array
    {
        $clean = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $clean;
    }

    protected static function encriptarPassword($password) :string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPass($passwordIngresado, $passwordEncriptado): string
    {
        return password_verify($passwordIngresado, $passwordEncriptado);
    }

    public static function sanitize_email($email) :string
    {
        $escaped_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        
        if (filter_var($escaped_email, FILTER_VALIDATE_EMAIL)) {
            return $escaped_email; 
        } else {
            return false;
        }
    }
}
