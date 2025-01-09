<?php

include_once '../entity/dbConnection.php';
include_once '../controller/controller.php';
include_once '../entity/clienteEntity.php';


class registroCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}



    public static  function procesaPost()
    {  
        $db = new Database();
        $db->getConnection();
        $post = self::cleanPost();

        if($post["action"]=="registro")
        {

            $result = new stdClass();
            $result->error = false;
            $result->message = null;

            $nombre = $post['nombre'];
            $user = $post['user'];
            $pass = $post['pass'];
            $email = $post['email'];
            $apellido1 = $post['apellido1'];
            $apellido2 = $post['apellido2'];
            $tel = $post['tel'];
            $rol = $post['rol'];

            try
            {
                $cliente = new clienteEntity;
                $cleanEmail = self::sanitize_email($email);

                if ($cliente->userExists($user) ? true : ($cliente->emailExists($email) ? true : false)){
                    throw new exception ("Email o nombre de usuario ya registrado.");

                }else{$passEncrypt = self::encriptarPassword($pass);

                $fechaSQL = date('Y-m-d H:i:s');
                $dni = "-";
                $cliente->insertUser($user, $nombre, $apellido1, $apellido2, $rol, $cleanEmail, $tel, $fechaSQL, $passEncrypt, $dni);

                $result->error = false;
                $result->message = "Registro exitoso.";
                }
                
            }catch(Exception $e)
            {
                $result->error = true;
                $result->message =  $e->getMessage();
            }
        }
       // header('Content-Type: application/json');
        echo json_encode($result);
    }
}

if(array_key_exists('controller', $_POST) && $_POST['controller']=="registroCtrl"){    

    registroCtrl::procesaPost();
    
}

