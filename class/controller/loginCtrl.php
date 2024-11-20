<?php

require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';
require_once '../entity/clienteEntity.php';



class loginCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}



    public static  function procesaPost()
    { 
            
            $db = new Database();
            $db->getConnection();
            $post = self::cleanPost();

            if($post["action"]=="login")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;

                $username = $post['user'];
                $password = $post['pass'];
                
              
                try
                {
                    $cliente = new clienteEntity();

                    if (!$cliente->verifyUser($username, $password)) 
                        throw new Exception ("Usuario o contraseña incorrecto. Vuelve a intentarlo");

                    $cliente->getClienteByUsername($username);
                    $rol = $cliente->getRol();
                        
                    $result->message = "Inicio de sesión exitoso";
                    session_start();
                    $_SESSION['user'] = $username;
                    $_SESSION['rol'] = $rol;

                    //aquí va la lógica de cargar los perfiles.


                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }
                
                
                echo json_encode($result);
                exit();
            }

            if($post["action"]=="logout")
            {
                    session_start();
                    session_unset();
                    $_SESSION = [];  
                    session_destroy(); 

                    echo json_encode(["error" => false, "message" => "Sesión cerrada correctamente"]);
                    exit;
                
            }


    }
}

if(array_key_exists('controller', $_POST) && $_POST['controller']=="loginCtrl"){    

    LoginCtrl::procesaPost();
    
}

