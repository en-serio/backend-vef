<?php

session_start(); 
$user = $_SESSION['user'];
$rol = $_SESSION['rol']; 


require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';
require_once '../entity/clienteEntity.php';
require_once '../entity/transferVehiculoEntity.php';



class vehiculoCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}



    public static  function procesaPost()
    { 
            $db = new Database();
            $db->getConnection();
            $post = self::cleanPost();

            if($post["action"]=="loadPerfil")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;

                $user = $_SESSION['user'];
              
                try
                {
                   

                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }
                
                echo json_encode($result);
                exit();
            }

            if($post["action"]=="saveVehiculo")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;
                
                try
                {
                   
                 
                    
                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }
                
                echo json_encode($result);
                exit();
            }

            


    }
}

if(array_key_exists('controller', $_POST) && $_POST['controller']=="vehiculoCtrl"){    

    PerfilCtrl::procesaPost();
    
}

