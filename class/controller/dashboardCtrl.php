<?php

use PhpParser\Node\Stmt\Switch_;

session_start(); 
$user = $_SESSION['user'];
$rol = $_SESSION['rol']; 


include_once '../entity/dbConnection.php';
include_once '../controller/controller.php';
include_once '../entity/clienteEntity.php';
include_once '../entity/transferVehiculoEntity.php';



class dashboardCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}


    public static  function procesaPost()
    { 
            $db = new Database();
            $db->getConnection();
            $post = self::cleanPost();
           


    }
}

if(array_key_exists('controller', $_POST) && $_POST['controller']=="vehiculoCtrl"){    

    PerfilCtrl::procesaPost();
    
}

